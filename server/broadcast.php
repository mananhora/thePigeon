<?php
   // Code design from http://www.tutorialspoint.com/sqlite/sqlite_php.htm
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('thepigeon.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      //echo "Opened database successfully\n";
   }
   // Data obtained from AJAX:
   // 1. $_POST["usernameVal"];
   // 2. $_POST["letter"];
   // Obtain the userid of the user who wrote the letter.
   $sqlgetsenderuserid = "SELECT userid FROM user WHERE username = '".$_POST["usernameVal"]."'";
   $ret = $db->query($sqlgetsenderuserid);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     $userid = $row['userid'];
   }
   // Store the letter.
   $sql = "INSERT INTO letter (content, userid) VALUES ("."'".$_POST["letter"]."'".", '".$userid."')";
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      //echo "Letter stored successfully.";
   }  
   // Obtain the letterid of the latest entry in the "letter" table, which corresponds to the letter that
   // was just inserted/stored before using this script.
   $sqlgetletterid = "SELECT letterid FROM letter";
   $ret = $db->query($sqlgetletterid);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     $letterid = $row['letterid'];
   }
   // Find the friends of the user currently logged in.
   $sqlfriendrequestid = "SELECT receiveruserid FROM friendrequest WHERE senderuserid = ".$userid;
   //$sqlfriendrequestid = "SELECT receiveruserid FROM friendrequest WHERE senderuserid = 1";
   $ret = $db->query($sqlfriendrequestid);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      // Use each iteration to send the letter to each of the recipients of the broadcast.
      //$receiveruserid .= $row['receiveruserid']." ";
      $receiveruserid = $row['receiveruserid'];
      $sqlsendletter = "INSERT INTO mailbox(letterid, senderuserid, receiveruserid) VALUES (".$letterid.", ".$userid.", ".$receiveruserid.");";
      $result = $db->exec($sqlsendletter);
      if(!$result){
         echo $db->lastErrorMsg();
      } else {
         //echo "Letter stored successfully.";
      } 
   }
   $db->close();
   //echo "Before".$receiveruserid."After".$sqlfriendrequestid."Now".$sqlsendletter;
   echo "Broadcast completed.";
?>

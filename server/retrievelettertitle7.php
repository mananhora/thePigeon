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
   // 1. $_POST["email"];
   // 2. $_POST["password"];
   /*$sql = "SELECT username FROM user WHERE username = '".$_POST["email"]."' AND password = '".$_POST["password"]."'";
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     echo $row['username'];
   }*/
   // Obtain userid that corresponds to the username that is active in the current session.
   $sqlobtainuserid = "SELECT userid FROM user WHERE username = '".$_GET['usernameVal']."'";
   $ret = $db->query($sqlobtainuserid);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     $useridobtained = $row['userid'];
   }
   //echo $useridobtained;
   // Obtain the letterid of the letter.
   $sqlletterid = "SELECT letterid FROM letter WHERE letterid IN (SELECT letterid FROM mailbox WHERE receiveruserid = (SELECT userid FROM user WHERE userid = ".$useridobtained.")) ORDER BY letterid DESC LIMIT 1 OFFSET 6;";
   $ret = $db->query($sqlletterid);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     $letterid = $row['letterid'];
   }
   // If the user has not received letters yet, exit the script.
   if($letterid == ''){
      return -1;
   }
   // If this user has not received letters yet, use "WHERE userid = 2" for demo purposes.
   if($letterid == ''){
      $sqlletterid = "SELECT letterid FROM letter WHERE letterid IN (SELECT letterid FROM mailbox WHERE receiveruserid = (SELECT userid FROM user WHERE userid = 2)) ORDER BY letterid DESC LIMIT 1 OFFSET 6;";
      $ret = $db->query($sqlletterid);
      while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $letterid = $row['letterid'];
      }
   }

   // Obtain the senderuserid of the letter.
   $sqlsenderuserid = "SELECT senderuserid FROM mailbox WHERE letterid = ".$letterid." LIMIT 1";
   $ret = $db->query($sqlsenderuserid);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     //echo $row['firstname'];
      $senderuserid = $row['senderuserid'];
   }
   //echo $senderuserid;

   // Obtain the first name that corresponds to a given userid.
   $sqlfirstname = "SELECT firstname FROM user WHERE userid = ".$senderuserid;
   $ret = $db->query($sqlfirstname);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     //echo $row['firstname'];
      $firstname = $row['firstname'];
   }
   // echo $firstname;

   // Obtain the last name that corresponds to a given userid.
   $sqllastname = "SELECT lastname FROM user WHERE userid = ".$senderuserid;
   $ret = $db->query($sqllastname);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     //echo $row['firstname'];
      $lastname = $row['lastname'];
   }

   echo $firstname." ".$lastname;
   //$sql = "SELECT firstname, lastname FROM user, mailbox WHERE user.userid = 3 AND user.userid = mailbox.receiveruserid AND letterid = (SELECT letterid FROM letter WHERE letterid IN (SELECT letterid FROM mailbox WHERE receiveruserid = (SELECT userid FROM user WHERE userid = 3)) ORDER BY letterid DESC LIMIT 1 OFFSET 0)";
   /*$sql = "SELECT firstname, lastname FROM user, mailbox WHERE user.userid = ".$useridobtained." AND user.userid = mailbox.receiveruserid AND letterid = (SELECT letterid FROM letter WHERE letterid IN (SELECT letterid FROM mailbox WHERE receiveruserid = (SELECT userid FROM user WHERE userid = ".$useridobtained.")) ORDER BY letterid DESC LIMIT 1 OFFSET 0)";
   $ret = $db->query($sql);
   echo $sql;
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     //echo $row['firstname'];
      echo $sql;
   }*/
?>

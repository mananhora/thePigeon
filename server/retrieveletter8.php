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
   // Return letters received by this user, sorted from most recent to least recent, skipping 7 results.
   $sql = "SELECT content FROM letter WHERE letterid IN (SELECT letterid FROM mailbox WHERE receiveruserid = (SELECT userid FROM user WHERE userid = ".$useridobtained.")) ORDER BY letterid DESC LIMIT 1 OFFSET 7;";
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     echo $row['content'];
   }
?>

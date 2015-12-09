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
   // 1. $_POST["firstname"];
   // 2. $_POST["lastname"];
   // 3. $_POST["email"];
   // 4. $_POST["password"];   
   $sql = "INSERT INTO user (username, password, firstname, lastname) VALUES ('".$_POST["email"]."', '".$_POST["password"]."', '".$_POST["firstname"]."', '".$_POST["lastname"]."')";
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      //echo " Sweet! You can now send pigeon posts! ";
   }
   // Obtain the userid of the user that was just created, which will be contained in the last row retrieved.
   $sqlgetuserid = "SELECT userid FROM user";
   $ret = $db->query($sqlgetuserid);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      $userid = $row['userid'];
   }
   // Add two default friends to the account that was previously created.
   $sqladdfriends = "
   INSERT INTO friendrequest(senderuserid, receiveruserid) VALUES (".$userid.", 2);
   INSERT INTO friendrequest(senderuserid, receiveruserid) VALUES (".$userid.", 3);
   ";
   $ret = $db->exec($sqladdfriends);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Friends added successfully.\n";
   }
   $db->close();
?>

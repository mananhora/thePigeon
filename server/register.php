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
   // 1. $_POST['firstname'];
   // 2. $_POST['lastname'];
   // 3. $_POST['email'];
   // 4. $_POST['password'];
   $sql = "INSERT INTO user (username, password, firstname, lastname) VALUES (".$_POST['email'].$_POST['password'].$_POST['firstname'].$_POST['lastname'].")";
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "success";
   }
   $db->close();
?>

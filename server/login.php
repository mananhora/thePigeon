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
      echo "Opened database successfully\n";
   }
   // Data obtained from AJAX:
   // 1. $_POST["email"];
   // 2. $_POST["password"];
   $sql = "SELECT username FROM user WHERE username = '".$_POST["email"]."' AND password = '".$_POST["password"]."'";
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     echo $row['username'];
   }
?>

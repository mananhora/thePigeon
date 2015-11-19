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
   $sql = "INSERT INTO letter (content, userid) VALUES ("."'".$_POST["letter"]."'".", '".$_POST["usernameVal"]."')";
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Letter stored successfully.";
   }
   $db->close();   
?>
<?php
   // Code obtained from http://www.tutorialspoint.com/sqlite/sqlite_php.htm
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
      echo "<div>Opened database successfully</div>\n";
   }
   // Creating tables.
   $sql = "
   CREATE TABLE user (userid integer primary key autoincrement, username varchar(25) not null, password varchar(25) not null, firstname varchar(25) not null, lastname varchar(25) not null);
   CREATE TABLE letter (letterid integer primary key autoincrement, content varchar(1000) not null, timestamp default current_timestamp not null, userid integer not null, foreign key(userid) REFERENCES user(userid));
   CREATE TABLE mailbox (mailboxid integer primary key autoincrement, letterid integer not null, senderuserid integer not null, receiveruserid integer not null, timestamp default current_timestamp not null, foreign key(letterid) REFERENCES letter(letterid), foreign key(senderuserid) REFERENCES user(userid), foreign key(receiveruserid) REFERENCES user(userid));
   ";
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "<div>Tables created successfully</div>\n";
   }
   $db->close();
?>

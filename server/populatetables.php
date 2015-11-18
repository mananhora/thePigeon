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
   // Populating tables.
   // Testing scenario.
   // 1. Three users: Mary, John, and Peter.
   $sql = "
   INSERT INTO user(username, password, firstname, lastname) VALUES ('marysturges', 'mary', 'Mary', 'Sturges');
   INSERT INTO user(username, password, firstname, lastname) VALUES ('johnwaring', 'john', 'John', 'Waring');
   INSERT INTO user(username, password, firstname, lastname) VALUES ('peterippolito', 'peter', 'Peter', 'Ippolito');
   ";
   // 2. Mary writes two letters.
   $sql .= "
   INSERT INTO letter(content, userid) VALUES ('I have been applying to internships and finally I received a job offer! However, I am going to fail one class and that will not be fun. I hope 2016 will be better than 2015!', 1);
   INSERT INTO letter(content, userid) VALUES ('Thanksgiving will be super special. I will go to New York City and after that, I will visit a good friend in Boston. I cannot wait!', 1);
   ";
   // 3. Mary sends one of her letters to Peter, and the other one to John and Peter.
   $sql .= "
   INSERT INTO mailbox(letterid, senderuserid, receiveruserid) VALUES (1, 1, 3);
   INSERT INTO mailbox(letterid, senderuserid, receiveruserid) VALUES (2, 1, 2);
   INSERT INTO mailbox(letterid, senderuserid, receiveruserid) VALUES (2, 1, 3);
   ";
   // 4. Peter writes one letter.
   $sql .= "
   INSERT INTO letter(content, userid) VALUES ('I am going to start volunteering next month. There is a community where kids do not have a space to play, so we will take them to a museum and show them schools nearby the area where they can meet students and play. I will be doing this every Friday, and it will good for me to relax, take a break, and do something positive for my community.', 3);
   ";
   // 5. Peter sends the only letter he has written, to Mary and John.
   $sql .= "
   INSERT INTO mailbox(letterid, senderuserid, receiveruserid) VALUES (3, 3, 1);
   INSERT INTO mailbox(letterid, senderuserid, receiveruserid) VALUES (3, 3, 2);
   ";
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
   $db->close();
?>

<?php
 $abc=mysql_connect("localhost","root","sardar");
  mysql_select_db("hostel",$abc);
  $name = $this->Session->read('user');
          $rollno = $name['username'];
?>

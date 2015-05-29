<?php
include("connectdatabase.php");
if($_GET['value']=="reject")
{
     $sender=$_GET['sender'];
    $query="delete from `request` where `sender`=$sender and `receiver` in (select `groupid` from `group` where `rollno`=$rollno)";
    mysql_query($query,$abc);
    
}
if($_GET['value']=="accept")
{
     $sender=$_GET['sender'];
     $query="select `receiver` from `request` where `sender`=$sender and `receiver` in (select `groupid` from `group` where `rollno`=$rollno)";
     $result=mysql_query($query,$abc);
     $data=mysql_fetch_array($result);
     if($data['receiver']!="")
     {
        $query="delete from `request` where `sender`=$sender or `receiver`=$sender or exists(select * from `group` where `rollno`=$rollno and (`groupid`=`receiver` or `groupid`=`sender`))";
        mysql_query($query,$abc);
        $receiver=$data['receiver'];
        $query="update `group` set `groupid`=$sender where `groupid`=$receiver"; 
        mysql_query($query,$abc);   
     }
}
if($_GET['value']=="Leave Group")
{
    
    $query="delete from `request` where exists (select * from `group` where `rollno`=$rollno and (`groupid`=`receiver` or `groupid`=`sender`))";
    mysql_query($query,$abc);
    $query="delete from `group` where `rollno`=$rollno";
   mysql_query($query,$abc);
   $query="insert into `group`(`rollno`) values ($rollno)";
   mysql_query($query,$abc);
}
if($_GET['value']=="delete request")
{
    $receiver=$_GET['receiver'];
    $query="delete from `request` where `receiver`=$receiver and `sender` in (select `groupid` from `group` where `rollno`=$rollno)";
    mysql_query($query,$abc);
}


?>
<script type="text/javascript">
window.location = "http://localhost/hostel/index.php/grouping/requestnew"; 
</script>
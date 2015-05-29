<?php
include("connectdatabase.php");
$rollnor=$_GET['choice'];
$query="select `groupid` from `group` where `rollno`=$rollnor";
$result=mysql_query($query);
$data=mysql_fetch_array($result);
$idr=$data['groupid'];
$cansend=true;
$name = $this->Session->read('user');
          $rollno = $name['username'];
          
 $query="select `year`,`gender`,`course` from `users` where `rollno`=$rollno or `rollno`=$rollnor";
$result=mysql_query($query);
$data=mysql_fetch_array($result);
$data1=mysql_fetch_array($result);
 if($data['year']==$data1['year'] && $data['course']==$data1['course'] && $data['gender']==$data1['gender'])
  {
$query="select `groupid` from `group` where `rollno`=$rollno";
$result=mysql_query($query);
$data=mysql_fetch_array($result);
$ids=$data['groupid'];
$query = "select `rollno`,g.`groupid`,u.`name` from `group` as g Natural Join `users` as u where g.`groupid` = $ids order by `cgpi` desc";
$result=mysql_query($query);
$i=0;
while($data=mysql_fetch_array($result))
{
    if($data['rollno']!=$rollno && $i==0)
    $cansend=false;
    $i++;
}
$c1=$i;
$query = "select `rollno`,g.`groupid`,u.`name` from `group` as g Natural Join `users` as u where g.`groupid` = $idr order by `cgpi` desc";
$result=mysql_query($query);
$i=0;
while($data=mysql_fetch_array($result))
{
    if($data['rollno']!=$_GET['choice'] && $i==0)
    $cansend=false;
    $i++;
}
if($c1+$i>$maxgroupsize)
    $cansend=false;
$query="insert into `request` values ('$ids','$idr')";
if($cansend)
mysql_query($query);
  }
?>
<script type="text/javascript">
window.location = "http://localhost/hostel/index.php/grouping/requestnew"; 
</script>
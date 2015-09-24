<?php

class Panel extends AppModel
{
     var $name = 'Panel';
     var $useTable = false;
     
     
     function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
    }

     
     function passwordgen()
     {
         $query = "select username from users where username like '12m%'";
         $result=$this->query($query);
         foreach($result as $data)
         {
             $username = $data['users']['username'];
             $string = $this->randomPassword();
             $query = "update users set password='$string' where username='$username'";
             $this->query($query);
           
         }
       
     }
     function adminaccess($name)
     {
         $query="select admin,formfill from users where username='$name'";
         $result=$this->query($query);
         $result=$result[0]['users'];
         if(empty ($result))
             $result=0;
      
         return $result;
     }
     function hostel()
     {
         $query="select hostel from rooms group by hostel";
         $result=$this->query($query);
         return $result;
     }
     function room($hostelname)
     { 
         $query="SELECT * FROM rooms AS r WHERE r.hostel = '$hostelname' AND r.room_no NOT IN ( SELECT room_no FROM roomsrestriction)";
         $result=$this->query($query);
         return $result;
     }
     function notroom($hostelname)
     { 
         $query="SELECT * FROM rooms AS r natural join roomsrestriction as rr WHERE r.hostel = '$hostelname'";
         $result=$this->query($query);
         return $result;
     }
   
       function adddataintoroomre($room,$year,$capacity,$course,$gender)
       {
         $query="INSERT INTO `roomsrestriction`(`room_no`, `year`, `capacity`, `course`,`gender`) VALUES ('$room','$year','$capacity','$course','$gender')"; 
         $result=$this->query($query);  
       }
       function editroom($hostel)
       {
            $query="DELETE FROM `roomsrestriction` where room_no in (SELECT room_no FROM rooms WHERE hostel = '$hostel')";
            $result=$this->query($query);
       }
        function editaroom($roomno)
       {
            $query="DELETE FROM `roomsrestriction` where room_no='$roomno'";
            $result=$this->query($query);
       }
       function userinfo($rollno)
       {
           $query="select cgpi,year,course,gender,name,department,email,mobileno from users where rollno='$rollno'";
           $result=$this->query($query);
           return $result[0]['users'];
       }
       function eligiblehostels($rollno,$capacity,$userinfo)
       {
           $year=$userinfo[0]['config']['year'];
           $gender=$userinfo[0]['config']['gender'];
           $course=$userinfo[0]['config']['course'];
         $query="select r.hostel from rooms as r natural join roomsrestriction as rr where rr.year='$year' and rr.gender='$gender' and rr.course='$course' and rr.capacity='$capacity' group by r.hostel";
         $result=$this->query($query);
         return array_values($result);
       }
       function reloadlist($rollno)
       {
           $query="select `room_no`,`pre_rank` from `prefrence` where `groupid` in (select `groupid` from `group` where `rollno`='$rollno') order by `pre_rank`";
           $result=$this->query($query);
           return $result;
       }
       function remove($rollno,$roomno)
       {
           $query="delete from `prefrence` where `room_no`='$roomno' and `groupid` in (select `groupid` from `group` where `rollno`='$rollno') order by `pre_rank`";
           $result=$this->query($query);
       }
       function up($rollno,$roomno)
       {
           $roomlist=$this->reloadlist($rollno);
           if($roomlist[0]['prefrence']['room_no']!=$roomno)
           {
               $pre_rankfirst=0;
               $pre_ranklast=0;
               foreach ($roomlist as $data)
               {
                   $pre_ranklast=$data['prefrence']['pre_rank'];
                   if($data['prefrence']['room_no']==$roomno)
                   {
                       break;
                   }
                   $pre_rankfirst=$data['prefrence']['pre_rank'];
               }
            $query="UPDATE `prefrence` SET `pre_rank`='10000' WHERE room_no='$roomno' and `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
           $query="UPDATE `prefrence` SET `pre_rank`=$pre_ranklast WHERE pre_rank='$pre_rankfirst' and `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
           $query="UPDATE `prefrence` SET `pre_rank`=$pre_rankfirst WHERE room_no='$roomno' and `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
           }
       }
        function down($rollno,$roomno)
       {
           $roomlist=$this->reloadlist($rollno);
           $i=sizeof(array_keys($roomlist));
           if($roomlist[$i-1]['prefrence']['room_no']!=$roomno)
           {
               $pre_rankfirst=0;
               $pre_ranklast=0;
               $j=0;
               foreach ($roomlist as $data)
               {
                   $pre_rankfirst=$data['prefrence']['pre_rank'];
                   if($data['prefrence']['room_no']==$roomno)
                   {
                       $pre_ranklast=$roomlist[$j+1]['prefrence']['pre_rank'];
                       break;
                   }
                   $j++;
               }
            $query="UPDATE `prefrence` SET `pre_rank`='10000' WHERE room_no='$roomno' and `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
           
           $query="UPDATE `prefrence` SET `pre_rank`=$pre_rankfirst WHERE pre_rank='$pre_ranklast' and `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
           $query="UPDATE `prefrence` SET `pre_rank`=$pre_ranklast WHERE room_no='$roomno' and `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
           }
       }
       function update($rollno,$roomno,$groupsize,$userinfo)
       {
           $year=$userinfo[0]['config']['year'];
           $gender=$userinfo[0]['config']['gender'];
           $course=$userinfo[0]['config']['course'];
           $query="select room_no from roomsrestriction where year='$year' and gender='$gender' and course='$course' and capacity='$groupsize' and room_no='$roomno'";
           $result=$this->query($query);
           if(isset($result[0]['roomsrestriction']['room_no']))
           {
           $query="select `pre_rank`,`groupid` from `prefrence` where `groupid` in (select `groupid` from `group` where `rollno`='$rollno') order by `pre_rank` desc";
           $result=$this->query($query);
           if(isset ($result))
           {
               $query="select `groupid` from `group` where `rollno`='$rollno'";
               $result1=$this->query($query);
               $groupid=$result1[0]['group']['groupid'];
           }
           else
           $groupid=$result[0]['prefrence']['groupid'];    
           $highestrank=$result[0]['prefrence']['pre_rank']+1;
           $query="INSERT INTO `prefrence`(`groupid`, `room_no`, `pre_rank`) VALUES ('$groupid','$roomno','$highestrank')";
           if(count($result)<20)
           $result=$this->query($query);

           }
       }
       function removeall($rollno)
       {
           $query="DELETE FROM `prefrence` WHERE `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
       }
       function eligibleroom($rollno,$capacity,$userinfo)
       {
           $course=$userinfo[0]['config']['course'];
           $year=$userinfo[0]['config']['year'];
           $gender=$userinfo[0]['config']['gender'];
           $query="select `room_no` from `roomsrestriction` where `year`='$year' and `gender`='$gender' and `course`='$course' and capacity='$capacity' and `room_no` not in (select `room_no` from `prefrence` where `groupid` in (select `groupid` from `group` where `rollno`='$rollno'))";
           $result=$this->query($query);
           return $result;
       }
       function noteligibleroom($rollno,$capacity,$userinfo)
       {
            $course=$userinfo[0]['config']['course'];
           $year=$userinfo[0]['config']['year'];
           $gender=$userinfo[0]['config']['gender'];
          
            $query="select room_no from rooms where room_no not in (select room_no from roomsrestriction where year='$year' and gender='$gender' and course='$course' and capacity='$capacity')";

          // $query="select r.room_no from roomsrestriction as rr natural join rooms as r where (rr.year<>'$year' or rr.gender<>'$gender' or rr.course<>'$course' or rr.capacity<>'$capacity') and r.hostel in (select r.hostel from rooms as r natural join roomsrestriction as rr where rr.year='$year' and rr.gender='$gender' and rr.course='$course' and rr.capacity = '$capacity' group by r.hostel) union select room_no from rooms where hostel in (select r.hostel from rooms as r natural join roomsrestriction as rr where rr.year='$year' and rr.gender='$gender' and rr.course='$course' and capacity='$capacity' group by r.hostel) and room_no not in (select room_no from roomsrestriction)";
           $result=$this->query($query);
           //pr($result);
          $abc="";
           foreach($result as $data)
               $abc.=$data['rooms']['room_no'].",";
            $abc.="#hostel#".",";
           $query="select `room_no` from `prefrence` where `groupid` in (select `groupid` from `group` where `rollno`='$rollno')";
           $result=$this->query($query);
           foreach($result as $data)
               $abc.=$data['prefrence']['room_no'].",";
           return $abc;
           
       }
       function time2seconds($time='00:00:00')
{
    list($hours, $mins, $secs) = explode(':', $time);
    return ($hours * 3600 ) + ($mins * 60 ) + $secs;
}
       function scheduler($date,$time,$gap)
       {
           $query="delete from config";
           $this->query($query);
           $datetime1=$date." ".$time;
           $timestamp = strtotime($datetime1);
           $timestampofgap = $this->time2seconds($gap); 
           $query="select year,course,gender from users group by year,course,gender";
           $result=$this->query($query);
          
           foreach ($result as $data)
           {
               $year=$data['users']['year'];
               $course=$data['users']['course'];
               $gender=$data['users']['gender'];
               $query="select capacity from roomsrestriction where year='$year' and course='$course' and gender='$gender' group by capacity order by capacity";
               $result1=$this->query($query);
              
               $temp=$timestamp;
               $datetime=date("Y-m-d H:i:s", $timestamp);
               foreach( $result1 as $data1)
               {
                        if($data1['roomsrestriction']['capacity']==1)
                        {
                            $enddatetime=date("Y-m-d H:i:s", $temp+$timestampofgap);
                            $query="INSERT INTO `config`(`course`, `year`, `gender`, `fillchoice`, `grouping`, `groupsize`, `time`, `endtime`) VALUES ('$course','$year','$gender','1','0','1','$datetime','$enddatetime')";
                            $this->query($query);
                            $temp=$temp+$timestampofgap;
                            $datetime=date("Y-m-d H:i:s", $temp);
                        }
                        else if($data1['roomsrestriction']['capacity']>1)
                        {
                            $capacity=$data1['roomsrestriction']['capacity'];
                            $enddatetime=date("Y-m-d H:i:s", $temp+$timestampofgap);
                            $query="INSERT INTO `config`(`course`, `year`, `gender`, `fillchoice`, `grouping`, `groupsize`, `time`, `endtime`) VALUES ('$course','$year','$gender','0','1','$capacity','$datetime','$enddatetime')";
                            $this->query($query);
                            $temp=$temp+$timestampofgap;
                            $datetime=date("Y-m-d H:i:s", $temp);
                            $enddatetime=date("Y-m-d H:i:s", $temp+$timestampofgap);
                            $query="INSERT INTO `config`(`course`, `year`, `gender`, `fillchoice`, `grouping`, `groupsize`, `time`, `endtime`) VALUES ('$course','$year','$gender','1','0','$capacity','$datetime','$enddatetime')";
                            $this->query($query);
                            $temp=$temp+$timestampofgap;
                            $datetime=date("Y-m-d H:i:s", $temp);
                        }
                        
               }
           }
          
       }
       function configinfo($rollno)
       {
           date_default_timezone_set("Asia/Kolkata");
           $info=$this->userinfo($rollno);
           $year=$info['year'];
           $gender=$info['gender'];
           $course=$info['course'];
           $currenttime=time();
           $currenttime=date("Y-m-d H:i:s", $currenttime);
           $query="select fillchoice,grouping,groupsize,year,gender,course from config where year='$year' and gender='$gender' and course='$course' and time <'$currenttime' and endtime > '$currenttime'";
           $result=$this->query($query);
        
           if(!isset($result[0]['config']['groupsize']))
           {
               $result[0]['config']['groupsize']=0;
               $result[0]['config']['fillchoice']=0;
               $result[0]['config']['grouping']=0;
           }
            return $result;
       }
       function timetable()
       {
           $query="select * from config order by gender desc,`course`,`year`,`time`";
           $result=$this->query($query);
           return $result;
       }
       function fillinfoforuser($col1,$col2)
       {
           $query="select * from admintable where col1='$col1' and col2='$col2'";
           $result=$this->query($query);
           if(isset($result[0]['admintable']['col1']))
               return true;
               return false;
       }
        function pickinfoforuser($col2)
       {
           $query="select * from admintable where col2='$col2'";
           $result=$this->query($query);
           return $result;
       }
       function displayaalroom($hostelname)
       {
           $query="select room_no from rooms where hostel='$hostelname'";
             $result=$this->query($query);
           return $result;
       }
       function removeroom($room)
       {
           $query="delete from rooms where room_no='$room'";
            $result=$this->query($query);
       }
       function insertroom($room,$block,$hostel)
       {
           $temp=$block."-".$room;
           
           if(!empty($block) && !empty($hostel))
           {
               $query="INSERT INTO `rooms`(`room_no`, `hostel`) VALUES ('$temp','$hostel')";
               $result=$this->query($query);
           }
       }
       function deleteadmintable($col1,$col2)
       {
           $query="delete from admintable where `col1`='$col1' and `col2`='$col2'";
           $this->query($query);
           if($col2 == 'course')
           {
                 $temp=$col1."#%";
               $query="delete from admintable where `col1` like '$temp'";
               $this->query($query);
           }
           if($col2=='hostel')
           {
               $temp=$col1."-%";
               $query="delete from admintable where `col1` like '$temp'";
               $this->query($query);
           }
       }
       function addintoadmintable($col1,$col2)
       {
           $query="insert into admintable(col1,col2) values ('$col1','$col2')";
           $this->query($query);
       }
       function admincol2()
       {
           $query="select col2 from admintable group by col2";
           $result=$this->query($query);
           return $result;
       }
       function userlist($admin)
       {
           $query="select username from users where admin='$admin'";
           $result=$this->query($query);
           return $result;
       }
    
       function deleteuser($username)
       {
           $query="delete from users where username='$username'";
           $result=$this->query($query);
       }
       function adduser($username,$admin,$hostel)
       {
           if($hostel=="123")
           $query="INSERT INTO `users`(`username`, `password`, `year`, `name`, `admin`, `department`, `course`, `gender`, `email`, `rollno`, `cgpi`, `category`, `fathername`, `dob`, `bloodgroup`, `mobileno`, `pincode`, `permanentadd`)
   VALUES ('$username','$username','','','$admin','','','','','$username','','','','','','','','')"; 
        else
            $query="INSERT INTO `users`(`username`, `password`, `year`, `name`, `admin`, `department`, `course`, `gender`, `email`, `rollno`, `cgpi`, `category`, `fathername`, `dob`, `bloodgroup`, `mobileno`, `pincode`, `permanentadd`)
   VALUES ('$username','$username','','','$admin','$hostel','','','','$username','','','','','','','','')"; 
           $result=$this->query($query);
       }
       function mmcaroom($name)
       {
           $query="select r.room_no from (select rooms.room_no from rooms left join mmcaroomcapacity on rooms.room_no=mmcaroomcapacity.room_no where hostel in (select department from users where username='$name') and rooms.room_no not in (select room_no from olduserdataofrooms) and capacity <> '0' union (select temp1.room_no from (select count(room_no) as totalmember,room_no from olduserdataofrooms natural join rooms where hostel in (select department from users where username='$name') group by room_no) as temp1 natural join mmcaroomcapacity where temp1.totalmember < capacity)) as r order by r.room_no";
         
           $result=$this->query($query);
           return $result;
       }
       function mmcaroomcapacity($name)
       {
           $query="select temp1.room_no,temp1.capacity,temp2.rollno from (select rooms.room_no,capacity from rooms left join (select count(room_no) as capacity,room_no from olduserdataofrooms group by room_no) as temp on rooms.room_no=temp.room_no where rooms.hostel in (select department from users where username='$name')) 
               as temp1 left join (select rollno,room_no from olduserdataofrooms where room_no in (select room_no from rooms where hostel in (select department from users where username='$name'))) as temp2 on temp1.room_no=temp2.room_no";
           $result=$this->query($query);
           return $result; 
           
                 }
       function mmcauser($name)
       {
            $query="select rollno from rooms where  in (select department from users where username='$name')";
           $result=$this->query($query);
           return $result;
       }
         function mmcaroomlist($name)
       {
           $query="select temp2.room_no,temp1.capacity from  (select mmca.room_no,mmca.capacity from mmcaroomcapacity as mmca natural join rooms where hostel in (select department from users where username='$name')) as temp1 right join (select room_no from rooms where hostel in (select department from users where username='$name')) as temp2 on temp1.room_no=temp2.room_no";
           $result=$this->query($query);
          
           return $result;
       }
       function insertintommca($a,$b)
       {
           $query="INSERT INTO `mmcaroomcapacity`(`room_no`, `capacity`) VALUES ('$a','$b')";
           $this->query($query);
       }
       function editmmcaroom($name)
       {
           $query="delete from mmcaroomcapacity where room_no in (select room_no from rooms where hostel in (select department from users where username='$name'))";
           $this->query($query);
       }
       function addintooldtable($a,$b,$database)
       {
           $query="INSERT INTO `$database`(`rollno`, `room_no`) VALUES ('$a','$b')";
           $this->query($query);
       }
       function removedatafromoldtable($rollno,$database)
       {
           $query="delete from $database where rollno='$rollno'";
           $this->query($query); 
       }
       function totalpage($capacity,$name)
       {
           $query="select count(rollno) as num  from olduserdataofrooms natural join rooms where hostel in (select department from users where username='$name')";
           $result=$this->query($query);
           return ceil($result[0][0]['num']/$capacity);
       }
       function userlistpage($name,$pageno,$capacity)
       {
           $query="select old.rollno,validation,name from olduserdataofrooms as old natural join rooms natural join users where hostel in (select department from users where username='$name')";
           $result=$this->query($query);
           $result=array_chunk($result,$capacity);
         
          return $result[$pageno - 1];
       }
       function validationofuser($rollno,$validate)
       {
           $query="update users set validation='$validate' where rollno='$rollno'";
           $this->query($query);
       }
       function searchdata($data,$capacity,$colname,$name)
       {
           //$query="select users.rollno,users.name,users.validation from users natural join olduserdataofrooms natural join rooms where hostel in (select department from users where username='$name') and ( rollno like '%$data%' or name like '%$data%' or fathername like '%$data%' or cgpi like '%$data%' or bloodgroup like '%$data%'or year like '%$data%')";
           $query="select users.rollno,users.name,users.validation,users.password,rooms.room_no from users left join (olduserdataofrooms natural join rooms) on users.rollno=olduserdataofrooms.rollno  where hostel in (select department from users where username='$name') and users.".$colname." like '%$data%'"; 
           $result=$this->query($query);
           $totalpage=ceil(count($result)/$capacity);
           $result=array_chunk($result,$capacity);
           $result['totalpage']=$totalpage;
           return $result;
       }
       function adminsearch($data,$capacity,$colname)
       {
           $query="select users.rollno,users.name,users.validation,users.password,rooms.room_no from users left join (olduserdataofrooms natural join rooms) on users.rollno=olduserdataofrooms.rollno  where users.".$colname." like '%$data%'";
            $result=$this->query($query);
           $totalpage=ceil(count($result)/$capacity);
           $result=array_chunk($result,$capacity);
           $result['totalpage']=$totalpage;
           return $result;  
       }
       function alluser()
       {
           $query="(select username,formfill from users where admin='0' and formfill='1') union (select username,formfill from users where admin='0' and formfill='0')";
             $result=$this->query($query);
             $i=0;
             foreach ($result as $data) {
                 if($data['0']['formfill'])
                     $result[$i]['0']['formfill']='ON';
                 else
                     $result[$i]['0']['formfill']='OFF';
                 $i++;
             }
             return $result;
       }
       function formfillpermissionon($name)
       {
           if($name=='all')
           $query="update users set formfill='1',validation='0' where admin='0'";
           else
               $query="update users set formfill='1',validation='0' where username='$name'";
           $this->query($query);
       }
        function formfillpermissionoff($name)
       {
           if($name=='all')
           $query="update users set formfill='0' where admin='0'";
           else
               $query="update users set formfill='0' where username='$name'";
           $this->query($query);
       }
       function adminroomcapacity($hostel,$database)
       {
           $query="select temp1.room_no,temp1.capacity,temp2.rollno from (select rooms.room_no,capacity from rooms left join (select count(room_no) as capacity,room_no from $database group by room_no) as temp on rooms.room_no=temp.room_no where rooms.hostel='$hostel') 
               as temp1 left join (select rollno,room_no from $database where room_no in (select room_no from rooms where hostel ='$hostel')) as temp2 on temp1.room_no=temp2.room_no";
           $result=$this->query($query);
           return $result; 
       }
       function adminroom($hostel,$database)
       {
           $query="select r.room_no from (select rooms.room_no from rooms left join roomsrestriction on rooms.room_no=roomsrestriction.room_no where hostel='$hostel' and rooms.room_no not in (select room_no from $database) and capacity <> '0' union (select temp1.room_no from (select count(room_no) as totalmember,room_no from $database natural join rooms where hostel='$hostel' group by room_no) as temp1 natural join roomsrestriction where temp1.totalmember < capacity)) as r order by r.room_no";
           $result=$this->query($query);
           return $result;
       }
       function adminalluser($database)
       {
           $query="select username from users where admin='0' and rollno not in (select rollno from $database)";
           $result=$this->query($query);
           return $result;
       }
       function exportdata($data)
       {
           $j=0;
           $k=0;
           $i=0;
           $query="select ";
           $total=count($data);
           
           $total=$total-6;
           if(isset($data['rollno']))
           {
               $query=$query."users.$data[rollno]";
               $i++;$k++;
           }
           if(isset($data['name']))
           {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[name]";
               $i++;$k++;
           }
           if(isset($data['fathername']))
                  {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[fathername]";
               $i++;$k++;
           }
       
              if(isset($data['password']))
                  {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[password]";
               $i++;$k++;
           }
           if(isset($data['roomno']))
                  {
               $j++;
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."rooms.$data[roomno]";
               $i++;
           }
           if(isset($data['hostel']))
                  {
                  $j++;
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[hostel]";
               $i++;
           }
           
       
               
              if(isset($data['email']))
                  {
                  
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[email]";
                $i++;$k++;
           }
              if(isset($data['category']))
                  {
               
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[category]";
                $i++;$k++;
           }
              if(isset($data['bloodgroup']))
                  {
                 
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[bloodgroup]";
                $i++;$k++;
           }
              if(isset($data['mobileno']))
                  {
                 
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[mobileno]";
                $i++;$k++;
           }
              if(isset($data['mothername']))
                  {
                 
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[mothername]";
                $i++;$k++;
           }
              if(isset($data['comment']))
                  {
                
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[comment]";
                $i++;$k++;
           }
           
           
           
           if(isset($data['course']))
                  {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[course]";
               $i++;$k++;
           }
           if(isset($data['department']))
                  {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[department]";
               $i++;$k++;
           }
           if(isset($data['gender']))
                  {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[gender]";
               $i++;$k++;
           }
           if(isset($data['cgpi']))
                  {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[cgpi]";
               $i++;$k++;
           }
           if(isset($data['dob']))
                  {
               if($i>0&&$i<$total)
                   $query=$query.",";
               $query=$query."$data[dob]";
               $i++;$k++;
                  }        
               $table=$data['dataset'];
               $course=$data['courseid'];
               $year=$data['yearid'];
               $department=$data['departmentid'];
               $hostel=$data['hostelid'];
               $query2=$query." from ((`$table` right join `rooms` on $table.room_no = rooms.room_no) right join users on $table.rollno=users.rollno) where (admin='0' " ;
               $query1=$query." from ((`$table` right join `rooms` on $table.room_no = rooms.room_no) left join users on $table.rollno=users.rollno) where (admin='0' ";
              if($j>0&&$k==0)
              {
                  $query1=$query1."or admin is null";
                  $query2=$query2."or admin is null";
              }
              $query1=$query1.") ";
              $query2=$query2.") ";
               $i=0;
              $end="";
              if($course!='%')
              $end="and course like '$course' ";
             
              if($department!='%')
              $end=$end."and department like '$department' ";
                
              
              if($year!='%')
              $end=$end."and year like '$year' ";
               if($hostel!='%')
                  $end=$end."and rooms.hostel like '$hostel'";
              
              $query=$query1.$end." union ".$query2.$end;
              $data = $this->query($query);
              return $data;
            }
  function allotmentalgo($course,$year,$gender,$capacity)
   {
      $insertlist=array();
      $roomlist=array();
      $query="select room_no,capacity from roomsrestriction where course='$course' and year='$year' and gender='$gender' and capacity='$capacity'";
      $result1=$this->query($query);
     // echo $query;
      foreach($result1 as $data)
      {
          $roomlist[$data['roomsrestriction']['room_no']]=$data['roomsrestriction']['capacity'];
      }
      $query="select temp.groupid,temp.totalmember,room_no,temp.ncgpi from prefrence natural join (select count(*) as totalmember,`groupid`,max(`ncgpi`) as ncgpi,max(cgpi) as cgpi from `group` NATURAL JOIN `users` where course='$course' and year='$year' and gender='$gender' group by `groupid` order by `groupid`,`ncgpi` desc) as temp order by temp.ncgpi desc,temp.cgpi desc,temp.groupid,pre_rank";
      // echo "</br>".$query;
      $result2=$this->query($query);
    //  pr($result2);
      $query="select distinct temp.groupid,temp.totalmember from prefrence natural join (select count(*) as totalmember,`groupid`,max(`ncgpi`) as ncgpi,max(cgpi) as cgpi from `group` NATURAL JOIN `users` where course='$course' and year='$year' and gender='$gender' group by `groupid` order by `groupid`,`ncgpi` desc) as temp order by temp.ncgpi desc,temp.cgpi desc,temp.groupid";
     //  echo "</br>".$query;
      $result3=$this->query($query);
     // pr($result3);
      $idback=-1;
      $index=0;
      $id;
      foreach ($result2 as $data)
      {
          $id=$data['temp']['groupid'];
          if($id==$idback)
              continue;
          $canput=false;
          $roomno=$data['prefrence']['room_no'];
          if($result3[$index]['temp']['groupid']!=$id)
          {
                   foreach ($result1 as $nav)
                   {
                          if( $result3[$index]['temp']['totalmember']<=$roomlist[$nav['roomsrestriction']['room_no']])
                            {
                                   $insertlist[]=array($result3[$index]['temp']['groupid'],$nav['roomsrestriction']['room_no']);
                                   $roomlist[$nav['roomsrestriction']['room_no']]= $roomlist[$nav['roomsrestriction']['room_no']]-$result3[$index]['temp']['totalmember'];  
                                   $index++;
                                   break;
                            }
                           
                    } 
         }
         
            if( $data['temp']['totalmember']<=$roomlist[$roomno])
             {
                    $idback=$id;
                    $index++;
                    $insertlist[]=array($id,$roomno);
                    $roomlist[$roomno]-=$data['temp']['totalmember'];
             }
          } 
          if(!empty($insertlist))
          if($insertlist[count($insertlist)-1][0]!=$id)
          {
                   foreach ($result1 as $nav)
                   {
                          if( $result3[$index]['temp']['totalmember']<=$roomlist[$nav['roomsrestriction']['room_no']])
                            {
                                   $insertlist[]=array($result3[$index]['temp']['groupid'],$nav['roomsrestriction']['room_no']);
                                   $roomlist[$nav['roomsrestriction']['room_no']]= $roomlist[$nav['roomsrestriction']['room_no']]-$result3[$index]['temp']['totalmember'];  
                                   $index++;
                                   break;
                            }
                           
                    } 
         }
          
          $query = "select groupid,users.rollno from `group` natural join users  where year='$year' and course='$course' and gender='$gender' order by groupid ";
         $results= $this->query($query);
         $grouprollrelation = array();
         foreach($results as $data)
         {
             $gid = $data['group']['groupid'];
            $grouprollrelation[$gid][] = $data['users']['rollno'];
         }
          $listinsert=array();
          foreach($insertlist as $data)
              foreach($grouprollrelation[$data[0]] as $tempdata)
                  $listinsert[]=array($tempdata,$data[1]);
          
         
          return $listinsert;
      
      }
 
    function randomalgo($course,$year,$gender)
    {
        $insertlist=array();
        $roomlist=array();
        $query="select temp1.room_no,(temp1.full - ifnull(temp2.fill,0)) as total from (select room_no,capacity as full from roomsrestriction where course='$course' and year='$year' and gender='$gender') as temp1 left join (select count(*) as fill,room_no from newuserdataofrooms natural join users where course='$course' and year='$year' and gender='$gender' group by room_no) as temp2 on temp1.room_no=temp2.room_no";
        $result=$this->query($query);
        $query="select users.rollno from `group` natural join `users` where course='$course' and year='$year' and gender='$gender' and rollno not in (select rollno from newuserdataofrooms) order by ncgpi desc";
        $result1=$this->query($query);
        foreach($result1 as $data)
        {
            
            $roll=$data['users']['rollno'];
            $i=0;
            foreach($result as $temp)
            {
                $room=$temp['temp1']['room_no'];
               if($temp[0]['total']>=1)
               {
                   
                   $insertlist[]=array($roll,$room);
                   $result[$i][0]['total']-=1;
                   break;
               }
               $i++;
            }
        }
      
       return $insertlist;
        
    }
         function normalize()
        {
             $insertlist=array();
             $query="select course,year,department from users where admin='0' and course <> '' and year <> '0' and department <> '' group by course,year,department";
                $result=$this->query($query);
                foreach ($result as $data)
                {
                     $course=$data['users']['course'];
                    $year=$data['users']['year'];
                    $department=$data['users']['department'];
                    $query="select rollno,cgpi from users where course='$course' and year='$year' and department='$department' and admin='0' order by cgpi desc";
                    $result12=$this->query($query);
                    $total=count($result12)-1;
                    if($total<=1)
                    $total=10/($total+1);
                    else
                        $total=10/($total-1);
                    $i=10;
                    foreach($result12 as $temp)
                    {
                        $insertlist[]=array($temp['users']['rollno'],$i);
                        $i=$i-$total;
                    }
                }
             //   pr($insertlist);
                
                $query = "UPDATE users SET ncgpi = CASE rollno ";
                
                foreach($insertlist as $results)
                {
                   $query .="when '$results[0]' then '$results[1]' ";
                }
                $query .="end";
                $this->query($query);
         }
         function validationpage($value,$capacity)
         {
             if($value==3)
             $query="select name,users.rollno,validation,hostel from users left join ( rooms natural join olduserdataofrooms ) on users.rollno=olduserdataofrooms.rollno where admin='0'";
             else
             $query="select name,users.rollno,validation,hostel from users left join ( rooms natural join olduserdataofrooms ) on users.rollno=olduserdataofrooms.rollno where admin='0' and validation='$value'";
            $result=$this->query($query);
            $totalpage=ceil(count($result)/$capacity);
            $result=array_chunk($result,$capacity);
            $result['totalpage']=$totalpage;
            return $result; 
             
         }
          function mmcavalidationpage($value,$capacity,$name)
         {
             if($value==3)
             $query="select name,users.rollno,validation,hostel from users left join ( rooms natural join olduserdataofrooms ) on users.rollno=olduserdataofrooms.rollno where hostel in (select department from users where username='$name') and  admin='0'";
             else
             $query="select name,users.rollno,validation,hostel from users left join ( rooms natural join olduserdataofrooms ) on users.rollno=olduserdataofrooms.rollno where hostel in (select department from users where username='$name') and  admin='0' and validation='$value'";
            $result=$this->query($query);
            $totalpage=ceil(count($result)/$capacity);
            $result=array_chunk($result,$capacity);
            $result['totalpage']=$totalpage;
            return $result; 
             
         }
         function otherchoicegroup($name)
         {
             $course=$name['course'];
             $year=$name['year'];
             $gender=$name['gender'];
             $query="select temp.groupid,temp.totalmember,temp.ncgpi,kas.rollno from (select count(*) as totalmember,`groupid`,max(`ncgpi`) as ncgpi,max(cgpi) as cgpi from `group` NATURAL JOIN `users` where course='$course' and year='$year' 
             and gender='$gender' group by `groupid` order by `ncgpi` desc,cgpi desc) as temp natural join (select groupid,rollno,ncgpi as y from `group` natural join users ) as kas order by temp.ncgpi desc,temp.cgpi desc,temp.groupid,kas.y desc";
             // $query="select groupid,count(rollno) as capacity,rollno,ncgpi from group natural join users where course=$course and year=$year and gender=$gender group by groupid order by groupid,ncgpi desc)";
             //$query="select temp1.capacity,temp2.rollno from (select rooms.room_no,capacity from (select count(room_no) as capacity,room_no from olduserdataofrooms group by room_no) as temp on rooms.room_no=temp.room_no where rooms.hostel in (select department from users where username='$name')) 
               //as temp1 left join (select rollno,room_no from olduserdataofrooms where room_no in (select room_no from rooms where hostel in (select department from users where username='$name'))) as temp2 on temp1.room_no=temp2.room_no";
           $result=$this->query($query);
           return $result; 
        }
        function otherprefrence($name,$user)
        {
            $course=$user['course'];
            $year=$user['year'];
            $gender=$user['gender'];
            $query="select room_no from prefrence where groupid in (select groupid from `group` natural join users where rollno='$name' and year='$year' and course='$course' and gender='$gender') order by pre_rank";
            $result=$this->query($query);
            if(!empty($result))
            return $result; 
        }
        function otheruserinfo($rollno,$user)
        {
              $course=$user['course'];
            $year=$user['year'];
            $gender=$user['gender'];      
           $query="select * from users where rollno='$rollno' and year='$year' and course='$course' and gender='$gender'";
           $result=$this->query($query);
           if(!empty($result))
           return $result[0]['users'];
    
       }
       function eligibleuserlist()
       {
           $query="select rollno from users where admin='0' and rollno not in (select rollno from `group`) and rollno not in (select rollno from newuserdataofrooms) and validation='1'";
           $result=$this->query($query);
           return $result;
       }
       function studentgrouplist()
       {
           $query="select rollno from `group`";
           $result=$this->query($query);
           return $result;
       }
       function deletegrouplist($var)
       {
            $query="delete from `group` where rollno in(";
            foreach($var['sm'] as $data)
                $query=$query."'$data',";
              $query = substr($query, 0, strlen($query)-1);
            $query=$query.")";
            $this->query($query);
       }
       function addintogroup($var)
       {
          
           $query="insert into `group` (`groupid`, `rollno`) VALUES";
            foreach($var['su'] as $data)
                $query=$query."(NULL,'$data'),";
             $query = substr($query, 0, strlen($query)-1);
             $this->query($query);
             
       }
}
?>

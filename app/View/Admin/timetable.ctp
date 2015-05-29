

  <div id='adminmenu' style='background-color:#9B1C26' >
 <ul style='display:inline'>
 
     <li> <a href="<?php echo $base_url  ?>/admin/scheduling"> Scheduling </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/formfillpermission " > Formfillpermissions </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/timetable " > TimeTable </a> </li>
      <li> <a href="<?php echo $base_url  ?>/admin/copytogroup " > Allow Students</a> </li>
       <li> <a href="<?php echo $base_url  ?>/admin/copynewtoold " >Copy new to old</a> </li>
 </ul></div>



<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$i=0;
$yearpre="";
$genderpre="";
$coursepre="";
foreach($timetabledata as $data)
{
    $course=$data['config']['course'];
    $year=$data['config']['year'];
    $gender=$data['config']['gender'];
    if($gender=="male")
        $gender="Boys";
    else
        $gender="Girls";
    $groupsize=$data['config']['groupsize'];
    $timestart=$data['config']['time'];
    $timeend=$data['config']['endtime'];
    $fillchoice=$data['config']['fillchoice'];
    $grouping=$data['config']['grouping'];
    if( ($yearpre!=$year || $coursepre!=$course || $genderpre!=$gender)||$i==0)
    {
        echo "<div id='timetableheader'>$course $year year $gender timtable </div><br />";
        $j=0;
        
        }
      
           $j++;
           if($fillchoice)
           {
               echo "<div id='timetablesubheader'>$j. $year year choice filling of rooms for $groupsize capacity ,starts from $timestart to $timeend</div><br />";
           }
           else
           {
               echo "<div id='timetablesubheader'>$j. $year year grouping of $groupsize members ,starts from $timestart to $timeend</div><br />";
           }
         $yearpre=$year;
    $genderpre=$gender;
    $coursepre=$course;
    $i++;
}
?>

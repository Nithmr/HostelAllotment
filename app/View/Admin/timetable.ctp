<?php
  echo $this->Html->script('jquery.js');
  echo $this->Html->script('moment.js');
  echo $this->Html->script('bootstrap.js');
  echo $this->Html->script('bootstrap-datetimepicker.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->css('bootstrap-datetimepicker.min.css');
  echo $this->Html->css('metisMenu.min.css');
  echo $this->Html->css('sb-admin-2.css');
 ?>

  <div id='adminmenu' class="row" >
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-th-list"></i> Time Table
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Another Settings
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="<?php echo $base_url  ?>/admin/scheduling"> Scheduling </a>
                                        </li>
                                        <li><a href="<?php echo $base_url  ?>/admin/formfillpermission " > Formfillpermissions </a>
                                        </li>
                                        <li><a href="<?php echo $base_url  ?>/admin/timetable " > TimeTable </a>
                                        </li>
                                        <li ><a href="<?php echo $base_url  ?>/admin/copytogroup " > Allow Students</a></li>
                                        <li><a href="<?php echo $base_url  ?>/admin/copynewtoold " >Copy new to old</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


<div class="panel-body">
<?php


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
        echo "<div id='timetableheader'><h3>$course <small>$year year $gender timtable </small></h3></div><br />";
        $j=0;
        
        }
      
           $j++;
           if($fillchoice)
           {
               echo "<div id='timetablesubheader'>$j. &nbsp &nbsp $year year choice filling of rooms for $groupsize capacity ,starts from $timestart to $timeend</div><br /> <hr />";
           }
           else
           {
               echo "<div id='timetablesubheader'>$j.&nbsp &nbsp $year year grouping of $groupsize members ,starts from $timestart to $timeend</div><br />";
           }
         $yearpre=$year;
    $genderpre=$gender;
    $coursepre=$course;
    $i++;
}
?>
</div>
</div>
</div>

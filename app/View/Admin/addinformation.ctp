<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo $this->Html->script('jquery.js');
echo $this->Html->script('moment.js');
echo $this->Html->script('bootstrap.js');
echo $this->Html->script('bootstrap-datetimepicker.js');
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('bootstrap-datetimepicker.min.css');
echo $this->Html->css('metisMenu.min.css');
echo $this->Html->css('sb-admin-2.css');
?>

<div class="col-lg-10">
<div class=" panel panel-default" id="masterdiv" >
	    <div class="panel-heading">
        Modify Information
    </div>
    <div id="addinfoleft" class="panel panel-body" >
        <ul class='nav nav-pills'>
            <?php
                $temp=$base_url."/admin/addinformation?link=category";
                echo "<li><a href='$temp'>CATEGORY</a></li>";
                 $temp=$base_url."/admin/addinformation?link=year";
                echo "<li><a href='$temp'>YEAR</a></li>";
                 $temp=$base_url."/admin/addinformation?link=course";
                echo "<li><a href='$temp'>COURSE</a></li>";
                 $temp=$base_url."/admin/addinformation?link=department";
                echo "<li><a href='$temp'>DEPARTMENT</a></li>";
                 $temp=$base_url."/admin/addinformation?link=hostel";
                echo "<li><a href='$temp'>HOSTEL</a></li>";
                 $temp=$base_url."/admin/addinformation?link=hostel-block";
                echo "<li><a href='$temp'>HOSTEL-BLOCK</a></li>";
            ?>
            
        </ul>
    
     <?php
        if(isset($selectedlink))
        {
        ?>
    <div id="addinfomid" style="width: 35%; float: left; padding-left: 40px" >
        <br /><br /><br />
        <form action="" method="post">
   
       <?php 
    if($selectedlink == "hostel-block")
    {
       echo "<label>Hostel</label><br /><select class='form-control' id='hostellist' name='hostellist' >";           
            foreach ($hostellist as $data) {
            $year = $data['admintable']['col1'];
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
           echo " </select>  "; 
    }
    
    if($selectedlink == "year" || $selectedlink == "department")
    {
       echo "<label>Course</label><br /><select class='form-control' id='hostellist' name='course' >";           
            foreach ($courselist as $data) {
            $year = $data['admintable']['col1'];
            echo "<option  value=$year><div>  &nbsp&nbsp   $year </div></option>";                                                
            }
           echo " </select>  "; 
    }
    ?>
    <br />
           <p /> <label><?php echo $selectedlink; ?> </label><br /><input class='form-control' type="text" name="textfield" /> <p /><br />
    <input class='btn btn-outline btn-default' type="hidden" name="link" <?php echo "value='$selectedlink'";?> /> <p />
   <br />
        <input class='btn btn-outline btn-default' type="submit" name="set" value='<?php echo "add ".$selectedlink; ?>' /> <p />
        </form>
    </div>
    <div id="addinforight" style="width: 33%; float: left" >
     <br /><br />
        <form style="margin-left:50px" method="post" action="">
<select class='form-control' style=" width:300px ; " size="10" name="selecteditem[]"> 
    <?php              
           foreach ($col1list as $data) {
            $year = $data['admintable']['col1'];
            
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
</select>
             <input class='btn btn-outline btn-default' type="hidden" name="link" <?php echo "value='$selectedlink'";?> /></br>
        <input class="btn btn-outline btn-default" type="submit" name="set" value="remove" />
        </form>
        <?php
        }
        ?>
    </div>
</div>
</div>
</div>
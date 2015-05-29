<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div id="masterdiv" style="width: 100%  " >
    <div id="addinfoleft" style="width: 24%; float: left; margin-top: 40px; border: 1px dotted #CC3333 ; " >
        <ul>
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
    </div>
     <?php
        if(isset($selectedlink))
        {
        ?>
    <div id="addinfomid" style="width: 35%; float: left; padding-left: 40px" >
        <br /><br /><br /><br /><br /><br />
        <form action="" method="post">
   
       <?php 
    if($selectedlink == "hostel-block")
    {
       echo "<label>Hostel</label><br /><select id='hostellist' name='hostellist' >";           
            foreach ($hostellist as $data) {
            $year = $data['admintable']['col1'];
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
           echo " </select>  "; 
    }
    
    if($selectedlink == "year" || $selectedlink == "department")
    {
       echo "<label>Course</label><br /><select id='hostellist' name='course' >";           
            foreach ($courselist as $data) {
            $year = $data['admintable']['col1'];
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
           echo " </select>  "; 
    }
    ?>
           <p /> <label><?php echo $selectedlink; ?> </label><br /><input type="text" name="textfield" /> <p />
    <input type="hidden" name="link" <?php echo "value='$selectedlink'";?> /> <p />
   
        <input type="submit" name="set" value='<?php echo "add_".$selectedlink; ?>' /> <p />
        </form>
    </div>
    <div id="addinforight" style="width: 33%; float: left" >
     <br /><br />
        <form method="post" action="">
<select style=" width:300px ; " size="10" name="selecteditem[]"> 
    <?php              
           foreach ($col1list as $data) {
            $year = $data['admintable']['col1'];
            
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
</select>
             <input type="hidden" name="link" <?php echo "value='$selectedlink'";?> />
        <input type="submit" name="set" value="remove" />
        </form>
        <?php
        }
        ?>
    </div>
</div>
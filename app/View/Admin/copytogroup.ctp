<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

  <div id='adminmenu' style='background-color:#9B1C26' >
 <ul style='display:inline'>
 
     <li> <a href="<?php echo $base_url  ?>/admin/scheduling"> Scheduling </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/formfillpermission " > Formfillpermissions </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/timetable " > TimeTable </a> </li>
      <li> <a href="<?php echo $base_url  ?>/admin/copytogroup " > Allow Students</a> </li>
       <li> <a href="<?php echo $base_url  ?>/admin/copynewtoold " >Copy new to old</a> </li>
 </ul></div>
<div>
    <form method="post" action="">
    <select style=" width:300px ; " size="10" name="su[]" multiple> 
    <?php              
           foreach ($userdatalist as $data) {
            $year = $data['users']['rollno'];
            
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
</select>
     <input type="submit" name="action2" value="add>>" />
     </form>
    <form method="post" action="">
    <select style=" width:300px ; " size="10" name="sm[]" multiple> 
    <?php              
           foreach ($groupdatalist as $data) {
            $year = $data['group']['rollno'];
            
            echo "<option value=$year ><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
</select>
        <input type="submit" name="action" value="remove" />
    </form>
    <div></div>
    <div></div>
</div>
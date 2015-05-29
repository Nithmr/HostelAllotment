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

<div style="padding: 10%">
    <a href="<?php echo $base_url  ?>/admin/copynewtoold?normalize=normalize" onclick="return confirm('Are you sure?')" ><input style="margin-bottom: 20px;" type="button" value="Redefine the ranks only press when new ranks to be created" /></a><br />
    <a href="<?php echo $base_url  ?>/admin/copynewtoold?newtoold=newtoold" onclick="return confirm('old data will be deleted and new data(result) will be copied')" ><input style="margin-bottom: 20px;" type="button" value="Copy Data from  new records to old table only press after allotment " /></a><br />
    <a href="<?php echo $base_url  ?>/admin/copynewtoold?deletenew=deletenew" onclick="return confirm('new data(result) will be deleted')" ><input style="margin-bottom: 20px;" type="button" value="Delete New Table Record Only press during new allotment" /></a><br />
</div>
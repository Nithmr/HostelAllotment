<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$formaction = "$base_url/admin/scheduling";
?>

<style>
  
    option
    {
        word-spacing: 35px;
        margin-left: 15px;
    }
    
    
</style>
 
  <div id='adminmenu' style='background-color:#9B1C26' >
 <ul style='display:inline'>
 
     <li> <a href="<?php echo $base_url  ?>/admin/scheduling"> Scheduling </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/formfillpermission " > Formfillpermissions </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/timetable " > TimeTable </a> </li>
      <li> <a href="<?php echo $base_url  ?>/admin/copytogroup " > Allow Students</a> </li>
       <li> <a href="<?php echo $base_url  ?>/admin/copynewtoold " >Copy new to old</a> </li>
 </ul></div>




<div id="content">
    
    <form method="post" action="<?php echo $base_url ?>/admin/formfillpermission" >
        <label>Select</label>
        <select size="20" name="rollno">
            <option value="all"> ALL </option>
            <?php 
            foreach($alluser as $data)
            {
                $roll=$data['0']['username'];
                $formset=$data['0']['formfill'];
                echo "<option value='$roll'>$roll $formset</option>";
            }
            ?>
        </select>
        <br />
       
        <input type="submit" value="ON" name="set"/>
        <input type="submit" value="OFF" name="set"/>
    </form>
</div>
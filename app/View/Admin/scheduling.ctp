<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$formaction = "$base_url/admin/scheduling";
//echo $this->HTML->script('jquery-ui-sliderAccess.js');
//echo $this->HTML->script('ui.jquery.js');
//echo $this->HTML->script('jquery-ui-timepicker-addon.js');
//echo $this->HTML->css('design.css');
//echo $this->Html->script('jquery.datepicker.js');
 //   echo $this->Html->css('datepicker.css');

  echo $this->Html->script('datetime.js');
  echo $this->Html->css('datetime.css');
?>

<script type="text/javascript" >
$(document).ready(function() 
{
$("#date").AnyTime_picker(
      { format: "%Y-%m-%d",
        formatUtcOffset: "%: (%@)",
        hideInput: false
         } );


$("#time").AnyTime_picker(
      { format: "%H:%i:%s",
        
        hideInput: false
         } );

})
</script>

  <div id='adminmenu' style='background-color:#9B1C26' >
 <ul style='display:inline'>
 
     <li> <a href="<?php echo $base_url  ?>/admin/scheduling"> Scheduling </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/formfillpermission " > Formfillpermissions </a> </li>
     <li> <a href="<?php echo $base_url  ?>/admin/timetable " > TimeTable </a> </li>
      <li> <a href="<?php echo $base_url  ?>/admin/copytogroup " > Allow Students</a> </li>
       <li> <a href="<?php echo $base_url  ?>/admin/copynewtoold " >Copy new to old</a> </li>
 </ul></div>



<div id="content">
    
    <form style="margin-left: 15px;" method="get" action=<?php echo $formaction ?> >
    
      <p>  <label>  date </label><input type="text" id="date" name="date"/> </p>
      <p>  <label> time </label><input type="text" id="time" name="time"/> </p>
      <p>  <label> event gap in hours </label> <input type="text" id="gap" name="gap"/> </p>
        <input type="submit" />
    </form>
</div>
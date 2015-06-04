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

  echo $this->Html->script('jquery.js');
  echo $this->Html->script('moment.js');
  echo $this->Html->script('bootstrap.js');
  echo $this->Html->script('bootstrap-datetimepicker.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->css('bootstrap-datetimepicker.min.css');
  echo $this->Html->css('metisMenu.min.css');
  echo $this->Html->css('sb-admin-2.css');
?>

<script type="text/javascript" >
$(document).ready(function() 
{
$(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'L',
			viewMode: 'years'
                });
                $('#date').datetimepicker({
                    format: 'L',
			viewMode: 'years'
                });
                $('#time').datetimepicker({
                    format: 'LT',
			viewMode: 'years'
                });
		$('#datetimepicker4').datetimepicker({
                    format: 'LT',
			viewMode: 'years'
                });
            });

})
</script>
 <div id='adminmenu' class="row" >
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-th-list"></i> Scheduling
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
 </br>
<div class="container" id="content" >
<form method="get" action=<?php echo $formaction ?> >
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker3'>
                    <span class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                    </span>
                    <input type='text' name='date' id='date' class="form-control" placeholder="Date"/>
                </div>
            </div>
        </div>
        
    </div>
</div>
</br>
<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker4'>
		    <span class="input-group-addon">
                        <span class="fa fa-circle-o-notch"></span>
                    </span>
                    <input type='text' name='time' id='time' class="form-control" placeholder="Time" />
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
</br>
<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker5'>
		    <span class="input-group-addon">
                        <span class="fa fa-circle-o-notch"></span>
                    </span>
                    <input type='text' name='gap' id='gap' class="form-control" placeholder="Difference in Rounds in Hours" />
                    
                </div>
            </div>
        </div>
        
    </div>
<input type="submit" class="btn btn-outline btn-primary" style="margin-left: 240px;" />
</div>
</br>
</div>

</form>
</div>

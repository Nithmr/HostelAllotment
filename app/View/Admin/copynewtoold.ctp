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

  <div id='adminmenu' class="row" >
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-th-list"></i> Copy New to Old
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
<div style="margin-left: 24px;margin-right: 24px;">
</br>
    <a href="<?php echo $base_url  ?>/admin/copynewtoold?normalize=normalize" onclick="return confirm('Are you sure?')" ><input class="btn btn-outline btn-block" type="button" value="Redefine the ranks only press when new ranks to be created" /></a><br />
    <a href="<?php echo $base_url  ?>/admin/copynewtoold?newtoold=newtoold" onclick="return confirm('old data will be deleted and new data(result) will be copied')" ><input class="btn btn-outline btn-block" type="button" value="Copy Data from  new records to old table only press after allotment " /></a><br />
    <a href="<?php echo $base_url  ?>/admin/copynewtoold?deletenew=deletenew" onclick="return confirm('new data(result) will be deleted')" ><input class="btn btn-outline btn-block" type="button" value="Delete New Table Record Only press during new allotment" /></a><br />
</div>
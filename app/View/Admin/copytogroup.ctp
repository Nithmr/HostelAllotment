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
				<i class="fa fa-th-list"></i> Allow Students
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
		<div class="form-group" style="margin-left: 24px;margin-right: 24px;" id="content">
			<form method="post" action="">
				<select multiple class="form-control" size="10" name="su[]"> 
					<?php              
					foreach ($userdatalist as $data) {
						$year = $data['users']['rollno'];

						echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
					}
					?>
				</select>
			</br>
			<input type="submit" name="action2" value="add" class="btn btn-outline btn-primary" style="margin-left: 240px;" />
		</br>
	</form>
</br>
<form method="post" action="" class="has-error">
	<select multiple class="form-control" size="10" name="sm[]"> 
		<?php              
		foreach ($groupdatalist as $data) {
			$year = $data['group']['rollno'];
			
			echo "<option value=$year ><div>  &nbsp&nbsp   $year </div></option>";
		}
		?>
	</select>
</br>
<input class="btn btn-outline btn-danger" style="margin-left: 240px;" type="submit" name="action" value="remove" />
</form>
<div>
	
</div>
<div>
	
</div>
</div>
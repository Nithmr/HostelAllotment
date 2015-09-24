<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$formaction = "$base_url/admin/scheduling";
  echo $this->Html->script('jquery.js');
  echo $this->Html->script('moment.js');
  echo $this->Html->script('bootstrap.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->css('metisMenu.min.css');
  echo $this->Html->css('sb-admin-2.css');
?>

<div id='adminmenu' class="row" >
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-th-list"></i> Form Fill Permissions
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
<form method="post" action="<?php echo $base_url ?>/admin/formfillpermission" >
    
                                            <label>Select Roll Number</label>
                                            <select size="20"  class="form-control" name="rollno">
                                                <option value="all"> ALL </option>
           						 <?php 
           							 foreach($alluser as $data)
           								 {
               									 $roll=$data['0']['username'];
               									 $formset=$data['0']['formfill'];
               									 echo "<option value='$roll'>$roll   &nbsp &nbsp &nbsp &nbsp    $formset</option>";
            								  }
          						  ?>
                                            </select>
 </br>
</br>
					<input type="submit" class="btn btn-outline btn-primary" value="ON" name="set" style="margin-left: 240px;"/>
        				<input type="submit" class="btn btn-outline btn-danger" value="OFF" name="set" style="margin-left: 240px;"/>
</form>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
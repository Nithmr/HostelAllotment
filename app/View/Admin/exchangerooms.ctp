
<?php 
echo $this->Html->script('jquery.js');
echo $this->Html->script('metisMenu.min.js');
echo $this->Html->script('bootstrap.js');
echo $this->Html->script('jquery.dataTables.min.js');
echo $this->Html->script('dataTables.bootstrap.min.js');
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('dataTables.responsive.css');
echo $this->Html->css('metisMenu.min.css');
echo $this->Html->css('sb-admin-2.css');

?>


<?php 
echo "<div class='panel panel-default' id='adminmenu' >";
echo"<div class='panel-heading'>
Room Exchange  
</div>";
echo "<ul class='nav nav-pills'>";
foreach($hostellist as $data)
{
 $hostel=$data['admintable']['col1'];
 echo     "<li><a href='$base_url/admin/exchangerooms?hostelname=$hostel' >$hostel</a></li>";


}
echo "</ul> </br>";
if($hostelname!='none')
{
    ?>
    <div id="exchangeroomsmaindiv" style="width: 100%;">
        <div id="tableinfo">
            <form method="post" action="" >
                <input type="radio" value="olduserdataofrooms"  name="database" checked onchange="this.form.submit();"/>Old Table Data
                <input type="radio" value="newuserdataofrooms" name="database" onchange="form.submit();" <?php if($database=='newuserdataofrooms') echo 'checked';?>/>New Table Data
            </form>
        </div>
        <div id="leftexchangeroomsdiv" style="width: 40%; float:left; padding-top: 200px" >
            <form method="post" action="" >
                <label>Roll No</label>
                <select class="form-control" style="width: 40%" name="rollno"/>
                <?php 
                foreach ($userlist as $data) {
                    $year = $data['users']['username'];
                    echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
                } ?>
            </select><br />
            <p />
            <label>Room No</label>
            <select class="form-control" style="width: 40%" name="roomno" >  
                <?php 
                foreach ($adminroomslist as $data) {
                    $year = $data['r']['room_no'];
                    echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
                } ?>
            </select>
            <p />
            <input type="hidden" value="<?php echo $database;?>" name="database" />
            <input class="btn btn-outline btn-default" type="submit" value="add>>" name="set">
        </form>
    </div>
    
    <div class="row" id="rightexchangeroomsdiv" style="width: 60%; float: left" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Rooms with Status
                </div>
                <form action ="" method="post" >
                   <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="statstable">
                            <thead>
                                <tr>
                                    <th>Room No.</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $capacity=0;$i=0;
                                foreach ($roomsentry as $data)
                                {

                                   if($i==$capacity)
                                   {
                                      echo "<tr>";
                                      $capacity=$data['temp1']['capacity'];
                                      $roomno = $data['temp1']['room_no'];
                                      if($capacity==null)
                                       $capacity=1;
                                   echo "<td rowspan='$capacity'>$roomno</td>";
                                   $i=1;
                                   $roll = $data['temp2']['rollno'];
                                   if($roll==null)
                                       echo "<td>empty</td>";
                                   else
                                    echo "<td> $roll <input type='radio' value='$roll' name='rollno' > </td>";
                                echo "</tr>";
                                continue;
                            }


                            $roll = $data['temp2']['rollno'];
                            echo "<tr><td> $roll <input type='radio' value='$roll' name='rollno' ></td></tr>";
                            $i++;



                        }

                        ?>
                    </tbody>
                </table>
                <input type="hidden" value="<?php echo $database;?>" name="database" />
                <input class="btn btn-outline btn-default" type="submit" value="remove" name="set"  />
            </form>
        </div>

    </div>

    <?php
}
?>

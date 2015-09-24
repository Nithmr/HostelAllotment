<?php
echo $this->Html->script('jquery.js');
echo $this->Html->script('moment.js');
echo $this->Html->script('bootstrap.js');
echo $this->Html->script('bootstrap-datetimepicker.js');
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('bootstrap-datetimepicker.min.css');
echo $this->Html->css('metisMenu.min.css');
echo $this->Html->css('sb-admin-2.css');
?>
<div class="col-lg-10">
    <div class="panel panel-default" id="masterdiv" style="width: 100%  " >
        <div class="panel-heading">
            Create New Account
        </div>
        <div class="panel-body" id="addinfoleft"  >
            <ul class="nav nav-pills">
                <?php
                $temp=$base_url."/admin/addremoveusers?link=user";
                echo "<li><a href='$temp'>CREATE USER ACCOUNT</a></li>";
                $temp=$base_url."/admin/addremoveusers?link=mmca";
                echo "<li><a href='$temp'>CREATE MMCA ACCOUNT</a></li>";
                ?>
            </ul>
            
            <?php
            if(isset($selectedlink))
            {
                ?>
                <br />
                <div  id="addinfomid" style="width: 30%; float: left; padding-left: 40px" >
                    <br />
                    <form action="" method="post">
                     
                     <?php 
                     if($selectedlink == "mmca")
                     {
                         
                         $heading="USER-NAME";
                         echo "<label>Hostel</label><br /><select style='width:80%' class='form-control' id='hostellist' name='hostel' >";           
                         foreach ($hostellist as $data) {
                            $year = $data['admintable']['col1'];
                            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
                        }
                        echo "</select><p />";
                    }
                    else if($selectedlink == "user")
                    {
                        
                        
                        $heading="ROLL NO";
                        
                    }
                    ?><br />
                    <p /> <label><?php echo $heading; ?> </label><br /><input style="width:80%" class="form-control" type="text" name="textfield" /> <p />
                    <input class="form-control" type="hidden" name="link" <?php echo "value='$selectedlink'";?> /> <p />
                    
                    <input class="btn btn-outline btn-default" type="submit" name="set" value="add" /> <p />
                </form>
            </div>
            <div id="addinforight" style="width: 33%; float: left" >
               <br /><br />
               <form  method="post" action="">
                <select class="form-control" style=" width:300px ; " size="10" name="selecteditem[]"> 
                    <?php              
                    foreach ($userlist as $data) {
                        $year = $data['users']['username'];
                        echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
                    }
                    ?>
                </select>
                <br />
                <input type="hidden" name="link" <?php echo "value='$selectedlink'";?> />
                <input class="btn btn-outline btn-default" type="submit" name="set" value="remove" />

            </form>
            <?php
        }
        ?>
    </div>
</div>
</div>
</div>
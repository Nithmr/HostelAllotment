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

<div class="panel panel-default">
    <div class="panel-heading">
        Rooms
    </div>
    <?php
    echo "<div id='adminmenu' class='panel-body'>";

    echo "<ul class='nav nav-pills'>";
    foreach ($hostellist as $data) {
     $hostel=$data['admintable']['col1'];
     echo     "<li><a href='$base_url/admin/addremoverooms?hostelname=$hostel' >$hostel</a></li>";
 }

 echo "</ul>";
 if ($hostelname!="none") {
    ?>

    <script type="text/javascript"> 

        function blocklistupdate()
        {

            $('#blocklist  option').remove();  
            var blocks = [];
            <?php
            $i=0;
            foreach($blocklist as $data)
            {
               echo "blocks[$i] = '". $data['admintable']['col1'] ."';" ;
               $i++;
           }
           ?>

           var value = $("#hostellist option:selected").val(); 
           for(var i=0;i<blocks.length;i++)
           {

            if(blocks[i].search(value)>=0)
            {
                <?php
                if(isset($selectblock))
                {
                 ?>
                 if(blocks[i] == '<?php echo $selectblock; ?>')
                 $('#blocklist').append('<option selected="selected" value="'+blocks[i]+'">'+blocks[i]+'</option>');
                 else
                    $('#blocklist').append('<option value="'+blocks[i]+'">'+blocks[i]+'</option>');
                <?php } 
                else
                    { ?>
                        $('#blocklist').append('<option value="'+blocks[i]+'">'+blocks[i]+'</option>');
                        <?php }
                        ?>

                    }
                }

            }
            $(document).ready(function() {
                blocklistupdate();
            }
            );

        </script>
        <div style="margin-left:110px;">
            <div style="width: 50%;float:left; padding-top: 60px; ">
               <form action="" method="post">
                 <label>Room No </label><input class="form-control" style="width:50%" type="text" name="roomno_add" /> <p /><br />
                 <label>Hostel List </label><select class="form-control" style="width:50%" onchange="blocklistupdate()" id="hostellist" name="hostellist" >
                 <?php              
                 foreach ($hostellist as $data) {
                    $year = $data['admintable']['col1'];
                    if($hostelname==$year)
                        echo "<option value=$year selected='selected'><div>     $year </div></option>";
                    else
                        echo "<option value=$year><div>     $year </div></option>";
                }
                ?>


            </select>
            <p /><br />
            <label> Blocks </label>
            <select class="form-control" style="width:50%" id="blocklist" name="blocklist">
            </select><br />
            <input type="hidden" name="hostelname" <?php echo "value='$hostelname'";?> /> <p />
            <input type="submit" name="set" class="btn btn-outline btn-default" value="addroom" /> <p />
        </form>
    </div>
    <div >
        <br />
        <form method="post" action="">
            <select class="form-control" style="width:300px ; " size="20" name="roomlist"> 
                <?php              
                foreach ($allroom as $data) {
                    $year = $data['rooms']['room_no'];

                    echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
                }
                ?>
            </select>
            <input type="hidden" name="hostelname" <?php echo "value='$hostelname'";?> />
            <input type="submit" name="set" value="remove" class="btn btn-outline btn-danger" />
        </form>
    </div>
</div>
<?php echo "</div>"; ?>
</div>
<?php
}
?>







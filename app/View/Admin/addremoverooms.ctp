<?php
    echo "<div id='adminmenu' style='background-color:#9B1C26' >";
 echo "<ul style='display:inline'>";
foreach($hostellist as $data)
{
   $hostel=$data['admintable']['col1'];
                       echo     "<li><a href='$base_url/admin/addremoverooms?hostelname=$hostel' >$hostel</a></li>";
                               
                            
}
echo "</ul></div>";
if($hostelname!="none")
{
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




<div style="width: 100%">
<div style="width: 50%;float:left; padding-top: 120px; ">
 <form action="" method="post">
    <label>Room No </label><input type="text" name="roomno_add" /> <p />
    <label>Hostel List </label><select onchange="blocklistupdate()" id="hostellist" name="hostellist" >
    <?php              
            foreach ($hostellist as $data) {
            $year = $data['admintable']['col1'];
            if($hostelname==$year)
                echo "<option value=$year selected='selected'><div>  &nbsp&nbsp   $year </div></option>";
            else
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
        
        
    </select>
    <p />
    <label> Blocks </label>
     <select id="blocklist" name="blocklist">
    </select>
    <input type="hidden" name="hostelname" <?php echo "value='$hostelname'";?> /> <p />
        <input type="submit" name="set" value="addroom" /> <p />
        </form>
</div>
<div style="width: 50%; float:left; padding-top: 20px; ">
    <br />
    <form method="post" action="">
<select style=" width:300px ; " size="25" name="roomlist"> 
    <?php              
           foreach ($allroom as $data) {
            $year = $data['rooms']['room_no'];
            
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
</select>
        <input type="hidden" name="hostelname" <?php echo "value='$hostelname'";?> />
        <input type="submit" name="set" value="remove" />
        </form>
    </div>
</div>
<?php
}
?>
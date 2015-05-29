<script type="text/javascript"> 


function checkAll(formname, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[formname].getElementsByTagName('input');
 
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
      checkboxes[i].checked = checktoggle;
    }
  }
}


function yearlistupdate()
{
    
$('#yearid  option').remove();  
    var blocks = [];
    <?php
    $i=0;
     foreach($yearlist as $data)
     {
       echo "blocks[$i] = '". $data['admintable']['col1'] ."';" ;
         $i++;
     }
    ?>
            
var value = $("#courseid option:selected").val(); 
for(var i=0;i<blocks.length;i++)
    {
        
        if(blocks[i].search(value)>=0)
            {
                 var nav=blocks[i].split('#',2);
                <?php if( isset($year))
                     { ?>
                if(nav[1] == '<?php echo $year; ?>')
               $('#yearid').append('<option selected value="'+nav[1]+'">'+nav[1]+'</option>');
               else
                   $('#yearid').append('<option value="'+nav[1]+'">'+nav[1]+'</option>');
               <?php
                     }
                  else { ?>
               $('#yearid').append('<option value="'+nav[1]+'">'+nav[1]+'</option>');
               <?php } ?>
            }
    }

}
$(document).ready(function() {
    yearlistupdate();
}
);

</script>
   <?php

    echo "<div id='adminmenu' style='background-color:#9B1C26' >";
 echo "<ul style='display:inline'>";
foreach($hostellist as $data)
{
   $hostel=$data['rooms']['hostel'];
                       echo     "<li><a href='$base_url/admin/roomproperties?hostelname=$hostel' >$hostel</a></li>";
                               
                            
}
echo "</ul></div>";
if($hostelname!="none")
{
 
?>
<div>
    <form name='abc' method='get' action=''>
              course:
        <select name='course' id="courseid" onchange="yearlistupdate()">
        <?php
        
        
         foreach($courselist as $data)
         {
             $temp=$data['admintable']['col1'];
             if(isset($course))
             {
                 if($temp!=$course)
                   echo "<option value='$temp'>$temp</option>";
                 else
                     echo "<option selected value='$temp'>$temp</option>";
            }
            else
                 echo "<option value='$temp'>$temp</option>";
         }
    ?>
      </select >
        year:
         <select name='year' id='yearid'>;
         </select>
    <?php echo"<input type='hidden' name='hostelname' value='$hostelname'/>";?>
  
        capacity:
        <select name='capacity' id='capacityid'>
           <?php if(isset ($capacity))
         echo "<option value='$capacity' selected='selected'>$capacity</option>";
           ?>
        <option value='0'>Room-lock</option>
        <option value='1'>1</option>
          <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        <option value='6'>6</option>
    </select>Gender:
    <select name='gender' id='genderid'>
        <?php
         
               foreach($genderlist as $data)
              {
             $temp=$data;         
            if(isset($gender))
             {
                if($gender!=$temp)
                echo "<option value='$temp'>$temp</option>";
                else
                echo "<option selected value='$temp'>$temp</option>";
              }
              else
                  echo "<option value='$temp'>$temp</option>";
         }
       ?>  
    </select></br>
    <table width="600px" style="text-align: center;">
        <tr>
            <th></th>
            <th>Room no.</th>
            <th>year</th>
            <th>capacity</th>
            <th>course</th>
            <th>gender</th>
        </tr>
    <?php
    foreach($roomno as $data)
    {
        $var=$data['r']['room_no'];
        echo "<tr><td><input type='checkbox' name='$var' value='$var'/></td><td>$var</td><td>empty</td><td>empty</td><td>empty</td><td>empty</td></tr>";
    }
    echo "<tr><td></td><td>---------</td><td>---------</td><td>---------</td><td>---------</td><td>---------</td></tr>";
    foreach($notroomno as $data)
    {
        $var=$data['r']['room_no'];
        $vary=$data['rr']['year'];
        $varca=$data['rr']['capacity'];
        $varco=$data['rr']['course'];
        $varg=$data['rr']['gender'];
        echo "<tr><td><input type='submit' name='$var' value='Edit' onclick='alternavneet()'/></td><td>$var</td><td>$vary</td><td>$varca</td><td>$varco</td><td>$varg</td></tr>";
    }
    
    ?>
    </table>
         <input style="height: 30px;left: 68%; position: fixed; top: 90%; width: 100px;" type="submit" value="submit" name="ok" />
         <a href="javascript:void();" style="height: 30px;left: 68%; position: fixed; top: 80%; width: 100px;" onclick="javascript:checkAll('abc', true);">check all</a>
         <a href="javascript:void();" style="height: 30px;left: 80%; position: fixed; top: 80%; width: 100px;" onclick="javascript:checkAll('abc', false);">uncheck all</a>
        </form></br>
  
 <?php     
    $temp="$base_url/admin/edit_room";
   echo "<form method='get' action='$temp'>";
   echo "<input type='hidden' name='hostelname' value='$hostelname'/>";
   ?>
            <input style="height: 30px;
    left: 80%;
    position: fixed;
    top: 90%;
    width: 100px;" type="submit" name="edit" value="Edit all room"/>
        </form>
</div>
    
<?php } ?>

</body>
</html>

<?php  echo $this->Html->script('jquery.js');
echo $this->Html->script('metisMenu.min.js');
echo $this->Html->script('bootstrap.js');
echo $this->Html->script('jquery.dataTables.min.js');
echo $this->Html->script('dataTables.bootstrap.min.js');
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('dataTables.responsive.css');
echo $this->Html->css('metisMenu.min.css');
echo $this->Html->css('sb-admin-2.css');

?>

<script type="text/javascript"> 
    function password123()
    {
          
    
    var pass=new Array(30);
    <?php 
    $i=0;
    foreach($valuserlist as $data)
    {
        $a=$data['users']['password'];
        echo "pass[$i]='$a';";
        $i++;
    }
    ?>    
          
document.getElementById("bpass").disabled = true;
 var tables,row, newCell;
tables = document.getElementsByTagName('table');
row = tables[0].rows[0];
  newCell = row.insertCell(1);
  newCell.appendChild(document.createTextNode('password'));
for (var i = 0; i < 30; i++) 
{
  row = tables[0].rows[i+1];
  newCell = row.insertCell(1);
  newCell.appendChild(document.createTextNode(pass[i]));
}


    }
</script>
<div id="viewinfocontent" class="panel panel-default">
<div class="panel-heading">
    Search for Information
</div><br /><div class="panel panel-body">
    <form  class="col-lg-3" method="get" action="<?php echo $base_url ?>/admin/search">
       <input class ="form-control"type="text" name="textfield" value="<?php echo $textfieldval; ?>" />
    <div class="radio">
        <br />
       <label> <input type="radio" name="searchfield" value="rollno" <?php if($searchfieldval == "rollno" || $searchfieldval=="") echo "checked"; ?>/>ROLLNO</label>
        <label><input type="radio" name="searchfield" value="name" <?php if($searchfieldval == "name") echo "checked"; ?>/>NAME</label>
        <label><input type="radio" name="searchfield" value="fathername" <?php if($searchfieldval == "fathername") echo "checked"; ?>/>FATHER NAME</label>
        <label><input type="radio" name="searchfield" value="mobileno" <?php if($searchfieldval == "mobileno") echo "checked"; ?>/>MOBILE NO.</label>
        <label><input type="radio" name="searchfield" value="bloodgroup" <?php if($searchfieldval == "bloodgroup") echo "checked"; ?>/>BLOOD GROUP</label>
        </div>
    
    <input type="submit" class ="btn btn-default btn-outline" name="search" value="search" /><p />
    </form>
    <input id="bpass" type="button" name="show" value="show-password" onclick="password123()"/>
    
<div id="validationdiv">
    <?php if($noofpages!=0){ ?>    
    <div id="pageno">
   
        <script type="text/javascript"> 
        $(function() {
    $('#pageno').pagination({
      pages :<?php echo $noofpages ?>,
        cssStyle: 'light-theme',
        displayedPages:10,
        edges:1,
        currentPage: <?php echo $currentpage ?>,
        
        hrefTextPrefix:"<?php echo "$base_url/admin/search?search=search&textfield=$textfieldval&searchfield=$searchfieldval&pageno=" ?>"
    });
});    

        </script>
        
    
   
    </div></div>
        <?php } ?>
    <div id="contenttable">
        <table border ="1" width="600px">
            <thead>
                <tr>
                    <th>
                        rollno
                    </th>
                    <th>
                        name
                    </th>
                    <th>
                        room no.
                    </th>
                     <th>
                        viewinfo
                    </th>
                     <th>
                        status
                    </th>
                </tr>
            </thead>
            <?php 
            if(!empty($valuserlist))
            {
                foreach($valuserlist as $data)
                {
                
                $rollno = $data['users']['rollno'];
                $validation = $data['users']['validation'];
                $name = $data['users']['name'];
                $room=$data['rooms']['room_no'];
                echo "<tr  class='validation$validation'><td  >$rollno</td>";
                if(empty ($name))
                    $name='empty';
               
                echo  "<td>$name</td>"; 
                echo  "<td>$room</td>"; 
                echo "<td><a href='$base_url/admin/viewinformation?pageno=$currentpage&search=search&textfield=$textfieldval&searchfield=$searchfieldval&rollno=$rollno'>view more </a></td>";
               
                echo "<td>";
                
               
                
                if($validation==1)
                {
                    echo "validated";
                }
                elseif ($validation==2) 
                {
                    echo "not validate";    
                }
                else
                    echo "yet to vaidate";
                echo '</td>';
                echo"</tr>";
                }
            }
            
            ?>
            
        </table>
    </div>
</div>
</div>
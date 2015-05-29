<?php
?>
<div id="masterdiv" style="width: 100%  " >
    <div id="addinfoleft" style="width: 24%; float: left; margin-top: 40px; border: 1px dotted #CC3333 ; " >
        <ul>
            <?php
                $temp=$base_url."/admin/addremoveusers?link=user";
                echo "<li><a href='$temp'>CREATE USER ACCOUNT</a></li>";
                $temp=$base_url."/admin/addremoveusers?link=mmca";
                echo "<li><a href='$temp'>CREATE MMCA ACCOUNT</a></li>";
            ?>
        </ul>
    </div>
     <?php
        if(isset($selectedlink))
        {
        ?>
    <div id="addinfomid" style="width: 35%; float: left; padding-left: 40px" >
        <br />
        <form action="" method="post">
   
       <?php 
    if($selectedlink == "mmca")
    {
       echo "<label>CREATE MMCA ACOUNT</label><br /><br /><br />";
       $heading="USER-NAME";
       echo "<label>Hostel</label><br /><select id='hostellist' name='hostel' >";           
            foreach ($hostellist as $data) {
            $year = $data['admintable']['col1'];
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            echo "</select><p />";
    }
    else if($selectedlink == "user")
    {
        echo "<label>CREATE USER ACOUNT</label><br /><br /><br />";
    
        $heading="ROLL NO";
        
    }
    ?>
           <p /> <label><?php echo $heading; ?> </label><br /><input type="text" name="textfield" /> <p />
    <input type="hidden" name="link" <?php echo "value='$selectedlink'";?> /> <p />
   
        <input type="submit" name="set" value="add" /> <p />
        </form>
    </div>
    <div id="addinforight" style="width: 33%; float: left" >
     <br /><br />
        <form method="post" action="">
<select style=" width:300px ; " size="10" name="selecteditem[]"> 
    <?php              
           foreach ($userlist as $data) {
            $year = $data['users']['username'];
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
</select>
             <input type="hidden" name="link" <?php echo "value='$selectedlink'";?> />
        <input type="submit" name="set" value="remove" />
        </form>
        <?php
        }
        ?>
    </div>
</div>

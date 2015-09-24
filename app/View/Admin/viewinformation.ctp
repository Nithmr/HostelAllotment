


<div id="viewinfocontent">
    <?php
    if(isset($setinfo))
    {
    ?>
    <form method="get" action="<?php echo $base_url ?>/mmca/search">
    <input type="text" name="textfield"  />
    <input type="submit" name="search" value="search"  /><p />
    </form>
<?php

    }
else if(!isset($setinfo))
{
    $roll=$userdata['rollno'];
?>    
      <div id="userinfotop">
        <div id="userinfotopleft">
            <label >Name</label> <span><?php  echo $userdata['name']; ?> </span> <p />
            <label>Fathers Name</label> <span><?php echo $userdata['fathername'] ?></span> <p />
             <label>Mothers Name</label> <span><?php echo $userdata['mothername'] ?></span> <p />
            <label>D O B</label> <span><?php echo $userdata['dob'] ?></span> <p />
            <label>Gender</label> <span><?php echo $userdata['gender'] ?></span> <p />
            <label>Blood Group</label> <span><?php echo $userdata['bloodgroup'] ?></span> <p />
        </div>
        <div id="userinfotopright">
            <div id="userinfoimageview" >
            <image height="200" width="160" src="/hostel/faltoo/<?php echo $imagedata[0]['imageupload']['imageadd'] ?>" /> 
            </div>
        </div>
    </div>
    <div id="userinfomid">
            <label >Roll No</label> <span><?php echo $userdata['rollno'] ?></span> <p />
             <label>CGPI</label> <span><?php echo $userdata['cgpi'] ?></span> <p />
            <label>Course</label> <span><?php echo $userdata['course'] ?></span> <p />
            <label>Department</label> <span><?php echo $userdata['department'] ?></span> <p />
            
             <label>Year</label> <span><?php echo $userdata['year'] ?></span> <p />
            
    </div>
    <div id="userinfobottom">
             <label >category</label> <span><?php echo $userdata['category'] ?></span> <p />
             <label> Email id </label> <span><?php echo $userdata['email'] ?></span> <p />
            <label> Mobile No. </label> <span><?php echo $userdata['mobileno'] ?></span> <p />
            <label> Parent Mobile No. </label> <span><?php echo $userdata['fathermobileno'] ?></span> <p />
            <label> Father Occupation </label> <span><?php echo $userdata['fatheroccupation'] ?></span> <p />
            <label> Mother Occupation </label> <span><?php echo $userdata['motheroccupation'] ?></span> <p />
            <label> Permanent Address </label> <span><?php echo $userdata['permanentadd'] ?></span> <p />
            <label> Pincode </label> <span><?php echo $userdata['pincode'] ?></span> <p />
              <label> comment </label> <span style="color: red; font-weight: bold " ><?php echo $userdata['comment'] ?></span> <p />
   
            <?php 
            if(isset($vtype))
            {
                $url="$base_url/admin/validation?vtype=$vtype&pageno=$page&rollno=$roll&";
                $urle="$base_url/admin/filluserinfo?vtype=$vtype&pageno=$page&rollno=$roll";
                $urlb="$base_url/admin/validationpage?vtype=$vtype&pageno=$page&rollno=$roll";
            }
            else if(isset($text))
            {
                $url="$base_url/admin/validation?pageno=$page&search=search&textfield=$text&searchfield=$search&rollno=$roll&";
                $urle="$base_url/admin/filluserinfo?pageno=$page&search=search&textfield=$text&searchfield=$search&rollno=$roll";
                $urlb="$base_url/admin/search?pageno=$page&search=search&textfield=$text&searchfield=$search&rollno=$roll";
                
            }
            ?>
            <a href="<?php echo $urle ?>" > <input type="button" value="Edit Info" /></a>
           <a href="<?php echo $url."validate=1"; ?>"> <input type="button" value="validate " /></a>
           
          <a href="<?php echo $url."validate=2"; ?>"> <input type="button" value="unvalidate " /></a>
          <a href="<?php echo $urlb; ?>"> <input type="button" value="back" /></a>
    </div>   

</div>
<?php } ?>


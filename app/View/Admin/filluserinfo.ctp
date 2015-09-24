<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.

 *  */
   echo $this->Html->script('jquery.imageupload.js');
     echo $this->Html->script('validationadmin.js');
     
    
   echo $this->Html->script('jquery.datepicker.js');
    echo $this->Html->css('datepicker.css');
     echo $this->Html->css('pagination.css');
?>

<script type="text/javascript"> 

function yeardepartmentlistupdate()
{
    
$('#departmentlist  option').remove();
$('#yearlist  option').remove();
    var blocks = [];
    var year=[];
    <?php
    $i=0;
     foreach($departmentlist as $data)
     {
       echo "blocks[$i] = '". $data['admintable']['col1'] ."';" ;
         $i++;
     }
      $i=0;
     foreach($yearlist as $data)
     {
       echo "year[$i] = '". $data['admintable']['col1'] ."';" ;
         $i++;
     }
    ?>
            
var value = $("#courselist option:selected").val(); 
 $('#departmentlist').append('<option selected value="">UNKNOWN</option>');
  $('#yearlist').append('<option selected value="">UNKNOWN</option>');
for(var i=0;i<blocks.length;i++)
    {
     
        if(blocks[i].search(value)>=0)
            {
                var nav=blocks[i].split('#',2);
                if(nav[1] == '<?php echo $user_department; ?>')
               $('#departmentlist').append('<option selected value="'+nav[1]+'">'+nav[1]+'</option>');
               else
               $('#departmentlist').append('<option value="'+nav[1]+'">'+nav[1]+'</option>');
            }
    }
    for(var i=0;i<year.length;i++)
    {
        
        if(year[i].search(value)>=0)
            {
                var nav=year[i].split('#',2);
                if(nav[1] =='<?php echo $user_year; ?>')
               $('#yearlist').append('<option selected value="'+nav[1]+'">'+nav[1]+'</option>');
               else
               $('#yearlist').append('<option value="'+nav[1]+'">'+nav[1]+'</option>');    
            }
    }

}
$(document).ready(function() {
    yeardepartmentlistupdate();
}
);

</script>
 <div id="flash-message">
            	<?php echo $this->Session->flash(); ?>
                        </div>
<div id="userinfoform">

    <div id="imageupload">
    <div id="imageview">
        <image src="/hostel/faltoo/<?php echo $imageaddress ?>" height="140" width="120" />
    </div>
    <div id="imageuploadbutton">
        <form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage'>
             <input type = "button" value = "Choose image" style="width: 120px"  onclick ="javascript:document.getElementById('photoimg').click();">
      <input name="photoimg" id="photoimg" type="file" style='display: none'/>
        
        </form>
    </div>
    </div>
    <?php 
      if(isset($vtype))
            {
                $urle="$base_url/admin/filluserinfo?vtype=$vtype&pageno=$pageno&rollno=$roll__no";
            }
            else if(isset($text))
            {
                $urle="$base_url/admin/filluserinfo?pageno=$pageno&search=search&textfield=$text&searchfield=$search&rollno=$roll__no";
            }
    ?>
<form id="myform" class="form" action="<?php echo $urle; ?>" method="post">

  
    <p class="placename">
        <label for="name"> Name </label>
        <input type="text" id="name" name="name" value="<?php echo $user_name ?>" />
        <span id="nameinfo" ></span>
    </p>   
    
    <p class="placename">
        <label for="fathername"> Father's Name </label>
        <input type="text" name="fathername"  id="fathername" value="<?php echo $user_fathername ?>" />
        <span id="fathernameinfo" ></span>
    </p>   
    
      <p class="placename">
        <label for="mothername"> Mother's Name </label>
        <input type="text" name="mothername"  id="mothername" value="<?php echo $user_mothername ?>" />
        <span id="mothernameinfo" ></span>
    </p>   
    
    
    <p class="placename">
        <label for="dob"> Date of Birth </label>
        <input type="text" name="dob" id="dob" value="<?php echo $user_dob ?>"  />
        <span id="dobinfo" ></span>
    </p>   
    
     <p class="placename">
        <label for="course"> Course </label>
       <select id="courselist" name="course" onchange="yeardepartmentlistupdate()">
           <option selected value=""><div>  &nbsp&nbsp UNKNOWN </div></option>
             <?php              
           foreach ($courselist as $data) {
            $year = $data['admintable']['col1'];
            if($year==$user_course)
             echo "<option selected value=$year><div>  &nbsp&nbsp   $year </div></option>";
                else
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            }
            ?>
        </select>
    </p> 
   
    <p class="placename">
        <label for="department">Department </label>
        <select id="departmentlist" name="department"  >
       
            
        </select>
        <span id="departmentinfo" ></span>
    </p>    
    
    <p class="placename">
        <label for="year">year </label>
        <select id="yearlist" name="year">
           
        </select>
    </p>    
    
   
     
    
     <p class="placename">
        <label for="gender"> Gender </label>
      <select id="genderlist" name="gender">
          <option value='' selected >UNKNOWN</option>
          <?php if($user_gender == "male") { 
              
          
            echo "<option value='male' selected >Male</option>
            <option value='female'>Female</option>";
            
          }
          else if($user_gender == "female")
          {
                  echo "<option value='male' >Male</option>
                  <option value='female' selected >Female</option>";
          }
          else
          {
               echo "<option value='male' >Male</option>
                  <option value='female' >Female</option>";
          }
                ?>
        </select>
              
    </p>  
    
   
     <p class="placename">
        <label for="category"> Category </label>
       <select id="categorylist" name="category">
           <option selected value=""><div> &nbsp&nbsp UNKNOWN </div></option>
             <?php              
           foreach ($categorylist as $data) {
            $year = $data['admintable']['col1'];
            if($year==$user_category)
             echo "<option selected value=$year><div>  &nbsp&nbsp   $year </div></option>";
                else
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
           
            }
            ?>
        </select> 
        
    </p>   
    
    
    <p class="placename">
        <label for="ph"> PH </label>
        <?php if($user_ph)
        {
?>
        <input style="width: 14px" type="checkbox" name="ph" value='1' checked/>
<?php
        }
        else
        {
        ?>
        <input style="width: 14px" type="checkbox" name="ph"  value='1'/>
        <?php
        }
        ?>
    </p> 
    
    <p class="placename">
        <label for="cgpi"> CGPI </label>
        <input type="text" name="cgpi" id="cgpi" value="<?php echo $user_cgpi ?>"  />
        <span id="cgpiinfo" name="cgpiinfo" ></span>
    </p>   
   
    
    
     <p class="placename">
        <label for="email"> email </label>
        <input type="text" name="email" id="email" value="<?php echo $user_email ?>" />
        <span id="emailinfo" ></span>
    </p>  
    
    
    
    <p class="placename">
        <label for="bloodgroup"> Blood Group </label>
		
		    <select name="bloodgroup" >
                        <option selected value="unknown" >UNKNOWN</option>
               <?php if(!empty($user_bloodgroup)) {?>
            <option selected value="<?php echo $user_bloodgroup ?>"><?php echo $user_bloodgroup ?></option><?php } ?>
	    <option value="A+" >A+</option>
	    <option  value="A-"  >A-</option>
	    <option  value="B+">B+</option>
	    <option  value="B-">B-</option>
	    <option  value="AB+" >AB+</option>
	    <option   value="AB-" >AB-</option>
	    <option  value="O+" >O+</option>
	    <option   value="O-" >O-</option>
	    
	    </select>


        <span id="bloodgroupinfo" ></span>
    </p>   
    
    
   
   
   
   
    <p class="address" style="height: 120px" >
        <label for="address"> Permanent Address </label>
       <textarea id="address" name="address" type="text"><?php echo $user_permanentadd ?> </textarea>
        <span id="addressinfo" ></span>
    </p>   
    
     <p class="placename">
        <label for="pincode"> Pin-code </label>
        <input type="text" name="pincode" id="pincode" value="<?php echo $user_pincode ?>"  />
        <span id="pincodeinfo" ></span>
    </p>   
   
     <p class="placename">
        <label for=""> Mobile No </label>
        <input type="text" name="mobileno" id="phone_number"  value="<?php echo $user_mobileno ?>" />
        <span id="phone_numberinfo" ></span>
    </p>   
    
      <p class="placename">
        <label for="fathermobileno"> Parent's Mobile </label>
        <input type="text" name="fathermobileno"  id="fathermobileno" value="<?php echo $user_fathermobileno ?>" />
        <span id="fathermobilenoinfo" ></span>
    </p>   
    
      <p class="placename">
        <label for="fatheroccupation"> Father's occupation </label>
        <input type="text" name="fatheroccupation"  id="fatheroccupation" value="<?php echo $user_fatheroccupation ?>" />
        <span id="fatheroccupationinfo" ></span>
    </p>   
    
      <p class="placename">
        <label for="motheroccupation"> Mother's Occupation </label>
        <input type="text" name="motheroccupation"  id="motheroccupation" value="<?php echo $user_motheroccupation ?>" />
        <span id="motheroccupationinfo" ></span>
    </p>   
    
     
    <p class="address" style="height: 100px" >
        <label for="address"> Comment </label>
       <textarea id="comment" name="comment" type="text"><?php echo $user_comment ?> </textarea>
        <span id="addressinfo" ></span>
    </p>  
	
    <p class="submit">
        <input  type="submit" value="Submit">
    </p>

       
</form>
</div>

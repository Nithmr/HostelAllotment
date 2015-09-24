
<style type="text/css">
    #tableinfo input
    {
     margin-left: 50px;
    }
    #tableinfo
    {
        text-align: center;
    }
    #leftdataexport
    {
     margin-top: 40px;
     width: 50%;
         float:left;
    }
    #leftdataexport label
    {
        margin-left: 30px;
    }
    #rightdataexport
    {
        margin-top: 40px;
        float: left;
        width: 50%;
    }
    
</style>
<script type="text/javascript"> 

function yeardepartmentlistupdate()
{
    
$('#datadepartment  option').remove();
$('#datayear  option').remove();
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
            
var value = $("#datacourse option:selected").val();
$('#datadepartment').append('<option value="%">-ALL-</option>');
$('#datayear').append('<option value="%">-ALL-</option>');
for(var i=0;i<blocks.length;i++)
    {
        
        if(blocks[i].search(value)>=0)
            {
                var nav=blocks[i].split('#',2);
               $('#datadepartment').append('<option value="'+nav[1]+'">'+nav[1]+'</option>');
            }
    }
    for(var i=0;i<year.length;i++)
    {
        
        if(year[i].search(value)>=0)
            {
                var nav=year[i].split('#',2);
               $('#datayear').append('<option value="'+nav[1]+'">'+nav[1]+'</option>');    
            }
    }

}
$(document).ready(function() {
    yeardepartmentlistupdate();
}
);

</script>

<form action="" method="post">
<div id="content">
<div id="tableinfo">
    <input type="radio" value="olduserdataofrooms"  name="dataset" checked/>Old Table Data
    <input type="radio" value="newuserdataofrooms" name="dataset" />New Table Data
</div>
    
    <div  id="leftdataexport">
         <select name="courseid" id="datacourse" onchange=" yeardepartmentlistupdate()">
            <option value="%"> -ALL- </option>
            <?php 
            foreach($courselist as $data)
            {
                $roll=$data['admintable']['col1'];
                echo "<option value='$roll'>$roll</option>";
            }
            ?>
        </select>
        <label>Course</label> <br />
        <select id="datadepartment" name="departmentid"></select>
        <label>Department</label> <br />
        <select id="datayear" name="yearid"></select>
        <label>Year</label> <br />
         <select name="hostelid">
            <option value="<?php echo $hostel; ?>"><?php echo $hostel; ?></option>
        </select>
        <label>hostel</label> <br />
    </div>
    <div id="rightdataexport">
        <input type="checkbox" name="rollno" value="rollno" />rollno<br />
        <input type="checkbox" name="name" value="name" />name<br />
        <input type="checkbox" name="fathername" value="fathername" />fathername<br />
        <input type="checkbox" name="mobileno" value="mobileno" />mobile no<br />
        <input type="checkbox" name="roomno" value="room_no" />room no<br />
        <input type="checkbox" name="hostel" value="hostel" />hostel<br />
        <input type="checkbox" name="course" value="course" />course<br />
        <input type="checkbox" name="department" value="department" />department<br />
        <input type="checkbox" name="gender" value="gender" />gender<br />
        <input type="checkbox" name="cgpi" value="cgpi" />cgpi<br />
        <input type="checkbox" name="dob" value="dob" />date of birth<br />
        
        <input type="checkbox" name="email" value="email" />email<br />
        <input type="checkbox" name="category" value="category" />category<br />
        <input type="checkbox" name="bloodgroup" value="bloodgroup" />bloodgroup<br />
        <input type="checkbox" name="mothername" value="mothername" />mothername<br />
        <input type="checkbox" name="comment" value="comment" />comment<br />
    </div>
    
</div>
    <input value="submit" type="submit" name="export">
    
</form>
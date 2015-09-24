<?php //   ?>

 <div id='contentpane'>
                <div id ='leftborder'></div>
                
		<div id='content'>
                 
<h1> Welcome  <?php echo $name ?> </h1>
            <?php 

$i=0;

foreach ($allotedinfo as $data)
{

    if($i==0)
    {    
    $allotedroom = $data['newuserdataofrooms']['room_no'];
     echo "alloted room $allotedroom<br>room memebers ";
    }
    $allotedroll = $data['newuserdataofrooms']['rollno'];
    echo "$allotedroll ";
    $i++;
    
}


?>
      
        </div>
                  <div id ="rightborder"></div>
     </div>



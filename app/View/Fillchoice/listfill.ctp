   <div id='contentpane'>
                <div id ='leftborder'></div>
                
		<div id='content'>
                          


<div id ="left" >
    
        <div id="leftlisttitle" ><h2>Filled Choice</h2></div>
  <div id='leflist'>    

    
<?php
echo "<select size='7' id='preference' >";
$rank=1;

foreach ($result as $data) {
    

    $room = $data['prefrence']['room_no'];
   
    echo "<option value=$room><div> $rank. &nbsp&nbsp   $room </div></option>";
    $rank = $rank+1;
}
echo "</select>";

?>

</div>
        
           <div id="remove">
          <div  id="upimage">
              <img    useMap="#Map2" class="Mapingup" src="/hostel/app/webroot/img/up.png" />    
          <map name="Map2" id="Map2">
          <area  data-key="85" shape="poly" coords="2,15" href="#" />
          <area shape="poly" data-key="86" coords="4,15" href="#" />
          <area shape="poly" data-key="87" coords="3,16" href="#" />
          <area id="upchoicelist" alt="up" shape="poly" data-key="88" coords="7,15,3,15,10,4,16,15,13,15,13,29,6,29,6,15" href="#" />
        </map>
          </div>
          <div id="downimage"> <img  src="/hostel/app/webroot/img/DOWN.png"  useMap="#Map3" class="Mapingup" />
              <map name="Map3" id="Map3">
  <area alt="down" id="downchoice" data-key="89" shape="poly" coords="3,18,7,18,7,4,13,4,13,17,17,18,10,29" href="#" />
</map>
    </div>
          
          
          
          <a  href="#" id ="removechoice" > Remove </a>  <br /> 
          
            <a  href="#" id ="removeallchoice" > Remove All </a> 
          
          
      </div>
      </div>



<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
     <input id="eligibleroombutton" style="margin-left: 10%;" type="button" value="enter choice" />  
<?php


echo "<select id='eligibleroomlist' style='  border: 2px solid;
    height: 300px;
    margin-left: 15%;
    margin-top: 7%;
    width: 150px;' size=7>";


foreach ($eligiblerooms as $data) {
    

    $room = $data['roomsrestriction']['room_no'];
   
    echo "<option value=$room><div> $room </div></option>";
    
}
echo "</select>";

?>
   
</div>

 <div id ="rightborder"></div>
                
        </div>
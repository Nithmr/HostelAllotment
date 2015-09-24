<?php 
    echo "  <div id='contentpane'>
                <div id ='leftborder'></div>
                
		<div id='content'>";
                          
?>  




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




<div id="loadingimg" ><img id ="loading" src="/hostel/app/webroot/img/loadinfo.net.gif" />  </div>

<div id="fillup"  >
    <img src="/hostel/app/webroot/img/BACK.png"    useMap="#Map4" class="Mapingup" />
         <map name="Map4" id="Map4">
  <area linking="fillup" class='simple' alt="back" shape="poly" data-key="123478" coords="5,11,16,4,16,7,30,7,30,13,17,14,16,17" href="#" />
</map>
</div>
<div id ="imageload"  >
</div>
  
<div id ="image">
  
    <img src="/hostel/app/webroot/img/nithtopview.png"  useMap="#Map" class="Maping" />
    
    <map name='Map' id='Map'>
    <area shape='poly' data-key='1010' class='simple' coords='215,265,261,270,265,225,223,221,214,241' linking='pghisometricview1' href='#' alt='P.G.H' />
  <area shape='poly' data-key='1011' class='simple' coords='512,365,514,379,550,381,548,362,607' linking='vbhisometricview1' href='#' alt='V.B.H' />
  <area shape='poly' data-key='1012' class='simple' coords='607,308,605,327,646,331,647,309' href='#' linking='mmhisometricview1' alt='M.M.H' />
  <area shape='poly' data-key='1013'  class='simple' coords='554,269,555,279,590,289,594,273,575,260' linking='dbhisometricview1'  href='#' alt='D.B.H' />
  <area shape='poly' data-key='1014' class='simple' coords='570,253,586,248,590,230,577,225,557,229,558,246,357' linking='nbhisometricview1' href='#' alt='N.B.H' />
  <area shape='poly' data-key='1015' class='simple' coords='356,444,472,442,476,466,359,464' href='#' alt='LEARN' />
</map>
</div>


<span id="selections" ></span>

<script type="text/javascript">


</script>
  
	<script type="text/javascript">
            
            
 var testvar='hello';           
        $(document).ready(function () {
       
var imgTitle='';       
       
       $('area').each(function()
   {
      $(this).qtip(
      {
         content: $(this).attr('alt'),
         position: { target: 'mouse' },// Use the ALT attribute of the area map
         style: {
            name: 'dark', // Give it the preset dark style
            border: {
               width: 0, 
               radius: 0 
            }, 
           
            tip: true // Apply a tip at the default tooltip corner
         }
      });
   });
       
       
             $('.Mapingup').mapster({
                fillColor: '000000',
		mapKey: 'data-key',
                isSelectable: false,
                fillOpacity: 0.6
    });
    



$(".simple").live("click",function()
{
    
 
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var resp = xmlhttp.responseText; 
    document.getElementById("image").innerHTML = resp;
     parseScript(resp);
    }
  }
  $('#loadingimg').css("visibility","visible");

    xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/selectimg?img="+ $(this).attr("linking"),false);
xmlhttp.send();
$('#loadingimg').css("visibility","hidden");
});
       
       $('.Maping').mapster({
                fillColor: '000000',
		mapKey: 'data-key',
		singleSelect:true,
                fillOpacity: 0.6
		
       
    });
    
      


            $("#imageload").live('click',function(){
            
       
       
          
      
      $('area').each(function()
   {
          $('.qtip-active').empty().remove();
      $(this).qtip(
      {
         content: $(this).attr('alt'),
         position: { target: 'mouse' },// Use the ALT attribute of the area map
         style: {
            name: 'dark', // Give it the preset dark style
            border: {
               width: 0, 
               radius: 0 
            }, 
           
            tip: true // Apply a tip at the default tooltip corner
         }
      });
   }); 
       
       
       
     $('.Maping').mapster({
                fillColor: '000000',
		mapKey: 'data-key',
		singleSelect:true,
                fillOpacity: 0.6
    });
    
    
     
  
        
       
});
			
        });
        
        
    </script>

       <div id ="rightborder"></div>
                
        </div>
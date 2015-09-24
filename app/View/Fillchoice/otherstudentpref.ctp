
<div id="preferencecontent">

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
    
    <div id="right" style="float: left;width: 80%" >
        
          <div id="exchangeroomsmaindiv" style="width: 100%;">
            <div class="box" id="rightexchangeroomsdiv" style="width: 60%; float: left" >
                <form action ="" method="post" >
                <table class="display" border="0" width="500px"  >
                    <thead>
                    <tr>
                        <th>Group Rank</th>
                        <th>Group Member</th>
                        <th>Filled Choice</th>
                    </tr>
                    </thead>
                    <?php
                     $capacity=0;$i=0;$rank=0;
                     foreach ($grouplist as $data)
                     {
                       
                         if($i==$capacity)
                         {
                              $rank++;
                              echo "<tr class ='morethanone'>";
                             $capacity=$data['temp']['totalmember'];
                             if($capacity==null)
                                 $capacity=1;
                             echo "<td rowspan='$capacity'>$rank</td>";
                             $i=1;
                             $roll = $data['kas']['rollno'];
                            echo "<td> <a href='#' class='rollid' alt='$roll' > $roll </a> </td>  <td rowspan='$capacity' > <a href='#' class='viewmorepref' alt='$roll' > view more </a> </td>";
                             echo "</tr>";
                             continue;
                         }

                         $roll = $data['kas']['rollno'];
                         echo "<tr class ='single' ><td> <a href='#' class='rollid' alt='$roll' > $roll </a> </td>  </tr>";
                        
                        
                         $i++;
                      }
                    
                    ?>
                </table>
                   
   
                </form>
            </div>
            
        </div>
        
  
        
    </div>
    
</div>



<script type="text/javascript">
    $('.rollid').each(function()
   {
      $(this).qtip(
      {
         
          hide: { fixed:true },
         content:  { 
                text: 'loading...',
                url: '<?php echo $base_url ?>/fillchoice/idcard',
                type:'GET',
                data : { rollno:$(this).attr('alt') 
                  
              }
     
            },
           position: { corner: { tooltip: 'topMiddle' } },// Use the ALT attribute of the area map
         style: {
            name: 'light', // Give it the preset dark style
            border: {
               width: 0, 
               radius: 0 
            }, 
            
            width : 415,
            height : 190,
           // Apply a tip at the default tooltip corner
         }
      });
   });
    
     $('.viewmorepref').each(function()
   {
      $(this).qtip(
      {
         
          hide: { fixed:true },
         content:  { 
            
               
                text: 'loading...',
                url: '<?php echo $base_url ?>/fillchoice/filledlist',
                type:'GET',
                
                data : { rollno:$(this).attr('alt')} 
              
              
     
            },
           position: { corner: { tooltip: 'topMiddle' } },// Use the ALT attribute of the area map
         style: {
            name: 'light', // Give it the preset dark style
            border: {
               width: 0, 
               radius: 0 
            }, 
            
            width : 320,
            style: { width: { min: 30,max:180 } }
           // Apply a tip at the default tooltip corner
         }
      });
   });
    
    
</script>



<style type="text/css">
    
   
    .mainidcard
    {
        
        width: 400px;
        height: 180px;
        border-top: solid 1px gray;
         border-left: solid 1px gray;
        -moz-box-shadow: 3px 3px 4px #000;
	-webkit-box-shadow: 3px 3px 4px #000;
	box-shadow: 3px 3px 4px #000;
	/* For IE 8 */
	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";
	/* For IE 5.5 - 7 */
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');

    }
    .testing
    {
        color: #B4886B;
       
       
       
       
    }
    
    
    .top
    {
        width: 100%;
        height: 80%;
        border-bottom: solid 1px gray;
        
    }
    
    .topleft
    {
        text-align: center;
        width: 275px;
        height: 80%;
        
        float: left;
        padding-top: 15px;
        
    }
    
    .topright
    {
        width: 120px;
        height: 100%;
        float: left;
        padding-top: 5px
    }
  
.idtext
{
    color:gray;
    
}
.bottom
{
    height: 20%;
    width: 100%;
}
.bottomleft
{
    width: 73%;
     float : left;
     text-align: center;
     
}
.bottomright
{
    width: 27%;
    float: left;
    
}

table.fillchoices
{
    border-collapse:collapse;
    width: 300px;
       
}
table.fillchoices td
{
    border-bottom: 1px solid #aaa;
    border-right: 1px solid #aaa;
    text-align: center;
}
table.fillchoices thead th
{
    border-bottom: 1px solid #aaa;
    border-right: 1px solid #aaa;
    text-align: center;
}
  
    table.display {
	margin: 0 auto;
	clear: both;
	width: 100%;
       border-collapse:collapse;
       border: 1px solid #B4886B;
	
	/* Note Firefox 3.5 and before have a bug with border-collapse
	 * ( https://bugzilla.mozilla.org/show%5Fbug.cgi?id=155955 ) 
	 * border-spacing: 0; is one possible option. Conditional-css.com is
	 * useful for this kind of thing
	 *
	 * Further note IE 6/7 has problems when calculating widths with border width.
	 * It subtracts one px relative to the other browsers from the first column, and
	 * adds one to the end...
	 *
	 * If you want that effect I'd suggest setting a border-top/left on th/td's and 
	 * then filling in the gaps with other borders.
	 */
}

table.display thead th {
	padding: 3px 18px 3px 10px;
	border-bottom: 1px solid black;
	font-weight: bold;
        color: #B4886B;
	
	
}

table.display .morethanone {
    border-top: 1px solid #aaa;
} 

table.display tr.heading2 td {
	border-bottom: 1px solid #aaa;
}

table.display td {
	padding: 3px 10px;
        text-align: center;
        color : #939191;
        font-weight: bolder;
}

table.display td.center {
	
}

table.display td a
{
    text-decoration: none;
    color : #939191;
}

table.display tr.odd.gradeA {
	background-color: #ddffdd;
}

div.filldiv
{
    height: 200px;
    overflow-y: scroll;
    overflow-x: hidden;
    background-color: #ffffff;
         -moz-box-shadow: 3px 3px 4px #000;
	-webkit-box-shadow: 3px 3px 4px #000;
	box-shadow: 3px 3px 4px #000;
	/* For IE 8 */
	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";
	/* For IE 5.5 - 7 */
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');
}

div.box {
	height: 450px;
        margin-top: 40px;
        margin-left: 100px;
	padding: 10px;
	overflow: auto;
	border-top: solid 1px black;
        border-left: solid 1px black; 
	background-color: #ffffff;
         -moz-box-shadow: 3px 3px 4px #000;
	-webkit-box-shadow: 3px 3px 4px #000;
	box-shadow: 3px 3px 4px #000;
	/* For IE 8 */
	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";
	/* For IE 5.5 - 7 */
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');

}



</style>
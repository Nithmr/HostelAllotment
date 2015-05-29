 <div style="float:right;width: 70%;margin-left: 30px;margin-top: 20px;margin-bottom: 20px">
                 <span style="color: gray;font-size: 20px;font-weight: bold" >
                         your current group is (
<?php
                    $i=0;
                    
                    foreach($usergroup as $data)
                    {
                        $i++;
                        echo $data['g']['rollno']." ";
                    }
                    echo ")";
                    
                    echo "</span>";
                    if($i>1)
                    {
                         
                         echo "<a href='$base_url/grouping//newacceptreject?value=leavegroup'><input type='button' name='value' value='leave group'  /></a>";
                    }
                     ?>
             
             </div>
<div style="float:left;width:40%;height:500px; margin-left: 21px">
                    <label>Sent Request</label>
                  <div  class="requestdiv">
                      
                      <table class="request"> 
                       <thead>
                       <th>S.no</th>
                       <th>Roll no</th>
                       <th>Group Rank </th>
                       <th>delete</th>
                       </thead>
                 <?php
                  $sn =0;
                    if(isset ($ridlist))
                 {
                  foreach( $ridlist as $data)
                  {
                     $sn++;
                     $gid = $data[0];
                     $cap = count($grouprollno[$gid]);
                     $rank = $rankgroup[$gid]['rank'];
                    
                    
                     
                     echo "<tr class='morethanonereq' >";
                     echo "<td rowspan=$cap >$sn</td>";
                     $rollno = $grouprollno[$gid][0][0];
                     echo "<td ><a href='#' class='rollid' alt='$rollno' >$rollno</a></td>";
                     echo "<td rowspan=$cap >$rank</td>";
                     echo "<td rowspan=$cap><a class='sideaction' href=$base_url/grouping/newacceptreject?value=deleterequest&receiver=$gid> delete</a></td>";
                     
                     echo '</tr>';
                     
                     $start=0;
                          $gid = $grouprollno[$gid];
                            foreach($gid as $result)
                          {
                                if($start!=0)
                                {
                              $rollno = $result[0];
                              
                              echo "<tr><td ><a href='#' class='rollid' alt='$rollno' >$rollno</a></td></tr>";
                                }
                                $start++;
                              
                          }
                     
                     
                  }
                  
                 }
                 
                  
                  
                  
                  ?>
                   </table>
                      
                    <?php $roll = $usergroup[0]['g']['rollno']; 
                    if(!$cansend)
                    echo "<h3>Further activities will be carried out by your group leader $roll </h3>"; 
                    
                    ?>  
                      
                  </div>
                   <label style="margin-top: 30px;" >Received Request</label>
                    <div  class="requestdiv">
                   
                        <table class="request"> 
                       <thead>
                       <th>S.no</th>
                       <th>Roll no</th>
                       <th>Group Rank </th>
                       <th>action</th>
                       </thead>
                 <?php
                 
                 if(isset ($sidlist))
                 {
                  $sn =0;
                  
                  foreach( $sidlist as $data)
                  {
                     $sn++;
                     $gid = $data[0];
                     $cap = count($grouprollno[$gid]);
                     $rank = $rankgroup[$gid]['rank'];
                    
                    
                     
                     echo "<tr class='morethanonereq' >";
                     echo "<td rowspan=$cap >$sn</td>";
                     $rollno = $grouprollno[$gid][0][0];
                     echo "<td ><a href='#' class='rollid' alt='$rollno' >$rollno</a></td>";
                     echo "<td rowspan=$cap >$rank</td>";
                     echo "<td rowspan=$cap><a class='sideaction' href=$base_url/grouping/newacceptreject?value=accept&sender=$gid> accept </a>|<a class='sideaction' href=$base_url/grouping/newacceptreject?value=reject&sender=$gid> reject</a></td>";
                     
                     echo '</tr>';
                     
                     $start=0;
                          $gid = $grouprollno[$gid];
                            foreach($gid as $result)
                          {
                                if($start!=0)
                                {
                              $rollno = $result[0];
                              
                              echo "<tr><td ><a href='#' class='rollid' alt='$rollno' >$rollno</a></td></tr>";
                                }
                                $start++;
                              
                          }
                     
                     
                  }
                  
                
                 }
                  
                  
                  ?>
                   </table>
                  </div>
</div>
            <div id="righttable" style="">
                <table class="display" border="0"  >
                    <thead>
                    <tr>
                        <th>Group Rank</th>
                        <th>Group Member</th>
                        <th>Send Request</th>
                    </tr>
                    </thead>
                <?php 
                      
                     
                      foreach($ranklist as $data)
                      {
                          $cap = $data['capacity'];
                          $gid = $data['groupid'];
                          $rank = $data['rank'];
                          echo "<tr class ='morethanone' >";
                       
                         // pr($grouprollno);
                         // exit;
                          
                          echo "<td rowspan=$cap>$rank</td>";
                          $rollno = $grouprollno[$gid][0][0];
                          $status = $grouprollno[$gid][0][1];
                           echo "<td><a href='#' class='rollid' alt='$rollno' >$rollno</a></td>";
                          
                        
                          
                          
                
                          
                          if($status&$cansend)
                          {
                              
                              echo "<td rowspan=$cap><a class='sideaction' href=$base_url/grouping/sendrequest?choice=$rollno&sendrequest=sendrequest>send-request</a></td>";
                          }
                         else 
                             {
                             echo "<td rowspan=$cap></td>";
                             
                             }
              
                          echo "</tr>";
                          
                          $start=0;
                          $gid = $grouprollno[$gid];
                            foreach($gid as $result)
                          {
                                if($start!=0)
                                {
                              $rollno = $result[0];
                              $status = $result[1];
                              echo "<tr class ='single' ><td><a href='#' class='rollid' alt='$rollno' >$rollno</a></td></tr>";
                                }
                                $start++;
                              
                          }
                      }
                      echo "</table>";
                ?>
                      
                     <?php //if($cansend) echo '<input type="submit" name="send-request" value="send-request"/>'; ?>
                  
            </div>    





<style type="text/css">
    
   
    table.request
    {
        margin: 0 auto;
	clear: both;
	width: 90%;
       border-collapse:collapse;
       border-bottom: 1px solid;
     
      
    }
    
    
.sideaction
{
    text-decoration: none;
    color : #939191;
}
    table.request .morethanonereq
    {
        border-top:  1px solid black;
        
    }
    
    table.request td
    {
         border-right: 1px solid black;
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

table.display,table.request thead th {
	padding: 3px 18px 3px 10px;
	border-bottom: 1px solid black;
	font-weight: bold;
        color: #B4886B;
	
	
}

table.display .morethanone 
{
    border-top: 1px solid #aaa;
   
} 

table.display tr.heading2 td {
	border-bottom: 1px solid #aaa;
}

table.display,table.request td {
	padding: 3px 10px;
        text-align: center;
        color : #939191;
        font-weight: bolder;
}

table.display td.center {
	
}


.rollid
{
    text-decoration: none;
    color : #939191;
}

table.display tr.odd.gradeA {
	background-color: #ddffdd;
}

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


.requestdiv
{
    float:left;width:100%;height: 150px;overflow: auto;
        padding: 10px;
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

#righttable
{
    padding: 10px;
    width: 40%;
    float: right;
    margin-right: 40px;
    height: 400px;
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


.highlight
{
 text-decoration: none;
 color: black;
}
</style>



<script type="text/javascript">
    
  $("table a").mouseenter(function(){
      
  $(this).removeClass("rollid");
$(this).addClass("highlight");
});

$("table a").mouseleave(function(){
$(this).removeClass("highlight");
$(this).addClass("rollid");
});
    
    $('.rollid').each(function()
   {
      $(this).qtip(
      {
         
          hide: { fixed:true },
         content:  { 
                text: 'loading...',
                url: '<?php echo $base_url ?>/grouping/idcard',
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
   </script>
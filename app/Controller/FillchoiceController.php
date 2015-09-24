<?php

App::uses('Sanitize', 'Utility');
class FillchoiceController extends AppController
{
   var $name =  'Fillchoice';
     function beforeFilter() {
        parent::beforeFilter();
      
        if(!$this->isLogin) 
        {
            $this->redirect(BASE_URL . '/user/login');  
        }
        else if($this->admin >0 )
        {
            $this->redirect(BASE_URL . '/user/logout');
        }
        else
        {
            
           
        if($this->fillchoiceactive==0)
           {
               $this->redirect(BASE_URL . '/user/logout');
           }
            
             $name = $this->Session->read('user');
          $name = $name['username'];
    
         
         $result = $this->Panel->reloadlist($name);
         
         $this->set('result',$result);
        }
    }
      public function enterlistroom()
    {
       
        
          $getdata = $this->params->query;
            $room = $getdata['room'];
          
            
            
            
            
            
            $name = $this->Session->read('user');
          $name = $name['username'];
          
         /*   $result = $this->Panel->noteligibleroom($name,  $this->groupsize,$this->userinformation);
         
         $string="";
         
          foreach ($result as $data) {
             $string .= $data.",";
         }
          */
         $flag =  $this->Panel->update($name,$room,  $this->groupsize,  $this->userinformation);
       
         
         $this->redirect("$this->baseurl/fillchoice/listfill");
       
     //   echo "<script type='text/javascript'>  window.location = '$this->baseurl/fillchoice/listfill';  </script>";
       
         
    }
    
    
    
     public function enterroom()
    {
       
        
          $getdata = $this->params->query;
            $room = $getdata['room'];
          
            
            
            
            
            
            $name = $this->Session->read('user');
          $name = $name['username'];
          
            $string = $this->Panel->noteligibleroom($name,  $this->groupsize,$this->userinformation);
         
        /* $string="";
         
          foreach ($result as $data) {
             $string .= $data.",";
         }*/
          
         $flag =  $this->Panel->update($name,$room,  $this->groupsize,  $this->userinformation);
       
         
       
        echo "<script type='text/javascript'>  listreload();  </script>";
        exit;
        
    }
    
    
    
    public function reloadlist()
    {
        
          $name = $this->Session->read('user');
          $name = $name['username'];
         $string = $this->Panel->noteligibleroom($name,  $this->groupsize,$this->userinformation);
         
         
        // $string="";
        /* foreach ($result as $data) {
             $string .= $data.",";
         }*/
        
         echo "<script type='text/javascript'> $('#imageload').click(); rebin('$string');</script>";
 
         $results = $this->Panel->reloadlist($name);
         $rank=1;
           echo "<select size='7' id='preference' >";
    foreach ($results as $data) {
    
  
   
    $room = $data['prefrence']['room_no'];
    
     
     echo "<option value=$room>$rank. &nbsp&nbsp   $room </option>";
    $rank = $rank +1;
  } 
         
      echo "</select>";
        
         
     
         
       
     exit;
         
        
    }

    
    
     public function upchoice()
    {
         $getdata = $this->params->query;
         $room = $getdata['room'];
         
 
          $name = $this->Session->read('user');
          $name = $name['username'];
          $this->Panel->up($name,$room);
          
           echo "<script type='text/javascript'>  listreload(); </script>";
        exit;
    }
    
    public function downchoice()
    {
         $getdata = $this->params->query;
         $room = $getdata['room'];
         
 
          $name = $this->Session->read('user');
          $name = $name['username'];
          $this->Panel->down($name,$room);
          
           echo "<script type='text/javascript'>  listreload(); </script>";
        exit;
    }
    
    
    public function listfill()
    {
           $name = $this->Session->read('user');
          $name = $name['username'];
          
          $result = $this->Panel->eligibleroom($name,  $this->groupsize,$this->userinformation);
          
          
           $this->set('eligiblerooms', $result);
        
    }
    
    public function removeall()
    {
        
 
          $name = $this->Session->read('user');
          $name = $name['username'];
          $this->Panel->removeall($name);
          
           echo "<script type='text/javascript'>  listreload(); </script>";
        exit;
    }
    
   

 public function fillchoice()
    {
        $stack = array();
        array_push($stack, '/hostel/index.php/panel/selectimg?img=nithtopview.png');
        $this->Session->write('stack',$stack);
    }
    

    
    public function selectimg()
    {
        
      
           $name = $this->Session->read('user');
          $name = $name['username'];
         $query = "SELECT room_no,pre_rank FROM prefrence where groupid in (select `groupid` from `group` where rollno=$name) ORDER BY pre_rank DESC";
        // $result = $this->Panel->query($query);
      
         
         
         $string = $this->Panel->noteligibleroom($name,  $this->groupsize,$this->userinformation);
         /*
         $string="";
         foreach ($result as $data) {
             $string .= $data.",";
         }*/
         
        
         
        
         
         
       $getdata = $this->params->query;
       $img = $getdata['img'];
      
         $eligiblehostel = $this->Panel->eligiblehostels($name,  $this->groupsize,$this->userinformation);
        
         
         $flag=0;
         $string_eligible = "You are eligible for ";
         foreach ($eligiblehostel as $data)
         {
             $hostel = $data['r']['hostel'];
             $pos  = stripos($img, $hostel);
             $string_eligible .= $hostel."   "; 
             if($pos>-1)
                 
             {
                 
                // pr($eligiblehostel);
               $flag = 1;
               
               
             }
         }
         if($flag==0&&$img!="fillup")
             $img = "nohostel";
         
         
      
       if($img!='fillup')
       {
       
         $stack = $this->Session->read('stack');
       if($stack == null)
           $stack = array();
       array_push($stack,$_SERVER[ 'REQUEST_URI' ]);
        $this->Session->write("stack", $stack); 
    
        
       }
       
        
         
       $count=FALSE;
       while(!$count)
       {
       switch ($img)
         {
           
           
           
             case "nohostel":
             {
                 echo "<script type='text/script'> alert('$string_eligible'); </script>";
             }
          
             case "fillup":
             {
                 
              
                    $stack = $this->Session->read('stack');
        
                   if(count($stack)>1)
                      $value = array_pop($stack);
                     $value = end($stack);
                     $this->Session->write("stack", $stack);
                    
                    
                     
                     
                     $query = parse_url($value, PHP_URL_QUERY);
            parse_str($query, $params);
            $test = $params['img'];
            $img=$test;
            
            $count=FALSE;
            break;
                     
             }
                 
             
             case "nithtopview":
             {
                  echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
                 echo "   <map name='Map' id='Map'>
    <area shape='poly' data-key='1010' class='simple' coords='215,265,261,270,265,225,223,221,214,241' linking='pghisometricview1'  href='#' alt='P.G.H' />
  <area shape='poly' data-key='1011' class='simple' coords='512,365,514,379,550,381,548,362,607' linking='vbhisometricview1' href='#' alt='V.B.H' />
  <area shape='poly' data-key='1012' class='simple' coords='607,308,605,327,646,331,647,309' href='#' linking='mmhisometricview1' alt='M.M.H' />
  <area shape='poly' data-key='1013'  class='simple' coords='554,269,555,279,590,289,594,273,575,260' linking='dbhisometricview1'  href='#' alt='D.B.H' />
  <area shape='poly' data-key='1014' class='simple' coords='570,253,586,248,590,230,577,225,557,229,558,246,357' linking='nbhisometricview1' href='#' alt='N.B.H' />
  <area shape='poly' data-key='1015' class='simple' coords='356,444,472,442,476,466,359,464' href='#' alt='LEARN' />
</map>";
                 
                  echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
                 
             }
             
             
                 
             case "vbhisometricview1":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='357,442,478,468' href='#' />
  <area class='simple' data-key='1002' shape='poly' coords='57,386,205,320,212,323,230,312,230,301,212,300,202,298,206,291,187,286,165,292,146,298,138,297,132,296,121,300,106,302,96,302,86,304,76,305,61,306,55,310,50,312,46,308,37,310,32,313,30,320,23,324,22,326' href='#' linking='vbhisometricview2' alt='ISOMETRIC VIEW II' />
  <area class='simple' data-key='1003' shape='poly' coords='178,435,284,437,284,442,298,442,332,448,343,446,341,423,336,391,327,368,319,354,306,349,278,347,251,347,233,347,212,349,195,348,185,348,177,353' linking ='vbhtopview' href='#' alt='TOP VIEW' />
  <area class='simple' data-key='1004' shape='poly' coords='266,128,278,122,289,123,298,114,308,116,317,109,328,111,335,104,344,106,352,98,360,99,368,93,380,93,391,98,397,92,404,92,411,89,416,86,406,84,411,79,419,79,426,75,432,75,436,70,448,71,449,65,457,67,462,61,510,73,510,91,511,123,489,135,436,159,398,175,362,194,331,206,318,208,303,202,294,201,282,189,270,148,279,158,272,144' href='#' linking='vbh-a-interface' alt='A BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='520,73,526,68,533,69,535,66,541,65,545,62,550,62,555,58,560,58,564,54,581,58,587,54,591,51,580,50,590,45,598,42,610,39,653,45,655,85,634,95,613,106,598,119,570,133,561,134,520,111,518,108' href='#' linking='vbh-b-interface' alt='B BLOCK' />
  <area class='simple' data-key='1006' shape='poly' coords='689,65,740,75,742,93,740,107,738,121,726,128,715,138,699,154,683,161,677,169,668,176,661,177,623,161,606,157,611,111,652,89,669,91,677,83,665,81' href='#' linking='vbh-c-interface' alt='C BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
                case "vbhisometricview2":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect' coords='356,442,478,468' href='#' />
  <area class='simple' data-key='1001' shape='poly' coords='462,414,569,415,589,417,630,418,627,378,616,344,606,330,594,320,572,320,543,319,518,318,494,319,478,319,466,322,462,327,461,344,459,367,461,389' href='#' linking='vbhtopview' alt='TOP VIEW' />
  <area class='simple' data-key='1002' shape='poly' coords='689,343,808,276,806,261,791,255,777,249,765,241,756,238,749,243,744,241,721,249,705,254,698,252,681,256,678,260,665,266,658,265,644,273,633,274,625,276,615,277,615,287,615,296,622,307,646,323' href='#' linking='vbhisometricview1' alt='ISOMETRIC VIEW I' />
  <area class='simple' data-key='1003' shape='poly' coords='630,82,682,90,677,140,624,158,612,158,596,153,594,166,581,177,563,180,534,186,518,182,478,170,479,115,492,110' href='#' linking='vbh-a-interface' alt='A BLOCK' />
  <area class='simple' data-key='1004' shape='poly' coords='244,252,462,191,460,131,416,116,203,156,207,213,227,241' href='#' linking='vbh-b-interface' alt='B BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='152,152,175,152,186,146,197,149,205,143,221,143,231,140,246,136,257,134,272,132,282,128,302,127,325,122,346,119,361,125,202,156,203,209,199,212,186,174' href='#' linking='vbh-c-interface' alt='C BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
              case "vbhtopview":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='357,442,476,467' href='#' />
  <area class='simple' data-key='1002' shape='poly' coords='655,291,796,228,804,232,824,221,807,209,796,209,796,202,783,199,777,199,761,202,742,207,735,208,727,207,715,210,703,211,694,212,680,214,666,216,654,219,643,221,636,219,630,222,623,234' href='#' linking='vbhisometricview2' alt='ISOMETRIC VIEW II' />
  <area class='simple' data-key='1003' shape='poly' coords='687,190,634,167,613,138,613,125,633,119,646,114,662,112,673,111,680,102,696,102,708,98,724,94,737,91,743,89,756,87,762,90,766,92,768,96,775,99,782,104,798,106,803,114,806,124,739,168,722,177' href='#' linking='vbhisometricview1' alt='ISOMETRIC VIEW I' />
  <area class='simple' data-key='1004' shape='poly' coords='347,328,430,328,430,313,462,312,462,328,565,329,564,276,346,276' href='#' linking='vbh-a-interface' alt='A BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='138,283,138,230,320,232,318,283,235,281,237,266,206,266,204,284' href='#' linking='vbh-b-interface' alt='B BLOCK' />
  <area class='simple' data-key='1006' shape='poly' coords='139,140,140,190,206,191,206,176,232,175,236,192,312,188,313,140' href='#' linking='vbh-c-interface' alt='C BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
               
              case "vbh-a-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='poly' coords='16,293,14,310,24,320,46,315,412,318,416,249,411,240,360,244,341,252,342,269,333,268,330,247,29,248,28,292' href='#' linking='vbh-ablock-front' alt='A BLOCK FRONT' />
  <area class='simple' data-key='1002' shape='rect' coords='365,444,474,467' href='#' />
<area class='simple' data-key='1003' shape='poly' coords='436,244,435,312,475,316,481,324,826,326,822,288,816,286,816,246,783,244' href='#' linking='vbh-ablock-back' alt='A BLOCK BACK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
               case "vbh-b-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='poly' coords='18,202,18,285,73,285,110,284,414,285,418,205,414,198,274,200,238,204,213,198,149,201,114,200,109,226,103,222,103,211,94,202,63,200,38,196' linking='vbh-bblock-front' href='#' alt='B FRONT' />
  <area class='simple' data-key='1002' shape='poly' coords='434,204,432,279,437,286,720,284,749,282,794,284,803,280,804,234,805,202,786,202,742,207,723,213,726,228,718,224,720,206,707,205' href='#' linking='vbh-bblock-back'  alt='B BACK' />
  <area class='simple' data-key='1003' shape='rect' coords='364,444,474,467' href='#' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
               case "vbh-c-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='poly' coords='16,288,14,202,93,211,96,217,94,229,107,231,106,207,142,206,212,205,230,207,262,207,292,202,361,205,415,204,419,209,419,286,417,291' href='#' linking='vbh-cblock-front' alt='C FRONT' />
  <area class='simple' data-key='1002' shape='poly' coords='456,289,747,285,758,290,798,290,812,289,816,224,779,225,744,227,737,244,728,244,725,224,677,228,620,227,454,226' href='#' linking='vbh-cblock-back' alt='C BACK' />
  <area class='simple' data-key='1003' shape='rect' coords='358,444,477,467' href='#' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
               case "vbh-ablock-front":
                 
             
                   echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='64,280,113,319' href='#' data-key='VBH-A-104' alt='AG-104' />
<area shape='rect' coords='115,279,162,319' href='#' data-key='VBH-AG-103' alt='AG-103' />
<area shape='rect' coords='165,279,210,320' href='#' data-key='VBH-AG-102' alt='AG-102' />
<area shape='rect' coords='213,279,259,318' href='#' data-key='VBH-AG-101' alt='AG-101' />
<area shape='rect' coords='599,278,648,319' href='#' data-key='VBH-AG-117' alt='AG-117' />
<area shape='rect' coords='550,276,596,319' href='#' data-key='VBH-AG-118' alt='AG-118' />
<area shape='rect' coords='498,278,548,318' href='#' data-key='VBH-AG-119' alt='AG-119' />
<area shape='rect' coords='450,280,498,318' href='#' data-key='VBH-AG-120' alt='AG-120' />
<area shape='rect' coords='399,280,450,320' href='#' data-key='VBH-AG-121' alt='AG-121' />
<area shape='rect' coords='349,278,397,321' href='#' data-key='VBH-AG-122' alt='AG-122' />
<area shape='rect' coords='64,234,113,273' href='#' data-key='VBH-AF-204' alt='AF-204' />

<area shape='rect' coords='115,233,162,273' href='#' data-key='VBH-AF-203' alt='AF-203' />

<area shape='rect' coords='165,233,210,274' href='#' data-key='VBH-AF-202' alt='AF-202' />
<area shape='rect' coords='213,233,259,272' href='#' data-key='VBH-AF-201' alt='AF-201' />
<area shape='rect' coords='599,232,648,273' href='#' data-key='VBH-AF-217' alt='AF-217' />
<area shape='rect' coords='550,230,596,273' href='#' data-key='VBH-AF-218' alt='AF-218' />
<area shape='rect' coords='498,232,548,272' href='#' data-key='VBH-AF-219' alt='AF-219' />
<area shape='rect' coords='450,234,498,272' href='#' data-key='VBH-AF-220' alt='AF-220' />
<area shape='rect' coords='399,234,450,274' href='#' data-key='VBH-AF-221' alt='AF-221' />
<area shape='rect' coords='349,232,397,275' href='#' data-key='VBH-AF-222' alt='AF-222' />
  <area shape='rect' coords='359,443,474,467' href='#' />
  <area shape='poly' coords='231,365,228,424,251,430,274,426,273,436,587,438,585,403,579,377,577,367,559,362,532,364,345,363,313,363,311,365,298,363' href='#' data-key='1001' class='simple' linking='vbh-ablock-back' alt='A BLOCK BACK' />
  <area shape='rect' coords='64,186,113,225' href='#' data-key='VBH-AS-304' alt='AS-304' />
  <area shape='rect' coords='115,185,162,225' href='#' data-key='VBH-AS-303' alt='AS-303' />
  <area shape='rect' coords='165,185,210,226' href='#' data-key='VBH-AS-302' alt='AS-302' />
  <area shape='rect' coords='213,185,259,224' href='#' data-key='VBH-AS-301' alt='AS-301' />
  <area shape='rect' coords='599,184,648,225' href='#' data-key='VBH-AS-317' alt='AS-317' />
  <area shape='rect' coords='550,182,596,225' href='#' data-key='VBH-AS-318' alt='AS-318' />
  <area shape='rect' coords='498,184,548,224' href='#' data-key='VBH-AS-319' alt='AS-319' />
  <area shape='rect' coords='450,186,498,224' href='#' data-key='VBH-AS-320' alt='AS-320' />

  <area shape='rect' coords='399,186,450,226' href='#' data-key='VBH-AS-321' alt='AS-321' />
  <area shape='rect' coords='349,184,397,227' href='#' data-key='VBH-AS-322' alt='AS-322' />
</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
             
   
             
             
             
              case "vbh-ablock-back":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='750,268,796,306' href='#' data-key='VBH-AG-105' alt='AG-105' />
<area shape='rect' coords='707,269,749,308' href='#' data-key='VBH-AG-106' alt='AG-106' />
<area shape='rect' coords='660,269,706,307' href='#' data-key='VBH-AG-107' alt='AG-107' />
<area shape='rect' coords='610,269,658,309' href='#' data-key='VBH-AG-108' alt='AG-108' />
<area shape='rect' coords='562,269,610,306' href='#' data-key='VBH-AG-109' alt='AG-109' />
<area shape='rect' coords='518,269,562,307' href='#' data-key='VBH-AG-110' alt='AG-110' />
<area shape='rect' coords='432,269,480,307' href='#' data-key='VBH-AG-111' alt='AG-111' />
<area shape='rect' coords='384,269,430,307' href='#' data-key='VBH-AG-112' alt='AG-112' />
<area shape='rect' coords='336,269,384,307' href='#' data-key='VBH-AG-113' alt='AG-113' />
<area shape='rect' coords='291,270,336,306' href='#' data-key='VBH-AG-114' alt='AG-114' />
<area shape='rect' coords='246,269,290,306' href='#' data-key='VBH-AG-115' alt='AG-115' />
<area shape='rect' coords='196,268,243,307' href='#' data-key='VBH-AG-116' alt='AG-116' />
<area shape='rect' coords='196,224,243,263' href='#' data-key='VBH-AF-216' alt='AF-216' />
<area shape='rect' coords='246,225,290,262' href='#' data-key='VBH-AF-215' alt='AF-215' />
<area shape='rect' coords='291,226,336,262' href='#' data-key='VBH-AF-214' alt='AF-214' />
<area shape='rect' coords='336,225,384,263' href='#' data-key='VBH-AF-213' alt='AF-213' />
<area shape='rect' coords='384,225,430,263' href='#' data-key='VBH-AF-212' alt='AF-212' />
<area shape='rect' coords='432,225,480,263' href='#' data-key='VBH-AF-211' alt='AF-211' />
<area shape='rect' coords='518,225,562,263' href='#' data-key='VBH-AF-210' alt='AF-210' />
<area shape='rect' coords='562,225,610,262' href='#' data-key='VBH-AF-209' alt='AF-209' />
<area shape='rect' coords='610,225,658,265' href='#' data-key='VBH-AF-208' alt='AF-208' />
<area shape='rect' coords='660,225,706,263' href='#' data-key='VBH-AF-207' alt='AF-207' />
<area shape='rect' coords='707,225,749,264' href='#' data-key='VBH-AF-206' alt='AF-206' />
<area shape='rect' coords='750,224,796,262' href='#' data-key='VBH-AF-205' alt='AF-205' />

  <area shape='rect' coords='358,444,475,467' href='#' />
  <area shape='poly' coords='229,412,228,432,230,431,239,435,270,435,357,429,380,436,417,433,472,436,518,434,559,434,595,435,606,435,606,368,585,365,532,375,533,387,525,387,524,370,492,365,456,371,432,366,409,369,387,370,364,372,346,370,330,369,312,367,296,368,279,367,264,367,248,372,243,370,243,385,242,396,242,413' href='#' class='simple' linking='dbh-ablock-front' data-key='10002' alt='A BLOCK FRONT' />
  <area shape='rect' coords='196,179,243,218' href='#' data-key='VBH-AS-316' alt='AS-316' />
  <area shape='rect' coords='246,180,290,217' href='#' data-key='VBH-AS-315' alt='AS-315' />
  <area shape='rect' coords='291,181,336,217' href='#' data-key='VBH-AS-314' alt='AS-314' />
  <area shape='rect' coords='336,180,384,218' href='#' data-key='VBH-AS-313' alt='AS-313' />
  <area shape='rect' coords='384,180,430,218' href='#' data-key='VBH-AS-312' alt='AS-312' />
  <area shape='rect' coords='432,180,480,218' href='#' data-key='VBH-AS-311' alt='AS-311' />
  <area shape='rect' coords='518,180,562,218' href='#' data-key='VBH-AS-310' alt='AS-310' />
  <area shape='rect' coords='562,180,610,217' href='#' data-key='VBH-AS309-' alt='AS-309' />
  <area shape='rect' coords='610,180,658,220' href='#' data-key='VBH-AS-308' alt='AS-308' />
  <area shape='rect' coords='660,180,706,218' href='#' data-key='VBH-AS-307' alt='AS-307' />
  <area shape='rect' coords='707,180,749,219' href='#' data-key='VBH-AS-306' alt='AS-306' />
  <area shape='rect' coords='750,179,796,217' href='#' data-key='VBH-AS-305' alt='AS-305' />
</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break; 
                 case "vbh-bblock-front":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='594,186,644,230' href='#' data-key='VBH-BS-317' alt='BS-317' />
<area shape='rect' coords='594,238,644,282' href='#' data-key='VBH-BF-217' alt='BF-217' />
<area shape='rect' coords='703,187,760,229' href='#' data-key='VBH-BS-315' alt='BS-315' />
<area shape='rect' coords='646,188,699,231' href='#' data-key='VBH-BS-316' alt='BS-316' />
<area shape='rect' coords='533,189,592,231' href='#' data-key='VBH-BS-318' alt='BS-318' />
<area shape='rect' coords='381,190,439,230' href='#' data-key='VBH-BS-301' alt='BS-301' />
<area shape='rect' coords='328,191,380,231' href='#' data-key='VBH-BS-302' alt='BS-302' />
<area shape='rect' coords='271,190,328,232' href='#' data-key='VBH-BS-303' alt='BS-303' />
<area shape='rect' coords='214,191,270,233' href='#' data-key='VBH-BS-304' alt='BS-304' />
<area shape='rect' coords='214,244,270,286' href='#' data-key='VBH-BF-204' alt='BF-204' />
<area shape='rect' coords='271,243,328,285' href='#' data-key='VBH-BF-203' alt='BF-203' />
<area shape='rect' coords='328,244,380,284' href='#' data-key='VBH-BF-202' alt='BF-202' />
<area shape='rect' coords='381,243,439,283' href='#' data-key='VBH-BF-201' alt='BF-201' />
<area shape='rect' coords='533,242,592,284' href='#' data-key='VBH-BF-218' alt='BF-218' />
<area shape='rect' coords='646,241,699,284' href='#' data-key='VBH-BF-216' alt='BF-216' />
<area shape='rect' coords='703,240,760,282' href='#' data-key='VBH-BF-215' alt='BF-215' />

  <area shape='rect' coords='359,442,476,466' href='#' />


  <area shape='poly' coords='234,435,239,365,252,361,266,365,279,360,300,363,341,363,383,364,436,364,498,365,519,365,524,387,531,390,527,374,539,367,566,363,591,360,609,366,599,415,601,438,591,442,539,436,511,436,479,439,334,440,281,440' class='simple' href='#' data-key='1003' linking='vbh-bblock-back' alt='B BLOCK BACK' />


  <area shape='rect' coords='703,291,760,333' href='#' data-key='VBH-BG-115' alt='BG-115' />

  <area shape='rect' coords='646,292,699,335' href='#' data-key='VBH-BG-116' alt='BG-116' />

  <area shape='rect' coords='594,292,644,336' href='#' data-key='VBH-BG-117' alt='BG-117' />

  <area shape='rect' coords='533,293,592,335' href='#' data-key='VBH-BG-118' alt='BG-118' />

  <area shape='rect' coords='381,294,439,334' href='#' data-key='VBH-BG-101' alt='BG-101' />

  <area shape='rect' coords='329,295,381,335' href='#' data-key='VBH-BG-102' alt='BG-102' />

  <area shape='rect' coords='271,294,328,336' href='#' data-key='VBH-BG-103' alt='BG-103' />

  <area shape='rect' coords='214,295,270,337' href='#' data-key='VBH-BG-104' alt='BG-104' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
             
                 case "vbh-bblock-back":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='583,169,634,211' href='#' data-key='VBH-BS-305' alt='BS-305' />
<area shape='rect' coords='531,169,581,212' href='#' data-key='VBH-BS-306' alt='BS-306' />
<area shape='rect' coords='472,169,530,211' href='#' data-key='VBH-BS-307' alt='BS-307' />
<area shape='rect' coords='416,169,470,210' href='#' data-key='VBH-BS-308' alt='BS-308' />
<area shape='rect' coords='359,170,415,211' href='#' data-key='VBH-BS-309' alt='BS-309' />
<area shape='rect' coords='257,169,316,209' href='#' data-key='VBH-BS-310' alt='BS-310' />
<area shape='rect' coords='198,170,256,210' href='#' data-key='VBH-BS-311' alt='BS-311' />
<area shape='rect' coords='143,169,199,209' href='#' data-key='VBH-BS-312' alt='BS-312' />
<area shape='rect' coords='91,170,143,211' href='#' data-key='VBH-BS-313' alt='BS-313' />
<area shape='rect' coords='31,169,91,213' href='#' data-key='VBH-BS-314' alt='BS-314' />
<area shape='rect' coords='583,221,634,263' href='#' data-key='VBH-BF-205' alt='BF-205' />
<area shape='rect' coords='531,221,581,264' href='#' data-key='VBH-BF-206' alt='BF-206' />
<area shape='rect' coords='472,221,530,263' href='#' data-key='VBH-BF-207' alt='BF-207' />
<area shape='rect' coords='416,221,470,262' href='#' data-key='VBH-BF-208' alt='BF-208' />
<area shape='rect' coords='359,222,415,263' href='#' data-key='VBH-BF-209' alt='BF-209' />
<area shape='rect' coords='257,221,316,261' href='#' data-key='VBH-BF-210' alt='BF-210' />
<area shape='rect' coords='198,222,256,262' href='#' data-key='VBH-BF-211' alt='BF-211' />
<area shape='rect' coords='143,221,199,261' href='#' data-key='VBH-BF-212' alt='BF-212' />
<area shape='rect' coords='91,222,143,263' href='#' data-key='VBH-BF-213' alt='BF-213' />
<area shape='rect' coords='31,221,91,265' href='#' data-key='VBH-BF-214' alt='BF-214' />

  <area shape='rect' coords='359,444,476,468' href='#' />

  <area shape='poly' coords='251,429,257,417,257,371,255,365,290,366,313,365,326,371,322,383,330,384,332,364,351,365,386,369,418,362,425,370,445,369,462,368,482,363,504,365,530,365,545,365,558,365,569,365,565,431,346,431' href='#' data-key='vbh-bblock-front' linking='vbh-bblock-front' class='simple' alt='B BLOCK FRONT' />

  <area shape='rect' coords='583,275,634,317' href='#' data-key='VBH-BG-105' alt='BG-105' />

  <area shape='rect' coords='531,275,581,318' href='#' data-key='VBH-BG-106' alt='BG-106' />

  <area shape='rect' coords='472,275,530,317' href='#' data-key='VBH-BG-107' alt='BG-107' />

  <area shape='rect' coords='416,275,470,316' href='#' data-key='VBH-BG-108' alt='BG-108' />

  <area shape='rect' coords='359,276,415,317' href='#' data-key='VBH-BG-109' alt='BG-109' />

  <area shape='rect' coords='257,275,316,315' href='#' data-key='VBH-BG-110' alt='BG-110' />
  <area shape='rect' coords='198,276,256,316' href='#' data-key='VBH-BG-111' alt='BG-111' />

  <area shape='rect' coords='143,275,199,315' href='#' data-key='VBH-BG-112' alt='BG-112' />

  <area shape='rect' coords='91,276,143,317' href='#' data-key='VBH-BG-113' alt='BG-113' />

  <area shape='rect' coords='31,275,91,319' href='#' data-key='VBH-BG-114' alt='BG-114' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
                case "vbh-cblock-front":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'><area shape='rect' coords='709,180,765,220' href='#' data-key='VBH-CS-315' alt='CS-315' />
<area shape='rect' coords='649,180,706,221' href='#' data-key='VBH-CS-316' alt='CS-316' />
<area shape='rect' coords='598,181,648,220' href='#' data-key='VBH-CS-317' alt='CS-317' />
<area shape='rect' coords='540,180,597,223' href='#' data-key='VBH-CS-318' alt='CS-318' />
<area shape='rect' coords='383,181,441,221' href='#' data-key='VBH-CS-301' alt='CS-301' />
<area shape='rect' coords='325,179,382,220' href='#' data-key='VBH-CS-302' alt='CS-302' />
<area shape='rect' coords='276,180,324,222' href='#' data-key='VBH-CS-303' alt='CS-303' />
<area shape='rect' coords='216,179,275,222' href='#' data-key='VBH-CS-304' alt='CS-304' />
<area shape='rect' coords='709,232,765,272' href='#' data-key='VBH-CS-215' alt='CF-215' />
<area shape='rect' coords='649,232,706,273' href='#' data-key='VBH-CS-216' alt='CF-216' />
<area shape='rect' coords='598,233,648,272' href='#' data-key='VBH-CS-217' alt='CF-217' />
<area shape='rect' coords='540,232,597,275' href='#' data-key='VBH-CS-218' alt='CF-218' />
<area shape='rect' coords='383,233,441,273' href='#' data-key='VBH-CS-201' alt='CF-201' />
<area shape='rect' coords='325,231,382,272' href='#' data-key='VBH-CS-202' alt='CF-202' />
<area shape='rect' coords='276,232,324,274' href='#' data-key='VBH-CS-203' alt='CF-203' />
<area shape='rect' coords='216,231,275,274' href='#' data-key='VBH-CS-204' alt='CF-204' />

  <area shape='rect' coords='359,442,474,468' href='#' />

  <area shape='poly' coords='250,434,253,417,276,407,279,396,276,381,283,375,301,377,323,376,348,376,373,374,389,375,413,376,448,376,478,377,498,378,504,392,514,379,533,378,553,380,569,378,573,383,569,403,567,427,566,440,542,440,322,439,279,439' href='#' data-key='asdf' class='simple' linking='vbh-cblock-back' alt='C BLOCK BACK' />

  <area shape='rect' coords='709,284,765,324' href='#' data-key='VBH-CG-115' alt='CG-115' />

  <area shape='rect' coords='649,284,706,325' href='#' data-key='VBH-CG-116' alt='CG-116' />

  <area shape='rect' coords='598,285,648,324' href='#' data-key='VBH-CG-117' alt='CG-117' />

  <area shape='rect' coords='540,284,597,327' href='#' data-key='VBH-CG-118' alt='CG-118' />

  <area shape='rect' coords='383,285,441,325' href='#' data-key='VBH-CG-101' alt='CG-101' />

  <area shape='rect' coords='325,283,382,324' href='#' data-key='VBH-CG-102' alt='CG-102' />

  <area shape='rect' coords='276,284,324,326' href='#' data-key='VBH-CG-103' alt='CG-103' />

  <area shape='rect' coords='216,283,275,326' href='#' data-key='VBH-CG-104' alt='CG-104' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
           case "vbh-cblock-back":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'><area shape='rect' coords='78,193,127,228' href='#' data-key='VBH-CS-314' alt='CS-314' />
<area shape='rect' coords='127,192,176,231' href='#' data-key='VBH-CS-313' alt='CS-313' />
<area shape='rect' coords='176,193,231,229' href='#' data-key='VBH-CS-312' alt='CS-312' />
<area shape='rect' coords='234,194,281,233' href='#' data-key='VBH-CS-311' alt='CS-311' />
<area shape='rect' coords='285,195,337,231' href='#' data-key='VBH-CS-310' alt='CS-310' />
<area shape='rect' coords='382,193,429,233' href='#' data-key='VBH-CS-309' alt='CS-309' />
<area shape='rect' coords='431,196,483,232' href='#' data-key='VBH-CS-308' alt='CS-308' />
<area shape='rect' coords='485,194,529,235' href='#' data-key='VBH-CS-307' alt='CS-307' />
<area shape='rect' coords='534,196,586,232' href='#' data-key='VBH-CS-306' alt='CS-306' />
<area shape='rect' coords='590,193,634,235' href='#' data-key='VBH-CS-305' alt='CS-305' />
<area shape='rect' coords='590,244,634,286' href='#' data-key='VBH-CF-205' alt='CF-205' />
<area shape='rect' coords='534,247,586,283' href='#' data-key='VBH-CF-206' alt='CF-206' />
<area shape='rect' coords='485,245,529,286' href='#' data-key='VBH-CF-207' alt='CF-207' />
<area shape='rect' coords='431,247,483,283' href='#' data-key='VBH-CF-208' alt='CF-208' />
<area shape='rect' coords='382,244,429,284' href='#' data-key='VBH-CF-209' alt='CF-209' />
<area shape='rect' coords='285,246,337,282' href='#' data-key='VBH-CF-201' alt='CF-210' />
<area shape='rect' coords='234,245,281,284' href='#' data-key='VBH-CF-211' alt='CF-211' />
<area shape='rect' coords='176,244,231,280' href='#' data-key='VBH-CF-212' alt='CF-212' />
<area shape='rect' coords='127,243,176,282' href='#' data-key='VBH-CF-213' alt='CF-213' />
<area shape='rect' coords='78,244,127,279' href='#' data-key='VBH-CF-214' alt='CF-214' />

  <area shape='rect' coords='359,443,473,466' href='#' />

  <area shape='poly' coords='251,424,250,437,277,442,314,439,345,438,406,444,425,437,452,438,482,441,517,441,544,441,566,439,564,373,514,373,449,372,432,375,407,377,387,376,351,370,336,373,329,393,316,391,323,382,308,377,283,375,267,374,255,372,257,411' href='#' class='simple' linking='vbh-cblock-front' data-key='10101' alt='C BLOCK FRONT' />

  <area shape='rect' coords='78,292,127,327' href='#' data-key='VBH-CG-114' alt='CG-114' />

  <area shape='rect' coords='127,291,176,330' href='#' data-key='VBH-CG-113' alt='CG-113' />

  <area shape='rect' coords='176,292,231,328' href='#' data-key='VBH-CG-112' alt='CG-112' />

  <area shape='rect' coords='234,293,281,332' href='#' data-key='VBH-CG-111' alt='CG-111' />

  <area shape='rect' coords='285,294,337,330' href='#' data-key='VBH-CG-110' alt='CG-110' />

  <area shape='rect' coords='382,292,429,332' href='#' data-key='VBH-CG-109' alt='CG-109' />

  <area shape='rect' coords='431,295,483,331' href='#' data-key='VBH-CG-108' alt='CG-108' />

  <area shape='rect' coords='485,293,529,334' href='#' data-key='VBH-CG-107' alt='CG-107' />

  <area shape='rect' coords='534,295,586,331' href='#' data-key='VBH-CG-106' alt='CG-106' />

  <area shape='rect' coords='590,292,634,334' href='#' data-key='VBH-CG-105' alt='CG-105' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
   
   
        case "nbhisometricview1":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='poly' coords='169,210,168,203,188,189,197,184,199,172,206,165,227,166,233,165,259,149,341,161,333,170,315,178,316,188,262,220,247,232,241,312,189,279,179,283,168,282,167,264' href='#' linking='nbh-a-interface' alt='A Block' />
  <area class='simple' data-key='1002' shape='poly' coords='594,173,609,168,640,178,641,186,640,196,700,209,701,270,650,292,612,296,596,300' linking='nbh-b-interface' href='#' alt='B Block' />
  <area class='simple' data-key='1003' shape='rect' coords='361,445,472,466' href='#'  alt='Learn' />
  <area class='simple' data-key='1004' shape='rect' coords='670,358,782,380' linking='nbhisometricview2' alt='ISOMETRIC VIEW II' href='#' />
  <area class='simple' data-key='1005' shape='rect' coords='668,391,780,413' linking='nbhtopview' alt='TOP VIEW' href='#' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
   
    case "nbhisometricview2":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='360,444,478,466'  alt='learn'  href='#' />
  <area class='simple' data-key='1002' shape='rect' coords='540,355,654,380' linking='nbhisometricview1' alt='ISOMETRIC VIEW I'  href='#' />
  <area class='simple' data-key='1003' shape='rect' coords='539,390,656,413' linking='nbhtopview'   alt='TOP VIEW'  href='#' />
  <area class='simple' data-key='1004' shape='poly' coords='271,141,270,134,281,130,294,130,294,136,301,140,315,137,322,139,332,144,336,151,349,160,357,169,343,172,338,175,347,188,354,187,365,202,347,213,322,217,312,221,315,241,315,271,299,234,291,208,284,194,277,192,273,190,270,172,266,156,264,148,265,141' href='#' linking='nbh-a-interface' alt='A BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='481,185,468,178,529,166,535,171,544,168,543,163,590,158,600,158,637,148,666,153,675,154,676,147,686,144,704,149,714,150,713,158,711,164,718,168,695,213,673,221,659,218,644,225,612,234,590,242,563,250,539,259,517,264,508,279,473,289,481,224,480,219,472,194,466,187,472,183' href='#' linking='nbh-b-interface' alt='B BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
   
   
          case "nbhtopview":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='98,397,209,414' linking='nbhisometricview2' alt='ISOMETRIC VIEW II' href='#' />
  <area class='simple' data-key='1002' shape='rect' coords='104,184,214,206' linking='nbhisometricview1' alt='ISOMETRIC VIEW I' href='#' />
  <area class='simple' data-key='1003' shape='rect' coords='365,446,472,465' alt='learn' href='#' />
  <area class='simple' data-key='1004' shape='poly' coords='337,68,348,69,350,54,378,56,389,60,391,66,413,68,413,84,418,85,417,140,413,143,413,154,417,157,416,230,400,230,354,228,350,228,351,125,357,104,338,106' href='#'  linking='nbh-a-interface' alt='A BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='500,320,500,304,574,303,574,309,588,309,589,305,661,304,662,311,677,310,677,303,749,304,752,330,757,340,763,340,762,371,748,373,747,383,710,384,708,371,503,371,502,364' href='#' linking='nbh-b-interface' alt='B BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }      
             
             
             
              case "nbh-a-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='poly' coords='17,202,35,204,35,219,223,220,224,205,242,205,242,215,361,217,362,203,405,205,405,216,413,217,410,267,251,268,254,282,15,284' href='#' linking='nbh-ablock-front' alt='A BLOCK FRONT' />
  <area class='simple' data-key='1002' shape='poly' coords='429,249,429,274,501,274,502,287,539,290,627,291,630,270,820,269,822,194,800,193,805,204,628,206,623,198,606,195,604,202,491,207,490,198,465,194,448,196,451,204,441,207,444,257,433,257' href='#' linking='nbh-ablock-back' alt='A BLOCK BACK' />
  <area class='simple' data-key='1003' shape='rect' coords='360,445,474,467' alt='learn' href='#' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
              case "nbh-b-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='361,443,476,464' alt='learn' href='#' />
  <area class='simple' data-key='1002' shape='poly' coords='22,251,23,218,34,216,37,206,62,207,62,217,104,218,105,207,119,210,120,219,398,220,399,210,412,209,414,272,22,271' href='#' linking='nbh-bblock-front' alt='B BLOCK FRONT' />
  <area class='simple' data-key='1003' shape='poly' coords='436,199,437,257,432,260,428,271,820,269,817,242,814,220,815,206,806,199,787,195,778,203,748,204,735,207,739,196,720,196,720,207,580,204,486,207,455,208,449,198' href='#' linking='nbh-bblock-back' alt='B BLOCK BACK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
             
             
             case "room mapping case":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
             
             
             
      
            case "nbh-ablock-front":
                
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                    
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map' id='Maping'   />";
                
                
              echo "<map name='Map' id='Map'>
  <area shape='rect' coords='360,443,480,471' alt='learn' href='#' />
  <area shape='poly' coords='185,413,199,418,199,376,206,370,205,363,242,363,244,375,349,375,350,363,366,364,366,372,533,373,532,363,552,363,548,432,371,434,182,436' href='#' class='simple' linking='nbh-ablock-back' data-key='10001' alt='A BLOACK BACK' />
  <area shape='rect' coords='400,291,437,322' href='#' data-key='NBH-A-109' alt='A-109' />
  <area shape='rect' coords='354,292,396,321' href='#' data-key='NBH-A-110' alt='A-110' />
  <area shape='rect' coords='312,291,353,322' href='#' data-key='NBH-A-111' alt='A-111' />
  <area shape='rect' coords='268,289,307,322' href='#' data-key='NBH-A-112' alt='A-112' />
  <area shape='rect' coords='228,292,266,320' href='#' data-key='NBH-A-113' alt='A-113' />
  <area shape='rect' coords='186,291,228,322' href='#' data-key='NBH-A-114' alt='A-114' />
  <area shape='rect' coords='398,257,435,288' href='#' data-key='NBH-A-209' alt='A-209' />
  <area shape='rect' coords='350,257,395,290' href='#' data-key='NBH-A-210' alt='A-210' />
  <area shape='rect' coords='311,259,350,290' href='#' data-key='NBH-A-211' alt='A-211' />
  <area shape='rect' coords='268,257,308,286' href='#' data-key='NBH-A-212' alt='A-212' />
  <area shape='rect' coords='226,258,265,288' href='#' data-key='NBH-A-213' alt='A-213' />
  <area shape='rect' coords='182,258,226,288' href='#' data-key='NBH-A-214' alt='A-214' />
  <area shape='rect' coords='396,227,436,254' href='#' data-key='NBH-A-309' alt='A-309' />
  <area shape='rect' coords='352,227,395,257' href='#' data-key='NBH-A-310' alt='A-310' />
  <area shape='rect' coords='311,227,351,257' href='#' data-key='NBH-A-311' alt='A-311' />
  <area shape='rect' coords='268,227,308,255' href='#' data-key='NBH-A-312' alt='A-312' />
  <area shape='rect' coords='225,226,268,257' href='#' data-key='NBH-A-313' alt='A-313' />
  <area shape='rect' coords='182,226,226,256' href='#' data-key='NBH-A-314' alt='A-314' />
  <area shape='rect' coords='395,194,434,224' href='#' data-key='NBH-A-409' alt='A-409' />
  <area shape='rect' coords='351,194,393,223' href='#' data-key='NBH-A-410' alt='A-410' />
  <area shape='rect' coords='312,194,350,224' href='#' data-key='NBH-A-411' alt='A-411' />
  <area shape='rect' coords='264,195,310,225' href='#' data-key='NBH-A-412' alt='A-412' />
  <area shape='rect' coords='226,194,264,225' href='#' data-key='NBH-A-413' alt='A-413' />
  <area shape='rect' coords='182,191,226,224' href='#' data-key='NBH-A-414' alt='A-414' />
</map>";
              
                echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
      
       
        
            case "nbh-ablock-back":
                
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                    
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map' id='Maping'   />";
                
                
              echo "<map name='Map' id='Map'>
  <area shape='rect' coords='359,446,474,465' href='#' alt='learn' />
  <area shape='rect' coords='341,246,391,278' href='#' data-key='NBH-A-108' alt='A-108' />
  <area shape='rect' coords='393,245,437,275' href='#' data-key='NBH-A-107' alt='A-107' />
  <area shape='rect' coords='440,244,486,280' href='#' data-key='NBH-A-106' alt='A-106' />
  <area shape='rect' coords='487,244,537,278' href='#' data-key='NBH-A-105' alt='A-105' />
  <area shape='rect' coords='582,242,633,279' href='#' data-key='NBH-A-104' alt='A-104' />
  <area shape='rect' coords='635,243,683,279' href='#' data-key='NBH-A-103' alt='A-103' />
  <area shape='rect' coords='684,243,730,279' href='#' data-key='NBH-A-102' alt='A-102' />
  <area shape='rect' coords='731,243,778,279' href='#' data-key='NBH-A-101' alt='A-101' />
  <area shape='rect' coords='730,208,778,241' href='#' data-key='NBH-A-201' alt='A-201' />
  <area shape='rect' coords='682,207,728,240' href='#' data-key='NBH-A-202' alt='A-202' />
  <area shape='rect' coords='631,205,681,240' href='#' data-key='NBH-A-203' alt='A-203' />
  <area shape='rect' coords='581,205,631,240' href='#' data-key='NBH-A-204' alt='A-204' />
  <area shape='rect' coords='489,206,537,242' href='#' data-key='NBH-A-205' alt='A-205' />
  <area shape='rect' coords='441,206,488,243' href='#' data-key='NBH-A-206' alt='A-206' />
  <area shape='rect' coords='390,206,439,243' href='#' data-key='NBH-A-207' alt='A-207' />
  <area shape='rect' coords='340,206,389,243' href='#' data-key='NBH-A-208' alt='A-208' />
  <area shape='rect' coords='730,167,777,206' href='#' data-key='NBH-A-301' alt='A-301' />
  <area shape='rect' coords='683,168,729,204' href='#' data-key='NBH-A-302' alt='A-302' />
  <area shape='rect' coords='633,167,681,205' href='#' data-key='NBH-A-303' alt='A-303' />
  <area shape='rect' coords='583,168,632,205' href='#' data-key='NBH-A-304' alt='A-304' />
  <area shape='rect' coords='487,168,536,204' href='#' data-key='NBH-A-305' alt='A-305' />
  <area shape='rect' coords='439,169,487,203' href='#' data-key='NBH-A-306' alt='A-306' />
  <area shape='rect' coords='390,167,437,205' href='#' data-key='NBH-A-307' alt='A-307' />
  <area shape='rect' coords='341,167,390,203' href='#' data-key='NBH-A-308' alt='A-308' />
  <area shape='rect' coords='729,132,776,168' href='#' data-key='NBH-A-401' alt='A-401' />
  <area shape='rect' coords='681,130,729,167' href='#' data-key='NBH-A-402' alt='A-402' />
  <area shape='rect' coords='632,130,680,166' href='#' data-key='NBH-A-403' alt='A-403' />
  <area shape='rect' coords='584,131,631,166' href='#' data-key='NBH-A-404' alt='A-404' />
  <area shape='rect' coords='488,131,536,167' href='#' data-key='NBH-A-405' alt='A-405' />
  <area shape='rect' coords='438,131,487,166' href='#' data-key='NBH-A-406' alt='A-406' />
  <area shape='rect' coords='391,129,436,164' href='#' data-key='NBH-A-407' alt='A-407' />
  <area shape='rect' coords='339,129,390,164' href='#' data-key='NBH-A-408' alt='A-408' />
  <area shape='poly' coords='72,348,95,348,94,364,318,364,316,352,339,351,340,364,482,363,480,355,479,349,530,350,525,358,524,365,537,366,551,428,552,432,353,430,350,446,69,446' href='#' data-key='20202' linking='nbh-ablock-front' class='simple' alt='A BLOCK FRONT' />
</map>";
              
                echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
             
   
    
            case "nbh-bblock-front":
                
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                    
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map' id='Maping'   />";
                
                
              echo "
<map name='Map' id='Map'>
<area shape='rect' coords='103,143,165,187' href='#' data-key='NBH-B-413' alt='B-413' />
<area shape='rect' coords='169,146,232,189' href='#' data-key='NBH-B-414' alt='B-414' />
<area shape='rect' coords='231,146,290,190' href='#' data-key='NBH-B-415' alt='B-415' />
<area shape='rect' coords='293,146,353,186' href='#' data-key='NBH-B-416' alt='B-416' />
<area shape='rect' coords='355,147,415,186' href='#' data-key='NBH-B-417' alt='B-417' />
<area shape='rect' coords='420,145,480,188' href='#' data-key='NBH-B-418' alt='B-418' />
<area shape='rect' coords='481,146,537,189' href='#' data-key='NBH-B-419' alt='B-419' />
<area shape='rect' coords='545,147,603,187' href='#' data-key='NBH-B-420' alt='B-420' />
<area shape='rect' coords='606,147,665,189' href='#' data-key='NBH-B-421' alt='B-421' />
<area shape='rect' coords='669,146,729,186' href='#' data-key='NBH-B-422' alt='B-422' />
<area shape='rect' coords='731,145,786,188' href='#' data-key='NBH-B-423' alt='B-423' />
<area shape='rect' coords='731,191,786,234' href='#' data-key='NBH-B-323' alt='B-323' />
<area shape='rect' coords='669,192,729,232' href='#' data-key='NBH-B-322' alt='B-322' />
<area shape='rect' coords='606,193,665,235' href='#' data-key='NBH-B-321' alt='B-321' />
<area shape='rect' coords='545,193,603,233' href='#' data-key='NBH-B-320' alt='B-320' />
<area shape='rect' coords='481,192,537,235' href='#' data-key='NBH-B-319' alt='B-319' />
<area shape='rect' coords='420,191,480,234' href='#' data-key='NBH-B-318' alt='B-318' />
<area shape='rect' coords='355,193,415,232' href='#' data-key='NBH-B-317' alt='B-317' />
<area shape='rect' coords='293,192,353,232' href='#' data-key='NBH-B-316' alt='B-316' />
<area shape='rect' coords='231,192,290,236' href='#' data-key='NBH-B-315' alt='B-315' />
<area shape='rect' coords='169,192,232,235' href='#' data-key='NBH-B-314' alt='B-314' />
<area shape='rect' coords='103,189,165,233' href='#' data-key='NBH-B-313' alt='B-313' />
<area shape='rect' coords='103,238,165,282' href='#' data-key='NBH-B-213' alt='B-213' />
<area shape='rect' coords='169,241,232,284' href='#' data-key='NBH-B-214' alt='B-214' />
<area shape='rect' coords='231,241,290,285' href='#' data-key='NBH-B-215' alt='B-215' />
<area shape='rect' coords='293,241,353,281' href='#' data-key='NBH-B-216' alt='B-216' />
<area shape='rect' coords='355,242,415,281' href='#' data-key='NBH-B-217' alt='B-217' />
<area shape='rect' coords='420,240,480,283' href='#' data-key='NBH-B-218' alt='B-218' />
<area shape='rect' coords='481,241,537,284' href='#' data-key='NBH-B-219' alt='B-219' />
<area shape='rect' coords='545,242,603,282' href='#' data-key='NBH-B-220' alt='B-220' />
<area shape='rect' coords='606,242,665,284' href='#' data-key='NBH-B-221' alt='B-221' />
<area shape='rect' coords='669,241,729,281' href='#' data-key='NBH-B-222' alt='B-222' />
<area shape='rect' coords='731,240,786,283' href='#' data-key='NBH-B-223' alt='B-223' />

  <area shape='rect' coords='358,444,475,467' alt='learn' href='#' />
  <area shape='poly' coords='217,358,218,425,203,425,210,438,622,436,628,408,618,401,622,369,611,369,609,358,581,359,580,370,536,371,539,360,522,356,523,365,487,369,453,371,230,367,232,358' href='#' data-key='10001' class='simple' linking='nbh-bblock-back' alt='B BLOCK BACK' />
  <area shape='rect' coords='731,294,786,337' href='#' data-key='NBH-B-123' alt='B-123' />
  <area shape='rect' coords='669,295,729,335' href='#' data-key='NBH-B-122' alt='B-122' />
  <area shape='rect' coords='606,296,665,338' href='#' data-key='NBH-B-121' alt='B-121' />
  <area shape='rect' coords='545,296,603,336' href='#' data-key='NBH-B-120' alt='B-120' />
  <area shape='rect' coords='481,295,537,338' href='#' data-key='NBH-B-119' alt='B-119' />
  <area shape='rect' coords='420,294,480,337' href='#' data-key='NBH-B-118' alt='B-118' />
  <area shape='rect' coords='355,296,415,335' href='#' data-key='NBH-B-117' alt='B-117' />
  <area shape='rect' coords='293,295,353,335' href='#' data-key='NBH-B-116' alt='B-116' />
  <area shape='rect' coords='231,295,290,339' href='#' data-key='NBH-B-115' alt='B-115' />
  <area shape='rect' coords='169,295,232,338' href='#' data-key='NBH-B-114' alt='B-114' />
  <area shape='rect' coords='103,292,165,336' href='#' data-key='NBH-B-113' alt='B-113' />
</map>";
              
                echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
      
       
        
            case "nbh-bblock-back":
                
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                    
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map' id='Maping'   />";
                
                
              echo "<map name='Map' id='Map'>
<area shape='rect' coords='764,119,817,159' href='#' data-key='NBH-B-412' alt='B-412' />
<area shape='rect' coords='706,118,762,160' href='#' data-key='NBH-B-411' alt='B-411' />
<area shape='rect' coords='648,118,704,161' href='#' data-key='NBH-B-410' alt='B-410' />
<area shape='rect' coords='588,120,648,163' href='#' data-key='NBH-B-409' alt='B-409' />
<area shape='rect' coords='423,118,475,160' href='#' data-key='NBH-B-407' alt='B-407' />
<area shape='rect' coords='364,118,421,160' href='#' data-key='NBH-B-406' alt='B-406' />
<area shape='rect' coords='304,118,361,160' href='#' data-key='NBH-B-405' alt='B-405' />
<area shape='rect' coords='19,118,79,158' href='#' data-key='NBH-B-401' alt='B-401' />
<area shape='rect' coords='195,117,250,158' href='#' data-key='NBH-B-404' alt='B-404' />
<area shape='rect' coords='136,117,194,158' href='#' data-key='NBH-B-403' alt='B-403' />
<area shape='rect' coords='82,118,134,158' href='#' data-key='NBH-B-402' alt='B-402' />
<area shape='rect' coords='479,118,535,160' href='#' data-key='NBH-B-408' alt='B-408' />
<area shape='rect' coords='479,162,535,204' href='#' data-key='NBH-B-308' alt='B-308' />
<area shape='rect' coords='82,162,134,202' href='#' data-key='NBH-B-302' alt='B-302' />
<area shape='rect' coords='136,161,194,202' href='#' data-key='NBH-B-303' alt='B-303' />
<area shape='rect' coords='195,161,250,202' href='#' data-key='NBH-B-304' alt='B-304' />
<area shape='rect' coords='19,162,79,202' href='#' data-key='NBH-B-301' alt='B-301' />
<area shape='rect' coords='304,162,361,204' href='#' data-key='NBH-B-305' alt='B-305' />
<area shape='rect' coords='364,162,421,204' href='#' data-key='NBH-B-306' alt='B-306' />
<area shape='rect' coords='423,162,475,204' href='#' data-key='NBH-B-307' alt='B-307' />
<area shape='rect' coords='588,164,648,207' href='#' data-key='NBH-B-309' alt='B-309' />
<area shape='rect' coords='648,162,704,205' href='#' data-key='NBH-B-310' alt='B-310' />
<area shape='rect' coords='706,162,762,204' href='#' data-key='NBH-B-311' alt='B-311' />
<area shape='rect' coords='764,163,817,203' href='#' data-key='NBH-B-312' alt='B-312' />
<area shape='rect' coords='764,206,817,246' href='#' data-key='NBH-B-212' alt='B-212' />
<area shape='rect' coords='706,205,762,247' href='#' data-key='NBH-B-211' alt='B-211' />
<area shape='rect' coords='648,205,704,248' href='#' data-key='NBH-B-210' alt='B-210' />
<area shape='rect' coords='588,207,648,250' href='#' data-key='NBH-B-209' alt='B-209' />
<area shape='rect' coords='423,205,475,247' href='#' data-key='NBH-B-207' alt='B-207' />
<area shape='rect' coords='364,205,421,247' href='#' data-key='NBH-B-206' alt='B-206' />
<area shape='rect' coords='304,205,361,247' href='#' data-key='NBH-B-205' alt='B-205' />
<area shape='rect' coords='19,205,79,245' href='#' data-key='NBH-B-201' alt='B-201' />
<area shape='rect' coords='195,204,250,245' href='#' data-key='NBH-B-204' alt='B-204' />
<area shape='rect' coords='136,204,194,245' href='#' data-key='NBH-B-203' alt='B-203' />
<area shape='rect' coords='82,205,134,245' href='#' data-key='NBH-B-202' alt='B-202' />
<area shape='rect' coords='479,205,535,247' href='#' data-key='NBH-B-208' alt='B-208' />

  <area shape='rect' coords='358,443,477,466' alt='learn' href='#' />
  <area shape='poly' coords='167,409' href='#' data-key='NBfs' linking='nbh-bblock-front' class='simple' alt='B BLOCK FRONT' />
  <area shape='poly' coords='167,433,674,434,666,429,665,356,649,352,649,363,294,365,295,354,275,354,273,363,219,363,220,351,186,352,186,363,170,364,174,408,166,408,166,416' href='#' data-key='NBfs' linking='nbh-bblock-front' class='simple' alt='B BLOCK FRONT' />
  <area shape='rect' coords='479,252,535,294' href='#' data-key='NBH-B-108' alt='B-108' />
  <area shape='rect' coords='82,252,134,292' href='#' data-key='NBH-B-102' alt='B-102' />
  <area shape='rect' coords='136,251,194,292' href='#' data-key='NBH-B-103' alt='B-103' />
  <area shape='rect' coords='195,251,250,292' href='#' data-key='NBH-B-104' alt='B-104' />
  <area shape='rect' coords='19,252,79,292' href='#' data-key='NBH-B-101' alt='B-101' />
  <area shape='rect' coords='304,252,361,294' href='#' data-key='NBH-B-105' alt='B-105' />
  <area shape='rect' coords='364,252,421,294' href='#' data-key='NBH-B-106' alt='B-106' />
  <area shape='rect' coords='423,252,475,294' href='#' data-key='NBH-B-107' alt='B-107' />
  <area shape='rect' coords='588,254,648,297' href='#' data-key='NBH-B-109' alt='B-109' />
  <area shape='rect' coords='648,252,704,295' href='#' data-key='NBH-B-110' alt='B-110' />
  <area shape='rect' coords='706,252,762,294' href='#' data-key='NBH-B-111' alt='B-111' />
  <area shape='rect' coords='764,253,817,293' href='#' data-key='NBH-B-112' alt='B-112' />

</map>";
              
                echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
             
   
   
   
             
             
              case "topview template code":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
             
                  
              case "mmhisometricview1":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect' coords='358,443,472,471' href='#' alt='LEARN' />
  <area class='simple' data-key='1002' shape='poly' coords='689,160,758,138,822,97,822,82,801,72,774,63,736,73,717,83,702,97,670,112,679,145' href='#' linking='mmhisometricview2' alt='ISO VIEW II' />
  <area class='simple' data-key='1003' shape='poly' coords='521,77,580,57,596,57,599,51,646,55,653,134,573,132,568,126,519,127' href='#' linking='mmhtopview' alt='TOP VIEW' />
  <area class='simple' data-key='1004' shape='poly' coords='493,247,494,230,489,227,499,207,509,205,520,188,528,186,538,192,546,192,553,197,564,200,577,203,590,206,600,176,635,187,640,177,653,178,660,182,674,187,666,208,658,211,644,250,624,292,615,306,595,310,572,308,516,282,519,257,520,242,508,237' href='#'  linking='mmh-ablock-interface' alt='A BLOCK' />
  <area class='simple' data-key='1006' shape='poly' coords='428,260,438,259,437,250,434,248,439,244,436,231,429,220,417,220,406,202,399,198,384,202,372,206,361,208,352,212,342,214,337,206,334,196,326,184,321,176,284,186,274,182,269,186,258,186,252,194,260,212,270,219,277,244,278,254,282,261,284,272,289,282,290,292,296,302,305,312,318,319,330,320,343,320,402,298,400,266,405,256' href='#' linking='mmh-bblock-interface'  alt='B BLOCK' />
  <area class='simple' data-key='1007' shape='poly' coords='252,184,265,182,271,172,270,158,266,142,262,129,262,121,259,105,256,94,248,94,236,88,232,84,238,72,244,67,248,65,230,57,220,55,205,51,188,65,176,83,162,95,187,100,168,115,176,143,183,160,187,166,195,161,210,148,212,133,218,132,224,139,226,156,235,158,242,164,248,174' href='#' linking='mmh-cblock-interface'  alt='C BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
                  
              case "mmhtopview":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect' coords='357,443,476,470' href='#' />
  <area class='simple' data-key='1001' shape='poly' coords='176,180,178,160,180,140,172,128,152,122,134,118,120,114,102,111,85,106,72,98,60,97,46,114,28,127,26,156,39,165,54,171,77,176,106,176,124,171,136,175,146,171' href='#' linking='mmhisometricview1' alt='ISO VIEW I' />
  <area class='simple' data-key='1002' shape='poly' coords='40,324,108,300,130,290,164,268,171,261,172,248,158,240,142,232,132,225,119,226,94,240,82,236,66,250,54,258,44,269,22,275,32,308' href='#' linking='mmhisometricview2' alt='ISO VIEW II' />
  <area class='simple' data-key='1003' shape='poly' coords='259,324,282,330,288,326,297,324,304,322,308,319,314,318,315,308,319,288,320,280,325,275,372,283,382,254,386,246,388,225,362,224,355,226,310,220,302,244,277,243,272,251' href='#' linking='mmh-ablock-interface' alt='A BLOCK' />
  <area class='simple' data-key='1004' shape='poly' coords='421,198,438,216,446,214,464,232,499,198,538,235,582,199,562,178,522,145,502,164,480,142' href='#' linking='mmh-bblock-interface' alt='B BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='739,351,738,320,732,317,730,268,699,266,698,236,648,236,612,234,614,260,637,262,635,291,676,294,680,350' linking='mmh-cblock-interface' href='#' alt='C BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
                  
              case "mmhisometricview2":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect' coords='361,443,476,469' href='#' />
  <area class='simple' data-key='1001' shape='poly' coords='582,406,619,422,626,419,647,428,714,418,758,434,764,382,751,368,698,353,677,351,646,340,629,332,606,355,584,370' href='#' linking='mmhisometricview1' alt='ISO VIEW I' />
  <area class='simple' data-key='1002' shape='poly' coords='798,334,717,333,714,324,665,324,662,274,688,273,711,264,729,254,746,253,751,249,787,249,798,251' href='#' linking='mmhtopview' alt='TOP VIEW' />
  <area class='simple' data-key='1003' shape='poly' coords='220,342,251,330,248,317,273,308,280,306,274,270,311,255,308,232,316,228,316,216,316,207,312,190,308,180,302,168,275,176,253,183,219,195,224,214,191,226,205,267,195,272,202,300' href='#' linking='mmh-ablock-interface' alt='A BLOCK' />
  <area class='simple' data-key='1004' shape='poly' coords='322,183,318,145,316,138,324,124,338,101,365,100,371,87,440,94,442,107,431,121,429,145,402,154,386,154,378,154,372,170,364,174,348,182,337,185' href='#' linking='mmh-bblock-interface' alt='B BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='640,105,625,150,606,159,597,153,582,159,564,151,544,133,542,144,530,150,514,136,494,126,484,120,482,110,484,92,504,84,515,77,535,72,540,70,553,80,571,79,579,74,597,80' href='#' linking='mmh-cblock-interface' alt='C BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
                  
              case "mmh-ablock-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='360,442,476,468' href='#' alt='LEARN' />
  <area class='simple' data-key='1002' shape='rect' coords='96,80,336,221' href='#' linking = 'mmh-ablock-1' alt='A BLOCK SIDE I' />
  <area class='simple' data-key='1003' shape='rect' coords='71,248,299,442' href='#' linking = 'mmh-ablock-2' alt='A BLOCK SIDE II' />
  <area class='simple' data-key='1004' shape='rect' coords='510,75,765,232' href='#' alt='A BLOCK SIDE III' linking = 'mmh-ablock-3' />
  <area class='simple' data-key='1005' shape='rect' coords='514,259,776,414' href='#' alt='A BLOCK SIDE IV'  linking = 'mmh-ablock-4' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
                  
              case "mmh-bblock-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='poly' coords='393,247,339,242,305,231,281,228,271,219,211,220,173,221,150,217,129,212,131,197,103,202,68,202,44,203,42,128,63,149,90,149,117,152,112,99,154,99,179,88,204,90,226,85,252,86,269,86,286,83,351,76,384,74,393,73' href='#' linking='mmh-bblock-1' alt='B BLOCK SIDE I' />
  <area class='simple' data-key='1001' shape='poly' coords='269,445,176,395,232,392,269,392,287,389,299,385,296,370,304,359,311,351,311,284,295,274,265,273,247,264,227,267,214,261,196,267,183,265,164,264,142,261,111,252,77,225,55,221,57,445' href='#' alt='B BLOCK SIDE II' linking='mmh-bblock-2' />
  <area class='simple' data-key='1002' shape='poly' coords='786,208,786,89,747,96,722,88,694,91,659,90,628,88,598,78,563,79,530,84,510,77,482,79,468,96,448,85,434,85,431,230,453,211,485,200,490,215,490,215,509,218,524,224,590,226,627,202,730,202,743,196' href='#' alt='B BLOCK SIDE III' linking='mmh-bblock-3' />
  <area class='simple' data-key='1003' shape='poly' coords='772,445,776,280,752,273,740,258,723,264,705,257,689,271,670,263,622,266,607,267,611,289,590,294,572,292,556,291,544,299,538,304,526,305,512,297,509,363,529,362,540,362,552,369,553,374,553,376,604,380,613,406,612,406,650,407,670,426,653,439,644,443' href='#' alt='B BLOCK SIDE IV' linking='mmh-bblock-4' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
             
                  
              case "mmh-cblock-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='358,441,473,466' href='#'  alt='LEARN' />
  <area class='simple' data-key='1002' shape='rect' coords='63,32,336,227' href='#' linking='mmh-cblock-1' alt='C BLOCK SIDE I' />
  <area class='simple' data-key='1003' shape='rect' coords='62,246,350,430' href='#' linking='mmh-cblock-2' alt='C BLOCK SIDE II' />
  <area class='simple' data-key='1005' shape='rect' coords='499,63,762,231' href='#' linking='mmh-cblock-3' alt='C BLOCK SIDE III' />
  <area class='simple' data-key='1007' shape='rect' coords='506,257,781,424' href='#' linking='mmh-cblock-4' alt='C BLOCK SIDE IV' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
             
             
             
             
             
             case "mmh-ablock-1":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='352,242,397,308' href='#' data-key='MMH-AG-17' alt='AG-17' />
<area shape='rect' coords='301,242,346,308' href='#' data-key='MMH-AG-18' alt='AG-18' />
<area shape='rect' coords='398,242,443,308' href='#' data-key='MMH-AG-16' alt='AG-16' />
<area shape='rect' coords='350,167,396,233' href='#' data-key='MMH-AF-17' alt='AF-17' />
<area shape='rect' coords='301,167,347,233' href='#' data-key='MMH-AF-18' alt='AF-18' />
<area shape='rect' coords='448,167,494,233' href='#' data-key='MMH-AF-15' alt='AF-15' />
<area shape='rect' coords='449,96,495,158' href='#' data-key='MMH-AS-15' alt='AS-15' />
<area shape='rect' coords='401,96,447,158' href='#' data-key='MMH-AS-16' alt='AS-16' />
<area shape='rect' coords='350,96,396,158' href='#' data-key='MMH-AS-17' alt='AS-17' />
<area shape='rect' coords='299,96,345,158' href='#' data-key='MMH-AS-18' alt='AS-18' />
<area shape='rect' coords='398,167,444,233' href='#' data-key='MMH-AF-16' alt='AF-16' />
<area shape='rect' coords='449,242,494,308' href='#' data-key='MMH-AG-15' alt='AG-15' />

  <area shape='rect' coords='353,440,473,465' href='#' alt='LEARN' />

  <area shape='rect' coords='115,381,252,408' href='#' class='simple' linking='mmh-ablock-2' data-key='123' alt='A BLOCK SIDE II' />

  <area shape='rect' coords='337,380,491,407' href='#'  class='simple' linking='mmh-ablock-3' data-key='12' alt='A BLOCK SIDE III' />

  <area shape='rect' coords='629,378,772,406' href='#'  class='simple' linking='mmh-ablock-4' data-key='1' alt='A BLOCK SIDE IV' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
               case "mmh-ablock-2":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'>
<area shape='rect' coords='342,150,384,208' href='#' data-key='MMH-AS-4' alt='AS-4' />
<area shape='rect' coords='389,150,431,208' href='#' data-key='MMH-AS-3' alt='AS-3' />
<area shape='rect' coords='437,149,479,207' href='#' data-key='MMH-AS-2' alt='AS-2' />
<area shape='rect' coords='484,149,526,207' href='#' data-key='MMH-AS-1' alt='AS-1' />
<area shape='rect' coords='484,220,526,278' href='#' data-key='MMH-AF-1' alt='AF-1' />
<area shape='rect' coords='437,220,479,278' href='#' data-key='MMH-AF-2' alt='AF-2' />
<area shape='rect' coords='389,221,431,279' href='#' data-key='MMH-AF-3' alt='AF-3' />
<area shape='rect' coords='342,221,384,279' href='#' data-key='MMH-AF-4' alt='AF-4' />
<area shape='rect' coords='342,288,384,346' href='#' data-key='MMH-AG-4' alt='AG-4' />
<area shape='rect' coords='389,288,431,346' href='#' data-key='MMH-AG-3' alt='AG-3' />
<area shape='rect' coords='437,287,479,345' href='#' data-key='MMH-AG-2' alt='AG-2' />

  <area shape='rect' coords='359,442,475,473' href='#' alt='LEARN' />

  <area shape='rect' coords='116,380,250,406' href='#' class='simple' linking='mmh-ablock-1' data-key='123' alt='A BLOCK SIDE I' />

  <area shape='rect' coords='337,381,489,409' href='#' class='simple' linking='mmh-ablock-3' data-key='12' alt='A BLOCK SIDE III' />

  <area shape='rect' coords='630,380,774,407' href='#' class='simple' linking='mmh-ablock-4' data-key='1' alt='A BLOCK SIDE IV' />

  <area shape='rect' coords='484,287,526,345' href='#' data-key='MMH-AG-1' alt='AG-1' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
             
        case "mmh-ablock-3":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
<area shape='poly' coords='390,170,390,115,350,115,349,172' href='#' data-key='MMH-AS-10' alt='AS-10' />
<area shape='poly' coords='431,172,432,111,394,113,393,172,394,169,410,173' href='#' data-key='MMH-AS-9' alt='AS-9' />
<area shape='poly' coords='478,172,477,108,436,111,437,171' href='#' data-key='MMH-AS-8' alt='AS-8' />
<area shape='poly' coords='532,175,530,105,481,107,482,171' href='#' data-key='MMH-AS-7' alt='AS-7' />
<area shape='poly' coords='529,260,530,190,481,188,482,252' href='#' data-key='MMH-AF-7' alt='AF-7' />
<area shape='poly' coords='479,256,477,193,436,190,437,250' href='#' data-key='MMH-AF-8' alt='AF-8' />
<area shape='poly' coords='432,251,432,192,394,190,393,245,394,246,410,250' href='#' data-key='MMH-AF-9' alt='AF-9' />
<area shape='poly' coords='390,247,390,192,350,186,347,242' href='#' data-key='MMH-AF-10' alt='AF-10' />

  <area shape='rect' coords='359,443,475,470' href='#' alt='LEARN' />

  <area shape='rect' coords='115,382,249,406' href='#' class='simple' linking='mmh-ablock-1' data-key='123'  alt='A BLOCK SIDE I' />


  <area shape='rect' coords='336,380,487,404' href='#' class='simple' linking='mmh-ablock-2' data-key='12'  alt='A BLOCK SIDE II' />


  <area shape='rect' coords='630,380,774,406' href='#' class='simple' linking='mmh-ablock-4' data-key='1'  alt='A BLOCK SIDE IV' />

  <area shape='poly' coords='123,345,120,270,88,273,92,337' href='#' data-key='MMH-AG-13' alt='AG-13' />

  <area shape='poly' coords='88,334,83,274,58,266,60,330' href='#' data-key='MMH-AG-14' alt='AG-14' />

  <area shape='poly' coords='118,260,117,184,85,184,85,253,86,258' href='#' data-key='MMH-AF-13' alt='AF-13' />

  <area shape='poly' coords='54,184,81,186,81,254,56,253,54,251' href='#' data-key='MMH-AF-14' alt='AF-14' />

  <area shape='poly' coords='116,172,116,95,82,98,83,170' href='#' data-key='MMH-AS-13' alt='AS-13' />

  <area shape='poly' coords='80,172,79,102,52,100,52,172' href='#' data-key='MMH-AS-14' alt='AS-14' />

  <area shape='poly' coords='231,352' href='#' />

  <area shape='poly' coords='230,354,272,342,272,274,228,276' href='#' data-key='MMH-AG-12' alt='AG-12' />

  <area shape='poly' coords='277,338,277,273,320,264,321,323' href='#' data-key='MMH-AG-11' alt='AG-11' />

  <area shape='poly' coords='232,263,242,267,260,267,270,261,275,260,272,186,232,186,229,189' href='#' data-key='MMH-AF-12' alt='AF-12' />

  <area shape='poly' coords='280,258,290,259,312,256,321,254,311,234,310,211,310,184,278,184' href='#' data-key='MMH-AF-11' alt='AF-11' />

  <area shape='poly' coords='226,93,229,174,271,174,268,103,268,99' href='#' data-key='MMH-AS-12' alt='AS-12' />

  <area shape='poly' coords='272,100,275,172,310,174,309,132,308,104' href='#' data-key='MMH-AS-11' alt='AS-11' />

  <area shape='poly' coords='529,338,530,268,481,266,482,330' href='#' data-key='MMH-AG-7' alt='AG-7' />

  <area shape='poly' coords='479,329,477,266,436,263,437,323' href='#' data-key='MMH-AG-8' alt='AG-8' />

  <area shape='poly' coords='432,321,432,262,394,260,393,315,394,316,410,320' href='#' data-key='MMH-AG-9' alt='AG-9' />

  <area shape='poly' coords='390,315,390,260,350,254,347,310' href='#' data-key='MMH-AG-10' alt='AG-10' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-ablock-4":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='poly' coords='537,175,538,98,483,100,481,176' href='#' data-key='MMH-AS-6' alt='AS-6' />
<area shape='poly' coords='543,175,544,98,595,101,596,176' href='#' data-key='MMH-AS-5' alt='AS-5' />
<area shape='poly' coords='537,273,538,196,483,198,481,274' href='#' data-key='MMH-AF-6' alt='AF-6' />
<area shape='poly' coords='543,273,544,196,593,198,594,269' href='#' data-key='MMH-AF-5' alt='AF-5' />

  <area shape='rect' coords='357,448,475,473' href='#' alt='LEARN' />

  <area shape='rect' coords='114,380,247,406' href='#' class='simple' linking='mmh-ablock-1' data-key='123'  alt='A BLOCK SIDE I' />

  <area shape='rect' coords='338,380,489,405' href='#' class='simple' linking='mmh-ablock-2' data-key='12'  alt='A BLOCK SIDE II' />

  <area shape='rect' coords='631,378,772,407' href='#' class='simple' linking='mmh-ablock-3' data-key='1'  alt='A BLOCK SIDE III' />

  <area shape='poly' coords='537,357,538,283,483,282,481,358' href='#' data-key='MMH-AG-6' alt='AG-6' />

  <area shape='poly' coords='543,358,543,286,593,286,594,354' href='#' data-key='MMH-AG-5' alt='AG-5' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-bblock-1":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='484,117,535,182' href='#' data-key='MMH-BS-17' alt='BS-17' />
<area shape='rect' coords='429,116,480,181' href='#' data-key='MMH-BS-18' alt='BS-18' />
<area shape='rect' coords='374,117,425,182' href='#' data-key='MMH-BS-19' alt='BS-19' />
<area shape='rect' coords='318,118,369,183' href='#' data-key='MMH-BS-20' alt='BS-20' />
<area shape='rect' coords='484,201,535,266' href='#' data-key='MMH-BF-17' alt='BF-17' />
<area shape='rect' coords='429,200,480,265' href='#' data-key='MMH-BF-18' alt='BF-18' />
<area shape='rect' coords='374,201,425,266' href='#' data-key='MMH-BF-19' alt='BF-19' />
<area shape='rect' coords='319,202,370,267' href='#' data-key='MMH-BF-20' alt='BF-20' />
<area shape='rect' coords='320,279,371,344' href='#' data-key='MMH-BG-19' alt='BG-19' />
<area shape='rect' coords='374,278,425,343' href='#' data-key='MMH-BG-18' alt='BG-18' />
<area shape='rect' coords='429,277,480,342' href='#' data-key='MMH-BG-17' alt='BG-17' />

  <area shape='rect' coords='114,383,250,408' href='#'class='simple' linking='mmh-bblock-2' data-key='123' alt='B BLOCK SIDE II' />

  <area shape='rect' coords='339,381,489,407' href='#' alt='B BLOCK SIDE III' class='simple' linking='mmh-bblock-3' data-key='12' />

  <area shape='rect' coords='631,379,775,407' href='#' alt='B BLOCK SIDE IV' class='simple' linking='mmh-bblock-4' data-key='1' />

  <area shape='rect' coords='357,444,475,467' href='#' />

  <area shape='rect' coords='484,276,535,341' href='#' data-key='MMH-BG-16' alt='BG-16' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-bblock-2":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
<area shape='rect' coords='287,109,334,173' href='#' data-key='MMH-BS-4' alt='BS-4' />
<area shape='rect' coords='337,108,384,172' href='#' data-key='MMH-BS-3' alt='BS-3' />
<area shape='rect' coords='390,108,437,172' href='#' data-key='MMH-BS-2' alt='BS-2' />
<area shape='rect' coords='440,107,487,171' href='#' data-key='MMH-BS-1' alt='BS-1' />
<area shape='rect' coords='440,186,487,250' href='#' data-key='MMH-BF-1' alt='BF-1' />
<area shape='rect' coords='390,187,437,251' href='#' data-key='MMH-BF-2' alt='BF-2' />
<area shape='rect' coords='337,187,384,251' href='#' data-key='MMH-BF-3' alt='BF-3' />
<area shape='rect' coords='287,188,334,252' href='#' data-key='MMH-BF-4' alt='BF-4' />
<area shape='rect' coords='287,259,334,323' href='#' data-key='MMH-BG-4' alt='BG-4' />
<area shape='rect' coords='337,258,384,322' href='#' data-key='MMH-BG-3' alt='BG-3' />
<area shape='rect' coords='390,258,437,322' href='#' data-key='MMH-BG-2' alt='BG-2' />

  <area shape='rect' coords='360,444,476,467' href='#' alt='LEARN' />

  <area shape='rect' coords='114,381,252,409' href='#' class='simple' linking='mmh-bblock-1' data-key='123' alt='B BLOCK SIDE I' />

  <area shape='rect' coords='336,380,487,408' href='#' alt='B BLOCK SIDE III' class='simple' linking='mmh-bblock-3' data-key='12' />

  <area shape='rect' coords='631,382,773,407' href='#' alt='B BLOCK SIDE IV' class='simple' linking='mmh-bblock-4' data-key='1' />

  <area shape='rect' coords='440,257,487,321' href='#' data-key='MMH-BG-1' alt='BG-1' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-bblock-3":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='433,133,469,183' href='#' data-key='MMH-BS-11' alt='BS-11' />
<area shape='rect' coords='475,134,511,184' href='#' data-key='MMH-BS-10' alt='BS-10' />
<area shape='rect' coords='518,131,559,184' href='#' data-key='MMH-BS-9' alt='BS-9' />
<area shape='rect' coords='562,131,606,183' href='#' data-key='MMH-BS-8' alt='BS-8' />
<area shape='rect' coords='609,131,651,185' href='#' data-key='MMH-BS-7' alt='BS-7' />
<area shape='rect' coords='609,201,651,255' href='#' data-key='MMH-BF-7' alt='BF-7' />
<area shape='rect' coords='562,199,604,253' href='#' data-key='MMH-BF-8' alt='BF-8' />
<area shape='rect' coords='518,198,559,251' href='#' data-key='MMH-BF-9' alt='BF-9' />
<area shape='rect' coords='475,199,511,249' href='#' data-key='MMH-BF-10' alt='BF-10' />
<area shape='rect' coords='433,198,469,248' href='#' data-key='MMH-BF-11' alt='BF-11' />
<area shape='rect' coords='566,265,651,320' href='#' data-key='MMH-BG-7' alt='BG-7' />
<area shape='rect' coords='519,264,560,317' href='#' data-key='MMH-BG-8' alt='BG-8' />
<area shape='rect' coords='475,261,511,311' href='#' data-key='MMH-BG-9' alt='BG-9' />
<area shape='poly' coords='408,121,424,122,424,184,411,182' href='#' data-key='MMH-BS-12' alt='BS-12' />
<area shape='poly' coords='384,107,406,112,407,183,388,182' href='#' data-key='MMH-BS-13' alt='BS-13' />
<area shape='poly' coords='264,182,256,112,213,112,219,183' href='#' data-key='MMH-BS-15' alt='BS-15' />
<area shape='poly' coords='171,110,208,113,215,180,175,180' href='#' data-key='MMH-BS-16' alt='BS-16' />
<area shape='poly' coords='171,193,208,196,214,270,175,263' href='#' data-key='MMH-BF-16' alt='BF-16' />
<area shape='poly' coords='264,276,261,197,213,195,219,270' href='#' data-key='MMH-BF-15' alt='BF-15' />

  <area shape='rect' coords='360,443,474,467' href='#' alt='LEARN' />

  <area shape='rect' coords='114,381,250,403' href='#' alt='B BLOCK SIDE I' class='simple' linking='mmh-bblock-1' data-key='123' />

  <area shape='rect' coords='337,384,488,408' href='#' alt='B BLOCK SIDE II' class='simple' linking='mmh-bblock-2' data-key='12' />

  <area shape='rect' coords='630,380,772,406' href='#' alt='B BLOCK SIDE IV' class='simple' linking='mmh-cblock-4' data-key='1' />

  <area shape='poly' coords='264,349,262,281,218,277,219,343' href='#' data-key='MMH-BG-14' alt='BG-14' />

  <area shape='poly' coords='215,342' href='#' />

  <area shape='poly' coords='175,276,211,279,214,343,177,336' href='#' data-key='MMH-BG-15' alt='BG-15' />

  <area shape='poly' coords='361,363,387,347,384,285,359,289' href='#' data-key='MMH-BG-13' alt='BG-13' />

  <area shape='poly' coords='407,330,387,343,387,283,403,278' href='#' data-key='MMH-BG-12' alt='BG-12' />

  <area shape='poly' coords='426,318,412,328,406,278,422,271' href='#' data-key='MMH-BG-11' alt='BG-11' />

  <area shape='poly' coords='362,272,385,274,404,268,388,261,387,245,388,216,387,200,358,200' href='#' data-key='MMH-BF-14' alt='BF-14' />

  <area shape='poly' coords='389,200,404,196,406,242,420,243,422,260,408,267,396,260,391,247' href='#' data-key='MMH-BF-13' alt='BF-13' />

  <area shape='poly' coords='428,257,440,254,432,246,426,238,426,219,426,195,408,192,408,238' href='#' data-key='MMH-BF-12' alt='BF-12' />

  <area shape='poly' coords='356,107,380,108,381,180,360,182' href='#' data-key='MMH-BS-14' alt='BS-14' />

  <area shape='rect' coords='433,260,469,310' href='#' data-key='MMH-BG-10' alt='BG-10' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-bblock-4":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<img src='ROOM-SELECTION_B_VIEWIV.png' width='830' height='469' usemap='#Map' border='0' />

<map name='Map' id='Map'><area shape='rect' coords='556,282,617,365' href='#' data-key='MMH-BG-5' alt='BG-5' />
<area shape='rect' coords='488,282,549,365' href='#' data-key='MMH-BG-6' alt='BG-6' />
<area shape='rect' coords='488,187,549,270' href='#' data-key='MMH-BF-6' alt='BF-6' />
<area shape='rect' coords='556,187,617,270' href='#' data-key='MMH-BF-5' alt='BF-5' />
<area shape='rect' coords='556,92,617,175' href='#' data-key='MMH-BS-5' alt='BS-5' />

  <area shape='rect' coords='357,442,476,470' href='#' alt='LEARN' />

  <area shape='rect' coords='115,381,250,406' href='#' alt='B BLOCK SIDE I' class='simple' linking='mmh-bblock-1' data-key='123' />

  <area shape='rect' coords='336,379,491,411' href='#' alt='B BLOCK SIDE II' class='simple' linking='mmh-bblock-2' data-key='12' />

  <area shape='rect' coords='630,379,774,407' href='#' alt='B BLOCK SIDE III' class='simple' linking='mmh-bblock-3' data-key='1' />

  <area shape='rect' coords='488,92,549,175' href='#' data-key='MMH-BS-6' alt='BS-6' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-cblock-1":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='392,106,442,170' href='#' data-key='MMH-CS-16' alt='CS-16' />
<area shape='rect' coords='447,105,497,169' href='#' data-key='MMH-CS-15' alt='CS-15' />
<area shape='rect' coords='339,106,389,170' href='#' data-key='MMH-CS-17' alt='CS-17' />
<area shape='rect' coords='284,107,334,171' href='#' data-key='MMH-CS-18' alt='CS-18' />
<area shape='rect' coords='392,188,442,252' href='#' data-key='MMH-CF-16' alt='CF-16' />
<area shape='rect' coords='447,187,497,251' href='#' data-key='MMH-CF-15' alt='CF-15' />
<area shape='rect' coords='339,188,389,252' href='#' data-key='MMH-CF-17' alt='CF-17' />
<area shape='rect' coords='284,189,334,253' href='#' data-key='MMH-CF-18' alt='CF-18' />
<area shape='rect' coords='339,261,389,325' href='#' data-key='MMH-CG-17' alt='CG-17' />
<area shape='rect' coords='284,262,334,326' href='#' data-key='MMH-CG-18' alt='CG-18' />
<area shape='rect' coords='392,261,442,325' href='#' data-key='MMH-CG-16' alt='CG-16' />

  <area shape='rect' coords='356,442,475,472' href='#' alt='LEARN' />

  <area shape='rect' coords='114,381,253,408' href='#' class='simple' linking='mmh-cblock-1' data-key='123' alt='C BLOCK SIDE I' />

  <area shape='rect' coords='336,380,491,406' href='#' alt='C BLOCK SIDE III' class='simple' linking='mmh-cblock-3' data-key='12' />

  <area shape='rect' coords='629,379,774,407' href='#'  class='simple' linking='mmh-cblock-4' data-key='1' alt='C BLOCK SIDE IV' />

  <area shape='rect' coords='447,260,497,324' href='#' data-key='MMH-CG-15' alt='CG-15' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-cblock-2":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'>
<area shape='rect' coords='454,109,501,169' href='#' data-key='MMH-CS-1' alt='CS-1' />
<area shape='rect' coords='403,109,450,169' href='#' data-key='MMH-CS-2' alt='CS-2' />
<area shape='rect' coords='301,110,348,170' href='#' data-key='MMH-CS-4' alt='CS-4' />
<area shape='rect' coords='352,110,399,170' href='#' data-key='MMH-CS-3' alt='CS-3' />
<area shape='rect' coords='454,187,501,247' href='#' data-key='MMH-CF-1' alt='CF-1' />
<area shape='rect' coords='403,187,450,247' href='#' data-key='MMH-CF-2' alt='CF-2' />
<area shape='rect' coords='301,188,348,248' href='#' data-key='MMH-CF-4' alt='CF-4' />
<area shape='rect' coords='352,189,399,249' href='#' data-key='MMH-CF-3' alt='CF-3' />
<area shape='rect' coords='352,259,399,319' href='#' data-key='MMH-CG-3' alt='CG-3' />
<area shape='rect' coords='301,259,348,319' href='#' data-key='MMH-CG-4' alt='CG-4' />
<area shape='rect' coords='403,258,450,318' href='#' data-key='MMH-CG-2' alt='CG-2' />

  <area shape='rect' coords='114,380,252,408' href='#' alt='C BLOCK SIDE I' class='simple' linking='mmh-cblock-1' data-key='123' />

  <area shape='rect' coords='337,378,491,406' href='#' alt='C BLOCK SIDE III' class='simple' linking='mmh-cblock-3' data-key='12' />

  <area shape='rect' coords='628,380,772,407' href='#' alt='C BLOCK SIDE IV'  class='simple' linking='mmh-cblock-4' data-key='1' />

  <area shape='rect' coords='357,442,477,467' href='#' />

  <area shape='rect' coords='454,258,501,318' href='#' data-key='MMH-CG-1' alt='CG-1' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-cblock-3":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'><area shape='poly' coords='414,174,412,112,433,109,434,171' href='#' data-key='MMH-CS-11' alt='CS-11' />
<area shape='poly' coords='386,175,411,171,409,108,382,108' href='#' data-key='MMH-CS-12' alt='CS-12' />
<area shape='poly' coords='414,250,412,196,433,185,435,241' href='#' data-key='MMH-CF-11' alt='CF-11' />
<area shape='poly' coords='386,263,411,253,409,196,384,198' href='#' data-key='MMH-CF-12' alt='CF-12' />
<area shape='rect' coords='573,114,619,176' href='#'data-key='MMH-CS-7'  alt='CS-7' />
<area shape='rect' coords='525,122,569,176' href='#' data-key='MMH-CS-8' alt='CS-8' />
<area shape='rect' coords='480,128,520,177' href='#' data-key='MMH-CS-9' alt='CS-9' />
<area shape='rect' coords='443,132,479,176' href='#' data-key='MMH-CS-10' alt='CS-10' />
<area shape='rect' coords='443,195,479,239' href='#' data-key='MMH-CF-10' alt='CF-10' />
<area shape='rect' coords='480,192,520,241' href='#' data-key='MMH-CF-9' alt='CF-9' />
<area shape='rect' coords='525,189,569,243' href='#' data-key='MMH-CF-8' alt='CF-8' />
<area shape='rect' coords='573,187,619,249' href='#' data-key='MMH-CF-7' alt='CF-7' />
<area shape='rect' coords='444,255,480,299' href='#' data-key='MMH-CG-10' alt='CG-10' />
<area shape='rect' coords='480,253,520,302' href='#' data-key='MMH-CG-9' alt='CG-9' />
<area shape='rect' coords='526,253,570,307' href='#' data-key='MMH-CG-8' alt='CG-8' />
<area shape='poly' coords='211,173,208,107,176,110,178,169' href='#' data-key='MMH-CS-14' alt='CS-14' />
<area shape='poly' coords='255,172,253,102,215,103,217,170' href='#' data-key='MMH-CS-13' alt='CS-13' />
<area shape='poly' coords='211,254,208,188,176,191,178,250' href='#' data-key='MMH-CF-14' alt='CF-14' />
<area shape='poly' coords='257,258,255,188,217,189,219,256' href='#' data-key='MMH-CF-13' alt='CF-13' />

  <area shape='rect' coords='113,381,253,408' href='#' alt='C BLOCK SIDE I' class='simple' linking='mmh-cblock-1' data-key='123' />

  <area shape='rect' coords='336,380,491,407' href='#' alt='C BLOCK SIDE II' class='simple' linking='mmh-cblock-2' data-key='1'  />

  <area shape='rect' coords='630,378,773,405' href='#' alt='C BLOCK SIDE IV' class='simple' linking='mmh-cblock-4' data-key='1' />

  <area shape='poly' coords='258,340,256,270,218,271,220,332' href='#' data-key='MMH-CG-13' alt='CG-13' />

  <area shape='poly' coords='215,330,213,272,180,267,180,326' href='#' data-key='MMH-CG-14' alt='CG-14' />

  <area shape='rect' coords='573,253,619,315' href='#' data-key='MMH-CG-7' alt='CG-7' />

  <area shape='poly' coords='385,339,410,326,408,272,383,274' href='#' data-key='MMH-CG-12' alt='CG-12' />

  <area shape='poly' coords='414,320,411,271,432,260,433,311' href='#' data-key='MMH-CG-11' alt='CG-11' />

  <area shape='rect' coords='358,442,474,467' href='#' alt='LEARN' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
                  case "mmh-cblock-4":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'><area shape='rect' coords='432,100,485,172' href='#' data-key='MMH-CS-6' alt='CS-6' />
<area shape='rect' coords='491,100,544,172' href='#' data-key='MMH-CS-5' alt='CS-5' />
<area shape='rect' coords='491,187,544,259' href='#' data-key='MMH-CF-5' alt='CF-5' />
<area shape='rect' coords='432,187,485,259' href='#' data-key='MMH-CF-6' alt='CF-6' />
<area shape='rect' coords='491,269,544,341' href='#' data-key='MMH-CG-5' alt='CG-5' />

  <area shape='rect' coords='358,441,474,471' href='#' alt='LEARN' />

  <area shape='rect' coords='115,380,253,410' href='#' alt='C BLOCK SIDE I' class='simple' linking='mmh-cblock-1' data-key='123' />

  <area shape='rect' coords='334,379,490,408' href='#' alt='C BLOCK SIDE II' class='simple' linking='mmh-cblock-2' data-key='12' />

  <area shape='rect' coords='630,378,773,407' href='#' alt='C BLOCK SIDE III' class='simple' linking='mmh-cblock-3' data-key='1' />

  <area shape='rect' coords='432,269,485,341' href='#' data-key='MMH-CG-6' alt='CG-6' />
";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
     
               
             
             case "room mapping case":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
             
             
             
             
             
             
             
              case "pghisometricview1":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='poly' coords='479,348,463,359,458,356,457,362,440,373,415,388,405,382,407,367,389,337,389,303,377,284,361,290,358,263,353,250,369,240,384,236,394,228,407,225,418,218,432,217,509,296' href='#' linking='pgh-ablock-interface' alt='D BLOCK' />
  <area class='simple' data-key='1001' shape='poly' coords='517,195,532,160,530,152,549,140,562,140,577,130,589,131,629,149,644,150,658,152,678,161,712,177,703,186,695,189,668,220,656,231,581,278,574,279,573,265,591,252,567,218,549,200' href='#' linking='pgh-ablock-interface'  alt='A BLOCK' />
  <area class='simple' data-key='1002' shape='poly' coords='503,135,515,90,524,83,538,81,537,75,544,70,555,69,571,71,584,82,573,86,578,91,585,93,596,91,620,90,629,92,644,104,621,114,609,114,594,111,586,128,566,131,559,138,544,140,537,145,530,149,528,150' href='#' linking='pgh-bblock-interface'  alt='B BLOCK' />
  <area class='simple' data-key='1003' shape='poly' coords='470,130,482,85,466,74,465,66,456,63,447,57,435,56,425,63,435,71,425,75,418,77,404,67,391,65,376,74,377,116,395,133,407,133,421,146' href='#' linking='pgh-cblock-interface'  alt='C BLOCK' />
  <area class='simple' data-key='1004' shape='poly' coords='161,160,245,137,261,171,168,198,167,199' href='#' linking='pgh-eblock-interface'  alt='F BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='169,214,268,181,292,228,180,272' href='#' linking='pgh-eblock-interface'  alt='E BLOCK' />
  <area class='simple' data-key='1006' shape='rect' coords='357,443,474,467' href='#' />
  <area class='simple' data-key='1007' shape='rect' coords='27,184,146,208' href='#' linking='pghisometricview2'  alt='ISO VIEW 2' />
  <area class='simple' data-key='1008' shape='rect' coords='27,219,146,242' href='#' linking='pghtopview'  alt='TOP VIEW' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
              
             
              case "pghtopview":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='235,310,313,380' href='#' linking='pgh-ablock-interface'  alt='D BLOCK' />
  <area class='simple' data-key='1002' shape='poly' coords='444,381,499,380,500,344,534,344,534,381,590,381,590,333,567,328,566,290,466,289,466,330,466,339,445,339' href='#' linking='pgh-ablock-interface' alt='A BLOCK' />
  <area class='simple' data-key='1003' shape='poly' coords='585,265,635,264,638,282,651,281,704,283,704,240,655,240,655,213,703,214,704,170,652,170,639,170,637,186,585,188' href='#' linking='pgh-bblock-interface' alt='B BLOCK' />
  <area class='simple' data-key='1011' shape='poly' coords='454,164,554,164,555,124,577,123,577,73,520,71,522,110,486,109,486,73,431,72,430,122,455,122' href='#' linking='pgh-cblock-interface' alt='C BLOCK' />
  <area class='simple' data-key='1004' shape='rect' coords='111,143,203,202' href='#' linking='pgh-eblock-interface' alt='F BLOCK' />
  <area class='simple' data-key='1005' shape='rect' coords='112,217,202,274' href='#' linking='pgh-eblock-interface' alt='E BLOCK' />
  <area class='simple' data-key='1006' shape='rect' coords='357,443,477,468' href='#'  alt='LEARN' />
  <area class='simple' data-key='1007' shape='rect' coords='643,352,762,377' href='#' linking='pghisometricview1' alt='ISO VIEW 1' />
  <area class='simple' data-key='1008' shape='rect' coords='642,386,762,412' href='#' linking='pghisometricview2' alt='ISO VIEW 2' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
              case "pghisometricview2":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1001' shape='rect' coords='358,443,474,467' href='#' alt='LEARN' />
  <area class='simple' data-key='1002' shape='rect' coords='675,358,792,384' href='#' linking='pghisometricview1'  alt='ISO VIEW 1' />
  <area class='simple' data-key='1003' shape='rect' coords='675,392,793,417' href='#' linking='pghtopview' alt='TOP VIEW' />
  <area class='simple' data-key='1004' shape='poly' coords='259,219,276,210,291,212,304,205,319,205,332,201,350,202,387,256,383,263,384,332,381,340,296,358,288,283,290,317,282,301,270,282,266,262' href='#' linking='pgh-ablock-interface' alt='D BLOCK' />
  <area class='simple' data-key='1005' shape='poly' coords='492,158,519,145,540,148,560,139,582,141,613,162,620,161,638,160,682,188,660,263,532,295,517,289,512,274,516,248,509,230,513,205,502,188,492,185' linking='pgh-ablock-interface' href='#' alt='A BLOCK' />
  <area class='simple' data-key='1006' shape='poly' coords='668,120,684,118,670,104,654,103,648,100,616,106,625,99,629,92,618,77,601,76,580,78,560,80,566,90,531,95,528,143,538,146,556,137,575,140,592,145,598,144,610,131,618,127,628,125,632,120' linking='pgh-bblock-interface' href='#' alt='B BLOCK' />
  <area class='simple' data-key='1007' shape='poly' coords='360,72,364,125,376,144,385,150,400,148,406,160,413,163,486,146,486,126,488,90,480,82,470,73,485,72,467,57,444,55,427,65,438,72,415,78,401,65,381,62' href='#' linking='pgh-cblock-interface' alt='C BLOCK' />
  <area class='simple' data-key='1008' shape='poly' coords='90,140,182,127,194,158,92,173' href='#' linking='pgh-eblock-interface' alt='F BLOCK' />
  <area class='simple' data-key='1010' shape='poly' coords='92,182,194,165,208,204,96,223' href='#' linking='pgh-eblock-interface' alt='E BLOCK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
                 case "pgh-ablock-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect'  coords='357,443,473,468' href='#' alt='LEARN' />
  <area class='simple' data-key='1001' shape='rect' linking='pgh-ablock-front'  coords='21,195,416,300' href='#' alt='A &amp; D FRONT' />
  <area class='simple' data-key='1002' shape='rect' linking='pgh-ablock-back' coords='431,196,819,299' href='#' alt='A&amp;D BACK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
                 case "pgh-bblock-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect' coords='358,443,475,467' href='#' />
  <area class='simple' data-key='1001' shape='rect'  coords='17,158,420,344' linking='pgh-bblock-front' href='#' alt=' B FRONT' />
  <area class='simple' data-key='1002' shape='rect' coords='436,149,814,343' linking='pgh-bblock-back' href='#' alt='B BACK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
                 case "pgh-cblock-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect' coords='357,443,476,467' href='#' alt='LEARN' />
  <area class='simple' data-key='1001' shape='rect'   coords='15,175,417,316' linking='pgh-cblock-front' href='#' alt='C FRONT' />
  <area class='simple' data-key='1002' shape='rect' coords='435,191,819,315' linking='pgh-cblock-back' href='#' alt='C BACK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
           
            
                  case "pgh-eblock-interface":
                 
             {
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
               
                echo "<map name='Map' id='Map'>
  <area class='simple' data-key='1000' shape='rect' coords='357,441,475,471' href='#'  alt='LEARN' />
  <area class='simple' data-key='1001' shape='rect' coords='16,163,419,337' href='#' linking='pgh-eblock-front' alt='E&amp;F FRONT' />
  <area class='simple' data-key='1002' shape='rect' coords='427,187,823,336' href='#' linking='pgh-eblock-back' alt='E&amp;F BACK' />
</map>";
                 
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
             
             
             case "pgh-ablock-back":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
<area shape='rect' coords='744,126,792,174' href='#' data-key='PGH-D-303' alt='D-303' />
<area shape='rect' coords='691,126,738,174' href='#' data-key='PGH-D-302' alt='D-302' />
<area shape='rect' coords='634,126,686,174' href='#' data-key='PGH-D-301' alt='D-301' />
<area shape='rect' coords='744,182,792,230' href='#' data-key='PGH-D-203' alt='D-203' />
<area shape='rect' coords='691,182,738,230' href='#' data-key='PGH-D-202' alt='D-202' />
<area shape='rect' coords='634,182,686,230' href='#' data-key='PGH-D-201' alt='D-201' />
<area shape='rect' coords='744,244,792,291' href='#' data-key='PGH-D-103' alt='D-103' />
<area shape='rect' coords='691,244,738,292' href='#' data-key='PGH-D-102' alt='D-102' />
<area shape='rect' coords='77,127,171,176' href='#' data-key='PGH-A-301' alt='A-301' />
<area shape='rect' coords='177,128,272,176' href='#' data-key='PGH-A-302' alt='A-302' />
<area shape='rect' coords='177,185,272,233' href='#' data-key='PGH-A-202' alt='A-202' />
<area shape='rect' coords='77,184,171,233' href='#' data-key='PGH-A-201' alt='A-201' />

  <area shape='rect' coords='357,443,475,469' href='#' alt='LEARN' />

  <area shape='rect' coords='264,337,578,421' href='#' data-key='PGH-A-' class='simple' linking='pgh-ablock-front' alt='A&amp;D FRONT' />

  <area shape='rect' coords='77,243,171,292' href='#' data-key='PGH-A-102' alt='A-102' />

  <area shape='rect' coords='177,244,272,292' href='#' data-key='PGH-A-101' alt='A-101' />

  <area shape='rect' coords='634,244,686,292' href='#' data-key='PGH-D-101' alt='D-101' />

</map>
";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
      
             
                
             case "pgh-ablock-front":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='702,125,756,164' href='#' data-key='PGH-A-304' alt='A-304' />
<area shape='rect' coords='531,125,585,164' href='#' data-key='PGH-A-303' alt='A-303' />
<area shape='rect' coords='702,173,756,212' href='#' data-key='PGH-A-204' alt='A-204' />
<area shape='rect' coords='126,125,166,162' href='#' data-key='PGH-D-304' alt='D-304' />
<area shape='rect' coords='170,126,211,162' href='#' data-key='PGH-D-305' alt='D-305' />
<area shape='rect' coords='214,125,256,162' href='#' data-key='PGH-D-306' alt='D-306' />
<area shape='rect' coords='125,172,166,212' href='#' data-key='PGH-D-204' alt='D-204' />
<area shape='rect' coords='170,172,211,212' href='#' data-key='PGH-D-205' alt='D-205' />
<area shape='rect' coords='214,172,255,212' href='#' data-key='PGH-D-206' alt='D-206' />
<area shape='rect' coords='214,221,255,261' href='#' data-key='PGH-D-106' alt='D-106' />
<area shape='rect' coords='170,221,211,261' href='#' data-key='PGH-D-105' alt='D-105' />

  <area shape='rect' coords='357,443,476,467' href='#' alt='LEARN' />

  <area shape='rect' coords='272,339,572,420' href='#' data-key='PGH-A-' class='simple' linking='pgh-ablock-back' alt='A&amp;D BACK' />

  <area shape='rect' coords='125,221,166,261' href='#' data-key='PGH-D-104' alt='D-104' />

  <area shape='rect' coords='519,221,597,259' href='#' data-key='100' alt='WARDENS' />

  <area shape='rect' coords='605,222,683,260' href='#' data-key='101' alt='WARDENS' />

  <area shape='rect' coords='691,222,757,260' href='#' data-key='102' alt='WARDENS' />

  <area shape='rect' coords='531,173,585,212' href='#' data-key='PGH-A-203' alt='A-203' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
              
         
             case "pgh-bblock-back":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'><area shape='rect' coords='290,160,353,206' href='#' data-key='PGH-B-203' alt='B-203' />
<area shape='rect' coords='290,103,353,149' href='#' data-key='PGH-B-303' alt='B-303' />
<area shape='rect' coords='496,160,559,206' href='#' data-key='PGH-B-204' alt='B-204' />
<area shape='rect' coords='496,103,559,149' href='#' data-key='PGH-B-304' alt='B-304' />
<area shape='rect' coords='496,218,560,262' href='#' data-key='PGH-B-105' alt='B-105' />
<area shape='rect' coords='377,218,457,266' href='#' data-key='PGH-B-104' alt='B-104' />

  <area shape='rect' coords='357,442,475,467' href='#' alt='LEARN' />

  <area shape='rect' coords='320,325,524,418' href='#' data-key='PGH-B-' linking='pgh-bblock-front'  class='simple' alt='B FRONT' />

  <area shape='rect' coords='289,218,369,266' href='#' data-key='PGH-B-103' alt='B-103' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;          
   
                   
             case "pgh-bblock-front":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'>
<area shape='rect' coords='418,121,495,177' href='#' data-key='PGH-B-302' alt='B-302' />
<area shape='rect' coords='296,121,373,177' href='#' data-key='PGH-B-301' alt='B-301' />
<area shape='rect' coords='418,189,495,245' href='#' data-key='PGH-B-202' alt='B-202' />
<area shape='rect' coords='296,189,373,245' href='#' data-key='PGH-B-201' alt='B-201' />
<area shape='rect' coords='418,257,495,313' href='#' data-key='PGH-B-102' alt='B-102' />

  <area shape='rect' coords='357,444,475,465' href='#' alt='LEARN' />

  <area shape='rect' coords='348,340,494,419' href='#' data-key='PGH-B-' class='simple' linking='pgh-bblock-back' alt='B BLOCK BACK' />

  <area shape='rect' coords='296,257,373,313' href='#' data-key='PGH-B-101' alt='B-101' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;          
     
      
          
         case "pgh-cblock-front":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
<area shape='rect' coords='695,257,778,319' href='#' data-key='PGH-C-105'  alt='C-105' />
<area shape='rect' coords='695,182,778,244' href='#' data-key='PGH-C-204'  alt='C-204' />
<area shape='rect' coords='695,108,778,170' href='#' data-key='PGH-C-304'  alt='C-304' />
<area shape='rect' coords='564,108,644,169' href='#' data-key='PGH-C-303'  alt='C-303' />
<area shape='rect' coords='565,183,645,244' href='#' data-key='PGH-C-203'  alt='C-203' />

  <area shape='rect' coords='358,443,474,467' href='#' alt='LEARN' />

  <area shape='rect' coords='267,333,573,425' href='#' data-key='PGH-C-' class='simple' linking='pgh-cblock-back'  alt='C BACK' />

  <area shape='rect' coords='565,258,645,319' href='#' data-key='PGH-C-104'  alt='C-104' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
      
        case "pgh-cblock-back":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "
<map name='Map' id='Map'><area shape='rect' coords='136,117,202,164' href='#' data-key='PGH-C-302'  alt='C-302' />
<area shape='rect' coords='136,175,202,222' href='#' data-key='PGH-C-202'  alt='C-202' />
<area shape='rect' coords='344,117,410,164' href='#' data-key='PGH-C-301'  alt='C-301' />
<area shape='rect' coords='344,175,410,222' href='#' data-key='PGH-C-201'  alt='C-201' />
<area shape='rect' coords='344,234,409,279' href='#' data-key='PGH-C-103'  alt='C-103' />
<area shape='rect' coords='224,234,305,279' href='#' data-key='PGH-C-102'  alt='C-102' />

  <area shape='rect' coords='357,442,475,467' href='#' alt='LEARN' />

  <area shape='rect' coords='274,316,570,410' href='#' data-key='PGH-C-' linking='pgh-cblock-front'  class='simple'  alt='C FRONT' />

  <area shape='rect' coords='136,234,217,279' href='#' data-key='PGH-C-101'  alt='C-101' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
   
   
       case "pgh-eblock-front":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<img src='ROOM-SELECTION_effront.png' width='830' height='469' usemap='#Map' border='0' />

<map name='Map' id='Map'><area shape='rect' coords='590,104,645,159' href='#' data-key='PGH-F-303'  alt='F-303' />
<area shape='rect' coords='528,104,583,159' href='#' data-key='PGH-F-302'  alt='F-302' />
<area shape='rect' coords='465,104,520,159' href='#' data-key='PGH-F-301'  alt='F-301' />
<area shape='rect' coords='340,104,395,159' href='#' data-key='PGH-E-303'  alt='E-303' />
<area shape='rect' coords='277,104,332,159' href='#' data-key='PGH-E-302'  alt='E-302' />
<area shape='rect' coords='213,104,268,159' href='#' data-key='PGH-E-301'  alt='E-301' />
<area shape='rect' coords='213,171,268,226' href='#' data-key='PGH-E-201'  alt='E-201' />
<area shape='rect' coords='277,171,332,226' href='#' data-key='PGH-E-202'  alt='E-202' />
<area shape='rect' coords='340,171,395,226' href='#' data-key='PGH-E-203'  alt='E-203' />
<area shape='rect' coords='465,171,520,226' href='#' data-key='PGH-F-201'  alt='F-201' />
<area shape='rect' coords='528,171,583,226' href='#' data-key='PGH-F-202'  alt='F-202' />
<area shape='rect' coords='591,171,646,226' href='#' data-key='PGH-F-203'  alt='F-203' />
<area shape='rect' coords='590,242,645,297' href='#' data-key='PGH-F-103'  alt='F-103' />
<area shape='rect' coords='528,242,583,297' href='#' data-key='PGH-F-102'  alt='F-102' />
<area shape='rect' coords='465,242,520,297' href='#' data-key='PGH-F-101'  alt='F-101' />
<area shape='rect' coords='340,242,395,297' href='#' data-key='PGH-E-103'  alt='E-103' />
<area shape='rect' coords='277,242,332,297' href='#' data-key='PGH-E-102'  alt='E-102' />

  <area shape='rect' coords='358,441,475,468' href='#' alt='LEARN' />

  <area shape='rect' coords='276,345,569,421' href='#' data-key='PGH-E-' class='simple' linking='pgh-eblock-back'  alt='E&amp;F BACK' />

  <area shape='rect' coords='213,242,268,297' href='#' data-key='PGH-E-101'   alt='E-101' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
   
        case "pgh-eblock-back":
                 
             echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
<area shape='rect' coords='122,107,173,160' href='#' data-key='PGH-F-304'  alt='F-304' />
<area shape='rect' coords='183,107,234,160' href='#' data-key='PGH-F-305'  alt='F-305' />
<area shape='rect' coords='243,107,294,160' href='#' data-key='PGH-F-306'  alt='F-306' />
<area shape='rect' coords='363,107,414,160' href='#' data-key='PGH-E-304'  alt='E-304' />
<area shape='rect' coords='423,107,474,160' href='#' data-key='PGH-E-305'  alt='E-305' />
<area shape='rect' coords='482,107,533,160' href='#' data-key='PGH-E-306'  alt='E-306' />
<area shape='rect' coords='122,171,173,224' href='#' data-key='PGH-F-204'  alt='F-204' />
<area shape='rect' coords='183,171,234,224' href='#' data-key='PGH-F-205'  alt='F-205' />
<area shape='rect' coords='243,171,294,224' href='#' data-key='PGH-F-206'  alt='F-206' />
<area shape='rect' coords='363,171,414,224' href='#' data-key='PGH-E-204'  alt='E-204' />
<area shape='rect' coords='423,171,474,224' href='#' data-key='PGH-E-205'  alt='E-205' />
<area shape='rect' coords='482,171,533,224' href='#' data-key='PGH-E-206'  alt='E-206' />
<area shape='rect' coords='482,238,533,291' href='#' data-key='PGH-E-106'  alt='E-106' />
<area shape='rect' coords='423,238,474,291' href='#' data-key='PGH-E-105'  alt='E-105' />
<area shape='rect' coords='363,238,414,291' href='#' data-key='PGH-E-104'  alt='E-104' />
<area shape='rect' coords='243,238,294,291' href='#' data-key='PGH-F-106'  alt='F-106' />
<area shape='rect' coords='183,238,234,291' href='#' data-key='PGH-F-105'  alt='F-105' />

  <area shape='rect' coords='357,443,475,468' href='#' alt='LEARN' />

  <area shape='rect' coords='313,343,530,425' href='#' data-key='PGH-E-' class='simple' linking='pgh-eblock-front'  alt='E&amp;F FRONT' />

  <area shape='rect' coords='122,238,173,291' href='#' data-key='PGH-F-104'  alt='F-104' />

</map>";
                 
            
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
   
   
   
             case "dbhisometricview1":
                 
             {   
                  echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
                 echo " <map name='Map' id='Map'> 
   <area data-key='10001' class='simple' linking='dbh-cd-interface'  shape='poly' coords='93,99,156,91,290,118,290,141,245,132,213,127,142,143,145,186,127,180,108,174,103,170' href='#' linking='dbh-cd-interface'  alt='C-Block' />
  <area data-key='10002' class='simple'   shape='poly' coords='143,144,154,240,293,300,320,287,318,221,309,201,321,186,345,178,357,175,359,164,319,151,288,144,266,152,257,146,267,142,230,129,212,127' href='#' linking='dbh-bd-interface'  alt='B Block' />
  <area data-key='10003' class='simple' shape='poly' coords='439,138,443,164,464,177,462,201,491,210,634,245,687,204,696,148,518,117,508,116' href='#' linking='dbh-ad-interface' linking='dbh-ad-interface'  alt='A Block' />
  <area data-key='10004' class='simple' shape='poly' coords='26,338,71,337,72,297,100,298,101,312,144,313,146,359,124,360,121,369,70,367,69,358,46,359,26,356' href='#' linking='dbhtopview' alt='Top View' />
  
  <area data-key='10005' class='simple' shape='poly' coords='103,420,109,445,157,431,200,419,210,424,271,403,280,393,265,382,253,379,243,373,235,372,215,375,205,383,197,384,194,379,188,376,180,376,165,377,162,391,150,395,147,403,141,405,138,400,133,396,128,394,118,397,117,416' href='#' linking='dbhisometricview2' alt='Isometric View II' />
  <area data-key='10006' class='simple' shape='poly' coords='359,446,472,446,474,470,357,468' href='#' alt='Learn' />
  </map>
";
             echo "<script type='text/javascript'> $('#imageload').click();</script>";
             $count=TRUE;      
             break;
             }  
               
             
             
             
             case "dbhtopview":
                    
                     echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
            echo         "<map name='Map' id='Map'>
  <area shape='poly' class='simple' coords='200,258,199,311,377,310,376,259' href='#' data-key='5' linking='dbh-cd-interface' alt='C-Block' />
  <area shape='poly' coords='360,310,359,366,495,366,493,312,431,311,433,324,418,326,417,313' href='#' class='simple' linking='dbh-bd-interface' data-key='4' alt='B-Block' />
  <area shape='poly' coords='466,132,604,132,608,209,528,212,526,190,508,189,505,208,468,211' href='#' class='simple' data-key='3' linking='dbh-ad-interface' alt='A-Block' />
  <area shape='poly' coords='24,344,26,351,21,354,37,362,32,364,62,380,72,388,82,389,90,384,131,401,153,368,151,358,143,353,135,357,132,353,105,348,103,344,89,342,75,345,76,351,69,353,65,348,40,341' class='simple' linking='dbhisometricview1' data-key='2' href='#'  alt='Isometric View I' />
  <area shape='poly' coords='144,415,149,437,193,425,233,414,243,420,287,404,297,403,299,396,307,390,299,388,297,383,280,380,278,374,265,373,253,374,238,376,238,381,232,382,224,376,217,375,203,376,199,384,198,386,197,390,185,392,185,400,178,401,175,395,166,393,160,394,154,396,157,407,156,413' linking='dbhisometricview2' class='simple' data-key='7' href='#' alt='Isometric View II' />
  <area shape='poly' coords='356,447,359,468,474,469,472,446' class='simple' data-key='1' href='#' alt='Learn' />
</map>";
                     echo "<script type='text/javascript'> $('#imageload').click();</script>";
                     $count=TRUE;
                     break;           
                     
                 case "dbhisometricview2":
                       echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
                       echo '<map name="Map" id="Map">
  <area shape="poly" class="simple" data-key="121" coords="302,169,309,252,331,280,534,224,536,152,541,142,516,130,434,142,474,136" href="#" linking="dbh-cd-interface" alt="C-Block" />
  <area shape="poly" class="simple" data-key="122" coords="537,150,534,222,580,252,700,208,712,139,658,122,621,138,129" href="#" linking="dbh-bd-interface" linking="dbhblock" alt="B-Block" />
  <area shape="poly" class="simple" data-key="123" coords="516,103,515,127,556,145,590,139,654,121,656,102,610,89" href="#" linking="dbh-ad-interface" alt="A-Block" />
  <area shape="poly" class="simple" data-key="124" linking="dbhtopview" coords="19,369,20,386,39,388,64,390,64,398,112,402,118,392,138,391,142,346,131,348,127,344,97,344,94,330,66,330,66,369" href="#" alt="Top View" />
  <area shape="poly" class="simple" data-key="125" coords="203,390,218,398,214,402,246,419,258,426,269,420,309,436,330,404,330,392,319,390,285,385,270,379,256,387,245,385,223,379,212,379,207,380" href="#" linking="dbhisometricview1" alt="Isometric View I" />
  <area shape="poly" class="simple" data-key="126" coords="357,448,473,447,474,470,358,470" href="#" alt="Learn" />
</map>';
                        echo "<script type='text/javascript'> $('#imageload').click();</script>";
                   $count=TRUE;
                 break;
                 
                 
              case "dbh-ad-interface" :
                  
                      echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
                     
             echo "<map name='Map' id='Map'>
  <area shape='poly' coords='15,271,14,226,36,226,36,189,26,180,50,171,73,177,89,171,124,181,138,177,146,178,164,170,185,178,202,171,222,179,240,170,259,176,275,170,303,177,296,188,295,204,305,204,312,202,310,194,305,189,306,182,317,177,336,173,372,171,395,168,410,170,409,178,406,186,405,245,412,248,412,273' href='#' class='simple' data-key='121311' linking='dbh-adblock-front' alt='AD-FRONT' />
  <area shape='poly' coords='424,248,424,270,492,272,494,278,826,279,824,241,813,240,814,181,820,178,797,172,777,177,757,170,740,176,720,171,703,176,682,170,665,176,646,170,625,176,605,170,588,175,569,169,544,174,553,196,536,202,537,186,526,179,510,175,488,170,466,169,446,168,436,170,438,185,436,208,439,226,438,244' href='#' class='simple' data-key='1232' linking='dbh-adblock-back' alt='AD-BOCK BACK' />
  <area shape='rect' coords='361,442,474,467' href='#' alt='LEARN' />
</map>";
             
               echo "<script type='text/javascript'> $('#imageload').click();</script>";
                   $count=TRUE;
                 break;
             
             
             
             
                case "dbh-bd-interface" :
                  
                      echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
                 
             echo "<map name='Map' id='Map'>
  <area shape='rect' coords='360,442,470,467' href='#' alt='LEARN' />
  <area shape='poly' class='simple' data-key='999' coords='16,164,21,262,17,261,14,278,16,296,352,296,375,300,416,313,418,145,367,172,359,167,344,172,330,168,316,173,301,169,282,178,271,175,260,180,242,176,228,174,220,170,204,174,192,170,176,174,164,172,152,177,136,170,122,176,103,169,86,164,53,160,35,160' href='#' linking='dbh-bdblock-front' alt='BD-BLOCK FRONT' />
  <area shape='poly' class='simple' data-key='989892' coords='430,184,442,186,439,176,450,170,466,174,477,168,493,172,506,167,518,173,533,168,546,173,558,166,572,170,585,166,599,172,612,167,626,174,639,167,651,171,664,169,679,171,692,169,708,172,726,165,771,159,801,158,804,170,801,184,801,221,800,248,805,257,824,258,824,288,432,289' linking='dbh-bdblock-back' href='#' alt='BD-BLOC BACK' />
</map>";
             
                echo "<script type='text/javascript'> $('#imageload').click();</script>";
                   $count=TRUE;
                 break;
             
             
             
              case "dbh-cd-interface" :
                  
                      echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='Maping'  />";
                 echo "<map name='Map' id='Map'>
  
  <area shape='poly' class='simple' data-key='fkasasdf' coords='28,151,24,162,28,182,28,220,28,250,22,254,20,245,12,248,13,276,98,276,107,279,337,273,394,293,412,290,414,157,394,160,380,156,371,161,359,158,345,162,334,157,322,162,308,155,298,162,285,158,273,160,261,158,247,162,236,158,226,162,209,160,198,162,184,158,172,163,160,158,149,164,152,186,124,190,126,174,118,167,110,158,96,155,84,152,68,150,48,147' href='#' linking='dbh-cdblock-front' alt='CD-BLOCK FRONT' />
  <area shape='rect'  data-key='asjddsaf' coords='357,442,472,466' href='#' alt='LEARN' />
  <area shape='poly' class='simple ' data-key='asjddsafdaf'  coords='820,272,826,158,804,158,790,160,773,158,763,160,740,167,729,168,718,172,723,182,725,196,705,195,706,169,694,165,682,170,669,166,656,168,642,166,629,170,619,166,610,171,596,165,583,168,569,166,559,171,545,165,534,170,518,166,507,169,492,165,482,169,468,163,457,170,442,166,428,169,423,178,422,265,442,276,463,271,486,274,518,277,547,274' href='#' linking='dbh-cdblock-back' alt='CD-BLOCK BACK' />
</map>";
             
              echo "<script type='text/javascript'> $('#imageload').click();</script>";
                   $count=TRUE;
                 break;
             
             
             
             
            case "dbh-adblock-front":
                
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                    
                echo "<img  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map' id='Maping'   />";
                
                
              echo "<map name='Map' id='Map'>
  <area shape='rect' coords='64,216,136,272' href='#' data-key='DBH-AD-112' alt='AD-112' />
  <area shape='rect' coords='139,214,209,271' href='#' data-key='DBH-AD-111' alt='AD-111' />
  <area shape='rect' coords='290,216,358,271' href='#' data-key='DBH-AD-110' alt='AD-110' />
  <area shape='poly' class='simple' data-key='timepass' linking='dbh-adblock-back'  coords='270,425,269,409,281,406,283,362,279,357,283,351,306,351,328,353,343,358,352,363,351,376,358,377,366,376,365,365,359,359,368,355,376,353,389,357,403,353,415,357,430,352,444,357,458,353,471,356,483,353,498,357,510,353,525,358,538,352,555,358,550,411,558,413,559,429,325,429,320,424' href='#' alt='AD-BLOCK BACK' />
<area shape='rect' data-key='DBH-AD-109' coords='366,214,433,270' href='#' alt='AD-109' />
  <area shape='rect' data-key='DBH-AD-108' coords='438,216,508,270' href='#' alt='AD-108' />
  <area shape='rect' data-key='DBH-AD-107' coords='512,216,581,269' href='#' alt='AD-107' />
  <area shape='poly' data-key='DBH-AD-212' coords='58,131,90,119,135,133,132,193,62,195' href='#' alt='AD-212' />
  <area shape='poly' data-key='DBH-AD-211' coords='167,121,209,134,210,196,137,194,135,130,286' href='#' alt='AD-211' />
  <area shape='poly' data-key='DBH-AD-210' coords='286,133,289,194,357,193,357,131,320,117' href='#' alt='AD-210' />
  <area shape='poly' data-key='DBH-AD-209' coords='362,130,366,193,433,193,432,129,397,118' href='#' alt='AD-209' />
  <area shape='poly' data-key='DBH-AD-208' coords='438,131,438,194,504,193,508,130,471,119' href='#' alt='AD-208' />
  <area shape='poly' data-key='DBH-AD-207' coords='512,129,512,193,579,192,582,131,546,116' href='#' alt='AD-207' />
  <area shape='rect'  coords='358,443,476,468' href='#' alt='LEARN' />
</map>";
              
                echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
             
                 
             case "dbh-adblock-back":
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
  <area shape='rect' coords='276,190,346,262' href='#' data-key='DBH-AD-106' alt='AD-106' />
  <area shape='rect' coords='351,190,420,262' href='#' data-key='DBH-AD-105' alt='AD-105' />
  <area shape='rect' coords='425,191,495,263' href='#' data-key='DBH-AD-104' alt='AD-104' />
  <area shape='rect' coords='499,191,575,262' href='#' data-key='DBH-AD-103' alt='AD-103' />
  <area shape='rect' coords='650,190,720,261' href='#' data-key='DBH-AD-102' alt='AD-102' />
  <area shape='rect' coords='725,189,800,262' href='#' data-key='DBH-AD-101' alt='AD-101' />
  <area shape='poly' coords='801,115,798,179,728,180,726,113,766,100' data-key='DBH-AD-201' href='#' alt='AD-201' />
  <area shape='poly' coords='724,114,724,181,650,179,651,114,690,101' data-key='DBH-AD-202' href='#' alt='AD-202' />
  <area shape='poly' coords='575,113,571,181,501,180,499,114,536,100' data-key='DBH-AD-203' href='#' alt='AD-203' />
  <area shape='poly' coords='498,113,495,179,424,179,422,114,460,100' data-key='DBH-AD-204' href='#' alt='AD-204' />
  <area shape='poly' coords='422,113,419,178,352,180,349,110,383,101' data-key='DBH-AD-205' href='#' alt='AD-205' />
  <area shape='poly' coords='346,112,344,180,275,178,275,114,309,101' data-key='DBH-AD-206' href='#' alt='AD-206' />
  <area shape='poly' coords='278,360,296,355,312,358,323,354,349,363,359,359,379,354,394,360,408,354,422,359,434,355,449,360,462,355,479,360,475,367,475,375,477,380,486,379,483,367,486,360,502,355,525,353,548,353,559,354,558,363,555,408,562,410,562,428,269,430,268,395,284,394' href='#' class='simple' data-key='dbhadback' linking='dbh-adblock-front' alt='AD-BLOCK FRONT' />
  <area shape='rect' coords='356,443,476,468' href='#' alt='LEARN' />
</map>";
   
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
   
   
   
   
    case "dbh-bdblock-front":
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
  <area shape='rect' coords='681,269,733,330' href='#'  data-key='DBH-BD-101' alt='BD- 101' />
  <area shape='rect' coords='622,268,678,330' href='#'  data-key='DBH-BD-102' alt='BD- 102' />
  <area shape='rect' coords='566,266,620,330' href='#'  data-key='DBH-BD-103' alt='BD- 103' />
  <area shape='rect' coords='403,268,453,330' href='#'  data-key='DBH-BD-104' alt='BD- 104' />
  <area shape='rect' coords='347,269,402,330' href='#'  data-key='DBH-BD-105' alt='BD- 105' />
  <area shape='rect' coords='294,268,345,329' href='#'  data-key='DBH-BD-106' alt='BD- 106' />
  <area shape='rect' coords='241,268,292,330' href='#'  data-key='DBH-BD-107' alt='BD- 107' />
  <area shape='rect' coords='679,186,733,249' href='#'  data-key='DBH-BD-201' alt='BD- 201' />
  <area shape='rect' coords='623,186,679,249' href='#'  data-key='DBH-BD-202' alt='BD- 202' />
  <area shape='rect' coords='567,187,622,251' href='#'  data-key='DBH-BD-203' alt='BD-203' />
  <area shape='rect' coords='400,190,454,251' href='#'  data-key='DBH-BD-204' alt='BD-204' />
  <area shape='rect' coords='348,191,399,249' href='#'  data-key='DBH-BD-205' alt='BD-205' />
  <area shape='rect' coords='293,191,343,250' href='#'  data-key='DBH-BD-206' alt='BD-206' />
  <area shape='rect' coords='239,189,292,252' href='#'  data-key='DBH-BD-207' alt='BD-207' />
  <area shape='poly' coords='237,109,259,100,287,105,285,154,286,170,237,172' href='#'  data-key='DBH-BD-307' alt='BD-307' />
  <area shape='poly' coords='314,98,341,107,341,170,291,170,291,107' href='#'  data-key='DBH-BD-306' alt='BD-306' />
  <area shape='poly' coords='370,97,394,106,396,170,346,171,346,107' href='#'  data-key='DBH-BD-305' alt='BD-305' />
  <area shape='poly' coords='425,96,451,105,452,169,401,169,400,105' href='#'  data-key='DBH-BD-304' alt='BD-304' />
  <area shape='poly' coords='592,95,567,103,567,168,620,168,620,102' href='#'  data-key='DBH-BD-303' alt='BD-303' />
  <area shape='poly' coords='649,95,676,104,676,166,625,166,624,104' href='#'  data-key='DBH-BD-302' alt='BD-302' />
  <area shape='poly' coords='721,100,704,94,680,102,679,165,733,165,732,107,290' href='#'  data-key='DBH-BD-301' alt='BD-301' />
  <area shape='poly' coords='291,375,292,440,461,439,521,441,522,430,534,427,534,422,521,418,520,366,523,359,489,357,467,367,445,366,420,366,392,365,371,364,351,365,333,365,318,364,303,365' href='#' class='simple' data-key='dbdsdbd' linking='dbh-bdblock-back' alt='BD-BLOCK BACK' />
  <area shape='rect' coords='357,442,472,466' href='#' alt='LEARN' />
</map>";
   
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
    case "dbh-bdblock-back":
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
  <area shape='rect' coords='522,265,575,325' href='#'  data-key='DBH-BD-108' alt='BD-108' />
  <area shape='rect' coords='473,266,522,326' href='#'  data-key='DBH-BD-109' alt='BD-109' />
  <area shape='rect' coords='417,267,468,325' href='#'  data-key='DBH-BD-110' alt='BD-110' />
  <area shape='rect' coords='364,265,416,325' href='#'  data-key='DBH-BD-111' alt='BD-111' />
  <area shape='rect' coords='315,266,362,324' href='#'  data-key='DBH-BD-112' alt='BD-112' />
  <area shape='rect' coords='205,265,259,330' href='#'  data-key='DBH-BD-113' alt='BD-113' />
  <area shape='rect' coords='151,267,203,329' href='#'  data-key='DBH-BD-114' alt='BD-114' />
  <area shape='rect' coords='98,267,149,329' href='#'  data-key='DBH-BD-115' alt='BD-115' />
  <area shape='rect' coords='44,269,96,327' href='#'  data-key='DBH-BD-116' alt='BD-116' />
  <area shape='rect' coords='525,188,577,248' href='#'  data-key='DBH-BD-208' alt='BD-208' />
  <area shape='rect' coords='472,188,521,249' href='#'  data-key='DBH-BD-209' alt='BD-209' />
  <area shape='rect' coords='417,188,469,249' href='#'  data-key='DBH-BD-210' alt='BD-210' />
  <area shape='rect' coords='366,188,416,249' href='#'  data-key='DBH-BD-211' alt='BD-211' />
  <area shape='rect' coords='313,188,362,249' href='#'  data-key='DBH-BD-212' alt='BD-212' />
  <area shape='rect' coords='204,189,259,254' href='#'  data-key='DBH-BD-213' alt='BD-213' />
  <area shape='rect' coords='152,189,202,254' href='#'  data-key='DBH-BD-214' alt='BD-214' />
  <area shape='rect' coords='97,189,150,251' href='#'  data-key='DBH-BD-215' alt='BD-215' />
  <area shape='rect' coords='41,190,95,250' href='#'  data-key='DBH-BD-216' alt='BD-216' />
  <area shape='poly' coords='576,170,523,170,521,107,548,99,575,107,495' href='#'  data-key='DBH-BD-308' alt='BD-308' />
  <area shape='poly' coords='519,105,520,169,469,172,470,107,493,98' href='#'  data-key='DBH-BD-309' alt='BD-309' />
  <area shape='poly' coords='439,98,467,108,467,172,416,172,414,107' href='#'  data-key='DBH-BD-310' alt='BD-310' />
  <area shape='poly' coords='387,99,413,108,416,171,365,175,361,109' href='#'  data-key='DBH-BD-311' alt='BD-311' />
  <area shape='poly' coords='332,101,361,108,362,175,311,175,308,109' href='#' data-key='DBH-BD-312'  alt='BD-312' />
  <area shape='poly' coords='222,99,250,109,250,172,202,172,199,109' href='#'  data-key='DBH-BD-313' alt='BD-313' />
  <area shape='poly' coords='170,98,196,107,198,173,149,173,147,106' href='#'  data-key='DBH-BD-314' alt='BD-314' />
  <area shape='poly' coords='112,99,144,105,148,171,95,173,91,108' href='#'  data-key='DBH-BD-315' alt='BD-315' />
  <area shape='poly' coords='57,99,89,106,91,173,39,172,35,107' href='#'  data-key='DBH-BD-316' alt='BD-316' />
  <area shape='poly' coords='285,367,287,421,283,428,285,441,341,442,482,441,494,445,518,448,518,357,491,369,444,368,438,373,407,369,389,369,364,370,347,370,327,366,315,363,305,363,292,363' href='#' class='simple' data-key='kjfkfjfk' linking='dbh-bdblock-front' alt='BD-BLOCK FRONT' />
  <area shape='rect' coords='360,446,470,463' href='#'  data-key='DBH-BD-' />
</map>";
   
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
   
    case "dbh-cdblock-front":
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
<area shape='poly' coords='317,97,340,103,340,165,293,165,293,104' href='#'  data-key='DBH-CD-309' alt='CD-309' />
<area shape='poly' coords='367,96,390,102,390,164,343,164,343,103' href='#'  data-key='DBH-CD-308' alt='CD-308' />
<area shape='poly' coords='417,96,440,102,440,164,393,164,393,103' href='#'  data-key='DBH-CD-307' alt='CD-307' />
<area shape='poly' coords='466,96,489,102,489,164,442,164,442,103' href='#'  data-key='DBH-CD-306' alt='CD-306' />
<area shape='poly' coords='515,96,538,102,538,164,491,164,491,103' href='#'  data-key='DBH-CD-305' alt='CD-305' />
<area shape='poly' coords='564,96,587,102,587,164,540,164,540,103' href='#'  data-key='DBH-CD-304' alt='CD-304' />
<area shape='poly' coords='613,96,636,102,636,164,587,164,588,103' href='#'  data-key='DBH-CD-303' alt='CD-303' />
  <area shape='rect' coords='299,257,342,314' href='#'  data-key='DBH-CD-107' alt='CD-107' />
  <area shape='rect' coords='344,256,393,312' href='#'  data-key='DBH-CD-106' alt='CD-106' />
  <area shape='rect' coords='395,254,444,312' href='#'  data-key='DBH-CD-105' alt='CD-105' />
  <area shape='poly' coords='687,250,741,250,738,290,689,282' href='#'  data-key='DBH-CD-101' alt='CD-101' />
  <area shape='poly' coords='640,249,640,309,673,311,672,274,682,272,682,249' href='#'  data-key='DBH-CD-102' alt='CD-102' />
  <area shape='rect' coords='590,251,640,309' href='#'  data-key='DBH-CD-103' alt='CD-103' />
  <area shape='rect' coords='447,254,586,310' href='#'  data-key='MMCA OFFICE' alt='MMCA OFFICE' />
  <area shape='rect' coords='688,179,736,234' href='#'  data-key='DBH-CD-201' alt='CD-201' />
  <area shape='rect' coords='641,180,687,234' href='#'  data-key='DBH-CD-202' alt='CD-202' />
  <area shape='rect' coords='590,180,639,236' href='#'  data-key='DBH-CD-203' alt='CD-203' />
  <area shape='rect' coords='542,179,589,236' href='#'  data-key='DBH-CD-204' alt='CD-204' />
  <area shape='rect' coords='494,181,543,237' href='#'  data-key='DBH-CD-205' alt='CD-205' />
  <area shape='rect' coords='442,181,490,238' href='#'  data-key='DBH-CD-206' alt='CD-206' />
  <area shape='rect' coords='394,180,441,238' href='#'  data-key='DBH-CD-207' alt='CD-207' />
  <area shape='rect' coords='343,182,393,239' href='#'  data-key='DBH-CD-208' alt='CD-208' />
  <area shape='rect' coords='293,183,342,239' href='#'  data-key='DBH-CD-209' alt='CD-209' />
  <area shape='poly' coords='712,95,735,104,734,163,687,162,688,102' href='#'  data-key='DBH-CD-301' alt='CD-301' />
  <area shape='poly' coords='664,96,687,102,687,162,638,164,639,105' href='#'  data-key='DBH-CD-302' alt='CD-302' />
  <area shape='poly' coords='279,363,278,431,292,441,305,441,325,442,343,441,366,440,400,439,417,438,441,440,471,439,478,437,483,431,492,432,504,432,526,440,544,439,557,434,558,365,562,358,554,355,527,356,513,359,502,362,493,365,487,367,488,373,489,379,481,381,476,375,478,366,471,361,310,363' href='#'  data-key='DBH-CD-afadsf' class='simple' linking='dbh-cdblock-back' alt='CD BLOCK BACK' />
  <area shape='rect' coords='362,445,468,463' href='#'  data-key='DBH-CD-' alt='LEARN' />
</map>";
   
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
   
   
   
   
 case "dbh-cdblock-back":
                 echo  "
                     <div id='updatebutton'>
                     <a href=#>
                     <img  src='/hostel/app/webroot/img/update.png' id='update' />
                     </a>
                   </div> ";
                echo "<img id='Maping'  src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                 
                 echo "<map name='Map' id='Map'>
<area shape='rect' coords='531,210,575,267' href='#'  data-key='DBH-CD-210' alt='CD-210' />
<area shape='rect' coords='485,210,529,267' href='#'  data-key='DBH-CD-211' alt='CD-211' />
<area shape='rect' coords='436,210,480,267' href='#'  data-key='DBH-CD-212' alt='CD-212' />
<area shape='rect' coords='388,210,432,267' href='#'  data-key='DBH-CD-213' alt='CD-213' />
<area shape='rect' coords='242,210,286,267' href='#'  data-key='DBH-CD-214' alt='CD-214' />
<area shape='rect' coords='191,210,235,267' href='#'  data-key='DBH-CD-215' alt='CD-215' />
<area shape='rect' coords='142,210,186,267' href='#'  data-key='DBH-CD-216' alt='CD-216' />
<area shape='rect' coords='145,279,188,334' href='#'  data-key='DBH-CD-114' alt='CD-114' />
<area shape='rect' coords='194,279,237,334' href='#'  data-key='DBH-CD-113' alt='CD-113' />
<area shape='rect' coords='243,279,286,334' href='#'  data-key='DBH-CD-112' alt='CD-112' />
<area shape='rect' coords='389,279,432,334' href='#'  data-key='DBH-CD-111' alt='CD-111' />
<area shape='rect' coords='437,279,480,334' href='#'  data-key='DBH-CD-110' alt='CD-110' />
<area shape='rect' coords='486,279,529,334' href='#'  data-key='DBH-CD-109' alt='CD-109' />
<area shape='poly' coords='551,127,578,135,576,193,533,193,534,135' href='#'  data-key='DBH-CD-310' alt='CD-310' />
<area shape='poly' coords='503,127,530,135,528,193,485,193,486,135' href='#'  data-key='DBH-CD-311' alt='CD-311' />
<area shape='poly' coords='455,127,480,136,480,192,437,192,438,135' href='#'  data-key='DBH-CD-312'  alt='CD-312' />
<area shape='poly' coords='405,127,434,135,433,193,390,194,388,135' href='#'  data-key='DBH-CD-313'  alt='CD-313' />
<area shape='poly' coords='257,127,286,135,285,193,242,194,240,135' href='#'  data-key='DBH-CD-314' alt='CD-314' />
<area shape='poly' coords='210,127,236,134,236,194,193,194,191,135' href='#'  data-key='DBH-CD-315'  alt='CD-315' />
<area shape='poly' coords='159,127,188,134,190,194,138,196,136,135' href='#'  data-key='DBH-CD-316' alt='CD-316' />
  <area shape='rect' coords='359,444,471,464' href='#'  data-key='DBH-CD-' alt='LEARN' />
  <area shape='poly' coords='280,419,275,416,268,416,270,437,321,435,328,439,394,436,471,434,504,445,521,444,519,362,502,362,484,360,470,362,452,362,439,362,427,361,408,363,391,363,379,361,365,362,354,363,356,377,339,380,342,368,332,362,326,359,312,357,303,356,289,356,282,358,277,359' href='#' class='simple' linking='dbh-cdblock-front'  data-key='afdfadsf' alt='CD BLOCK FRONT' />
  <area shape='rect' coords='38,210,89,268' href='#'  data-key='DBH-CD-' href='#'  data-key='DBH-CD-217' alt='CD-217' />
  <area shape='poly' coords='55,127,84,134,86,194,34,196,32,135' href='#'  data-key='DBH-CD-317' href='#'  data-key='DBH-CD-' alt='CD-317' />
  <area shape='rect' coords='534,279,577,334' href='#'  data-key='DBH-CD-108' alt='CD-108' />
</map>";
   
                   echo "<script type='text/javascript'> $('#imageload').click();</script>";
                echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                
       $count=TRUE;
       break;
      
   
   
   
   
   
                 
                 
              case "rooms":
                  
                   echo "<img id='Maping' src='/hostel/app/webroot/img/$img.png' usemap='#Map' class='map'  />";
                echo  "
                    <input type=button value='update' id='update' />
                   <map name='Map' >
                    <area data-key='100'  shape='rect' coords='292,386,354,487' href='#' alt='' />
<area data-key='200'   id='200' shape='rect' coords='370,387,432,488' href='#' alt='' />
<area data-key='300'  shape='rect' coords='451,386,513,487' href='#' alt='' />
<area data-key='400'  shape='rect' coords='535,387,597,488' href='#' alt='' />
<area data-key='500' shape='rect' coords='618,386,680,487' href='#' alt='' />
<area data-key='600' shape='rect' coords='694,387,756,488' href='#' alt='' />
<area data-key='700' shape='rect' coords='775,385,837,486' href='#' alt='' />
<area data-key='800' shape='rect' coords='784,224,835,311' href='#' alt='' />
<area data-key='900' shape='rect' coords='545,225,596,312' href='#' alt='' />
<area data-key='1000' shape='rect' coords='626,224,677,311' href='#' alt='' />
<area data-key='1100' shape='rect' coords='704,224,755,311' href='#' alt='' />
<area data-key='1200' shape='rect' coords='784,224,835,311' href='#' alt='' />
<area data-key='1300' shape='rect' coords='459,224,510,311' href='#' alt='' />
<area data-key='1400' shape='rect' coords='378,224,429,311' href='#' alt='' />
<area data-key='1500' shape='rect' coords='301,224,352,311' href='#' alt='' />
<area data-key='1600' shape='rect' coords='222,223,273,310' href='#' alt='' />
<area data-key='1700'shape='rect' coords='215,387,277,488' href='#' alt='' />
<area data-key='1800'shape='rect' coords='905,226,940,266' href='#' alt='' />
</map>";
                   echo "<script type='text/javascript'> rebin('$string'); $('#update').click(function(){enterroom();});      </script>";
                   $count=TRUE;
                   break;


                    default :
                    $count=FALSE;
                     $img = 'nithtopview';
                        break;
    
         }
         
       }
         
         
         exit;
    }
    
     public function listdelete()
    {
        
         $getdata = $this->params->query;
         $room = $getdata['room'];
         
 
          $name = $this->Session->read('user');
          $name = $name['username'];
          
          $this->Panel->remove($name,$room);
          
          
        echo "<script type='text/javascript'>  listreload(); </script>";
        
         
     
         
       
     exit;
    }
    
    function otherstudentpref()
    {
      //$this->Panel->allotmentalgo("b-tech/b-arch",2,"male",3);
       // $this->Panel->randomalgo("b-tech/b-arch",2,"male");
      // $this->Panel->normalize();
        $name = $this->Session->read('user');
         $getdata = $this->request;
         $result=$this->Panel->otherchoicegroup($name);
         $this->set('grouplist',$result);
     }
    
    function idcard()
    {
        $name = $this->Session->read('user');
        $rollno = $this->request->query['rollno'];
        $userinfo = $this->Panel->otheruserinfo($rollno,$name);
        $imagelink = $this->Panel->query("select imageadd from imageupload where rollno='$rollno' ");
        if(!empty($imagelink))
        $imagelink = $imagelink[0]['imageupload']['imageadd'];
        else
        $imagelink='thumbnail.jpg';
        $name=strtoupper($userinfo['name']);
        $mobileno = $userinfo['mobileno'];
        $email = $userinfo['email'];
        $cgpi= $userinfo['cgpi'];
        $dept = $userinfo['department'];
        $dob = $userinfo['dob'];
        echo "<div class='mainidcard'> 
            
        <div class='top'>
            <div class='topleft' >
            <span class='idtext' style='font-weight;font-weight: bold;font-size: 20px;'> $name </span> <br />
      <span class='testing' > Roll no : </span>  <span class='idtext'> $rollno </span> <br />
      <span class='testing'  > CGPI : </span>      <span class='idtext'> $cgpi </span> <br />
      <span class='testing'  > Dept : </span>      <span class='idtext'> $dept </span> <br />
       <span class='testing'  > DOB : </span>      <span class='idtext'> $dob </span> <br /> 
            
            </div>
            
            <div class='topright'>
            <img height='135' width='120' src='/hostel/faltoo/".$imagelink."'>
            </div>
        <div>
        
        <div class='bottom'>
         <div class='bottomleft'> <span class='idtext'> $email </span> <br /> </div>
         <div class='bottomright'>   <span class='idtext'> $mobileno </span>    <br /></div>
        </div>

        </div>";
        exit;
    }
    
    function filledlist()
    {
         $name = $this->Session->read('user');
        $rollno = $this->request->query['rollno'];
        $userpre=$this->Panel->otherprefrence($rollno,$name);
        echo "<div class='filldiv'>";
        echo "<table class='fillchoices'  >";
        
        echo "<thead>";
         echo "<th>Rank</th>";
         echo "<th style='border-right: 0px solid #aaa;' >Choice</th>";
         echo "</thead>";
        $rank=1;
        if(!empty ($userpre))
        {
   foreach ($userpre as $data) {
    

    $room = $data['prefrence']['room_no'];
   
    echo "<tr> <td> $rank. </td>  <td style='border-right: 0px solid #aaa;' > $room  </td> </tr>";
    $rank = $rank+1;
   }
        }
       
        echo "</table>";
        
        if(empty ($userpre))
        {
            echo '<center><h3>no filled choice </h3></center>';
        }
        echo "</div>";
        exit;
    }
    
}

?>

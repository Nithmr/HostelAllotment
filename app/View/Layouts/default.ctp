  <?php
  /**
   * 
   * PHP 5
   *
   * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
   * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
   *
   * Licensed under The MIT License
   * Redistributions of files must retain the above copyright notice.
   *
   * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
   * @link          http://cakephp.org CakePHP(tm) Project
   * @package       Cake.View.Layouts
   * @since         CakePHP(tm) v 0.10.0.1076
   * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
   */

  $cakeDescription = __d('cake_dev', 'Online Hostel Allotment');
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php echo $this->Html->charset(); ?>
  	<title>
  		<?php echo $cakeDescription ?>:
  		<?php echo $title_for_layout; ?>
  	</title>
  	<?php
  		echo $this->Html->meta('icon');
  		
  		
                  echo $this->Html->css('customcss.css');
  		echo $this->Html->css('bootstrap.css');
  		echo $this->Html->css('bootstrap-theme.css');
                  echo $this->Html->script('mapmaster.js');
  		echo $this->Html->script('bootstrap.js');
  		echo $this->Html->script('npm.js');
                 
                 echo $this->Html->script('jquery.imagemapster.js');
               
                 echo $this->Html->script('jquery.qtip-1.0.0-rc3.min.js');
                 
  		echo $this->fetch('meta');
  		echo $this->fetch('css');
  		echo $this->fetch('script');
  	?>
      
      
      
      
      
      <style>

  #wrapper {
      padding-left: 0;
      -webkit-transition: all 0.5s ease;
      -moz-transition: all 0.5s ease;
      -o-transition: all 0.5s ease;
      transition: all 0.5s ease;
  }

  #wrapper.toggled {
      padding-left: 250px;
  }

  #sidebar-wrapper {
      z-index: 1000;
      position: fixed;
      left: 250px;
      width: 0;
      height: 100%;
      top : 0px;
      margin-left: -250px;
      overflow: auto;
      background: #000;
      -webkit-transition: all 1.5s ease;
      -moz-transition: all 1.5s ease;
      -o-transition: all 1.5s ease;
      transition: all 1.5s ease;
  }

  #wrapper.toggled #sidebar-wrapper {
      width: 250px;
  }

  #page-content-wrapper {
      width: 100%;
      position: fixed;
      padding: 15px;
  }

  #wrapper.toggled #page-content-wrapper {
      position: absolute;
      margin-right: -250px;
  }

  /* Sidebar Styles */

  .sidebar-nav {
      position: absolute;
      top: 0px;
      width: 250px;
      margin: 0;
      padding: 0;
      list-style: none;
  }

  .sidebar-nav li {
      text-indent: 20px;
      line-height: 40px;
  }

  .sidebar-nav li a {
      display: block;
      text-decoration: none;
      color: #999999;
  }

  .sidebar-nav li a:hover {
      text-decoration: none;
      color: #fff;
      background: rgba(255,255,255,0.2);
  }

  .sidebar-nav li a:active,
  .sidebar-nav li a:focus {
      text-decoration: none;
  }

  .sidebar-nav > .sidebar-brand {
      height: 65px;
      font-size: 18px;
      line-height: 60px;
  }

  .sidebar-nav > .sidebar-brand a {
      color: #999999;
  }

  .sidebar-nav > .sidebar-brand a:hover {
      color: #fff;
      background: none;
  }

  @media(min-width:768px) {
      #wrapper {
          padding-left: 250px;
      }

      #wrapper.toggled {
          padding-left: 0;
      }

      #sidebar-wrapper {
          width: 250px;
      }

      #wrapper.toggled #sidebar-wrapper {
          width: 0;
      }

      #page-content-wrapper {
          padding: 20px;
          position: relative;
      }

      #wrapper.toggled #page-content-wrapper {
          position: relative;
          margin-right: 0;
      }
  }
          .fillchoice0
          {
              display: none;
          }
        .grouping0
        {
            display: none;
        }
           .fillform0
           {
               display: none;
           }
      </style>
     
  </head>
  <body>
     

   <nav class="navbar navbar">
    <div class="container-fluid">
      
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">NIT-Hamirpur</a>
      </div>

      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
        <?php
        if(!$isLogin){
          echo "<li><a href='#' >Login</a></li>";
          }
          else{
          echo "<li><a href='$base_url/user/logout'>Logout</a></li>";
          }?>
              <li><a href="<?php echo $webdirurl ?>/menubar/about/index.html" >About</a></li>
              <li><a href="<?php echo $webdirurl ?>/menubar/rules/rules.html" >Rules</a></li>
              <li><a href="<?php echo $webdirurl ?>/menubar/faq/faq.html" >Faq</a></li>
              <li><a href="#" >Gallery</a></li>
  </ul>
   </div>
    </div>
  </nav>

    <?php
     if($isLogin && $admin==0)
           {?>
    
	<div id="main">
		
                          echo "<ul class='nav'    >
                            <li><a href='$base_url/panel/index' >Home</a></li>
                                <li><a href='$base_url/panel/viewinfo'>Studentinfo</a></li>
                                <li><a href='$base_url/panel/editinfo'>Edit Password</a></li>
                                <li><a class='fillchoice$fillchoiceactive' href='$base_url/fillchoice/fillchoice'>fillchoice</a></li>
                                <li><a class='fillchoice$fillchoiceactive' href='$base_url/fillchoice/listfill'>fillchoice from list</a></li>
                                <li><a class='grouping$groupingactive' href='$base_url/grouping/requestnew'>roommate finder</a></li>
                                <li><a class='fillform$formfill' href='$base_url/userform/filluserinfo'>Fill information</a></li>
                                <li><a class='fillchoice$fillchoiceactive' href='$base_url/fillchoice/otherstudentpref'>other student pref</a></li>
                            </ul></div></div>";
                       
                       ?>   
                  
                    
           
                <?php echo $this->fetch('content'); ?>
                
              
      <div id ="scripts" style='visibility: hidden'></div>
      
      
      
        <script type="text/javascript">
            
            function parseScript(strcode) {
    var scripts = new Array();         // Array which will store the script's code
    
    // Strip out tags
    while(strcode.indexOf("<script") > -1 || strcode.indexOf("</script") > -1) {
      var s = strcode.indexOf("<script");
      var s_e = strcode.indexOf(">", s);
      var e = strcode.indexOf("</script", s);
      var e_e = strcode.indexOf(">", e);
      
      // Add to scripts array
      scripts.push(strcode.substring(s_e+1, e));
      // Strip from strcode
      strcode = strcode.substring(0, s) + strcode.substring(e_e+1);
    }
    
    // Loop through every script collected and eval it
    for(var i=0; i<scripts.length; i++) {
      try {
        eval(scripts[i]);
      }
      catch(ex) {
        // do what you want here when a script fails
      }
    }
  }
            
            
            
            
            
       function deleteroom()
          {
                  var htmlSelect=document.getElementById('preference');



   var value = $("#preference option:selected").val();       
          
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
    
     if (xmlhttp.readyState==4 )
      {
      var resp = xmlhttp.responseText; 
      document.getElementById("leflist").innerHTML = resp;
       parseScript(resp);
      }
   
    }
     document.getElementById('leflist').innerHTML    =  "<select size='7' id='preference' ><option value = 'loading'>Loading...</select>";
          
  xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/listdelete?room="+value,false);
  xmlhttp.send();

            

          }     
       

    function elegibleroomenter()
          {

  var selectitems = document.getElementById("preference");
  var items = selectitems.getElementsByTagName("option");
    
     if(items.length>19)
      alert("you can enter only 20 choices");
  else
      {
                  var htmlSelect=document.getElementById('eligibleroomlist');



   var value = $("#eligibleroomlist option:selected").val();       
        
    window.location = "<?php echo BASE_URL ?>" + "/fillchoice/enterlistroom?room="+value;
  //xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/enterroom?room="+value,false);

   }         

          }     
       
       
       
       
       
       
        function upchoice()
          {
                  var htmlSelect=document.getElementById('preference');



   var value = $("#preference option:selected").val();       
          
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
    
     if (xmlhttp.readyState==4 )
      {
      var resp = xmlhttp.responseText; 
      document.getElementById("leflist").innerHTML = resp;
       parseScript(resp);
      }
   
    }
     document.getElementById('leflist').innerHTML    =  "<select size='7' id='preference' ><option value = 'loading'>Loading...</select>";
          
  xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/upchoice?room="+value,false);
  xmlhttp.send();

            

          }     
       
       
   function downchoice()
          {
                  var htmlSelect=document.getElementById('preference');



   var value = $("#preference option:selected").val();       
          
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
    
     if (xmlhttp.readyState==4 )
      {
      var resp = xmlhttp.responseText; 
      document.getElementById("leflist").innerHTML = resp;
       parseScript(resp);
      }
   
    }
     document.getElementById('leflist').innerHTML    =  "<select size='7' id='preference' ><option value = 'loading'>Loading...</select>";
          
  xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/downchoice?room="+value,false);
  xmlhttp.send();

            

          }     
            
       
       
   function listremoveall()  
            
            {

  var htmlSelect=document.getElementById('preference');



   var value = $("#preference option:selected").val();       
          
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
    
     if (xmlhttp.readyState==4 )
      {
      var resp = xmlhttp.responseText; 
      document.getElementById("leflist").innerHTML = resp;
       parseScript(resp);
      }
   
    }
     document.getElementById('leflist').innerHTML    =  "<select size='7' id='preference' ><option value = 'loading'>Loading...</select>";
          
  xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/removeall",false);
  xmlhttp.send();

            
      
  }    
       
       
       function listreload()  
            
            {

  var htmlSelect=document.getElementById('preference');



   var value = $("#preference option:selected").val();       
          
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
    
     if (xmlhttp.readyState==4 )
      {
      var resp = xmlhttp.responseText; 
      document.getElementById("leflist").innerHTML = resp;
       parseScript(resp);
      }
   
    }
     document.getElementById('leflist').innerHTML    =  "<select size='7' id='preference' ><option value = 'loading'>Loading...</select>";
          
  xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/reloadlist",false);
  xmlhttp.send();

            
      
  }
            
  $(document).ready(function(){
  $('#removechoice').click(function (){deleteroom();});
  $('#upchoicelist').click(function (){upchoice();});
  $('#downchoice').click(function (){downchoice();});
  $('#removeallchoice').click(function (){listremoveall();});
  $('#eligibleroombutton').click(function (){elegibleroomenter();});

  $('.fillchoice0').click(function(e) { e.preventDefault(); });

  $('.grouping0').click(function(e) { e.preventDefault(); });

  $('#loadingimg').css("visibility","hidden");


     var url = window.location;
       
          $('.nav li a[href="'+url+'"]').attr('id','activelinks');
          
          
    

  });



          

              
              function rebin(keys)
              {
              
              
                
         
            array = keys.split('#hostel#');

            arraylocked = array[0].split(',');
            arrayfilled =  array[1].split(',');
            for(i=0;i<2000;i++)
                {
                 if(arraylocked[i]==undefined)
                    
                     arraylocked[i]=i;
                }
             for(i=0;i<40;i++)
                {
                 if(arrayfilled[i]==undefined)
                    
                     arrayfilled[i]=i;
                }
       
                  var options = {  fillColor: '000000',
  		mapKey: 'data-key',
  		singleSelect:true,
                  fillOpacity: 0.6,
  		 areas:  [
                      <?php for($i=0;$i<2000;$i++) {     
                     echo "{key: arraylocked[$i], 
                      staticState:true,
                      fillColor: 'ffffff',
  		    fillOpacity: 0.8
                    },";
                     }  
                   for($i=0;$i<40;$i++)
                   {
                       echo "{key: arrayfilled[$i], 
                      staticState:true,
                      fillColor: '000000',
  		    fillOpacity: 0.8
                    },"; 
                   }
                   
                   
                   ?>
            
              
              
              
          
      ]};
                  
               
                  $('#Maping').mapster('unbind');
                  $('#Maping').mapster(options);

                   
                   
                        
         
                   
                   
                   
                   
                   
                   
                   
             
               }
             
              

  function enterroom()
  {
      
      
      
           
  	var selectitems = document.getElementById("preference");
  var items = selectitems.getElementsByTagName("option");
    
     if(items.length>19)
      alert("you can enter only 20 choices");
  else
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
      document.getElementById("scripts").innerHTML = resp;
       parseScript(resp);
      }
    }
    var room = $("#Maping").mapster("get");

  $('#loadingimg').css("visibility","visible");
   


  xmlhttp.open("GET","<?php echo BASE_URL ?>/fillchoice/enterroom?room="+room,false);
  xmlhttp.send();

  $('#loadingimg').css("visibility","hidden");
  }
  }










  </script>			
      
    <?php
             } //end of user
    
  else if($admin==1 && $isLogin)
   {
  ?>
              <script type="text/javascript">
          $(document).ready(function(){
          var url = window.location;
       
          $('.nav li a[href="'+url+'"]').attr('id','activelinks');
          }
          );
  function redirect12($abc)
  {
          window.location = $abc;
  }
  </script>
                    <div id="wrapper" >

          <!-- Sidebar -->
          <div id="sidebar-wrapper">
              <ul class="sidebar-nav">
                  <li class="sidebar-brand">
                      <a href="#">
                          Administrator
                      </a>
                  </li>
                  <?php  echo    "<li><a href='$base_url/admin/roomproperties?hostelname=none' >Room-properties</a></li>
                                  <li><a href='$base_url/admin/scheduling'>Scheduler</a></li>
                                  
                                  <li><a href='$base_url/admin/addremoverooms?hostelname=none'>rooms</a></li>
                                  <li><a href='$base_url/admin/addinformation'>modiinfo</a></li>
                                  <li><a href='$base_url/admin/addremoveusers'>users</a></li>
                                   <li><a href='$base_url/admin/exchangerooms'>exchange rooms</a></li>
                                  <li><a href='$base_url/admin/search'>search</a></li>
                                  <li><a href='$base_url/admin/editinfo'>editinfo</a></li>
                                  <li><a href='$base_url/admin/exportdata'>data</a></li>
                         <li><a href='$base_url/admin/validationpage'>validate</a></li>
                                    
                              </ul></div></div>";
                          
                       echo $this->fetch('content'); ?>
              </ul>
          </div> 
    
            
                            
                            
                                           
                           
                    <?php
   }
   else if($isLogin && $admin == 2)
   {
       ?>
                                  
   <div id="main">
  	             
                      
             <div id='top'>
  		
                      <div id='top1'>
  			
                      </div>
                      <div id='top2'>
                        

                          <ul class='nav' style='margin-left:5%; '>
                                <li><a href='<?php echo $webdirurl ?>/menubar/about/index.html' >About</a></li>
              <li><a href='<?php echo $webdirurl ?>/menubar/rules/rules.html' >Rules</a></li>
              <li><a href='<?php echo $webdirurl ?>/menubar/faq/faq.html' >Faq</a></li>
              <li><a href='#' >Gallery</a></li>
                          </ul>
                       
                      </div>
                  </div>     
                      <div id='aboutbelowwall'>
                          <div id='loginmenudiv'>
                              <ul class='nav'    >
                        <?php  echo    "<li><a href='$base_url/mmca/index'>Home</a></li>
                                    <li><a href='$base_url/mmca/exchangerooms'>exchange rooms</a></li>
                                  <li><a href='$base_url/mmca/capacity'>capacity</a></li>
                                  <li><a href='$base_url/mmca/validationpage'>validate</a></li>
                                  <li><a href='$base_url/mmca/search'>search</a></li>
                                  <li><a href='$base_url/mmca/editinfo'>Edit password</a></li>
                                  <li><a href='$base_url/mmca/exportdata'>Export data</a></li>
                                  <li><a href='$base_url/user/logout'>logout</a></li>
                              </ul></div></div>";
                          
                       echo $this->fetch('content'); ?>
                            
                            
                                           
                                  
                                  
                                  
   <?php                               
   }
  else if(!$isLogin && !$admin)
       echo $this->fetch('content');
                    ?>
                      
      
   
  </body>
  </html>

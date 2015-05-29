<?php //   ?>

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
        <li><a href="#" >Login</a></li>
            <li><a href="<?php echo $webdirurl ?>/menubar/about/index.html" >About</a></li>
            <li><a href="<?php echo $webdirurl ?>/menubar/rules/rules.html" >Rules</a></li>
            <li><a href="<?php echo $webdirurl ?>/menubar/faq/faq.html" >Faq</a></li>
            <li><a href="#" >Gallery</a></li>
</ul>
 </div>
  </div>
</nav>
	 
<div class="container">    
        <div id="loginbx" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <fieldset id="loginbox">
                        <form id="slick-login" method="POST" action="" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" name="user_name" placeholder="username" class="form-control" value="">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" name="password" placeholder="password" class="form-control" >
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input type="submit" value="Log In" />

                                    </div>
                                </div>


                                
                            </form>     


<div id="flash-message">
            	<?php echo $this->Session->flash(); ?>
                        </div>

</fieldset>
    
     
          
    

</div>

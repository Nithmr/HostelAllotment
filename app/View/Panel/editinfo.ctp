 <div id="flash-message">
                <?php echo $this->Session->flash(); ?>
                        </div>
 <div class="container col-xs-12" id="container1">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Change Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Username: <?php echo $userinfo['username'] ?></label>
                            </div>

                            <div class="form-group">
                                <input type="password" name="oldpassword" id="oldpassword" class="form-control input-sm" placeholder="Current Password">
                            </div>

                            <div class="form-group">
                                <input type="password" name="newpassword" id="newpassword" class="form-control input-sm" placeholder="New Password">
                            </div>

                            <div class="form-group">
                                <input type="password" name="repassword" id="repassword" class="form-control input-sm" placeholder="Confirm Password">
                            </div>

                            <input type="submit" value="Submit" class="btn btn-info btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
#container1 {
    background-color: #e2dada;
}

.centered-form {
    margin-top: 120px;
    margin-bottom: 120px;
}

.centered-form .panel {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
}
</style>
    
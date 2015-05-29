
     <div id='contentpane'>
                <div id ='leftborder'></div>
                
		<div id='content'>
                          
<div id="flash-message">
            	<?php echo $this->Session->flash(); ?>
                        </div>
<form method="post">
    <table>
        <tr>
            <td>
                <label> Username </label>
            </td>
            <td>
                <?php echo $userinfo['username'] ?>
            </td>
        </tr>
         <tr>
            <td>
                <label> Old Password </label>
            </td>
               <td>
                <input type="password" name="oldpassword" id="oldpassword" />
              </td>
              
        </tr>
        <tr>
            <td>
                <label> New Password </label>
            </td>
               <td>
                <input type="password" name="newpassword" id="newpassword" />
              </td>
              
        </tr>
        <tr>
            <td>
                <label> Confirm Password </label>
            </td>
             <td>
                <input type="password" name="repassword" id="repassword" />
              </td>
        </tr> 
        <tr>
            <td>
                <input type="submit" value="submit" />
            </td>
        </tr>
            
    </table>   
</form>
 <div id ="rightborder"></div>
      
        </div>
                
     </div>
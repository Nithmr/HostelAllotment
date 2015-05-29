<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author Real-Ultimate
 */
App::uses('Sanitize', 'Utility');

class UserController extends AppController 
{
 
  
    
    
    public function index()
    {
        
    }


    public function login() {
    
         if($this->isLogin)
        {
             
             if($this->admin==1)
             {
                 $this->redirect(BASE_URL . '/admin/index');
             }
              if($this->admin==2)
             {
                 $this->redirect(BASE_URL . '/mmca/index');
             }
            
            $this->redirect(BASE_URL . '/panel/index');  
        }
           $this->data = Sanitize::clean($this->data, array('encode' => false));
           

        
       $data =    $this->data;
       if(isset ($data)&&!empty ($data['user_name'])&&!empty($data['password']))
      {
           $username = $data['user_name'];
           $password = $data['password'];
         $query = "select * from users left join `group` on users.rollno=`group`.rollno where username='$username'and password='$password'";  
           $result = $this->User->query($query);
          if(!empty ($result)) 
          {
               $this->Session->write("user",$result[0]['users']);
               $this->Session->write("groupentry",$result[0]['group']['groupid']);
              if($result[0]['users']['admin'])
             {
                 $this->redirect(BASE_URL . '/admin/index');
             }
         
          
          $this->redirect(BASE_URL . '/panel/index'); 
          }
          else
          {
                $this->Session->setFlash('Invalid usename or password', 'default', array('class' => 'error_message'));
          }
      }
           
      
     
        
    }
    
    public function logout()
    {
      $this->Session->write('user', '');
        $this->redirect(BASE_URL . '/user/login');
    }

    //put your code here
}

?>

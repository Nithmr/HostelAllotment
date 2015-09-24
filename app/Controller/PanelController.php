<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PanelController
 *
 * @author Real-Ultimate
 */
App::uses('Sanitize', 'Utility');
class PanelController extends AppController
{
   var $name =  'Panel';
     function beforeFilter() {
        parent::beforeFilter();
      
        
        
        
        
        
        if(!$this->isLogin) 
        {
            $this->redirect(BASE_URL . '/user/login');  
        }
        else if($this->admin >0)
        {
            $this->redirect(BASE_URL . '/user/logout');
        }
        else
        {
             $name = $this->Session->read('user');
          $name = $name['username'];
    
         
         $result = $this->Panel->reloadlist($name);
         
         $this->set('result',$result);
        }
    }
    
        
        public function ajaximage()
        {
            $path = "faltoo/";
            $name = $this->Session->read('user');
          $rollno = $name['username'];
            
	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
                                        $txt=str_replace(" ","_",$txt);
					if(in_array($ext,$valid_formats))
					{
					if($size<(1024*300))
						{
							$actual_image_name = time().$txt.".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
                                                            $query="select * from imageupload where rollno='$rollno'";
                                                            $result=$this->Panel->query($query);
                                                            if(isset($result[0]['imageupload']['rollno']))
                                                            {
                                                                $file = "faltoo/".$result[0]['imageupload']['imageadd'];
                                                                unlink($file);
                                                                $query="UPDATE `imageupload` SET `rollno`='$rollno',`imageadd`='$actual_image_name' WHERE rollno='$rollno'";
                                                                $result=$this->Panel->query($query);
                                                                  echo "<img height='140' width='120' src='/hostel/faltoo/".$actual_image_name."'  class='preview'>";
                                                            }
                                                            else
                                                            {
								$query="INSERT INTO `imageupload`(`rollno`, `imageadd`) VALUES ('$rollno','$actual_image_name')";
								$result=$this->Panel->query($query);	
                                                                echo "<img height='140' width='120' src='/hostel/faltoo/".$actual_image_name."'  class='preview'>";
									
                                                            }
                                                            
                                                            }
							else
								echo "failed";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
		}
            exit;
        }
    
 
       


       public function index()
    {
        $name = $this->Session->read('user');
       
        $this->set('name', $name['username']);
        
       $name = $name['username'];
       
       $query = "select room_no,rollno from newuserdataofrooms where room_no in ( select room_no from newuserdataofrooms where rollno='$name' )";
       
       
       $allotedinfo = $this->Panel->query($query);
       
    
       
       $this->set('allotedinfo', $allotedinfo);
         
        
        
         
    }
   

   public function virtualtour()
   {
       
   }
    
   










    public function viewinfo()
    {
        $username = $this->Session->read('user');
        $username = $username['username'];
        $query = "select * from users where rollno ='$username'";
        $result1 = $this->Panel->query($query);
        
        $query="select * from imageupload where rollno='$username'";
         $result = $this->Panel->query($query);
         if(isset($result[0]['imageupload']['imageadd']))
                    $this->set('imagedata',$result);
                else 
                {
                    $result[0]['imageupload']['imageadd']="thumbnail.jpg";
                  $this->set('imagedata',$result);
                }
                if(empty($result1[0]['users']['name']))
                {
                    $userdata['name']=" `";
                    $userdata['pincode']="` ";
                    $userdata['permanentadd']="` ";
                    $userdata['mobileno']="` ";
                    $userdata['email']=" `";
                    $userdata['bloodgroup']="` ";
                    $userdata['cgpi']="` ";
                    $userdata['department']="` ";
                    $userdata['dob']=" `";
                    $userdata['fathername']="` ";
                    $userdata['category']=" `";
                    $userdata['course']=" `";
                    $userdata['year']=" `";
                    $userdata['gender']="` ";
                    $userdata['mothername']="` ";
                    $userdata['motheroccupation']="` ";
                    $userdata['fatheroccupation']="` ";
                    $userdata['fathermobileno']="` ";
                    $userdata['ph']="` ";
                    $userdata['rollno']=$result1[0]['users']['rollno'];
                     $this->set('userdata',$userdata);
                }
                else
                    $this->set('userdata',$result1[0]['users']);
        
    }
 
    public function editinfo()
    {
        $this->data = Sanitize::clean($this->data, array('encode' => false));
           
        $userinfo = $this->Session->read('user');
        $data = $this->data;
        if(isset ($data)&&!empty($data))
        {
            $username = $userinfo['username'];
            $password = $data['oldpassword'];
           $query = "select username from users where username='$username' and password='$password'";
           $result = $this->Panel->query($query);
           
           if(!empty ($result))
           {
            if($data['newpassword']==$data['repassword']&&!empty($data['newpassword']))
                {
                $newpass = $data['newpassword'];
                $query = "update users set password='$newpass' where username='$username' and password ='$password'";
                $result = $this->Panel->query($query);
             
                    $this->Session->setFlash('Password updated successfully', 'default', array('class' => 'success_message'));
                        }
            else
            {
                 $this->Session->setFlash('Password did not match', 'default', array('class' => 'error_message'));

            }
           }
           else
           {
            $this->Session->setFlash('wrong password', 'default', array('class' => 'error_message'));

           }
        }
        
        $this->set('userinfo',$userinfo);
    }
    
   
    public function fillup()
    {
       
        exit;
    }


    
    
    
   
    
    
   
    public function kbhdblock()
    {
        $this->Session->write("hostel", "kbh");
    }
}

?>

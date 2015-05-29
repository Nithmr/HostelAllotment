<?php



App::uses('Sanitize', 'Utility');
class UserformController extends AppController
{
   var $name =  'Panel';
     function beforeFilter() {
        parent::beforeFilter();
      
        if(!$this->isLogin) 
        {
            $this->redirect(BASE_URL . '/user/login');  
        }
        else if($this->admin)
        {
            $this->redirect(BASE_URL . '/user/logout');
        }
        else
        {
            
             $name = $this->Session->read('user');
          $name = $name['username'];
              if($this->formfill==0)
           {
               $this->redirect(BASE_URL . '/user/login');
           }
            
         
         $result = $this->Panel->reloadlist($name);
         
         $this->set('result',$result);
        }
    }
    
     public function ajaximage()
        {
            $path = "faltoo/";
            $name = $this->Session->read('user');
          $rollno = $name['username'];
            
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","JPG");
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
						echo "Image file size max 300KB";					
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
    
 
    
     public function filluserinfo()
       {
                $flag=true; 
                $getdata = $this->data;
                $data=$this->Panel->pickinfoforuser("year");
                $this->set('yearlist',$data);
                $name = $this->Session->read('user');
                    $name = $name['username'];
                
                $data=$this->Panel->pickinfoforuser("course");
                $this->set('courselist',$data);
                $data=$this->Panel->pickinfoforuser("department");
                $this->set('departmentlist',$data);
             
                $data=$this->Panel->pickinfoforuser("category");
                $this->set('categorylist',$data);
                $query="select * from imageupload where rollno='$name'";
                $temp=$this->Panel->query($query);
                if(isset($temp[0]['imageupload']['imageadd']))
                    $this->set('imageaddress',$temp[0]['imageupload']['imageadd']);
                else 
                  $this->set('imageaddress',"thumbnail.jpg");
                $query="select * from users where rollno='$name'";
                $resultid=$this->Panel->query($query);
                if(isset($resultid[0]['users']['rollno']))
                {
                    
                    
                    $this->set('user_name',$resultid[0]['users']['name']);
                    
                    $this->set('user_course',$resultid[0]['users']['course']);
                    
                    $this->set('user_year',$resultid[0]['users']['year']);
                    
                    $this->set('user_gender',$resultid[0]['users']['gender']);
                    
                    $this->set('user_category',$resultid[0]['users']['category']);
                    
                    $this->set('user_fathername',$resultid[0]['users']['fathername']);
                    
                    $this->set('user_dob',$resultid[0]['users']['dob']);
                    
                    $this->set('user_department',$resultid[0]['users']['department']);
                    
                    $this->set('user_cgpi',$resultid[0]['users']['cgpi']);
                    
                    $this->set('user_bloodgroup',$resultid[0]['users']['bloodgroup']);
                  
                    $this->set('user_email',$resultid[0]['users']['email']);
                  
                    $this->set('user_mobileno',$resultid[0]['users']['mobileno']);
                  
                    $this->set('user_permanentadd',$resultid[0]['users']['permanentadd']);
                  
                    $this->set('user_pincode',$resultid[0]['users']['pincode']);
                    
                     $this->set('user_mothername',$resultid[0]['users']['mothername']);
                     
                      $this->set('user_fatheroccupation',$resultid[0]['users']['fatheroccupation']);
                      
                       $this->set('user_motheroccupation',$resultid[0]['users']['motheroccupation']);
                       
                        $this->set('user_fathermobileno',$resultid[0]['users']['fathermobileno']);
                        
                         $this->set('user_ph',$resultid[0]['users']['ph']);
                }
                else
                {
                    $this->set('user_name',"");
                    $this->set('user_pincode',"");
                    $this->set('user_permanentadd',"");
                    $this->set('user_mobileno',"");
                    $this->set('user_email',"");
                    $this->set('user_bloodgroup',"");
                    $this->set('user_cgpi',"");
                       $this->set('user_department',"");
                    $this->set('user_dob',"");
                    $this->set('user_fathername',"");
                    $this->set('user_category',"");
                    $this->set('user_course',"");
                    $this->set('user_year',"");
                    $this->set('user_gender',"");
                    
                      $this->set('user_mothername',"");
                     
                      $this->set('user_fatheroccupation',"");
                      
                       $this->set('user_motheroccupation',"");
                       
                        $this->set('user_fathermobileno',"");
                        
                         $this->set('user_ph',"0");
                }
                
                if(isset($getdata['name']))
                {
                    $query="select rollno from imageupload where rollno='$name'";
                   $nav=$this->Panel->query($query);
                   if(!isset($nav[0]['imageupload']['rollno']))
                   { 
                       $flag=false;
                        $this->Session->setFlash('Please upload the image', 'default', array('class' => 'error_message'));
                   }
                    if(!preg_match("{^[A-Za-z ]+$}",$getdata['name']))
                    {
                        $flag=false;
                        echo "name field should not be empty and contains only alphabate charecters (A-Za-z)";
                    }
                    else if(!filter_var($getdata['email'],FILTER_VALIDATE_EMAIL))
                    {
                        $flag=false;
                        echo "enter email is invalid";
                    }
                    else if(!preg_match("{^[A-Za-z ]+$}",$getdata['fathername']))
                    {
                        $flag=false;
                        echo "name field should not be empty and contains only alphabate charecters (A-Za-z)";
                    }
                     else if(!preg_match("{^[A-Za-z ]+$}",$getdata['mothername']))
                    {
                        $flag=false;
                        echo "name field should not be empty and contains only alphabate charecters (A-Za-z)";
                    }
                    else if(empty ($getdata['address']))
                    {
                        $flag=false;
                        echo "Permanent Address field should not be empty";
                    }
                    else if((strlen ($getdata['mobileno'])!=10 || !ctype_digit($getdata['mobileno'])))
                    {
                        $flag=false;
                        echo "enter mobile no is wrong";
                    }
                        else if((strlen ($getdata['fathermobileno'])!=10 || !ctype_digit($getdata['fathermobileno'])))
                    {
                        $flag=false;
                        echo "enter mobile no is wrong";
                    }
                    
                    else if((strlen ($getdata['pincode'])!=6 || !ctype_digit($getdata['pincode'])))
                    {
                        $flag=false;
                        echo "enter pincode is wrong";
                    }
                    else if(empty($getdata['gender']) || ($getdata['gender']!="male" && $getdata['gender']!="female"))
                    {
                        if(empty($getdata['gender']))
                        {
                            $flag=false;
                            echo "gender field is empty"; 
                        }
                        else if($getdata['gender']=="male" || $getdata['gender']=="female")
                        {
                            $flag=false;
                            echo "gender field contains only 'male' or 'female'";    
                        }
                    }
                        else if(!$temp=$this->Panel->fillinfoforuser($getdata['course'],"course") || empty($getdata['course']))
                    {
                           $flag=false;
                           if(empty($getdata['course']))
                            echo "your course field is not selected";
                           else if(!$temp)
                                   echo "please select the right course";
                               
                    }
                    else if(!$temp=$this->Panel->fillinfoforuser($getdata['course']."#".$getdata['department'],"department") || empty($getdata['department']))
                    {
                           $flag=false;
                           if(empty($getdata['department']))
                            echo "your department field is not selected";
                           else if(!$temp)
                                   echo "please select the right department";
                               
                    }
                    else if(!$temp=$this->Panel->fillinfoforuser($getdata['course']."#".$getdata['year'],"year") || empty($getdata['year']))
                    {
                           $flag=false;
                           if(empty($getdata['year']))
                            echo "your year field is not selected";
                           else if(!$temp)
                                   echo "please select the right year";
                               
                    }
                
                     else if(!$temp=$this->Panel->fillinfoforuser($getdata['category'],"category") || empty($getdata['category']))
                    {
                           $flag=false;
                           if(empty($getdata['category']))
                            echo "your category field is not selected";
                           else if(!$temp)
                                   echo "please select the right category";
                               
                    }
                    
                        
                    
                        else if (true)
                    {
                            if(empty($getdata['dob']))
                            {
                                $flag=false;
                                echo "your DOB field is empty";
                            }
                            else
                            {
                         list($yy,$mm,$dd)=explode("-",$getdata['dob']); 
                         if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd)) 
                         { 
                                      if(!checkdate($mm,$dd,$yy))
                                      {
                                          $flag=false;
                                          echo "enter date is wrong";
                                      }
                           }
                            }
                    }
             
                     else if(!preg_match("{^[0-9]\.[0-9][0-9]|10.00$}",$getdata['cgpi']))
                    {
                        $flag=false;
                        echo "please enter ur cgpi like 8.00 or 7.95";
                    }
                    
                    
                    
                    
                if($flag)
                {
 
                    $name = $this->Session->read('user');
                    $name = $name['username'];
                    if(!isset($resultid[0]['users']['rollno']))
                    { 
                    $query="INSERT INTO `users`(`rollno`,`name`,`course`, `year`, `gender`, `category`, `fathername`, `dob`, `department`, `cgpi`, `bloodgroup`, `email`, `mobileno`, `permanentadd`, `pincode`) 
                                           VALUES ('$name','$getdata[name]','$getdata[course]','$getdata[year]','$getdata[gender]','$getdata[category]','$getdata[fathername]','$getdata[dob]','$getdata[department]','$getdata[cgpi]','$getdata[bloodgroup]','$getdata[email]','$getdata[mobileno]','$getdata[address]','$getdata[pincode]')";
                    
                    
                    }
                    else
                    {
                        if(!isset($getdata['ph']))
                            $getdata['ph']=0;
                        $query="UPDATE `users` SET `rollno`='$name',`name`='$getdata[name]',`course`='$getdata[course]',`year`='$getdata[year]',`gender`='$getdata[gender]',`category`='$getdata[category]',`fathername`='$getdata[fathername]',`dob`='$getdata[dob]',`department`='$getdata[department]',`cgpi`='$getdata[cgpi]',`bloodgroup`='$getdata[bloodgroup]',`email`='$getdata[email]',`mobileno`='$getdata[mobileno]',`permanentadd`='$getdata[address]',`pincode`='$getdata[pincode]',`mothername`='$getdata[mothername]',`fathermobileno`='$getdata[fathermobileno]',`fatheroccupation`='$getdata[fatheroccupation]',`motheroccupation`='$getdata[motheroccupation]',`ph`='$getdata[ph]' WHERE rollno='$name'";
                    
                        
                    }
                    
                    
                    $this->Panel->query($query);
                    echo "<script> alert('successfully submitted'); window.location = '$this->baseurl/panel/viewinfo'; </script>";
                }
                
                }
            
       }

    
    
}

?>

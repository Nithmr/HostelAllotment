<?php

App::uses('Sanitize', 'Utility');
class MmcaController extends AppController
{
   var $name =  'Mmca';
   var $uses = array( 'Panel');
     function beforeFilter() {
        parent::beforeFilter();
      
        if($this->isLogin && $this->admin==2)
        {
        }
        else
        {
          $this->redirect(BASE_URL . '/user/login');
        }
    }
    function index()
    {
        
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
    
 
    
     public function filluserinfo()
       {
                $flag=true; 
                $getdata = $this->data;
                $parameter=  $this->request->query;
                $name = $this->request->query['rollno'];
                    $this->set('roll__no',$name);
                 if(isset($parameter['vtype']))
                 {
                        $vtype=$parameter['vtype'];
                        $page=$parameter['pageno'];
                        $this->set('vtype',$parameter['vtype']);
                        $this->set('pageno',$parameter['pageno']);
                        $urle="$this->baseurl/mmca/viewinformation?vtype=$vtype&pageno=$page&rollno=$name";
                 }
                 else if(isset($parameter['textfield']))
                 {
                        $page=$parameter['pageno'];
                        $text=$parameter['textfield'];
                        $search=$parameter['searchfield'];
                        $this->set('pageno',$parameter['pageno']);
                        $this->set('text',$parameter['textfield']);
                        $this->set('search',$parameter['searchfield']);
                        $urle="$this->baseurl/mmca/viewinformation?pageno=$page&search=search&textfield=$text&searchfield=$search&rollno=$name";
                 }
                
                $data=$this->Panel->pickinfoforuser("year");
                $this->set('yearlist',$data);
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
                         $this->set('user_comment',$resultid[0]['users']['comment']);
                    
                }
                else
                {
                    $this->set('user_comment',"");
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
                    
                   if(!preg_match("{^[A-Za-z ]*$}",$getdata['name']))
                    {
                        $flag=false;
                        echo "name field should not be empty and contains only alphabate charecters (A-Za-z)";
                    }
                    else if(!filter_var($getdata['email'],FILTER_VALIDATE_EMAIL))
                    {
                        $flag=false;
                        if(empty($getdata['email']))
                            $flag=true;
                        else
                        echo "enter email is invalid";
                    }
                    else if(!preg_match("{^[A-Za-z ]*$}",$getdata['fathername']))
                    {
                        $flag=false;
                        echo "name field should not be empty and contains only alphabate charecters (A-Za-z)";
                    }
                  
                    else if((strlen ($getdata['mobileno'])!=10 || !ctype_digit($getdata['mobileno'])))
                    {
                        $flag=false;
                          if(empty($getdata['email']))
                            $flag=true;
                        else
                        echo "enter mobile no is wrong";
                    }
                    else if((strlen ($getdata['pincode'])!=6 || !ctype_digit($getdata['pincode'])))
                    {
                        $flag=false;
                          if(empty($getdata['email']))
                            $flag=true;
                        else
                        echo "enter pincode is wrong";
                    }
               
                      
                     else if(!preg_match("{^[0-9]\.[0-9][0-9]|10.00|^$$}",$getdata['cgpi']))
                    {
                        $flag=false;
                        echo "please enter ur cgpi like 8.00 or 7.95";
                    }
                    
                    
                    
                if($flag)
                {
 
                   
                    $name = $parameter['rollno'];
             
                    {
                        if(!isset($getdata['ph']))
                            $getdata['ph']=0;
                        $query="UPDATE `users` SET `rollno`='$name',`comment`='$getdata[comment]',`name`='$getdata[name]',`course`='$getdata[course]',`year`='$getdata[year]',`gender`='$getdata[gender]',`category`='$getdata[category]',`fathername`='$getdata[fathername]',`dob`='$getdata[dob]',`department`='$getdata[department]',`cgpi`='$getdata[cgpi]',`bloodgroup`='$getdata[bloodgroup]',`email`='$getdata[email]',`mobileno`='$getdata[mobileno]',`permanentadd`='$getdata[address]',`pincode`='$getdata[pincode]',`mothername`='$getdata[mothername]',`fathermobileno`='$getdata[fathermobileno]',`fatheroccupation`='$getdata[fatheroccupation]',`motheroccupation`='$getdata[motheroccupation]',`ph`='$getdata[ph]' WHERE rollno='$name'";
                    
                        
                    }
                    
                    
                    $this->Panel->query($query);
                    echo "<script> alert('successfully submitted'); window.location = '$urle'; </script>";
                }
                
                }
            
       }

    
      
    function validation()
    {
        $getdata = $this->request;
        $validate = $getdata->query['validate'];
        $rollno = $getdata->query['rollno']; 
        $a=$getdata->query['pageno'];
        if(isset($getdata->query['textfield']))
        {
        $b=$getdata->query['textfield'];
        $c=$getdata->query['searchfield'];
        $url=BASE_URL."/mmca/search?pageno=$a&search=search&textfield=$b&searchfield=$c";
        }
        else if(isset($getdata->query['vtype']))
        {
            $d=$getdata->query['vtype'];
            $url=BASE_URL."/mmca/validationpage?pageno=$a&vtype=$d";
        }
        $this->Panel->validationofuser($rollno,$validate);
        $this->redirect($url);
    }
    function validationpage()
    {
         $capacity=30;
         $getdata = $this->request;
         if(isset($getdata->query['pageno']))
                 $page=$getdata->query['pageno'];
             else {
               $page=1;  
             }       
         if(isset($getdata->query['vtype']))
         {
             $this->set('vtype',$getdata->query['vtype']);
             $value=$getdata->query['vtype'];
         }
         else
         {
             $value=3;
         $this->set('vtype',3);
         }
         $name = $this->Session->read('user');
         $name = $name['username'];
         $result=$this->Panel->mmcavalidationpage($value,$capacity,$name);
         if($result['totalpage']==0)
             $result[0]=0;
         $this->set('valuserlist',$result[$page-1]);
         $this->set('noofpages',$result['totalpage']);
         $this->set('currentpage',$page);
    }

    
       
        function viewinformation()
    {
        
        $getdata = $this->request;
        if(isset($getdata->query['search']))
        {
           $text=$getdata->query['textfield'];
           $search=$getdata->query['searchfield'];
           $page=$getdata->query['pageno'];
        }
        else if(isset($getdata->query['vtype']))
        {
            $page=$getdata->query['pageno'];
            $vtype=$getdata->query['vtype'];
        }    
        else
        {
           $text="";
           $search="";
           $page=1;            
        }
        if(!isset($getdata->query['rollno']))
        {
             $this->set('setinfo','false');
        }
        else
        {
            $username = $getdata->query['rollno'];
        
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
                $userdata=$result1[0]['users'];
                if(empty($result1[0]['users']['name']))
                $userdata['name']="`";
                if(empty($result1[0]['users']['mothername']))
                $userdata['mothername']="`";
                if(empty($result1[0]['users']['pincode']))
                    $userdata['pincode']="` ";
                if(empty($result1[0]['users']['permanentadd']) || $result1[0]['users']['permanentadd']==" ")
                    $userdata['permanentadd']="` ";
                if(empty($result1[0]['users']['mobileno']))
                    $userdata['mobileno']="` ";
                if(empty($result1[0]['users']['email']))
                    $userdata['email']="`";
                if(empty($result1[0]['users']['bloodgroup']))
                    $userdata['bloodgroup']="` ";
                if(empty($result1[0]['users']['department']))
                    $userdata['department']="` ";
                if(($result1[0]['users']['dob']) == "0000-00-00")
                    $userdata['dob']=" `";
                if(empty($result1[0]['users']['fathername']))
                    $userdata['fathername']="` ";
                if(empty($result1[0]['users']['category']))
                    $userdata['category']=" `";
                if(empty($result1[0]['users']['course']))
                    $userdata['course']=" `";
                if(($result1[0]['users']['year'])== 0)
                    $userdata['year']=" `";
                if(empty($result1[0]['users']['gender']))
                    $userdata['gender']="` ";
                if(empty($result1[0]['users']['fathermobileno']))
                $userdata['fathermobileno']="`";
                if(empty($result1[0]['users']['motheroccupation']))
                $userdata['motheroccupation']="`";
                if(empty($result1[0]['users']['fatheroccupation']))
                $userdata['fatheroccupation']="`";
                 if(empty($result1[0]['users']['comment']))
                $userdata['comment']="`";
                    $userdata['rollno']=$result1[0]['users']['rollno'];
                     $this->set('userdata',$userdata);
               
    }
    $this->set('page',$page);
    if(isset($getdata->query['vtype']))
    $this->set('vtype',$vtype);
    else
        {
        $this->set('text',$text);
    $this->set('search',$search);
    }
        
    }
    
    
    function exchangerooms()
    {
         $name = $this->Session->read('user');
         $name = $name['username'];
         $getdata = $this->request;
          if(isset($getdata['data']['set']))
          {
              if($getdata['data']['set']=='add>>')
              {
                  $this->Panel->addintooldtable($getdata['data']['rollno'],$getdata['data']['roomno'],'olduserdataofrooms');
              }
              else if($getdata['data']['set']=='remove')
              {
                  $this->Panel->removedatafromoldtable($getdata['data']['rollno'],'olduserdataofrooms');
              }
          }
         $result=  $this->Panel->mmcaroomcapacity($name);
         $this->set('roomsentry',$result);
         $result=  $this->Panel->mmcaroom($name);
         $this->set('mmcaroomslist',$result);
        
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
    
   function search()
    {
        $getdata = $this->request;
          if(!isset($getdata->query['pageno']))
                $pageno=1;
        else
        {
            $pageno=$getdata->query['pageno'];
        }
        if(isset ($getdata->query['textfield']))
        {    
            //$getdata->query['textfield']="";
            $capacity=30;
            $name = $this->Session->read('user');
            $name = $name['username'];
            $result =  $this->Panel->searchdata($getdata->query['textfield'],$capacity,$getdata->query['searchfield'],$name);
            $this->set('textfieldval',$getdata->query['textfield']);
              $this->set('searchfieldval',$getdata->query['searchfield']);
             if($result['totalpage']!=0)
             {
                  $this->set('valuserlist',$result[$pageno-1]);
                   $this->set('noofpages',$result['totalpage']);
                   $this->set('currentpage',$pageno);
              }
               else {
                     $this->set('valuserlist',"");
                      $this->set('noofpages',0);
                      $this->set('currentpage',1);
                      }
                      
         }
         else
         {
                      $this->set('valuserlist',"");
                      $this->set('noofpages',0);
                      $this->set('textfieldval',"");
                      $this->set('searchfieldval',"");
                      $this->set('currentpage',1);
         }
    }

    
    function capacity()
    {
         $name = $this->Session->read('user');
         $name = $name['username'];
          $getdata = $this->request;
          if(isset($getdata['data']['set']))
          {
              if($getdata['data']['set']=='fill_capacity')
              {
                  $result=array_keys($getdata['data']);
                   for($i=1;$i<count($result)-1;$i++)
                   {
                       $this->Panel->insertintommca($result[$i],$getdata['data']['capacity']);
                   }
              }
             else if($getdata['data']['set']=='edit_capacity')
              {
                  $this->Panel->editmmcaroom($name);
              }
          }
          
         $result=  $this->Panel->mmcaroomlist($name);
         $this->set('mmcaroomlist',$result);
         
    }
   
    function exportdata()
    {
        //$this->Panel->randomalgo('B-TECH','1','male','2');
        //$this->Panel->normalize();
       // exit();
  
         $result =  $this->Panel->pickinfoforuser('course');
                 $this->set('courselist',$result);
                  $result =  $this->Panel->pickinfoforuser('year');
                          $this->set('yearlist',$result);
                  $result =  $this->Panel->pickinfoforuser('department');
                          $this->set('departmentlist',$result);
                          
                          $name = $this->Session->read('user');
                          $name = $name['department'];
                  //$query="select department from users where username='$name'";
                          $this->set('hostel',$name);
                          $getdata = $this->request;
                          if(isset($getdata['data']['export']))
                          {
                              $data=$getdata['data'];
                              
                              $data = $this->Panel->exportdata($data);
                              	$filename = "export_".date("Y.m.d").".csv";
$csv_file = fopen('php://output', 'w');
 
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="'.$filename.'"');
	
        $header_row=array_keys($data[0][0]);
        
fputcsv($csv_file,$header_row,',','"');
                        	foreach($data as $result)
{
// Array indexes correspond to the field names in your db table(s)
$row = array_values($result[0]);
 
fputcsv($csv_file,$row,',','"');
}
 
fclose($csv_file);     
                          
                            
                            
                            
                              exit;
                          }
    }
}
?>
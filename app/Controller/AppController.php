<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */



App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
   
      var $name = 'User';
      var $uses = array( 'Panel');
     public function beforeFilter() {
        parent::beforeFilter();
      
       ini_set('max_execution_time', 300);
        $this->set('webdirurl', 'http://'.$_SERVER['SERVER_NAME'].$this->webroot);
        $this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].$this->base);
        $this->baseurl = 'http://'.$_SERVER['SERVER_NAME'].$this->base;
        $user = $this->Session->read('user');
        $groupentry = $this->Session->read('groupentry');
        if(isset ($user)&&!empty ($user))
        {
           
            $result=$this->Panel->adminaccess($user['username']);
            $this->isLogin = 1;
            $linksinfo = $this->Panel->configinfo($user['username']);
            $this->fillchoiceactive = $linksinfo[0]['config']['fillchoice'];
            $this->groupingactive = $linksinfo[0]['config']['grouping'];
            $this->groupsize = $linksinfo[0]['config']['groupsize'];
             $this->set('isLogin', 1);
             $this->admin=$result['admin'];
             $this->formfill = $result['formfill'];
             $this->set('admin',$result['admin']);
             $this->set('formfill',$result['formfill']);
             $this->userinformation = $linksinfo;
             if(!empty($groupentry))
             {$this->set('fillchoiceactive',  $this->fillchoiceactive);
             $this->set('groupingactive',  $this->groupingactive);}
             else
             {
               $this->set('fillchoiceactive',0);
             $this->set('groupingactive',0);   
             }
             $this->set('maxgroupsize',  $this->groupsize);
             
          
             
             
        }
        else {
             
             $this->isLogin = 0;
             $this->admin = 0;
             $this->set('isLogin', 0);
             $this->set('admin', 0);
        }
        
        
        
        
        
       $query = "select * from config order by time ";
       $finalalgo = $this->Panel->query($query);
       $query = "select  course,year,gender,max(endtime)as endtime,randstatus from config group by course,year,gender having max(endtime)";
       $randomalgo = $this->Panel->query($query);
       date_default_timezone_set("Asia/Kolkata");
       $mintime = strtotime($finalalgo[0]['config']['time']);
        
        $now = time();
       
    
       
       if($now>$mintime&&!$finalalgo[0]['config']['ncgpistatus'])
       {
           
           $this->Panel->normalize();
              $query = "update config set ncgpistatus = '1'";
              $this->Panel->query($query);
                 echo $query."<br />";
       }
       
       
       
       foreach($finalalgo as $results)
       {
           
            $now = time();
            $algoendtime = strtotime($results['config']['endtime']);
            
            
            
            
            if(!$results['config']['status']&&$results['config']['fillchoice']&&$now>$algoendtime)
          {
               
              $course = $results['config']['course'];
              $year = $results ['config']['year'];
              $gender = $results['config']['gender'];
              $capacity = $results['config']['groupsize'];
            $newtable = $this->Panel->allotmentalgo($course,$year,$gender,$capacity);
            
            $query = "Insert into `newuserdataofrooms`(`rollno`, `room_no`) VALUES";
            
            foreach($newtable as $values)
            {
                $rollno = $values[0];
                $room_no = $values[1];
                $query  .= "('$rollno','$room_no'),";
            }
         
         $query1 = substr($query, 0, strlen($query)-1);
         $query1 .= ";";
         if(empty ($newtable))
             {$query1="";}
         $query2 = "delete from `group` where rollno in (select rollno from newuserdataofrooms)";
         $query2 .= ";";
         $query3 = "update config set status=1 where year='$year' and gender ='$gender' and  groupsize='$capacity' and course = '$course' ";
         $query3 .= ";";
         $query4="delete from prefrence where groupid in (select groupid from `group` natural join users where year='$year' and course='$course' and gender='$gender');";
         $query = "START TRANSACTION;\n".$query1.$query2.$query3.$query4."COMMIT;";
         
        $this->Panel->query($query); 
          echo $query."<br />";
          
       
         
          }
       
              
       }
        
       
       
       
       foreach($randomalgo as $results)
       {
           $now = time();
           $maxtime = strtotime($results[0]['endtime']);
                  
            if(!$results['config']['randstatus']&&$now>$maxtime)
          {
               
              $course = $results['config']['course'];
              $year = $results ['config']['year'];
              $gender = $results['config']['gender'];
              
            $newtable = $this->Panel->randomalgo($course,$year,$gender);
          
          //  pr($newtable);
            
              
            $query = "Insert into `newuserdataofrooms`(`rollno`, `room_no`) VALUES";
            
            foreach($newtable as $values)
            {
                $rollno = $values[0];
                $room_no = $values[1];
                $query  .= "('$rollno','$room_no'),";
            }
         
         $query1 = substr($query, 0, strlen($query)-1);
         $query1 .= ";";
         if(empty ($newtable))
         {$query1="";}    
         $query2 = "delete from `group` where rollno in (select rollno from newuserdataofrooms)";
         $query2 .= ";";
         $query3 = "update config set randstatus=1 where year='$year' and gender ='$gender'  and course = '$course' "; 
         $query3 .= ";";
         $query4="delete from prefrence where groupid in (select groupid from `group` natural join users where year='$year' and course='$course' and gender='$gender');";
         $query = "START TRANSACTION;\n".$query1.$query2.$query3.$query4."COMMIT;";
         
         echo $query."<br />";
       $this->Panel->query($query); 
              
          
            
          }
           
       }
       
       
        
     }
}

<?php  echo $this->Html->script('pagination.js');
  echo $this->Html->css('pagination.css');

?>


<div id="viewinfocontent">
<form method="get" action="<?php echo $base_url ?>/admin/validationpage" >
    <select name="vtype" onchange="this.form.submit()">
        <option value="3" <?php if($vtype==3) echo "selected"; ?> >all-student</option>
        <option value="1" <?php if($vtype==1) echo "selected"; ?> >validated student</option>
        <option value="2" <?php if($vtype==2) echo "selected"; ?> >unvalidated student</option>
        <option value="0" <?php if($vtype==0) echo "selected"; ?> >yet to validate</option>
    </select>
</form>
    
    <style>
    #pageno
    {
        text-align: center;
        margin-left: 20%;
    }
   
    #contenttable
    {
        margin-top: 20px;
        margin-left: 20%;
    }
    #contenttable table
    {
        border-collapse: collapse;
    }
    .validation1
    {
        background-color: gray;
        color: white;
    }
     .validation2
    {
        background-color: red;
        color: white;
    }
    .validation1 td a
    {
        color: white;
    }
    
</style>
<div id="validationdiv">
    <div id="validationdiv">
    <?php if($noofpages!=0){ ?>    
    <div id="pageno">
   
        <script type="text/javascript"> 
        $(function() {
    $('#pageno').pagination({
      pages :<?php echo $noofpages ?>,
        cssStyle: 'light-theme',
        displayedPages:10,
        edges:1,
        currentPage: <?php echo $currentpage ?>,
        
        hrefTextPrefix:"<?php echo "$base_url/admin/validationpage?vtype=$vtype&pageno=" ?>"
    });
});    

        </script>
        
    
   
    </div>
        <?php } ?>

      
            
    <div id="contenttable">
        <table border ="1" width="600px">
            <thead>
                <tr>
                    <th>
                        rollno
                    </th>
                    <th>
                        name
                    </th>
                     <th>
                        viewinfo
                    </th>
                     <th>
                        status
                    </th>
                    <th>
                        hostel
                    </th>
                </tr>
            </thead>
            <?php 
            if(!empty($valuserlist))
            {
                foreach($valuserlist as $data)
                {
               // pr($valuserlist);
                $rollno = $data['users']['rollno'];
                $validation = $data['users']['validation'];
                $name = $data['users']['name'];
                $hostel=$data['rooms']['hostel'];
                echo "<tr  class='validation$validation'><td  >$rollno</td>";
                if(empty ($name))
                    $name='empty';
               
                echo  "<td>$name</td>"; 
                echo "<td><a href='$base_url/admin/viewinformation?pageno=$currentpage&vtype=$vtype&rollno=$rollno'>view more </a></td>";
               
                echo "<td>";
                
               
                
                if($validation==1)
                {
                    echo "validated";
                }
                elseif ($validation==2) 
                {
                    echo "not validate";    
                }
                else
                    echo "yet to vaidate";
                echo '</td>';
                  echo "<td>$hostel</td>";
                echo"</tr>";
              
                }
            }
            
            ?>
            
        </table>
    </div>
</div>
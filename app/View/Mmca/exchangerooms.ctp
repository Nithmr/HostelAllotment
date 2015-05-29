<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

        <div id="exchangeroomsmaindiv" style="width: 100%;">
            <div id="leftexchangeroomsdiv" style="width: 40%; float:left; padding-top: 200px" >
                <form method="post" action="" >
                <label>Roll No</label>
                <input type="text" name="rollno"/>
                <p />
                <label>Room No</label>
                   <select name="roomno" >  
            <?php 
               foreach ($mmcaroomslist as $data) {
            $year = $data['r']['room_no'];
            echo "<option value=$year><div>  &nbsp&nbsp   $year </div></option>";
            } ?>
                </select>
                <p />
                <input type="submit" value="add>>" name="set">
                </form>
            </div>
            <div id="rightexchangeroomsdiv" style="width: 60%; float: left" >
                <form action ="" method="post" >
                <table border="1" width="500px">
                    <?php
                     $capacity=0;$i=0;
                     foreach ($roomsentry as $data)
                     {
                        
                         if($i==$capacity)
                         {
                              echo "<tr>";
                             $capacity=$data['temp1']['capacity'];
                             $roomno = $data['temp1']['room_no'];
                             if($capacity==null)
                                 $capacity=1;
                             echo "<td rowspan='$capacity'>$roomno</td>";
                             $i=1;
                             $roll = $data['temp2']['rollno'];
                             if($roll==null)
                             echo "<td>empty</td>";
                             else
                            echo "<td> $roll <input type='radio' value='$roll' name='rollno' > </td>";
                             echo "</tr>";
                             continue;
                         }
                        
                         
                         $roll = $data['temp2']['rollno'];
                         echo "<tr><td> $roll <input type='radio' value='$roll' name='rollno' ></td></tr>";
                         $i++;
                         
                       
                         
                     }
                    
                    ?>
                </table>
                    <input type="submit" value="remove" name="set" style="  height: 40px;
    left: 80%;
    position: fixed;
    top: 90%;
    width: 130px;" />
                </form>
            </div>
            
        </div>
        
  
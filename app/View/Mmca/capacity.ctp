<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="mmcaroomcapacity">
    <form method="post" action="">
        <label>capacity</label><br />
    <select name="capacity" >
        <option value="0" >room-lock</option>
        <option value="1" >1</option>
        <option value="2" >2</option>
        <option value="3" >3</option>
        <option value="4" >4</option>
        <option value="5" >5</option>
        <option value="6" >6</option>
        
    </select>
    <table style="width: 50% ; text-align: center;">
        <tr><th></th><th>room-no</th><th>capacity</th></tr>
        <?php 
            foreach($mmcaroomlist as $data)
            {
              
                echo '<tr>';
                $room = $data['temp2']['room_no'];
                $capa=$data['temp1']['capacity'];
                if($capa==null)
                echo "<td><input type='checkbox' name='$room' value='$room' /></td>";
                else
                echo "<td></td>";    
                echo "<td>$room</td>";
                if($capa==null)
                echo "<td>empty</td>";
                else
                echo "<td>$capa</td>";   
                echo '</tr>';
            }
        
        ?>
    </table>
        <input type="submit" name="set" value="fill_capacity" />
        <input type="submit" name="set" value="edit_capacity" />
    </form>
</div>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id ="image">
    
<?php echo $this->HTML->image('floors.png',array('usemap'=>'#Map','class'=>'map')); ?>
 <map name='Map' id='Map'>
  <area shape='rect' coords='335,212,894,311' href='rooms.html' alt='3rdfloor' />
  <area shape='rect' coords='336,333,894,413' href='#' alt='2ndfloor' />
  <area shape='rect' coords='341,440,891,519' href='#' alt='1st floor' />
</map>
</div>
<script type="text/javascript">
        $(function () {
            $('.map').maphilight();
        });
    </script>
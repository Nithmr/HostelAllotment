<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id ="image">
    
<?php echo $this->HTML->image('blocks.png',array('usemap'=>'#Map','class'=>'map')); ?>
    <map name="Map" id="Map">
  <area id="d_block" shape="rect" coords="370,41,788,145" href="<?php echo BASE_URL ?>/panel/kbhdblock" alt="d-block" />
  <area id="c_block" shape="rect" coords="205,71,338,489" href="#" alt="c-block" />
  <area id="a_block" shape="rect" coords="349,487,862,605" href="#" alt="a-block" />
  <area id="b_block" shape="rect" coords="810,66,933,465" href="#" alt="b-block" />
</map>
  
</div>

			
	<script type="text/javascript">
        $(function () {
            $('.map').maphilight();
			
        });
    </script>
<?php
/**
* $loop
* $class_column
*
*/

$_count =1;

$colums = '3';
$bscol = floor( 12/$colums );
$end = $loop->post_count;

$sub = 2;
$thumbsize = 'postthumb-grid';

?>
<div class="front-page front-page-featured">
	<div class="row">
	<?php

		$i = 0;
		$main = $num_mainpost;
		$j = 0;
		while($loop->have_posts()){
			$loop->the_post();
	 ?>
	 		<?php if( $i<=$main-1) { ?>
	 			<?php if( $i == 0 ) {  ?>
	 				<div  class="col-sm-6 main-posts">
	 			<?php } ?>
			 	<?php

			 	 wpo_get_template( 'post/_single-hover.php' , array('thumbsize'=>$thumbsize) )  ?>

				<?php if( $i == $main-1 || $i == $end -1 ) { ?>
					</div>
				<?php } ?>
			<?php } else { ?>
					<?php  if( $i == $main  ) { ?>
					<div class="col-sm-6 secondary-posts">
					<?php }  ?>

							<?php if( ++$j%$sub == 1 ) { ?>
							<div class="row">
							<?php } ?>
								<div class="col-md-6">
									<?php wpo_get_template( 'post/_single-hover.php', array('thumbsize'=>$thumbsize)  ) ?>
								</div>
						 	<?php if( $j%$sub == 0 || $i==$end-1 ) {   ?>
						 	</div>
						 	<?php } ?>
					<?php if( $i == $end-1 ) {   ?>
						</div>
					<?php } ?>
				<?php  } ?>
	<?php  $i++; } ?>
	</div>
</div>
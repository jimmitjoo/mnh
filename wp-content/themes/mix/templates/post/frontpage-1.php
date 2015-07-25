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

?>

<div class="front-page split-layout">
<div class="row">
<?php

	$i = 0;
	$main = $num_mainpost;

	while($loop->have_posts()){
		$loop->the_post();
 ?>
 		<?php if( $i<=$main-1) { ?>
 			<?php if( $i == 0 ) {  ?>
 			<div class="col-sm-6 main-posts no-padding">
 			<?php } ?>
		 	<?php get_template_part( 'templates/post/_single' ) ?>

			<?php if( $i == $main-1 || $i == $end -1 ) { ?>
			</div>
			<?php } ?>
		<?php } else { ?>
			<?php if( $i == $main  ) { ?>
			<div class="col-sm-6 secondary-posts no-padding">
			<?php }  ?>
				<article class="post pull-left">
					<?php
				    if ( has_post_thumbnail() ) {
				        ?>
				            <figure class="entry-thumb">
				                <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
				                    <?php the_post_thumbnail( );?>
				                </a>
				                <!-- vote    -->
                				<?php do_action('wpo_rating') ?>
				            </figure>
				        <?php
				    }
				    ?>

				    <div class="entry-content">
					    <div class="entry-content-inner clearfix">
					    	<div class="entry-meta">
					    		<div class="entry-category"><?php the_category(); ?></div>
					    		<div class="entry-create">
					    			<span class="meta-sep">|</span>
					    			<span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
				                	<span class="meta-sep">|</span>
					    		</div>
				                <ul class="entry-comment list-inline">
					                <li class="comment-count">
					                    <?php comments_popup_link(__(' 0 comment', TEXTDOMAIN), __(' 1 comment', TEXTDOMAIN), __(' % comments', TEXTDOMAIN)); ?>
					                </li>
				            	</ul>
					    	</div>
					    </div>

					    <?php
				        if (get_the_title()) {
				        ?>
				            <h4 class="entry-title">
				                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				            </h4>
				        <?php
				        }
				        ?>

					    <?php
				            if (! has_excerpt()) {
				                echo "";
				            } else {
				                ?>
				                    <p class="entry-description"><?php echo wpo_excerpt(29,'...'); ?></p>
				                <?php
				            }
				        ?>

				    </div>
				</article>
			<?php if( $i == $end-1 ) {   ?>
			</div>
			<?php } ?>
			<?php } ?>
<?php  $i++; } ?>
</div>
</div>
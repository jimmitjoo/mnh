<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-container">
		<header class="header-title clearfix">
			<?php if(wpo_theme_options('post-title')){ ?>
				<h2 class="entry-title pull-left">
					<?php the_title(); ?>
				</h2>
			<?php } ?>

			<div class="pull-right">
			    <?php if(get_previous_post_link()!=''){ ?>
			    <div class="btn btn-link">
			        <?php previous_post_link('%link',' <i class="fa fa-angle-left"></i> Previous'); ?>
			    </div>
			    <?php } ?>
			    <?php if(get_next_post_link()!=''){ ?>
			    <div class="btn btn-link">
			        <?php next_post_link('%link','Next <i class="fa fa-angle-right"></i> '); ?>
			    </div>
			    <?php } ?>
			</div>
		</header><!-- /header -->

		<div class="entry-thumb">
			<?php
				if ( has_post_format( 'video' )) {
				?>
					<div class="video-responsive">
						<?php wpo_embed(); ?>
					</div>
				<?php
				}
				else if ( has_post_format( 'audio' )) {
				?>
					<div class="audio-thumb audio-responsive">
						<?php wpo_embed(); ?>
					</div>
				<?php
				}
				else if ( has_post_format( 'gallery' )) {
					$_imgs = wpo_gallery();
				?>
					<div id="post-slide-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php foreach ($_imgs as $key => $_img) {
								echo '<div class="item '.(($key==0)?'active':'').'">';
									echo '<img src="'.$_img.'" alt="" class="img-responsive">';
								echo '</div>';
							} ?>
						</div>
						<div class="carousel-controls">
							<a class="left carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">
								<span class="fa fa-angle-left"></span>
							</a>
							<a class="right carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="next">
								<span class="fa fa-angle-right"></span>
							</a>
						</div>
					</div>
				<?php
				}
				else if (has_post_thumbnail()) {
				?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('full');?>
				</a>
				<?php }
			?>
		</div>

		<div class="entry-content no-border">
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<h4 class="entry-name">
						<?php _e('project description',TEXTDOMAIN); ?>
					</h4>

					<?php if($post->post_content=="") : ?>
						<?php echo '<div class="entry-description">Empty Post...!</div>' ?>
					<?php else : ?>
						<div class="entry-description">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>

				</div>
				<div class="col-lg-4 col-md-4">
					<h4 class="entry-name">
						<?php _e('Client',TEXTDOMAIN); ?>
					</h4>

					<?php
			            if (! has_excerpt()) {
			                echo "";
			            } else {
			                ?>
			                    <p class="entry-description">
									<?php the_excerpt(); ?>
								</p>
			                <?php
			            }
			        ?>

				</div>
				<div class="col-lg-4 col-md-4">
					<h4 class="entry-name">
						<?php _e('quick info',TEXTDOMAIN); ?>
					</h4>
					<ul class="list-unstyled">
						<li>
							<span class="text-primary"><?php _e('Author:',TEXTDOMAIN); ?></span>
							<?php the_author(); ?>
						</li>
						<li>
							<span class="text-primary"><?php _e('Category:',TEXTDOMAIN); ?></span>
							<?php the_terms( $post->ID, 'Categories' ); ?>
						</li>
						<li>
							<span class="text-primary"><?php _e('Date:',TEXTDOMAIN); ?></span>
							<span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
						</li>
						<li>
							<?php the_tags('<span class="text-primary"> Tag: </span>', ' , '); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>


		<?php //wp_link_pages(); ?>


		<div class="sharebox">
			<div class="row">
				<div class="col-sm-4">
					<h5 class="sharebox-title"><?php echo __( 'Share this Story!',TEXTDOMAIN ); ?></h5>
				</div>
				<div class="col-sm-8">
					<?php wpo_share_box(); ?>
				</div>
			</div>
		</div>

		<!-- About Info -->

		<?php get_template_part('templates/author-bio'); ?>

		<!-- Related Posts -->

		<?php if ( wpo_theme_options( 'show_related') ) : ?>
			<div class="related-posts">
				<?php
					$post_number = wpo_theme_options( 'limit-post', 3);
					//$post_number = 3;
					/*wpo_related_post( $post_number, 'portfolio', 'Categories'); ?>*/
					wpo_related_post( $post_number, 'portfolio', 'Categories', 'related_portfolio.php'); ?>
			</div>
		<?php endif; ?>

		<!-- Comment this post -->
		<?php comments_template(); ?>

	</div><!--  End .post-container -->

</article>
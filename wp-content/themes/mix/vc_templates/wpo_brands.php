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

extract( shortcode_atts( array(
	'title' => '',
	'number'=>-1,
	'icon'=>'',
	'alignment' => '',
	'size' => '',
	'descript' => '',
	'el_class'=>'',
	'link_target' => 'same_window'
), $atts ) );

$_id = wpo_makeid();
$args = array(
	'post_type' => 'brands',
	'posts_per_page'=>$number
);
$loop = new WP_Query($args);

if ( $loop->have_posts() ) : ?>
<?php
	$_count = 1;
	$columns_count=6;
	switch ($columns_count) {
		case '6':
			$class_column='col-sm-2 col-md-2';
			break;
		case '4':
			$class_column='col-sm-6 col-md-3';
			break;
		case '3':
			$class_column='col-sm-4';
			break;
		case '2':
			$class_column='col-sm-6';
			break;
		default:
			$class_column='col-sm-12';
			break;
	}
?>
	<section class="widget widget-brand-logo <?php echo (($el_class!='')?' '.$el_class:''); ?>">
		<?php if(!empty($title)){ ?>
			<h3 class="widget-title visual-title <?php echo $alignment.' '.$size; ?>">
				<?php if($icon!=''){ ?>
					<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
				<?php } ?>
				<span><span><?php echo esc_attr( $title ); ?></span></span>
				<?php if(trim($descript)!=''){ ?>
		            <span class="visual-description">
		                <?php echo $descript; ?>
		            </span>
		        <?php } ?>
			</h3>
		<?php } ?>

		<div class="widget-content">
			<div class="widget-brands-inner slide carousel" id="productcarouse-<?php echo $_id; ?>" data-ride="carousel">
				<div class="carousel-controls">
					<a href="#productcarouse-<?php echo $_id; ?>" data-slide="prev" class="left carousel-control">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#productcarouse-<?php echo $_id; ?>" data-slide="next" class="right carousel-control">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				<div class="carousel-inner">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
					<?php if( $_count%$columns_count == 1 ) echo '<div class="item'.(($_count==1)?" active":"").'"><div class="row">'; ?>
						<?php
							$meta = get_post_meta(get_the_ID(),'wpo_brandconfig',true);
							$link = isset($meta['brand_link']) ? $meta['brand_link'] : '#';
						?>
						<!-- Product Item -->
						<div class="<?php echo $class_column; ?> item-brand">
							<a href="<?php echo esc_url($link); ?>" <?php echo ($link_target=='new_window')? 'target="_blank"': ''; ?>>
								<?php the_post_thumbnail( 'brand-logo' ); ?>
							</a>
						</div>
						<!-- End Product Item -->

					<?php if( ($_count%$columns_count==0 && $_count!=1) || $_count== $number ) echo '</div></div>'; ?>
					<?php $_count++; ?>
				<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php wp_reset_query(); ?>
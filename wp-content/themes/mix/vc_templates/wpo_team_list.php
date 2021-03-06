<?php
extract( shortcode_atts( array(
	'title'=>'',
	'photo'=> '',
	'job'	=> '',
	'phone'=>'4',
	'information' => '',
	'google' => '',
	'twitter' => '',
	'linkedin'=>'',
	'facebook' => '',
	'pinterest'=> '',
	'style'		=> '',
), $atts ) );


?>
<div class="panel panel-default wpo-our-team text-center">
	<?php $img = wp_get_attachment_image_src($photo,'full'); ?>
	<?php if( isset($img[0]) )  { ?>
	<p class="panel-body no-margin-bottom zoom-2">
		<img class="img-responsive" src="<?php echo esc_url( $img[0] );?>" alt="<?php echo esc_attr( $title ); ?>"  />
	</p>
		<?php } ?>
	<div class="panel-footer">
		<h3><?php echo esc_attr( $title ); ?></h3>
		<h5><?php echo $job; ?></h5>
		<div class="team-info">
			<?php echo $information; ?>
		</div>
		<ul class="list-inline">
			<?php if( $facebook ){  ?>
			<li><a class="fa fa-facebook" href="<?php echo esc_url( $facebook ); ?>"> </a></li>
				<?php } ?>
			<?php if( $twitter ){  ?>
			<li><a class="fa fa-twitter" href="<?php echo esc_url( $twitter ); ?>"> </a></li>
			<?php } ?>
			<?php if( $pinterest ){  ?>
			<li><a class="fa fa-pinterest" href="<?php echo esc_url( $pinterest ); ?>"> </a></li>
			<?php } ?>
			<?php if( $google ){  ?>
			<li><a class="fa fa-google" href="<?php echo esc_url( $google ); ?>"> </a></li>
			<?php } ?>
		</ul>
	</div>
</div>
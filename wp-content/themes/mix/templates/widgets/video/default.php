<?php

if( $title ) {
        echo $before_title.$title.$after_title;
    }
?>

<div class="widget-video-content widget-content">
    <div class="widget-video-inner embed-responsive embed-responsive-16by9">
        <?php if ( $embed_code ) { ?>
            <?php echo $embed_code; ?>
        <?php } else { ?>
            <span class="visual-video-error text-error">
                <?php echo __( 'Video error!', TEXTDOMAIN ); ?>
            </span>
        <?php } ?>
    </div>
    <?php if ( $video_name ) { ?>
        <h6 class="widget-video-name">
            <?php echo $instance['video_name']; ?>
        </h6>
    <?php } ?>
</div>
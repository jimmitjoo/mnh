<div class="title-widget"><?php echo $title;?></div>
<ul class="social list-unstyled">
    <?php foreach( $socials as $key=>$social):
            if( isset($social['status']) && !empty($social['page_url']) ): ?>
                <li>
                    <a href="<?php echo esc_url($social['page_url']);?>" class="<?php echo esc_attr($key); ?>" target="_blank">
                        <i class="fa fa-<?php echo esc_attr($key); ?>">&nbsp;</i>
                        <!-- <span> <?php //echo $social['name']; ?></span> -->
                    </a>
                </li>
    <?php
            endif;
        endforeach;
    ?>
        </ul>
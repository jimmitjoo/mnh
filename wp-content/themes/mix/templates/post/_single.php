<?php $thumbsize = isset($thumbsize)? $thumbsize : 'thumbnail';?>
<article class="post">
    <?php
    if ( has_post_thumbnail() ) {
        ?>
            <figure class="entry-thumb">
                <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
                    <?php the_post_thumbnail( $thumbsize );?>
                </a>
                <!-- vote    -->
                <?php do_action('wpo_rating') ?>
            </figure>
        <?php
    }
    ?>
    <div class="entry-content">
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
                    <p class="entry-description"><?php echo wpo_excerpt(20,'...'); ?></p>
                <?php
            }
        ?>

        <div class="entry-content-inner clearfix">
            <div class="entry-meta">
                <div class="entry-category">
                    <?php the_category(); ?>
                </div>
            
                <ul class="entry-comment list-inline">
                    <li class="comment-count">
                        <?php comments_popup_link(__(' 0 ', TEXTDOMAIN), __(' 1 ', TEXTDOMAIN), __(' % ', TEXTDOMAIN)); ?>
                    </li>
                </ul>

                 <div class="entry-create">
                    <span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
                    <span class="readmore"><a href="<?php the_permalink(); ?>"><?php echo __('READ MORE', TEXTDOMAIN) ?></a></span> 
                </div>
            </div>
        </div>

    </div>
</article>
<?php 
global $wp_registered_sidebars;
 
    $meta_tabs = array(
        array(
            'id'    => 'wpo-config',
            'icon'  => 'fa-wrench',
            'title' => 'General'
        ),
        array(
            'id'    => 'option',
            'icon'  => 'fa-video-camera',
            'title' => 'Portfolio video'
        )
    );

?>
<!--Genaral config -->
<div id="wpo-post" class="wpo-metabox">
    <!-- Nav tabs -->
    <?php $mb->getTabsConfig($meta_tabs); ?>

    <!--Genaral config -->
    <div class="wpo-meta-content active" id="wpo-config">

        <!--show title config -->
            <p class="wpo_section config_layout">
            <?php 
                $_enabal_config = array('id'=>'config_layout','title'=>'Enabal config layout');
                $mb->getCheckboxElement( $_enabal_config ); ?>
            </p>

        <!--Select page layout-->
        <div class="wpo_section config_layout enabal-config">
        <?php
            $layout = array('id' => 'page_layout', 'title' => 'Select page layout');
            $mb->selectLayout($layout);
        ?>
        </div>

       <div style="clear:both;"></div>
        <!--Select left sidebar-->
        <p class="wpo_section left-sidebar config_layout enabal-config">
            <?php $mb->the_field('left_sidebar'); ?>
        <?php 
            $left_sidebars = array('id'=> 'left_sidebar','title'=>'Left Sidebar','data'=>$wp_registered_sidebars,'default'=>'sidebar-left');
            $mb->getSelectElement($left_sidebars);
        ?>
        </p>
        <!--Select right sidebar-->
        <p class="wpo_section right-sidebar config_layout enabal-config" style="display: none;">
    <?php 
        $right_sidebars = array('id'=> 'right_sidebar','title'=> 'Right Sidebar','data'=>$wp_registered_sidebars,'default'=>'sidebar-right');
        $mb->getSelectElement($right_sidebars); 
    ?>
        </p>

</div>

<div class="wpo-meta-content" id="option">
    <p class="wpo_section">
        <?php
            $video_link = array(
                'id'    => 'video_link',
                'title' => 'Video link',
                'des'   => '(Support <a href="https://www.youtube.com/" target="_bank" >Youtube</a> and <a href="http://vimeo.com/" target="_bank">Vimeo</a> video)'
            );
            $mb->addTextElement( $video_link );
        ?>
    </p>
    <div class="wpo_embed_view">
        <span class="spinner" style="float:none;"></span>
        <div class="result"></div>
    </div>
</div>

<script>
    WPO_Admin.params_Embed('#video_link','#option');
</script>
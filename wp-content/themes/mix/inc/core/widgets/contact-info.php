<?php
add_action('widgets_init', 'wpo_contact_info_load_widgets');

function wpo_contact_info_load_widgets() {
	register_widget('WPO_Contact_Info_Widget');
}

class WPO_Contact_Info_Widget extends WPO_Widget {
    
    private $params;

	function WPO_Contact_Info_Widget() {
        
        $this->params = array(
            'title' => __('Title', 'wpo'), 
            'description' => __('Description', 'wpo'), 
            'company' => __('Company', 'wpo'), 
            'country' => __('Country', 'wpo'), 
            'locality' => __('Locality', 'wpo'),
            'region' => __('Region', 'wpo'),
            'street' => __('Street', 'wpo'),
            'working-days' => __('Working Days', 'wpo'),
            'working-hours' => __('Working Hours', 'wpo'),
            'phone' => __('Phone', 'wpo'),
            'mobile' => __('Mobile', 'wpo'),
            'fax' => __('Fax', 'wpo'),
            'skype' => __('Skype', 'wpo'),
            'email-address' => __('Email Address', 'wpo'),
            'email' => __('Email', 'wpo'),
            'website-url' => __('Website URL', 'wpo'),
            'website' => __('Website', 'wpo')
        );
                    
        $widget_ops = array('classname' => 'contact-info', 'description' => __('Add contact information.', 'wpo'));

        $control_ops = array('id_base' => 'contact-info-widget');

        $this->WP_Widget('contact-info-widget', __('WPO: Contact Info', 'wpo'), $widget_ops, $control_ops);
    }


	function widget($args, $instance) {
		extract($args);		
        $title  = apply_filters('widget_title', esc_attr($instance['title']));

		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}
		?>
		<ul class="contact-info list-unstyled">
        <?php
        foreach ($this->params as $key => $value) :
            if ($instance[$key]) : 
                switch ($key) { 
                    case 'working-days':
                    case 'working-hours':
                    case 'phone':
                    case 'mobile':
                    case 'skype':
                    ?>
                        <li class="<?php echo $key ?>"><?php echo $value ?>: <?php echo esc_attr( $instance[$key] ); ?></li>
                    <?php
                        break;
                    case 'title':
                    case 'email-address':
                    case 'website-url':
                        break;
                    case 'email':
                    ?>
                        <li class="<?php echo $key ?>"><?php echo $value ?>: <a href="mailto:<?php echo esc_url( $instance['email-address'] ); ?>"><?php if($instance[$key]) { echo $instance[$key]; } else { echo $instance[$key]; } ?></a></li>
                    <?php 
                        break;
                    case 'website':
                    ?>
                        <li class="<?php echo $key ?>"><?php echo $value ?> <a href="<?php echo esc_url($instance['website-url']); ?>"><?php if($instance[$key]) { echo $instance[$key]; } else { echo $instance[$key]; } ?></a></li>
                    <?php 
                        break;
                    default: ?>
                        <li class="<?php echo $key ?>"><?php echo esc_attr( $instance[$key] ); ?></li>
            <?php }
            endif;
        endforeach; ?>
		</ul>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
        
        foreach ($this->params as $key => $value)
            $instance[$key] = $new_instance[$key];

		return $instance;
	}

	function form($instance) {
		$defaults = array('title' => __('Contact Info', 'wpo'));
		$instance = wp_parse_args((array) $instance, $defaults); 
        foreach ($this->params as $key => $value) :
        ?>
            <p>
                <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $value ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" type="text" value="<?php if (isset($instance[$key])) echo $instance[$key]; ?>" />
            </p>
        <?php endforeach; ?>
	<?php
	}
}
?>
<?php
/*==========================================================================
Button Import
==========================================================================*/
/** Step 1. */

add_action('admin_menu', 'add_tools_menu');

function add_tools_menu(){
	add_submenu_page( 'tools.php', __( 'WPO Import', 'wpo import' ),  __( 'WPO Import', 'wpo import' ) , 'manage_options', 'wpo-import', 'wpo_button_install_area_notice' );
}

function wpo_button_install_area_notice() {  
	$theme = wp_get_theme();
?>
	<div class="updated wpo-import">
	
		<h2><?php _e('Welcome to',TEXTDOMAIN); ?> <?php echo $theme->get('Name'); ?></h2>
		<?php _e('From here you will be able to give your new site a quick start by installing the demo content that is provided by the theme. You will need to make sure all the plugin required were installed and activated.',TEXTDOMAIN);?>
		<a href="http://wpopal.com/guides/mixstore/#!/install_data_demo"><?php echo $theme->get('Name'); ?><?php _e('You can read more from here',TEXTDOMAIN); ?></a>
		<p>
		<?php
			$url = get_template_directory().'/sample/data';
			$foders = array_diff(scandir($url), array('..', '.'));
			if($foders){?>
				<div class="option-import">
					<strong><?php _e('Select Data Demo You Want To Import',TEXTDOMAIN); ?></strong><br>
					<select class="wpo_option" name="wpo_option"> <?php
					foreach($foders as $foder){
						?>
							<option value="<?php echo $foder; ?>"><?php echo $foder; ?></option>
						<?php
					}?>
					</select>
				</div> <?php
			}	
		?>
		<p class="option-label">
			<strong><?php _e('WPO Import',TEXTDOMAIN); ?></strong><br>
			<label><?php _e('Import All ',TEXTDOMAIN); ?></label><input type="radio"  name="type_check" class="type_check" value="0" checked="checked" />
			<label><?php _e('Import Option ',TEXTDOMAIN); ?></label><input type="radio" name="type_check" class="type_check" value="1"/>
		</p>
		<div class="content-import">
			<input type="checkbox" class="import_sample" name="import_sample"/><label><?php _e('Sample Data',TEXTDOMAIN); ?></label>			
			<p class="option-import">
				<input type="checkbox" class="import_reading"/><label><?php _e('Reading Home',TEXTDOMAIN); ?></label>				
				<input type="checkbox" class="import_menu"/><label><?php _e('Mega Menu',TEXTDOMAIN); ?></label>
				<input type="checkbox" class="import_slider"/><label><?php _e('Slider',TEXTDOMAIN); ?></label>				
				<input type="checkbox" class="import_configs"/><label><?php _e('Configs',TEXTDOMAIN); ?></label>	
				<input type="checkbox" class="import_widget"/><label><?php _e('Widget',TEXTDOMAIN); ?></label>
				<input type="checkbox" class="import_dimensions"/><label><?php _e('Woocommerce Dimensions',TEXTDOMAIN); ?></label>	
				<p class="meassage">
					<?php _e('Please check data you want import',TEXTDOMAIN); ?>
				</p>			
			</p>
		</div>	
		<p class="import-message" style="display:none;">
			<span class="spinner" style="display: inline-block;float:none"></span> 
			<span class="meassage">
				<?php _e('Loading... this could take a couple of minutes, please wait until you get completion message',TEXTDOMAIN); ?>
			</span>
		</p>
		<p>
			<button class="button-primary wpo-install"><?php _e('Install Data',TEXTDOMAIN); ?></button>
		</p>
	</div>
	
	<script type="text/javascript">
		(function($){
			var $import_button = $('.wpo-install');
			var $import_message = $('.import-message');
			var $wpo_option    = $('.wpo_option');
			function checkimport() {
				var check_class = $( "input:radio[name=type_check]:checked" ).val();
				if(check_class && check_class == 1)
					$('.content-import').show();
				else
					$('.content-import').hide();
			}
			
			function sendData() {
				$('.option-import [type=checkbox]:checked').each(function(index) {
						var class_name = $( this ).attr( "class" );
						$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {action: class_name},
						success: function(response){
								if(index == ($('.option-import [type=checkbox]:checked').length - 1))
									$import_message.html('<?php echo __('<strong>Sucessfully imported demo data! </strong>',TEXTDOMAIN); ?>');
							}
						});
					});	
				}
			
			$(document).ready(function(){	
				checkimport();

				$('.type_check').click(
					function(){
						checkimport();						
					}
				);	
					
				$import_button.click(function(){
					$import_button.prop('disabled',true);
					$import_message.show();
					
					var check_class = $( "input:radio[name=type_check]:checked" ).val();
					var wpo_option  = $wpo_option.val();
					if(check_class && check_class == 1){
						 if($('input:checkbox[name=import_sample]').is(':checked')){
							$.ajax({
							url: ajaxurl,
							type: 'POST',
							data: {action: 'import_sample',option:wpo_option},
							success: function(response){
									sendData();
								}
							});	
						}
						else{
							sendData();	
						}	
					}else{
						$.ajax({
							url: ajaxurl,
							type: 'POST',
							data: {action: 'import_sample',option:wpo_option},
							success: function(response){
								$('.option-import [type=checkbox]').each(function(index) {
									var class_name = $( this ).attr( "class" );
									$.ajax({
									url: ajaxurl,
									type: 'POST',
									data: {action: class_name,option:wpo_option},
									success: function(response){
											if(index == ($('.option-import [type=checkbox]').length - 1))
												$import_message.html('<?php echo __('Sucessfully imported demo data!',TEXTDOMAIN);?>');
										}
									});
								});	
							}
						});		
					}
					
					return false;
				});
			});

		})(jQuery);
	</script>
<?php
}


/*==========================================================================
Import Sample Data
==========================================================================*/
add_action( 'wp_ajax_import_sample', 'wpo_install_sample_data' );
function wpo_install_sample_data(){
	$option =  (isset($_POST['option']) && !empty($_POST['option'])) ? ($_POST['option']) : '';
	if(empty($option))
		return;
    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		require_once ABSPATH . 'wp-admin/includes/import.php';
		$importer_error = false;

	if ( !class_exists( 'WP_Importer' ) ) {
		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if ( file_exists( $class_wp_importer ) ){
			require_once($class_wp_importer);
		}
		else{
			$importer_error = true;
		}
	}

	if ( !class_exists( 'WP_Import' ) ) {
		$class_wp_import = get_template_directory().'/sample/wordpress-importer/wordpress-importer.php';
		if ( file_exists( $class_wp_import ) ){
			require_once($class_wp_import);
		}
		else{
			$importer_error = true;
		}	  
	}

	if($importer_error){
		die(__('Import error! Please unninstall WP importer plugin and try again',TEXTDOMAIN));	
	}
	else{

		add_filter('intermediate_image_sizes_advanced', create_function('', 'return array();'));

		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = true;
		
		$inPath = 'http://wpopal.com/guides/basic/samples/'.$option.'/sample.xml';
		$outPath = get_template_directory().'/sample/data/'.$option.'/sample.xml';
		
		$in=    fopen($inPath, "rb");
		$out=   fopen($outPath, "wb");
		while ($chunk = fread($in,8192))
		{
			fwrite($out, $chunk, 8192);
		}
		fclose($in);
		fclose($out);
		
		
		$filexml = get_template_directory().'/sample/data/'.$option.'/sample.xml';
		
		if(file_exists($filexml)){
			//die($filexml);
			ob_start();
			$wp_import->import( $filexml);
			ob_end_clean();
		}
		else
		{
			die(__('Cannot Import data because no exists file sample.xml ',TEXTDOMAIN));	
		}
		if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )){
			// Set pages
            $woopages = array(
                'woocommerce_shop_page_id' => 'Shop',
                'woocommerce_cart_page_id' => 'Cart',
                'woocommerce_checkout_page_id' => 'Checkout',
                'woocommerce_pay_page_id' => 'Checkout &#8594; Pay',
                'woocommerce_thanks_page_id' => 'Order Received',
                'woocommerce_myaccount_page_id' => 'My Account',
                'woocommerce_edit_address_page_id' => 'Edit My Address',
                'woocommerce_view_order_page_id' => 'View Order',
                'woocommerce_change_password_page_id' => 'Change Password',
                'woocommerce_logout_page_id' => 'Logout',
                'woocommerce_lost_password_page_id' => 'Lost Password'
            );
            foreach($woopages as $woo_page_name => $woo_page_title) {
                $woopage = get_page_by_title( $woo_page_title );
                if(isset( $woopage->ID ) && $woopage->ID) {
                    update_option($woo_page_name, $woopage->ID); // Front Page
                }
            }

            // We no longer need to install pages
            delete_option( '_wc_needs_pages' );
            delete_transient( '_wc_activation_redirect' );

            // Flush rules after install
            flush_rewrite_rules();
		}
	}
	die;
}

/*==========================================================================
set Options
==========================================================================*/
add_action( 'wp_ajax_import_configs', 'wpo_install_set_options' );
function wpo_install_set_options(){
	if( file_exists(WPO_THEME_DIR.'/sample/config.txt') ){
		$content = file_get_contents( WPO_THEME_DIR.'/sample/config.txt' );
		$data = @unserialize( trim($content) );
		if( is_array($data) ){ 
			update_option("wpo_theme_options",$data);
		}
	}
	die;
}

/*==========================================================================
set Revslider
==========================================================================*/
if(in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )){
	
	require_once(ABSPATH .'wp-content/plugins/revslider/revslider_admin.php');
	add_action( 'wp_ajax_import_slider', 'wpo_install_set_revslider' );
	function wpo_install_set_revslider(){
		$option =  (isset($_POST['option']) && !empty($_POST['option'])) ? ($_POST['option']) : '';
		if(empty($option))
			return;
		$path = get_template_directory() . '/sample/data/'.$option.'/revslider';
		if ($handle = opendir( $path )) {
		    while (false !== ($entry = readdir($handle))) {
		        if ($entry != "." && $entry != "..") {
		            $_FILES['import_file']['tmp_name']= $path . '/' . $entry;
		            $slider = new RevSlider();
					$response = $slider->importSliderFromPost(true, true);
		        }
		    }
		    closedir($handle);
		}
		die;
	}
}

/*==========================================================================
Set widget
==========================================================================*/
add_action( 'wp_ajax_import_widget', 'wpo_install_set_widget' );

function wpo_install_set_widget(){
	global $wp_registered_sidebars;

	$widgets_json = get_template_directory_uri() . '/sample/widget/widget_data.json'; // widgets data file
	$widgets_json = wp_remote_get( $widgets_json );

	$json_data = $widgets_json['body'];

	$json_data = json_decode( $json_data, true );
	var_dump($json_data[0]);
	$sidebars_data = $json_data[0];
	$widget_data = $json_data[1];

	foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

		foreach ( $import_widgets as $import_widget ) :
			//if the sidebar exists
			if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = wpo_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if (!empty( $new_widgets) && array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					$current_multiwidget = $current_widget_data['_multiwidget'];
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}

			endif;
		endforeach;
	endforeach;
	if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
		update_option( 'sidebars_widgets', $current_sidebars );

		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );

		return true;
	}
	die;
}

function wpo_new_widget_name($widget_name, $widget_index){
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}

/*==========================================================================
Set Image Size active theme
==========================================================================*/
add_action( 'wp_ajax_import_dimensions', 'wpo_install_set_image_woocommerce_dimensions' );

function wpo_install_set_image_woocommerce_dimensions() {
	$catalog = array(
		'width' 	=> '195',	// px
		'height'	=> '215',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '480',	// px
		'height'	=> '425',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '73',	// px
		'height'	=> '80',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	die;
}

add_action( 'wp_ajax_import_reading', 'wpo_install_set_reading_pptions' );

function wpo_install_set_reading_pptions(){
    $homepage = get_page_by_title('Home');
	get_option('page_on_front');
    if( isset( $homepage ) && $homepage->ID ) {
        update_option('show_on_front', 'page');
        @update_option('page_on_front', $homepage->ID); // Front Page
    }
	die;
}

/*==========================================================================
Set menu
==========================================================================*/
add_action( 'wp_ajax_import_menu', 'wpo_install_set_menu' );

function wpo_install_set_menu(){
	global $wpdb;
	$table_db_name = $wpdb->prefix . "terms";
	$rows = $wpdb->get_results("SELECT * FROM $table_db_name where  name='Main Menu' or name='Top Menu Header'",ARRAY_A);
	$menu_ids = array();
	foreach($rows as $row) {
		$menu_ids[$row["name"]] = $row["term_id"] ;
	}

	if ( !has_nav_menu( 'mainmenu' ) || !has_nav_menu( 'mainmenu' ) ) {
		set_theme_mod( 'nav_menu_locations', array_map( 'absint', array( 
			'mainmenu' => $menu_ids['Main Menu'] ,
			'topmenu' => $menu_ids['Top Menu Header']
		) ) );
	}
	wp_delete_post(1);
	die;
}

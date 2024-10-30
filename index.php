<?php
/*
Plugin Name: Custom Index Shortcode
Plugin URI: 
Description: create customizable lists of pages using a simple shortcode
Author: Federico Azzario
Version: 1.3
Author URI: www.teuteca.com/ibis
*/

add_shortcode("custom-index", "custom_index_shortcode");

function custom_index_shortcode($attributes){
	ob_start();
	if(isset($attributes['id']) && is_numeric($attributes['id'])){
		//id specified by shortcode attribute
		$parent = $attributes['id'];
	}else{
		//get the id of the current article that is calling the shortcode
		$parent = get_the_ID();
	}
	
	$i = 0;
	//if(!isset($attributes['depth'])) $parentnodepth = $parent;
	//else $parentnodepth = '-1';
	$args = array(
		'parent' => $parent, //$parentnodepth,
		'child_of' => $parent,
		'post_type' => 'page',
		'hierarchical' => 0
	);
	//if(isset($attributes['title'])) echo "<span style='font-size:1.5em;font-weight:bold;'>".$attributes['title']."</span>";
	if(isset($attributes['title'])) {
		if(isset($attributes['titlesize'])) echo"<".$attributes['titlesize'].">".$attributes['title']."</".$attributes['titlesize'].">";
	}
	if(isset($attributes['list']) && $attributes['list']=='unordered') echo"<ul>";
	if(isset($attributes['list']) && $attributes['list']=='ordered') echo"<ol>";
	
	if(isset($attributes['order'])) $args['sort_order'] = $attributes['order'];
	if(isset($attributes['orderby'])) $args['sort_column'] = $attributes['orderby'];
	
	$mypages = get_pages($args);
	
	foreach( $mypages as $page ) {		

	?>
		<li>
			<a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a>
			<?php
			if(isset($attributes['author']) && $attributes['author'] !== 'no') { 
				echo' - ';
				if($attributes['author']=='link') { echo'<a href="'.get_author_posts_url( $page->post_author).'">'; }
				if($attributes['author']=='link' || $attributes['author']=='nolink') { echo get_userdata($page->post_author)->display_name; }
				if($attributes['author']=='link') { echo'</a>'; }
			} ?>
		</li>
		
		<?php
		
		if(isset($attributes['depth']) && $attributes['depth']>=1) {
		
		$childrenargs = array(
		'parent' => $page->ID,
		'child_of' => $page->ID,
		'post_type' => 'page',
		'hierarchical' => 0
		);
		
		if(isset($attributes['list']) && $attributes['list']=='unordered') echo"<ul>";
		if(isset($attributes['list']) && $attributes['list']=='ordered') echo"<ol>";
		
		if(isset($attributes['order'])) $childrenargs['sort_order'] = $attributes['order'];
		if(isset($attributes['orderby'])) $childrenargs['sort_column'] = $attributes['orderby'];
		
		$mychildren = get_pages($childrenargs);
	
		foreach( $mychildren as $child ) {		

		?>
			<li>
				<a href="<?php echo get_page_link( $child->ID ); ?>"><?php echo $child->post_title; ?></a>
				<?php
				if(isset($attributes['author']) && $attributes['author'] !== 'no') { 
					echo' - ';
					if($attributes['author']=='link') { echo'<a href="'.get_author_posts_url( $child->post_author).'">'; }
					if($attributes['author']=='link' || $attributes['author']=='nolink') { echo get_userdata($child->post_author)->display_name; }
					if($attributes['author']=='link') { echo'</a>'; }
				} ?>
			</li>
		
		<?php
		
			if(isset($attributes['depth']) && $attributes['depth']>=2) {
		
			$granchildrenargs = array(
			'parent' => $child->ID,
			'child_of' => $child->ID,
			'post_type' => 'page',
			'hierarchical' => 0
			);
		
			if(isset($attributes['list']) && $attributes['list']=='unordered') echo"<ul>";
			if(isset($attributes['list']) && $attributes['list']=='ordered') echo"<ol>";
		
			if(isset($attributes['order'])) $granchildrenargs['sort_order'] = $attributes['order'];
			if(isset($attributes['orderby'])) $granchildrenargs['sort_column'] = $attributes['orderby'];	
		
			$mygranchildren = get_pages($granchildrenargs);
	
			foreach( $mygranchildren as $granchild ) {		

			?>
				<li>
					<a href="<?php echo get_page_link( $granchild->ID ); ?>"><?php echo $granchild->post_title; ?></a>
					<?php
					if(isset($attributes['author']) && $attributes['author'] !== 'no') { 
						echo' - ';
						if($attributes['author']=='link') { echo'<a href="'.get_author_posts_url( $granchild->post_author).'">'; }
						if($attributes['author']=='link' || $attributes['author']=='nolink') { echo get_userdata($granchild->post_author)->display_name; }
						if($attributes['author']=='link') { echo'</a>'; }
					} ?>
				</li>
				
			<?php
		
				if(isset($attributes['depth']) && $attributes['depth']>=3) {
			
				$grangranchildrenargs = array(
				'parent' => $granchild->ID,
				'child_of' => $granchild->ID,
				'post_type' => 'page',
				'hierarchical' => 0
				);
		
				if(isset($attributes['list']) && $attributes['list']=='unordered') echo"<ul>";
				if(isset($attributes['list']) && $attributes['list']=='ordered') echo"<ol>";
		
				if(isset($attributes['order'])) $grangranchildrenargs['sort_order'] = $attributes['order'];
				if(isset($attributes['orderby'])) $grangranchildrenargs['sort_column'] = $attributes['orderby'];
		
				$mygrangranchildren = get_pages($grangranchildrenargs);
	
				foreach( $mygrangranchildren as $grangranchild ) {		

				?>
					<li>
						<a href="<?php echo get_page_link( $grangranchild->ID ); ?>"><?php echo $grangranchild->post_title; ?></a>
						<?php
						if(isset($attributes['author']) && $attributes['author'] !== 'no') { 
							echo' - ';
							if($attributes['author']=='link') { echo'<a href="'.get_author_posts_url( $grangranchild->post_author).'">'; }
							if($attributes['author']=='link' || $attributes['author']=='nolink') { echo get_userdata($grangranchild->post_author)->display_name; }
							if($attributes['author']=='link') { echo'</a>'; }
						} ?>
					</li>
		
				<?php
		
		
				}
			
				if(isset($attributes['list']) && $attributes['list']=='unordered') echo"</ul>";
				if(isset($attributes['list']) && $attributes['list']=='ordered') echo"</ol>";
				}
			}
			
			if(isset($attributes['list']) && $attributes['list']=='unordered') echo"</ul>";
			if(isset($attributes['list']) && $attributes['list']=='ordered') echo"</ol>";
			}
		}
			
		if(isset($attributes['list']) && $attributes['list']=='unordered') echo"</ul>";
		if(isset($attributes['list']) && $attributes['list']=='ordered') echo"</ol>";
		}
	}	
	if(isset($attributes['list']) && $attributes['list']=='unordered') echo"</ul>";
	if(isset($attributes['list']) && $attributes['list']=='ordered') echo"</ol>";
	
	$output_string=ob_get_contents();;
	ob_end_clean();

	return $output_string;
}

//**********************************************************************************************************************************

// ADDING QUICKTAG TO HTML EDITOR

if( !function_exists('_add_my_quicktags') ){
  function add_custom_index_quicktags(){
?>

    <script type="text/javascript">  
    /**
     * Add custom Quicktag buttons to the WordPress editor 
     * for ver. 3.3 and above only
     * Params for the addButton function are:
     *  - Button HTML ID (required)
     *  - Opening Tag (required)
     *  - Closing Tag (required)
     *  - Access key, accesskey="" attribute for the button (optional)
     *  - Title, title="" attribute (optional)
     *  - Priority/position on bar, 1-9 = first, 11-19 = second,
     *    21-29 = third, etc. (optional)
     */
    QTags.addButton( 'custom-index', 'custom-index', '[custom-index]','','','Custom Index Shortcode',999);  
    
    </script>

<?php
  }
  add_action('admin_print_footer_scripts',  'add_custom_index_quicktags');
}

//*********************************************************************************************************************************

// ADDING TinyMCE BUTTON

// Hooks your functions into the correct filters
function customindexshortcodeadd_mce_button() {
	// check user permissions
	global $typenow;

    // only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
	// check if WYSIWYG is enabled
	
		add_filter( 'mce_external_plugins', 'customindexshortcodeadd_tinymce_plugin' );
		add_filter( 'mce_buttons', 'customindexshortcoderegister_mce_button' );
	
}
add_action('admin_head', 'customindexshortcodeadd_mce_button');

// Declare script for new button
function customindexshortcodeadd_tinymce_plugin( $plugin_array ) {
	$plugin_array['customindexshortcode_button'] = plugins_url('/customindexshortcode_plugin.js',__FILE__);
	return $plugin_array;
}

// Register new button in the editor
function customindexshortcoderegister_mce_button( $buttons ) {
	array_push( $buttons, 'customindexshortcode_button' );
	return $buttons;
}

//css
function customindexshortcodeshortcodes_mce_css() {
	wp_enqueue_style('symple_shortcodes-tc', plugins_url('/my_style.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'customindexshortcodeshortcodes_mce_css' );
?>
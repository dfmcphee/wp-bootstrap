<?php

function setupCustomEditor() {
	
	/* Removes WordPress Editor
	add_action('init', 'remove_editor_init');

	function remove_editor_init() {
		remove_post_type_support('post', 'editor');
	}
	*/
	
	/**
	 * Calls the class on the post edit screen
	 */
	function call_archetype() 
	{
	    return new archetype();
	}
	if ( is_admin() )
	    add_action( 'load-post.php', 'call_archetype' );
	
	/** 
	 * The Class
	 */
	class archetype
	{
	    const LANG = 'some_textdomain';
	
	    public function __construct()
	    {
	        add_action( 'add_meta_boxes', array( &$this, 'add_some_meta_box' ) );
	    }
	
	    /**
	     * Adds the meta box container
	     */
	    public function add_some_meta_box()
	    {
	        add_meta_box( 
	             'some_meta_box_name'
	            ,__( 'Nimbl Post Editor', self::LANG )
	            ,array( &$this, 'render_meta_box_content' )
	            ,'post' 
	            ,'advanced'
	            ,'high'
	        );
	    }
	
	    public function output_row($layout){
			echo '<div class="row-fluid">';
			
	    }
	    
	    public function output_module($module_id, $module_data){
	    ?>
			<div id="<?php echo $module_id ?>" class="module">
				<div class="portlet">
					<div class="portlet-header">
						Rich Text Editor
						<span class="actions pull-right">
							<a href='#' class="btn btn-mini btn-primary edit">Edit</a>
							<a href='#' class="btn btn-mini btn-danger delete">Delete</a>
						</span>
					</div>
					<div class="portlet-content"><textarea class="redactor"><?php echo $module_data ?></textarea></div>
				</div>
			</div>
		<?php
	    }
	    
	    /**
	     * Render Meta Box content
	     */
	    public function render_meta_box_content() 
	    { 
	    
	    	$rows = get_post_meta($_GET['post'], 'bootfolio_layout');
	    	
	    	$rows = $rows[0];
	    	
	    ?>
	    	<div class="row-fluid">
	    		<div id="row-layouts" class="span12 well">
	    			<a href="#" id="one-column" class="btn">One Column</a>
	    			<a href="#" id="left-sidebar" class="btn">Left Sidebar</a>
	    			<a href="#" id="right-sidebar" class="btn">Right Sidebar</a>
	    			<a href="#" id="two-column" class="btn">Two Column</a>
	    		</div>
	    	</div>
	    	
	    	<div id="archetype-layout" class="row-fluid">
	    		<div class="span12">
		    		<?php 
		    		$row_count = 1;
		    		
		    		if (!empty($rows)) {
			    		foreach ($rows as $row) { 
			    			$column_count = 1;
			    		?>
			    		<div class="row-layout row-fluid" layout="<?= $row['type'] ?>">
			    			<div class="span12">
				    			<div class="row-fluid">
				    				<div class="span12"><a href="#" class="btn delete-row">x</a></div>
				    			</div>
				    			<div class="row-fluid">
						        		<?php 
						        			if (!empty($row['columns'])) {
							        			foreach ($row['columns'] as $column) {
							        				?>
							        				
							        				
							        				<div class="well column span<?= $column['size'] ?>">
							        					
							        				<?php
							        					if (!empty($column['modules'])) {
							        					
								        					foreach ($column['modules'] as $module) {
									        					$this->output_module($module['id'], $module['data']);
									        				}
								        				}
								        				?>
								        				
								        			</div>
								        		<?php
							        			}
						        			} 
						        		?>
				    			</div>
				    		</div>
		    			</div>
				     <?php 
				     		$column_count++;
				     	} 
			     	}
			     ?>

			     
			     
			    </div>
	       </div>
	       

	       
	       <hr/>
	       
	       <div id="edit-modal" title="Basic modal dialog">
	       		<input id="edit-id" type="hidden" />
				<div class="modal-content"></div>
				<div class="modal-actions">
					<a href="#" class="btn cancel-btn">Cancel</a>
					<a href="#" class="btn btn-primary save-btn">Save</a>
				</div>
		   </div>
	       
	       <h2>Modules</h2>
	       <div class="row-fluid">
		        <div class="span8">
		        	<div class="module multi">
				        <div class="portlet">
							<div class="portlet-header">
								Rich Text Editor
								<span class="actions pull-right">
									<a href='#' class="btn btn-mini btn-primary edit">Edit</a>
									<a href='#' class="btn btn-mini btn-danger delete">Delete</a>
								</span>
							</div>
							<div class="portlet-content"><textarea class="redactor"></textarea></div>
						</div>
					</div>
				</div>
	       </div>
	       <div class="row-fluid">
		        <div class="span8">
		        	<div class="module single">
				        <div class="portlet">
							<div class="portlet-header">
								WordPress Content
								<span class="actions pull-right">
									<a href='#' class="btn btn-mini btn-primary edit">Edit</a>
									<a href='#' class="btn btn-mini btn-danger delete">Delete</a>
								</span>
							</div>
							<div class="portlet-content"><textarea id="wp-content" class="redactor"></textarea></div>
						</div>
					</div>
				</div>
	       </div>

	       
	   <?php  }
	}
	
	
	
	function admin_include_css() {

		wp_register_style( 'admin_jquery_ui_css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/smoothness/jquery-ui.css', false, '1.0.0' );
		wp_register_style( 'admin_redactor_css', get_template_directory_uri() . '/library/redactor/css/redactor.css', false, '1.0.0' );
		

		wp_enqueue_style( 'admin_jquery_ui_css' );
		wp_enqueue_style( 'admin_redactor_css' );
	}
	
	add_action( 'admin_enqueue_scripts', 'admin_include_css' );
	
	function admin_inline_css(){
		
				wp_register_style( 'admin_bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css', false, '1.0.0' );
				
				wp_enqueue_style( 'admin_bootstrap_css' );
	
		?>
	    <style>
		    ul li {
			    list-style-type: none;
		    }
		    
		    #titlediv #title {
		    	height: 50px;
		    }
		    
		    .column { float: left; padding-bottom: 100px; }
			.portlet { margin: 0 1em 1em 0; }
			.portlet-header { margin: 0.3em; padding-bottom: 4px; padding-left: 0.2em; }
			.portlet-header .ui-icon { float: right; }
			.portlet-content { padding: 0.4em; display:none; }
			.ui-sortable-placeholder { border: 1px dotted black; visibility: visible !important; height: 50px !important; }
			.ui-sortable-placeholder * { visibility: hidden; }
			
			.ui-widget-overlay {
				background:black;
			}
			
			.redactor {
				height: 300px;
			}
		</style>
	<?php
	}
	
	add_action( 'admin_head', 'admin_inline_css' );
	
	function admin_js() {
	    $url = get_bloginfo('template_directory') . '/library/redactor/redactor.js';
	    echo '<script type="text/javascript" src="'. $url . '"></script>';
	    $url = get_bloginfo('template_directory') . '/library/js/wp-admin.js';
	    echo '<script type="text/javascript" src="'. $url . '"></script>';
	    wp_enqueue_script( 'jquery-ui-droppable' );
	}
	add_action('admin_footer', 'admin_js');

	function save_post_layout() {
		$data = $_POST['data'];
		
		$layout = $data['layout'];
		$postid = $data['post_id'];
		
		if (update_post_meta($postid, 'bootfolio_layout', $layout)) {
			echo 'success';
		}
		else {
			echo 'error';
			echo ': post id: ' . $postid;
		}
		
		echo $data['layout'];
	
		die(); // this is required to return a proper result
	}
	
	add_action('wp_ajax_save_post_layout', 'save_post_layout');
}

//setupCustomEditor();
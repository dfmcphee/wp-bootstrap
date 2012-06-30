window['rows'] = new Array();

rows_count = 0;

jQuery(document).ready(function($) {
	
	$('#adminmenuwrap').height( $(document).height() );
	
	$('#redactor_file_link').live('click', openMediaEmbed);
	
	// Initialize modal window to edit rich text editor
	$( "#edit-modal" ).dialog({
			autoOpen: false,
			height: 500,
			width: 850,
			modal: true
		});
	
	// Initialize columns as sortable
	jQuery( ".column" ).sortable({
			connectWith: ".column",
			handle: ".portlet-header",
			stop: function(e, ui) {
		        postLayout();
		    }
		});
	
	// Make modules draggable	
	jQuery( ".module.multi" ).draggable({
		connectToSortable: ".column",
		helper: "clone",
		revert: "invalid",
		handle: ".portlet-header"
	});
	
	// Make modules draggable	
	jQuery( ".module.single" ).draggable({
		connectToSortable: ".column",
		revert: "invalid",
		handle: ".portlet-header"
	});

		// Add jquery-ui classes to module
		jQuery( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
			.find( ".portlet-header" )
				.addClass( "ui-widget-header ui-corner-all" )
				.end()
			.find( ".portlet-content" );
		
		// Add click event to delete module button
		jQuery( ".column .portlet-header .delete" ).live('click', function(e) {
			e.preventDefault(); 
			jQuery( this ).parent().parent().parent().parent().remove();
			postLayout();
		});
		
		// Add click event to edit module button
		jQuery( ".column .portlet-header .edit" ).live('click', function(e) {
			e.preventDefault();
			var id = jQuery( this ).parent().parent().parent().parent().attr('id');
			var content = jQuery( this ).parent().parent().parent().find('.portlet-content').html();
			jQuery('#edit-modal .modal-content').html(content);
			jQuery('#edit-id').val(id);
			jQuery('#edit-modal').dialog('open');
			jQuery('#edit-modal .redactor').redactor({ overlay: false });
		});
		
		// Add click event to save button
		jQuery( "#edit-modal .save-btn" ).live('click', function(e) {
			e.preventDefault();
			var id = jQuery('#edit-id').val();
			var content = jQuery('#edit-modal .redactor').getCode();
			jQuery('#' + id + ' .redactor').html(content);
			jQuery('#edit-modal').dialog('close');
			postLayout();
		});
		
		// Add click event to cancel button
		jQuery( "#edit-modal .cancel-btn" ).live('click', function(e) {
			e.preventDefault();
			jQuery('#edit-modal').dialog('close');
		});

		jQuery( ".column" ).disableSelection();
	
	jQuery( "ul, li" ).disableSelection();
	
	jQuery( ".column" ).live( "sortreceive", function(event, ui) {
		//jQuery('.column .redactor').redactor();
	});
	
	// Add event to updating of layout
	jQuery( ".column" ).live( "sortupdate", function(event, ui) {
		var moduleCount = 1;
		
		// Loop through and index modules
		jQuery( ".column .module" ).each(function() {
			jQuery(this).attr('id', 'module_' + moduleCount);
			moduleCount++;
		});
	});
	
	// Add row layout button events
	jQuery( "#row-layouts .btn" ).bind( "click", function(event, ui) {
		addRowLayout(jQuery(this).attr('id'));
	});
	
	// Add click event to delete row button
	jQuery( ".row-layout .delete-row" ).live('click', function(e) {
		e.preventDefault(); 
		jQuery( this ).parents('.row-layout').remove();
		postLayout();
	});
});

// Add row to layout
function addRowLayout(layout) {

	var row = '<div class="row-layout row-fluid" layout="' + layout + '">';
	
	row += '<div class="span12">';
	
	row += '<div class="row-fluid">';
	
	row += '<div class="span12"><a href="#" class="btn delete-row">x</a></div>';
	
	row += '</div>';
	
	row += '<div class="row-fluid">';
	
	if (layout === 'one-column') {
		row += '<div class="span12 well column" size="12"></div>';
	}
	
	else if (layout === 'left-sidebar') {
		row += '<div class="span4 well column" size="4"></div><div class="span8 well column" size="8"></div>';
	}
	
	else if (layout === 'right-sidebar') {
		row += '<div class="span8 well column" size="8"></div><div class="span4 well column" size="4"></div>';
	}
	
	else if (layout === 'two-column') {
		row += '<div class="span6 well column" size="6"></div><div class="span6 well column" size="6"></div>';
	}
	
	row += '</div>';
	
	row += '</div>';
	
	row += '</div>';
	
	jQuery('#archetype-layout').append(row);
	
	jQuery('#archetype-layout .row-layout:last .column').sortable({
			connectWith: ".column",
			handle: ".portlet-header",
			stop: function(e, ui) {
		        postLayout();
		    }
		});
}

// Build module array
function setIDs(){
	var rowCount = 1;
	
	window['rows'] = new Array();
	
	jQuery( ".row-layout" ).each(function() {
    	jQuery(this).attr('id', 'row_' + rowCount);
		
		var row = new Object();
		
		row.type = jQuery(this).attr('layout');
		
		row.columns = Array();
		
		var columnCount = 1;
		jQuery(this).find( ".column" ).each(function() {
	    	jQuery(this).attr('id', 'column_' + columnCount);
			
			var column = new Object();
			
			column.size = jQuery(this).attr('size');
			
			column.modules = Array();
			
			jQuery(this).find( ".module" ).each(function() {
				
				var id = jQuery(this).attr('id');
				
				 var module = new Object();
				 
				 module.id = id;
				 module.data = jQuery('#' + id + ' .redactor').html();
				 column.modules.push(module);
			});
			
			columnCount++;
			
			row.columns.push(column);
		});
		
		window['rows'].push(row);
		
		rowCount++;
	});


}

// Post serialized layout to wordpress
function postLayout() {
	setIDs();				
	var options = {
		action: 'save_post_layout',
		data: {
			post_id: jQuery('#post_ID').val(),
			layout: window['rows']
		}
	};

	jQuery.post(ajaxurl, options, function(response) {
		if (response != 'success') {
			//alert('There was a problem saving your data.');
		}
	});
}
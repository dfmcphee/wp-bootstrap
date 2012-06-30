jQuery(function() {
	jQuery('.carousel').carousel('cycle', {
		  interval: 5000
		})
		
		var config = {    
		     over: function() {
					var itemID = this.id.split("-",2);
					jQuery('#post-' + itemID[1] + ' .thumbnail-info').slideDown('slow', function() {});
				},    
		     timeout: 300,
		     out:  	function () {
					var itemID = this.id.split("-",2);
					jQuery('#post-' + itemID[1] + ' .thumbnail-info').slideUp('slow', function() {});
				}  
		};
		
		jQuery('.span4.postbox').hoverIntent( config );
});
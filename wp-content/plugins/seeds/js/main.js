jQuery(function($) {
	var update_post_seeds = function(seed, link) {
		var options = {
			action: 'save_post_seed',
			data: {
				post_id: $('#post_ID').val(),
				seed: seed,
				link: link
			}
		};

		jQuery.post(ajaxurl, options, function(response) {
			if (response != 'success') {
				alert('There was a problem saving your data.');
			}
		});
	};

	$('.seed-input').live('change', function() {
		var seed = $(this).attr('name');
		var link = $(this).val();
		update_post_seeds(seed, link);
	});
});	
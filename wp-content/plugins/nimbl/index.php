<?php
  require_once('../../../wp-config.php');

  require_once('nimbl.php');
  
  $nimbl = new Nimbl;
  
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Nimbl Editor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<link href="http://dfmcphee.com/nimbl/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://dfmcphee.com/nimbl/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="http://dfmcphee.com/nimbl/css/codemirror.css" rel="stylesheet">
		<link href="http://dfmcphee.com/nimbl/css/admin.css" rel="stylesheet">
	</head>
	<body>
		    <div class="navbar">
		      <div class="navbar-inner">
		        <div class="container">
		          <a href="<?php echo get_bloginfo('siteurl');?>/wp-admin" class="btn btn-info"><i class="icon-arrow-left"></i> Back to WP-Admin</a>
		          <button type="submit" id="save-file" class="btn btn-primary pull-right">Save</button>
		        </div>
		      </div>
		    </div>
	    	    
			<div class="container">
				<div class="row">
					<div id="alerts" class="span12">
						
					</div>
				</div>
				<div class="row">
					<div id="file-tree" class="span3">
						<div class="well"><?php $nimbl->output_directory('../../'); ?></div>
					</div>
					<div class="span9">
						<div id="editor">
							<form id="editor-form">
								<textarea id="code" name="code"></textarea>
							</form>
						</div>
					</div>
				</div>
				<footer>
				</footer>
			</div>
		
		<script src="http://dfmcphee.com/nimbl/js/jquery.js"></script>
		<script src="http://dfmcphee.com/nimbl/js/codemirror.js"></script>
		<script src="http://dfmcphee.com/nimbl/js/bootstrap.js"></script>
		<script src="http://dfmcphee.com/nimbl/js/admin.js"></script>
	</body>
</html>
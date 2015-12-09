<html>
	<head>
		<title>
		<?php 
			echo isset($page_title) ? $page_title.' | ' : ''; 
			echo $this->config->item('site_name');
		?>
		</title>
		<?php echo isset($assets_content) ? $assets_content : ''; ?>
	</head>
	<body>
		<div class="ui container">
			<div class="ui three column centered grid padding-top-3">
				<h1>Dokumentasi LFS<?php echo isset($page_title) ? ' | '.$page_title : ''; ?></h1>
			</div>
			<?php echo isset($body_content) ? $body_content : ''; ?>
		</div>
		<div class="ui container">
			<?php echo isset($footer_content) ? $footer_content : ''; ?>
		</div>
		<?php echo isset($scripts_content) ? $scripts_content : ''; ?>
	</body>
</html>
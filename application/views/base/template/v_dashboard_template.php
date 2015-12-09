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
			<div class="padding-top-3">
				<div class="ui secondary large pointing red menu">
					<a id="dokumentasi_menu" class="item active" onclick="navigateDashboard('tabel_anggota_tim_menu', 'anggota_tim', 'dokumentasi_menu', 'dokumentasi');"><i class="file text outline icon"></i> Dokumentasi</a>
					<a id="tabel_anggota_tim_menu" class="item" onclick="navigateDashboard('dokumentasi_menu', 'dokumentasi', 'tabel_anggota_tim_menu', 'anggota_tim');"><i class="users icon"></i> Anggota Tim</a>
					<div class="right menu">
						<a class="ui item" href="<?php echo site_url('auth/logout'); ?>"><i class="sign out icon"></i> Logout </a>
					</div>
				</div>
				<div class="ui segment">
					<?php echo isset($body_content) ? $body_content : ''; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<?php echo isset($footer_content) ? $footer_content : ''; ?>
		</div>
		<?php echo isset($scripts_content) ? $scripts_content : ''; ?>
	</body>
</html>
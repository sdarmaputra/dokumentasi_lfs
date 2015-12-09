<div class="ui three column centered grid padding-top-3">
	<div class="ui column raised very padded text segment">		
		<form class="ui form" method="POST" action="<?php echo site_url('auth/login'); ?>">
			<div class="field">
				<label>Username</label>
				<input type="text" name="username" placeholder="Username">
			</div>
			<div class="field">
				<label>Password</label>
				<input type="password" name="password" placeholder="Password">
			</div>
			<button class="ui fluid teal vertical animated large button" tabindex="0" type="submit">
				<div class="hidden content">Log In</div>
					<div class="visible content">
					<i class="send icon"></i>
				</div>
			</button>
		</form>
	</div>
</div>


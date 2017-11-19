<div id="signin-box">
	<form class="form-signin" action="<?php echo base_url() ?>admin/validate_credentials" method="post">
		<div id="app-img"><img src="<?php echo base_url() ?>public/images/logo.png" alt="Open Science Publications" /></div>
		<label for="Username" class="sr-only">Email address</label>		
		<input type="text" name="user_name" value="" placeholder="Username" class="form-control" required autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
</div
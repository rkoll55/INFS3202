<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'login/confirm_pass'); ?>
				<h2 class="text-center">Forgot Password</h2>    
                </br>   
                    <div class="form-group">
						<input type="text" class="form-control" placeholder="Code sent to your email" required="required" name="code">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="New Password" required="required" name="password">
					</div>
                    <div class="form-group">
						<input type="password" class="form-control" placeholder="Re-type Password" required="required" name="confirm-password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Reset</button>
					</div>   
			<?php echo form_close(); ?>
	</div>
</div>

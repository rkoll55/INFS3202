<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'login/change_pass'); ?>
				<h2 class="text-center">Forgot Password</h2>    
                </br>   
                </h4> Enter Your Username </h4>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Send Email</button>
					</div>   
			<?php echo form_close(); ?>
	</div>
</div>

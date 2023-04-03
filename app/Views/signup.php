<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'signup/check_signUp'); ?>
				<h2 class="text-center">Sign Up</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
                    <div class="form-group">
						<input type="email" class="form-control" placeholder="Email" required="required" name="email">
					</div>
                    <div class="form-group">
						<input type="text" class="form-control" placeholder="First Name" required="required" name="FirstName">
					</div>
                    <div class="form-group">
						<input type="text" class="form-control" placeholder="Lirst Name" required="required" name="LastName">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>
                    <div class="form-group">
						<input type="password" class="form-control" placeholder="Confirm Password" required="required" name="confirm-password">
					</div>
					<?php echo $error; ?>
                    <div class="form-group">
                        <label class="form-check-label"><input type="checkbox" name = 'staff'> I am Staff</label>
                    </div>
			
					<div class="form-group">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Get Started</button>
					</div>
				 
					
			<?php echo form_close(); ?>
	</div>
</div>

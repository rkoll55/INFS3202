<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'donate/check_donation'); ?>
                </br>
				<h2 class="text-center">Donate to Us!</h2>      
                   </br> 
				   <div class="form-group">
						<input type="number" class="form-control" placeholder="Donation Amount" min="0.00" required="required" name="amount">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email" required="required" name="email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Card Number" pattern="\d{16}" required="required" name="number">
					</div>
                    <div class="form-group">
						<input type="text" class="form-control" placeholder="Cardholder Name" required="required" name="name">
					</div>
                    <div class="form-group">
						<input type="text" class="form-control" placeholder="Expiry" required="required" name="expiry">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="CVV" required="required" name="cvv" maxlength="7">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Pay</button>
					</div>
				 
					
			<?php echo form_close(); ?>
	</div>
</div>

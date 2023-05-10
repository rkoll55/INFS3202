<h2 align="center" style="margin-top: 10px;"> Update Profile </h2>
</br>
<h5 style="margin-left: 10px;">
<?php
    if(isset($error)){
        echo("Password is Incorrect");
    }
?>
</h5>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
        <h4 style="text-align: center;"> Update Username </h4>
        <?php echo form_open(base_url().'update_username'); ?>
            <div class="form-group">
			    <input type="text" class="form-control" placeholder="New Username" required="required" name="username">
			</div>
            <div class="form-group">
				<input type="password" class="form-control" placeholder="Password" required="required" name="password">
			</div>
            <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Update</button>
            </div>
        <?php echo form_close(); ?>
    </div>
    <div class="col-sm-4">
        <h4 style="text-align: center;"> Update Password </h4>
        <?php echo form_open(base_url().'update_password'); ?>
            <div class="form-group">
			    <input type="password" class="form-control" placeholder="New Password" required="required" name="newPassword">
			</div>
            <div class="form-group">
				<input type="password" class="form-control" placeholder="Old Password" required="required" name="password">
			</div>
            <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Update</button>
            </div>
        <?php echo form_close(); ?>
    </div>
    <div class="col-sm-2"></div>    
</div>
</br>
<div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
    <h4 style="text-align: center;"> Update Email </h4>
        <?php echo form_open(base_url().'update_email'); ?>
            <div class="form-group">
			    <input type="email" class="form-control" placeholder="New Email" required="required" name="email">
			</div>
            <div class="form-group">
				<input type="password" class="form-control" placeholder="Password" required="required" name="password">
			</div>
            <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Update</button>
            </div>
        <?php echo form_close(); ?>
    </div>
    <div class="col-sm-4">
    </div>
</div>
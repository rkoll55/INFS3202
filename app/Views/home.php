<?php if ($verified == 0) { ?>
    <a type="button" class="btn btn-link text-left" style="border-left: 50px; position: relative; left: 50px;" href="<?php echo base_url('/verify_email') ?>">Email Not verified, fix here</a>
<?php } ?>
<?php if ($verified == 2) { ?>
    <a style="border-left: 50px; position: relative; left: 50px;">Check your email for verification link</a>
<?php } ?>
<h2 align="center" style="margin-top: 10px;"> Pick a Subject! </h2>
<div class="row">
    <?php foreach ($subjects as $row){ ?>
        <div class="col-sm-3">
            <a href="<?php 
            echo base_url('main/'.$row->id) ?>" style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h5><?php echo $row->name ?></h5>
                    </div>
                    <div class="card-block">
                        <p>"<?php echo $row->description ?>"
                        </p>
                    </div>
                    </div>
                </div>
            </a>
        </div>
    <?php }; ?>
</div>
<h4 align="center" style="margin-top: 10px;"> Your Questions! </h4>
<div class="row">
    <?php foreach ($questions as $row){ ?>
        <div class="col-sm-3">
                <div class="card">
                <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h5><?php echo $row->title ?></h5>
                    </div>
                    <div class="card-block">
                        <p>"<?php echo $row->description ?>"
                        </p>
                    </div>
                </div>
                </div>
        </div>
    <?php }; ?>
</div>

<h4 align="center" style="margin-top: 10px;"> Your Bookmarked Questions </h4>
<div class="row">
    <?php foreach ($bookmarks as $row){ ?>
        <div class="col-sm-3">
        <a href="<?php 
            echo base_url('unbookmark/'.$row->questionId) ?>" style="text-decoration:none; color: black;">
                <div class="card">
                <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h5><?php echo $row->title ?></h5>
                    </div>
                    <div class="card-block">
                        <p>"<?php echo $row->description ?>"
                        </p>
                    </div>
                </div>
                </div>
        </div>
    <?php }; ?>
</div>


<div class="row">
<div class="col-md-10">

<div id="postPopup" class="popup" style="border: 1px solid black;">
    <div class="row">
        <div class = "col-10 text-left">
            </br>
            <h2 class="d-inline-block">Add a Subject</h2>
        </div>
        <div class = "col-2 text-right">
        <a type="button" id="closePopButton" class="btn btn-light btn-block text-right">x</a>
        </div>
    </div>
    <?php echo form_open(base_url().'new_subject'); ?>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Subject Name" required="required" maxlength="8" name="name">
        </div>
        <div class="form-group">
            <textarea class="form-control" style = "height: 100px;" placeholder="Subject Description" required="required" name="description"></textarea>
        </div>
        <button type="submit" id="submitButton" class="btn btn-success btn-block text-center">Submit</button>
    <?php echo form_close(); ?>
                                
</div>
<?php if ($staff == 1) {?>
<a type="button" id="postButton" class="btn btn-success text-left" style="border-left: 50px; position: relative; left: 60px;">Add Course</a>
<?php }?>
    </div>
<a type="button" class="btn btn-success text-left" style="border-left: 50px; position: relative; left: 60px;" href="<?php echo base_url('/update_profile') ?>">Profile Settings</a>

</div>

<script>
        var postButton = document.getElementById('postButton');
        var postPopup = document.getElementById('postPopup');
        var closePopup = document.getElementById('closePopButton');

        postButton.addEventListener('click', function(){
            postPopup.style.display = 'block';
        });

        closePopup.addEventListener('click', function(){
            postPopup.style.display = 'none';
        });
</script>
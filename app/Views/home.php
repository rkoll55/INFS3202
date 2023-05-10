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
<div class="row">
<div class="col-md-10">

<a type="button" class="btn btn-success text-left" style="border-left: 50px; position: relative; left: 60px;" href="<?php echo base_url('/update_profile') ?>">Add Course</a>
    </div>
<a type="button" class="btn btn-success text-left" style="border-left: 50px; position: relative; left: 60px;" href="<?php echo base_url('/update_profile') ?>">Profile Settings</a>

</div>
<div class="row">
    <div class="col-md-2" style="padding-left:2.5rem">
        <h5 class="mt-4">Manage</h5>
        <hr>
        <hr style="border-right: 1px solid #dee2e6; position: absolute; top: 0; bottom: 0; right: 0; height: 100%;">
        <a type="button" class="btn btn-light btn-block text-left" href="<?php 
            echo base_url() ?>">Home</a>
        <a type="button" class="btn btn-light btn-block text-left" href="<?php 
            echo base_url('/donate') ?>">Donate To Us</a>
    </div>
    <div class="col-md-10">
        <div class="row" align="center" style="justify-content: center;">
            <h1 align="center" style="padding-top:10px; padding-right:60px">Statistics</h1>
        </div>
        <?php if (isset($none)) { ?>
            <h3> No Statistical Data, Page has not been interacted with yet </h3>
        <?php } else { ?>
        <div class="row">

        <div class="col-sm-3">
            <a style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h6>Total Traffic</h6>
                    </div>
                    <div class="card-block">
                        <p style="text-align:center;"><?php echo $traffic ?> Clicks</p>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h6>Number of Users</h6>
                    </div>
                    <div class="card-block">
                        <p style="text-align:center;"><?php echo $num_users ?></p>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h6>Number of Questions</h6>
                    </div>
                    <div class="card-block">
                        <p style="text-align:center;"><?php echo $num_questions ?></p>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h6>Most Active User</h6>
                    </div>
                    <div class="card-block">
                        <p style="text-align:center;"><?php echo $most_active_user ?></p>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h6>Most Active Question</h6>
                    </div>
                    <div class="card-block">
                        <p style="text-align:center;">"<?php echo $most_active_question ?>"</p>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h6>Number of Interactions in Last Week</h6>
                    </div>
                    <div class="card-block">
                        <p style="text-align:center;"><?php echo $last_seven_days ?> Clicks</p>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-3">
            <a style="text-decoration:none; color: black;">
                <div class="card">
                    <div style="border: 1px solid #dee2e6;">
                    <div class="card-header">
                        <h6>Number of Interactions in Last Day</h6>
                    </div>
                    <div class="card-block">
                        <p style="text-align:center;"><?php echo $last_day ?> Clicks</p>
                    </div>
                    </div>
                </div>
            </a>
        </div>  
        </div>
        <?php } ?>
        <a href="<?php echo base_url() ?>download" style="padding-left: 50px">Download Statistics</a>
    </div>
    
</div>

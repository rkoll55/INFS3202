<div class="row">
    <?php foreach ($subjects as $row){ ?>
            <div class="col-sm-3">
            <a href="<?php 
            echo base_url('main/'.$row->id) ?>">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo $row->name ?></h5>
                    </div>
                    <div class="card-block">
                        <p>"<?php echo $row->description ?>"
                        </p>
                    </div>
                </div>
        </div>
    <?php }; ?>
</div>
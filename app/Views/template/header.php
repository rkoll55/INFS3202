<html>

<head>
    <title>Learniply</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>

<body>
    <script>
        // Show select image using file input.
        function readURL(input) {
            $('#default_img').show();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#select')
                        .attr('src', e.target.result)
                        .width(300)
                        .height(200);

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="col-md-3">
        <a class="navbar-brand" href="#">Learniply Board</a>
    </div>

    <div class="col-md-7">
        
            <?php
            if(isset($search)){ 
            ?>
			<?php echo form_open(base_url().'main/search'); ?>
            <div class="row">
            
                <div class="col-md-10">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="width: 100%;" name = "query">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
            <?php echo form_close(); ?>
            <?php
                }
            ?>

    </div>
        
    <div class="col-md-2">

        <ul class="nav">    
            <li class="nav-item ml-auto">   
            <?php if (session()->get('username')) { ?>
                <a class="mx-4" href="<?php echo base_url(); ?>login/logout"> Logout </a>
            <?php } else { ?>
                <a class="mx-4" href="<?php echo base_url(); ?>login"> Login </a>
            <?php } ?>
            </li>
        </u1>
    </div>
</div>
</nav>

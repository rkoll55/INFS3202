<!DOCTYPE html>
<html lang="en">
<script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>

<body>
    <div class ="container-fluid">
        <div class ="row">
            <div class="col-md-2">
                <h5 class="mt-4">Manage</h5>
                <hr>
                <hr style="border-right: 1px solid #dee2e6; position: absolute; top: 0; bottom: 0; right: 0; height: 100%;">
                <a type="button" id="postButton" class="btn btn-light btn-block text-left">Make Post</a>
                <a type="button"  class="btn btn-light btn-block text-left" href="<?php 
                    echo base_url() ?>">Home</a>

                <?php if(isset($back)){ ?>
                <a type="button"  class="btn btn-light btn-block text-left" href="<?php 
                    echo base_url('/login') ?>">Back</a>
                <?php } ?>
                </br>
                <a type="button"  class="btn btn-light btn-block text-left" href="<?php 
                    echo base_url('/donate') ?>">Donate To Us</a>
                <?php if(isset($staff)) { 
                    if ($staff == 1){ ?>
                <a type="button"  class="btn btn-light btn-block text-left" href="<?php 
                    echo base_url('/stats') ?>">Page Statistics</a>
                    <?php } 
                    } ?>
            </div>
            
            <div class="col-md-10">
                <div class="col-sm-12">
                    <h5 class="mt-4">Questions</h5>
                    <hr>
                    <!-- bootstrap source Datta Able Free Bootstrap 4 Admin Template
                            https://github.com/codedthemes/datta-able-bootstrap-dashboard -->
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php
                                if(isset($questions)){
                                    foreach ($questions as $pill){?>
                                    <li><a class="nav-link text-left" data-toggle = "pill" id="v-pills-<?php echo $pill->id; ?>" href="#v-tabs-<?php echo $pill->id; ?>" 
                                    role="tab" aria-controls="<?php echo($pill->id); ?>" style="outline: 2px solid #007bff;"  aria-selected="false"><?php echo($pill->title); ?></a></li>
                                    </br>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        </div>
                        <div class="col-md-9 col-sm-12" style="background-color: #f2f2f2; height: 100vh;"> 
                            <div class="tab-content" id="v-pills-tabContent">
                                <?php
                                    if(isset($questions)){
                                        foreach ($questions as $pill){
                                        ?>
                                            <div class="tab-pane fade" id="v-tabs-<?php echo $pill->id; ?>" role="tab" aria-labelledby="<?php echo($pill->id); ?>-tab">
                                                <div style="text-align:left;">
                                                    <div class = "answer-container" style="margin-top: 30px; padding-bottom: 20px">
                                                    <div class = row style= "padding-left: 50px">
                                                        <div class = col-md-9>

                                                            <h4 class="mt-4"><?php echo($pill->title); ?></h4>
                                                        </div>
                                                        <?php echo form_open(base_url().'main/bookmark'); ?>
                                                        <input type="hidden" name="question_id" value="<?php echo $pill->id ?>">
                                                        <button type="submit" class="btn btn-light text-center" style="width: 150px; margin-top: 20px; margin-right: 20px;">Bookmark</button>
                                                         <?php echo form_close()?>
                                                        
                                                     </div>
                                                            </br>
                                                        <div style="margin-left: 40px; margin-right: 40px;">
                                                            <?php echo($pill->description); ?>
                                                            
                                                            <?php 
                                                            $main = new \App\Controllers\Main();
                                                            $files = $main->get_files($pill->id);
                                                            echo "</br>";
                                                            echo "</br>";
                                                            
                                                            foreach($files as $file){ 
                                                                $filename = $file->name;
                                                                 echo anchor(base_url('writable/uploads/'.$filename)); 
                                                                 echo "</br>";
                                                            }
                                                            ?>

                                                        </div>
                                                        </br>
                                                    </div>
                                                </div>
                                                <hr class="my-4 bg-default"> 
                                                <h5 class="mt-4">Answers:</h5>

                                                <?php 
                                                $main = new \App\Controllers\Main();
                                                $answers = $main->get_answers($pill->id);
                                                foreach($answers as $answer){ ?>
                                                    <div class = "answer-container" style = "margin-top: 10px">
                                                        <div style = "margin-top: 15px; padding-bottom: 15px; margin-right: 15px; margin-left: 15px" >
                                                            <?php echo $answer->description; ?>
                                                            </br>                                                        </div>
                                                    </div>
                                                    <?php if(isset($staff)) { 
                                                        if ($staff == 1){
                                                            echo form_open(base_url().'main/endorse');
                                                            if ($answer->likes > 0){
                                                         ?>
                                                        <button type="submit" id="endorseButton_<?php echo $answer->id; ?>" class="btn btn-success text-center" style="width: 150px;">Un-Endorse</button>
                                                        <?php } else {
                                                            ?><button type="submit" id="endorseButton_<?php echo $answer->id; ?>" class="btn btn-secondary text-center" style="width: 150px;">Endorse</button>

                                                        <?php }  ?>
                                                        <input type="hidden" name="answerId" value="<?php echo $answer->id; ?>" />
                                                        <input type="hidden" name="answerLikes" value="<?php echo $answer->likes; ?>" />

                                                    <?php
                                                            echo form_close();
                                                    }
                                                  }
                                                }
                                                ?>


                                                </br></br>
                                                <div class = "answer_section">
                                                    <h5 class="d-inline-block"> Answer this Question</h5>
                                                    <form id="submitAnswer_<?php echo $pill->id; ?>">
                                                        <div class="form-group">
                                                            <textarea class="form-control" style = "height: 100px;" placeholder="Your Answer" required="required" name="user_answer"></textarea>
                                                        </div>        
                                                        <input type="hidden" name="question_id" value= "<?php echo $pill->id; ?>">
                                                        <button type="submit" id="answerButton_<?php echo $pill->id; ?>" class="btn btn-primary btn-block text-center" style="width: 150px;">Post</button>
                                                    </form>
                                                </div>
                                            </div>                                    
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div id="postPopup" class="popup" style="border: 1px solid black;">
                                <div class="row">
                                    <div class = "col-10 text-left">
                                        </br>
                                        <h2 class="d-inline-block">Make a Post</h2>
                                    </div>
                                    <div class = "col-2 text-right">
                                    <a type="button" id="closePopButton" class="btn btn-light btn-block text-right">x</a>
                                    </div>
                                </div>
                                <?php echo form_open_multipart('', array('id' =>'submitPost')); ?>
                                    <div class="form-group">
						                <input type="text" class="form-control" placeholder="Title (max 30 characters)" required="required" maxlength="30" name="title">
					                </div>
                                    <div class="form-group">
						                <textarea class="form-control" style = "height: 150px;" placeholder="Describe the problem here" required="required" name="description"></textarea>
					                </div>
                                    <div id="fileUpload" class="form-group" style="display: flex; align-items: center; border: 2px dashed #ccc; padding: 20px; cursor: pointer;" ondrop="dropHandler(event);"
                                        ondragover="dragOverHandler(event);">
                                        <p style="text-align: center"> Drag and Drop </p>
                                    </div>
                                    <div class="form-group" style="text-align: left">
                                        <p> Files must not exceed 1Mb in size</p>
                                    </div>
                
                                    <button type="submit" id="submitButton" class="btn btn-success btn-block text-center">Submit</button>
                                <?php echo form_close(); ?>
                                
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <script>

        var postButton = document.getElementById('postButton');
        var postPopup = document.getElementById('postPopup');
        var closePopup = document.getElementById('closePopButton');
        var submitPopup = document.getElementById('submitButton');
        let fileUpload = document.getElementById('fileUpload');
        var FilesData = new FormData();

        document.addEventListener('DOMContentLoaded', () => {
            const activeTabId = localStorage.getItem('activeTab');
            if (activeTabId) {
                const activeTab = document.querySelector(`[id^="v-pills-${activeTabId}"]`);
                if (activeTab) {
                    activeTab.click();
                }
            }
        });

        postButton.addEventListener('click', function(){
            postPopup.style.display = 'block';
        });


        submitPopup.addEventListener('click', function(event){

            event.preventDefault();
            var form = document.getElementById('submitPost');
            var formData = new FormData(form);
            formData.append('subject',<?php echo $subject?>);

            console.log("here");

            if (typeof FilesData !== 'undefined') {
                console.log("there");

             for (const [name, value] of FilesData.entries()) {
                formData.append('userfiles[]', value);
                console.log("done");
                }
            } 

            var request = new XMLHttpRequest();

            request.open('POST', '<?php echo base_url('main/submit_form'); ?>/ajax',true)

            request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            
            request.send(formData);

            postPopup.style.display = 'none';
            
        });


        <?php
            if(isset($questions)){
                foreach ($questions as $pill){
        ?>

        document.getElementById('v-pills-<?php echo $pill->id; ?>').addEventListener('click', function(event){
            localStorage.setItem('activeTab', <?php echo $pill->id; ?>);

            var formData = new FormData();
            formData.append('question', '<?php echo $pill->id; ?>');


            var request = new XMLHttpRequest();

            request.open('POST', '<?php echo base_url('main/boost'); ?>/ajax',true)
            request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');           
            request.send(formData);
        });

        document.getElementById('answerButton_<?php echo $pill->id ?>').addEventListener('click', function(event){

            event.preventDefault();
            
            var form = document.getElementById('submitAnswer_<?php echo $pill->id ?>');
            var formData = new FormData(form);

            var request = new XMLHttpRequest();

            request.open('POST', '<?php echo base_url('main/answer_question'); ?>/ajax',true)
            request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');           
            request.send(formData);

            document.getElementById('submitAnswer_<?php echo $pill->id ?>').reset();

        });

        <?php
                }
            }
        ?>

        closePopup.addEventListener('click', function(){
            postPopup.style.display = 'none';
        });


        function dropHandler(ev) {

            console.log("File(s) dropped");
            ev.preventDefault();
            const files = ev.dataTransfer.items ? [...ev.dataTransfer.items].map(item => item.getAsFile()) : [...ev.dataTransfer.files];
            
            files.forEach((file, i) => {
                FilesData.append(`file_${i}`, file);
                console.log("uploaded");
            });
            fileUpload.style.borderColor = "green";
        }

        function dragOverHandler(ev) {
            console.log("File(s) in drop zone");
            ev.preventDefault();
        }


    </script>
</body>
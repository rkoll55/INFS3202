<!DOCTYPE html>
<html lang="en">

<body>
    <div class ="container-fluid">
        <div class ="row">
            <div class="col-md-2">
                <!-- This is the new column added to the left -->
                <h5 class="mt-4">Settings</h5>
                <hr>
                <p>Content of the settings stuff go here.</p>
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
                                    <li><a class="nav-link text-left" data-toggle = "pill" id="v-pills-<?php echo $pill['id']; ?>" href="#v-tabs-<?php echo $pill['id']; ?>" 
                                    role="tab" aria-controls="<?php echo($pill['id']); ?>"  aria-selected="false"><?php echo($pill['title']); ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="tab-content" id="v-pills-tabContent">
                                <?php
                                    if(isset($questions)){
                                        foreach ($questions as $pill){
                                        ?>
                                            <div class="tab-pane fade" id="v-tabs-<?php echo $pill['id']; ?>" role="tab" aria-labelledby="<?php echo($pill['id']); ?>-tab">
                                            <?php echo($pill['content']); ?>
                                            </div>                                    
                                        <?php
                                    }
                                }
                                ?>
                                
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <p class="mb-0">Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint minim consectetur qui.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <p class="mb-0">Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <p class="mb-0">Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</body>
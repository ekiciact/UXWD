<?= $this->extend('common') ?>

<?= $this->section('body') ?>

<div class="create_placeholder z-depth-3">
    <div class="cropsnapp_placeholder">
        <span class="text"><?php echo lang('Lang.create_snapp.upload');?></span>
    </div>
    <div id="cropsnapp"></div>

    <div class="button_placeholder">
        <label for="upload">
            <div class="btn-floating btn-large waves-effect waves-light photo_button pulse" >
                <i class="material-icons">camera_alt</i>
            </div>
        </label>
        <input class="hide" type="file" id="upload" value="Choose a file" accept="image/*" />

        <div class="btn-floating btn-large waves-effect waves-light confirm_button" id="send" href="#create_snapp_modal">
            <i class="material-icons confirm_loader">send</i>
        </div>
    </div>
</div>

<!--Modal-->
<div id="create_snapp_modal">
    <div class="modal-content hide">
        <!--Navbar replacement-->
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="#"class="close-create_snapp_modal waves-effect"><i class="material-icons">close</i></a>

                </div>
            </nav>
        </div>

        <div class="modal-no-nav" style="margin-bottom: 70px">

            <ul class="stepper linear">
                <!--Part1: write title-->
                <li class="step active">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_snapp.title');?></div>
                    <div class="step-content">
                        <div class="input-field title_field">
                            <input id="snapp_title" type="text" class="validate" required>
                            <label for="snapp_title"><?php echo lang('Lang.create_snapp.w_title');?></label>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_snapp.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part1-->
                <!--Part2: Identify snapp-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_snapp.identify');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <div class="imageselector_container">
                            <div class="imageselector_loader preloader-wrapper small active">
                                <div class="spinner-layer spinner-green-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div><div class="gap-patch">
                                        <div class="circle"></div>
                                    </div><div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="imageselector hide">
                                <img src="https://picsum.photos/300/400" class="snapp" alt="">
                                <div class="suggestions">
                                    <div class="suggestion suggestion1 z-depth-3">
                                        <a href="#" id="suggestion1" class="suggestion_link waves-effect waves-circle"></a>
                                        <img src="https://picsum.photos/200" class="circle waves-effect" alt="">
                                    </div>
                                    <div class="suggestion suggestion2 z-depth-3">
                                        <a href="#" id="suggestion2" class="suggestion_link waves-effect waves-circle"></a>
                                        <img src="https://picsum.photos/201" class="circle" alt="">
                                    </div>
                                    <div class="suggestion suggestion3 z-depth-3">
                                        <a href="#" id="suggestion3" class="suggestion_link waves-effect waves-circle"></a>
                                        <img src="https://picsum.photos/202" class="circle" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="plant_name_wrapper">
                                <span id="plant_percentage"><div class="number_wrapper">  <div class="number">0%</div>  <div class="number_small_text"><?php echo lang('Lang.create_snapp.accuracy');?></div> </div></span>
                                <h4 id="plant_name"><?php echo lang('Lang.create_snapp.identify_plant');?></h4>
                        </span>
                        <div class="step-actions">
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_snapp.next');?></button>
                        </div>
                    </div>
                </li>

                <!--End part2-->
                <!--Part3: adding info-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_snapp.add_info');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <a class="waves-effect waves-light btn" id="add_info"><i class="material-icons left">info</i><?php echo lang('Lang.create_snapp.get_info');?></a>
                        <div class="input-field description_field">
                            <textarea id="description_area" class="materialize-textarea"></textarea>
                            <label for="description_area"><?php echo lang('Lang.create_snapp.description');?></label>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_snapp.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part3-->
                <!--Part4: adding location-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_snapp.add_location');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <div class="create_snapp_map_wrapper">
                            <div id="create_snapp_map"></div>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <!--saving your snapp-->
                            <a id="save_snapp" class="waves-effect waves-light btn"><i class="material-icons left">save</i><?php echo lang('Lang.create_snapp.save');?></a>
                        </div>
                    </div>
                </li>
                <!--End part4-->
            </ul>
        </div>
    </div>
</div>
<!--End Modal-->


<?= $this->endSection() ?>


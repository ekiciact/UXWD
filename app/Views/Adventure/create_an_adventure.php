<?= $this->extend('common') ?>


<?= $this->section('body') ?>

<!-- General Info -->
<div class="container">

    <div class="row">
        <div class="create_header_wrapper">
            <div class="create_header_number">1</div>
            <div class="create_header_text"><?php echo lang('Lang.create_adventure.gen_info');?></div>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">directions_walk</i>
            <input type="text" name="title_adv" id="title_adv" class="materialize-textarea" value="<?= $title ?>">
            <label for="title_adv"><?php echo lang('Lang.create_adventure.adv_title');?></label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <textarea id="textarea_description" class="materialize-textarea"> <?= $description ?> </textarea>
            <label for="textarea_description"><?php echo lang('Lang.create_adventure.description');?></label>
        </div>
    </div>


</div>

<!-- Adding points to adventure-->
<div class="container">
    <div class="row">
        <div class="create_header_wrapper">
            <div class="create_header_number">2</div>
            <div class="create_header_text"><?php echo lang('Lang.create_adventure.header_text');?></div>
        </div>
    </div>
</div>

<!-- Tabs -->
<ul class="tabs">
    <li class="tab col s4"><a class="active" href="#listview"><i class="material-icons">list</i>List</a></li>
    <li class="tab col s4"><a href="#mapview"><i class="material-icons">map</i>Map</a></li>
</ul>
<!-- Tab Views -->

    <!-- List Tab View -->
    <div id="listview" class="listview">
        <div id="list-container">
            <div class="col s12 m7">
                <div href="javascript:void(0)" class="card horizontal find_snapp_card">
                    <a href="javascript:void(0)" class="find_snapp_link waves-effect"></a>
                    <div class="card-image">
                        <!-- Picture should be of ratio 3:4 -->
                        <img class="find_snapp_list_image" src="https://picsum.photos/300/400">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <span class="card-title"><?php echo lang('Lang.create_adventure.card_title');?></span>
                            <p class="snapp_descripiton"><?php echo lang('Lang.create_adventure.snapp_descripiton');?></p>
                        </div>
                        <div class="card-action">
                            <div class="chip">0km</div>
                            <div>
                                <a href='javascript:void(0)'> <i class="material-icons">share</i> </a>
                                <a href='javascript:void(0)'> <i class="material-icons card-favorite">favorite_border</i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Tab View -->
    <div id="mapview">
    <div id="overviewMap"></div>
</div>
<!-- End Tab Views -->

<!-- Add Button -->
<div class="addButtonContainer">

    <div class="fixed-action-btn center-align">
        <a class="btn-floating btn-large">
            <i class="large material-icons">add</i>
        </a>
        <ul>

            <li><a id="makeSnappLink" href="#makeSnappModal" class="btn-floating option"><?php echo lang('Lang.create_adventure.makeSnappLink');?></a></li>
            <li><a id="chooseSnappLink" href="#chooseSnappModal" class="btn-floating option"><?php echo lang('Lang.create_adventure.chooseSnappLink');?></a>
            </li>
            <li><a id="simpleLocationLink" href="#simpleLocationModal" class="btn-floating option"><?php echo lang('Lang.create_adventure.simpleLocationLink');?></a></li>
        </ul>
    </div>

</div>

<!-- Save Button -->
<div class="container">
    <div class="row right-align">
        <!--saving your adventure-->
        <a id="save_adventure" class="waves-effect grey lighten-1 btn"><i class="material-icons left">save</i><?php echo lang('Lang.create_adventure.save');?></a>
        <a id="submit_adventure" class="waves-effect waves-light btn"><?php echo lang('Lang.create_adventure.publish');?><i
                    class="material-icons right">send</i></a>

    </div>
</div>


<!---------------------->
<!------- Modals ------->
<!---------------------->

<!-- Take a Snapp modal -->
<div id="makeSnappModal">
    <input class="hide" type="file" id="uploadSnappModal" value="Choose a file" accept="image/*"/>
    <div class="modal-content">
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="#" class="close-makeSnappModal modal-close-nav waves-effect"><i class="material-icons">close</i></a>
                </div>
            </nav>
        </div>
        <div class="modal-no-nav">

            <!-- modal content here -->
            <ul class="stepperMake stepper">
                <!--Part1: crop picture-->
                <li class="step active">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.crop_snapp');?></div>
                    <div class="step-content">
                        <!-- step 1 content here :)-->

                        <div id="cropsnapp" style="height: 300px"></div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step next-croppie"><?php echo lang('Lang.create_adventure.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part1-->

                <!--Part2: write title-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.title');?></div>
                    <div class="step-content">
                        <div class="input-field title_field">
                            <input id="adv_loc_title" type="text" class="validate" required>
                            <label for="adv_loc_title"><?php echo lang('Lang.create_adventure.w_title');?></label>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_adventure.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part2-->

                <!--Part3: Identify snapp-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.identify_snapp');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <div class="imageselector_container">
                            <div class="imageselector_loader preloader-wrapper small active">
                                <div class="spinner-layer spinner-green-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="imageselector hide">
                                <img src="https://picsum.photos/300/400" class="snapp" alt="">
                                <div class="suggestions">
                                    <div class="suggestion suggestion1 z-depth-3">
                                        <a href="#" id="suggestion1"
                                           class="suggestion_link waves-effect waves-circle"></a>
                                        <img src="https://picsum.photos/200" class="circle waves-effect" alt="">
                                    </div>
                                    <div class="suggestion suggestion2 z-depth-3">
                                        <a href="#" id="suggestion2"
                                           class="suggestion_link waves-effect waves-circle"></a>
                                        <img src="https://picsum.photos/201" class="circle" alt="">
                                    </div>
                                    <div class="suggestion suggestion3 z-depth-3">
                                        <a href="#" id="suggestion3"
                                           class="suggestion_link waves-effect waves-circle"></a>
                                        <img src="https://picsum.photos/202" class="circle" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="plant_name_wrapper">
                                <span id="plant_percentage"><div class="number_wrapper">  <div class="number">0%</div>  <div
                                                class="number_small_text"><?php echo lang('Lang.create_adventure.accuracy');?></div> </div></span>
                                <h4 id="plant_name"><?php echo lang('Lang.create_adventure.plant_name');?></h4>
                            </span>
                        <div class="step-actions">
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_adventure.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part3-->

                <!--Part4: adding info-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.add_info');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <a class="waves-effect waves-light btn" id="add_info"><i class="material-icons left">info</i><?php echo lang('Lang.create_adventure.get_info');?></a>
                        <div class="input-field description_field">
                            <textarea id="description_area" class="materialize-textarea"></textarea>
                            <label for="description_area"><?php echo lang('Lang.create_adventure.description');?></label>
                        </div>
                        <div class="row s6">
                            <div id="btnStart"
                                 class="btn-floating btn-large waves-effect waves-light">
                                <i class="material-icons">mic</i>
                            </div>

                            <div id="btnStop"
                                 class="hide btn-floating btn-large waves-effect waves-light red pulse">
                                <i class="large material-icons">stop</i>
                            </div>
                        </div>
                        <audio class="hide" id="voice" controls></audio>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_adventure.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part4-->

                <!--Part5: adding location-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.add_location');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <div class="create_snapp_map_wrapper">
                            <div id="create_snapp_map"></div>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <!--saving your snapp-->
                            <a id="addLocation" class="waves-effect waves-light btn"><i
                                        class="material-icons left">save</i><?php echo lang('Lang.create_adventure.save');?></a>

                        </div>
                    </div>
                </li>
                <!--End part5-->
            </ul>
            <!-- end modal content -->

        </div>
    </div>
</div>

<!-- Add existing Snapp modal -->
<div id="chooseSnappModal">
    <div class="modal-content">
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="#" class="close-chooseSnappModal modal-close-nav waves-effect"><i class="material-icons">close</i></a>
                </div>
            </nav>
        </div>
        <div class="modal-no-nav">
            <div id="addExistingSnappModal"></div>
            <!-- Modal content-->
            <!-- End Modal content-->

        </div>
    </div>
</div>

<!-- Add location modal -->
<div id="simpleLocationModal">
    <div class="modal-content">
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="#" class="close-simpleLocationModal modal-close-nav waves-effect"><i
                                class="material-icons">close</i></a>
                </div>
            </nav>
        </div>
        <div class="modal-no-nav">
            <p><?php echo lang('Lang.create_adventure.coming_soon');?></p>

            <div class="modal-footer">
                <div class="center-align">
                    <button class="btn waves-effect waves-light btn close-simpleLocationModal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>


<?= $this->section('script') ?>

<script>
function initExistingSnapp() {
    $("#addExistingSnappModal").html(`
    <h4 class="center-align"> Collections </h4>

    <div class="parent center-align">
    <?php foreach ($collection as $collec): ?>

        <div class="child">
            <div class="col s5 m6 l12 offset-s1">
                <a class="waves-effect" onclick="openCollection(<?=$collec->id_collection?>)">
                    <img class="responsive-img" src="<?=$collec->collectionPicture?>" width="80" height="80"/>
                </a>
                <h6>  <?=$collec->collectionName?> </h6>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    `);
}

function snappChosen_add_html(snapp){
    console.log("testtext")
    $("#addExistingSnappModal").html(`
    <ul class="stepperSelect stepper">
                <!--Part1: write title-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.title');?></div>
                    <div class="step-content">
                        <div class="input-field title_field">
                            <input id="adv_loc_title2" type="text" class="validate" required>
                            <label for="adv_loc_title2"><?php echo lang('Lang.create_adventure.w_title');?></label>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_adventure.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part1-->


                <!--Part2: adding info-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.add_info');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <div class="input-field description_field">
                            <textarea id="description_area2" class="materialize-textarea" ></textarea>
                            <label for="description_area2"><?php echo lang('Lang.create_adventure.description');?></label>
                        </div>
                        <div class="row s6">
                            <div id="btnStart2"
                                 class="btn-floating btn-large waves-effect waves-light">
                                <i class="material-icons">mic</i>
                            </div>

                            <div id="btnStop2"
                                 class="hide btn-floating btn-large waves-effect waves-light red pulse">
                                <i class="large material-icons">stop</i>
                            </div>
                        </div>
                        <audio class="hide" id="voice2" controls></audio>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <button class="waves-effect waves-dark btn next-step"><?php echo lang('Lang.create_adventure.next');?></button>
                        </div>
                    </div>
                </li>
                <!--End part2-->
                
                <!--Part3: adding location-->
                <li class="step">
                    <div class="step-title waves-effect"><?php echo lang('Lang.create_adventure.add_location');?></div>
                    <div class="step-content">
                        <!-- Your step content goes here (like inputs or so) -->
                        <div class="create_snapp_map_wrapper">
                            <div id="choose_snapp_map"></div>
                        </div>
                        <div class="step-actions">
                            <!-- Here goes your actions buttons -->
                            <!--saving your snapp-->
                            <a id="addLocation2" class="waves-effect waves-light btn"><i
                                        class="material-icons left">save</i><?php echo lang('Lang.create_adventure.save');?></a>

                        </div>
                    </div>
                </li>
                <!--End part3-->
            </ul>
            `);
}
</script>

<?= $this->endSection() ?>

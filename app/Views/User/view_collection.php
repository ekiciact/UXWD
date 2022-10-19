<?= $this->extend('common') ?>

<?= $this->section('body') ?>
<div class="container left-align">
    <h3><?php echo $collname->collectionName; ?></h3>
    <div class="container left-align">
            <?php if( $page_title === 'View SNapp Collection'): ?>
            <div>
                <!-- View all the snapps inside the selected collection -->

                <?php foreach ($collectionElements as $el): ?>
                    <div class="col s12 m7">
                        <div href="#" class="card horizontal find_snapp_card">
                                <a href="<?=base_url()?>/snapp/view/<?= $el->id_snapp ?>" class="find_snapp_link waves-effect"></a>
                            
                            <div class="card-image">
                                <!-- Picture should be of ratio 3:4 -->
                                    <img class="find_snapp_list_image" src="<?= $el->pic ?>">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <span class="card-title"><?= $el->title ?></span>
                                        <p class="snapp_descripiton"><?= $el->snappNotes ?></p>
                                </div>
                                <div class="card-action">
                                    <div>
                                            <button data-target="<?=$el->id_snapp?>" class="btn modal-trigger"> <i class="large material-icons">delete</i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Structure for each delete button there is modal that will pop up, the modal trigger is on line 28 -->
                    <form method="post" >
                            <div id="<?=$el->id_snapp?>" class="modal">
                                <div class="modal-content">
                                    <h4><?php echo lang('Lang.view_col.sure');?></h4>
                                    <input type="hidden" name="snapp_id" readonly="readonly" value="<?=$el->id_snapp?>">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="YES" class="btn btn-small">
                                    <a class="waves-effect waves-light btn-small">NO</a>
                                </div>
                            </div>
                    </form>
                <?php endforeach; ?>
            </div>
                <?php endif; ?>



            <?php if( $page_title !== 'View SNapp Collection'): ?>

            <div id="list-container" class="">

                <div class="col s12 center-align">
                    <div class="preloader-wrapper big active">
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
                </div>
            </div>

            <?php endif; ?>

    </div>    
</div>  
<?= $this->endSection() ?>

<?php if( $page_title !== 'View SNapp Collection'): ?>

    <?= $this->section('script') ?>

    <script>
        $(function () {
            $.get(`${base_url}/user/view_adventure_collection_json/<?= $coll_id ?>`).done(function (response) {
                let htmlList = "";
                console.log(response);
                JSON.parse(response).forEach(function (item, index) {
                    htmlList += `<div class="col s12 m7">
    <div href="#" class="card horizontal find_snapp_card">
        <a href="${base_url}/snapp/view_adv/${item.id_adv}" class="find_snapp_link waves-effect"></a>
        <div class="card-stacked">
            <div class="card-content">
                <span class="card-title">${item.title}</span>
                <p class="snapp_descripiton">${item.description}</p>
                <div class="adv_loc_thumbnail_placeholder">
                `
                    //Inner card
                    totalkm = 0;
                    if (item.locArray.length <= 3) {
                        item.locArray.forEach(function (item) {
                            htmlList += `<img class="adv_loc_thumbnail" src="${item.pic}">`
                            totalkm += parseInt(item.distanceToPrevious);
                        });
                    } else {
                        item.locArray.forEach(function (item) {
                            totalkm += parseInt(item.distanceToPrevious);
                        });
                        htmlList += `<img class="adv_loc_thumbnail" src="${item.locArray[0].pic}">`
                        htmlList += `<img class="adv_loc_thumbnail" src="${item.locArray[1].pic}">`
                        htmlList += `<img class="adv_loc_thumbnail" src="https://hnc.org.au/wp-content/themes/ncphn/img/three-dots.png">`
                    }
                    htmlList += ` <div class="chips_placeholder"> <div class="chip">${item.locArray.length} stops </div> <div class="chip"> total of ${Math.round(totalkm)}km </div></div>`
                    //End inner card
                    htmlList += `</div> </div>

        </div>
    </div>
</div>`;
                });
                $('#list-container').html(htmlList);
            });
        });
    </script>

    <?= $this->endSection() ?>

<?php endif; ?>
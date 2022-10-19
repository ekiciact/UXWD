<div>
<!--    <h6 class="left-align halfway-fab">Popular SNapps: distances from you</h6>-->
    <div id="snappview">
        <h5 class="center-align halfway-fab"><?php echo lang('Lang.db_home.title1');?></h5>
    <?php foreach ($snapp_top as $sna): ?>
        <div class="col s12 m7">
            <div href="#" class="card horizontal find_snapp_card">
                <a href="<?=base_url()?>/Snapp/view/<?=$sna->id_snapp?>" class="find_snapp_link waves-effect"></a>
                <div class="card-image">
                    <!-- Picture should be of ratio 3:4 -->
                    <img class="find_snapp_list_image" src="<?=$sna->pic?>">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                    <span class="card-title">
                        <?=$sna->title?>
                    </span>
                        <p class="snapp_descripiton">
                            <?=$sna->snappNotes?>
                        </p>
                    </div>
                    <div class="card-action">
                        <div class="chip">
                            <?php distance($sna->location_lat,$sna->location_lon,50.8637,4.6758);?>km
                        </div>
                        <div>
                            <a href="javascript:void(0)"> <i data-title="<?=$sna->title?>" data-id="<?=$sna->id_snapp?>" class="material-icons card-share">share</i> </a>
                            <a href="javascript:void(0)">
                                <i data-id="<?=$sna->id_snapp?>" class="material-icons card-favorite">
                                    <?php
                                    $found = 0;
                                    if (isset($array_snapp)){
                                        foreach ($array_snapp as $sna_f)
                                            if ($sna->id_snapp == $sna_f->id_snapp) $found = 1;
                                    }
                                    if($found == 1)
                                        echo "favorite";
//                                        print_r("favorite");
                                    else
                                        echo "favorite_border";
//                                        print_r("favorite_border");
                                    ?>
                                </i>
                                <span class="likes"><?=$sna->like_count?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

<!--    <h6 class="left-align halfway-fab">Popular Adventures: total distances (created date for now)</h6>-->


    <div id="adventureview">
        <h5 class="center-align halfway-fab"><?php echo lang('Lang.db_home.title2');?></h5>

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


    </div>


</div>


<?= $this->section('script') ?>

<script>
    response = <?=$adv_top?>;

        $(function () {

            let htmlList = "";
            response.forEach(function (item, index) {
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
</script>

<?= $this->endSection() ?>



<?php
function distance($lat1, $lon1, $lat2, $lon2)
{
    if(isset($_COOKIE["latitude"])){
        $lat2 = $_COOKIE["latitude"];
        $lon2 = $_COOKIE["longitude"];
    }
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;
    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
//    $km = number_format($r * $c, 2, '.', '');
    $km = number_format($r * $c);
    echo ' '.$km;
//    return $km;
}

?>
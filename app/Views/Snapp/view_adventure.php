<?= $this->extend('common') ?>

<?= $this->section('body') ?>
<style>
    img {
        border-radius: 5%;
    }
    descript
    {
        border-radius: 5%;
    }
</style>

<div class="container center-align">
    <h4 class="halfway-fab"><?=$title?></h4>
</div>
<div class="container">
    <div class="row">
        <div class="column s12">
            <div class="card">
                <div class="card-content">
                    <p class="">
                        <?=$description?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mapid" class="container center-align border-treatment" style="width: 350px; height: 200px;">

</div>
<div class="container">
    <h5><?php echo lang('Lang.view_adventure.ad_locations');?></h5>
    <?php foreach ($locations as $loc): ?>
        <div class="col s12 m7">
            <div href="#" class="card horizontal find_snapp_card">
                <a href="<?=base_url()?>/Adventure/view_location/<?=$loc->id_loc?>" class="find_snapp_link waves-effect"></a>
                <div class="card-image">
                    <!-- Picture should be of ratio 3:4 -->
                    <img class="find_snapp_list_image" src="<?=$loc->pic?>">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title"><?=$loc->title?></span>
                        <p class="snapp_descripiton"><?=$loc->description?></p>
                    </div>
                    <div class="card-action">
                        <div class="chip">
                            <?=$loc->distanceToPrevious?>  km
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="container">
    <div class="row">
        <div class="col s6 center-align">
            <a href='#' class="waves-effect waves-teal dropdown-trigger btn" data-target='dropdown1'>
                <i class="flaticon-save"></i>
            </a>
        </div>
    </div>
</div>

<div style="height: 60px; width: 100%;"></div>

<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!"><?php echo lang('Lang.view_adventure.ex_col');?></a></li>
    <li class="divider" tabindex="-1"></li>
    <?php foreach ($coll as $co):?>
        <li><a class="modal-trigger" href="#<?=$co->collectionName?>"><?=$co->collectionName?></a></li>
    <?php endforeach;?>
    <li class="divider" tabindex="-1"></li>
    <li><a class="modal-trigger" href="#addingCollection"><?php echo lang('Lang.view_adventure.create_col');?></a></li>
</ul>
<!-- Modal Structure -->
<?php foreach($coll as $collection):?>
    <div id="<?=$collection->collectionName?>" class="modal">
        <form method="post" action="<?=base_url()?>/Snapp/view_adv/<?=$id?>">
            <div class="modal-content">
                <h4><?php echo lang('Lang.view_adventure.note');?></h4>
                <div class="row">
                    <form class="col s6">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="note">
                                <label for="textarea1"><?php echo lang('Lang.view_adventure.textarea');?></label>
                                <br>
                                <input type="hidden" name="collection" readonly="readonly" value="<?=$collection->collectionName?>">
                                <br>
                                <br>
                                <input type="submit" value="save" class="btn btn-large">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">

                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
            </div>
        </form>
    </div>
<?php endforeach;?>
<div id="addingCollection" class="modal">
    <form method="post" action="<?=base_url()?>/Snapp/view_adv2/<?=$id?>" onsubmit="myButton.disabled = true; return true;">
        <div class="modal-content">
            <h4><?php echo lang('Lang.view_adventure.note');?></h4>
            <div class="row">
                <form class="col s6">
                    <div class="row">
                        <br>
                        <div class="input-field col s12">
                            <input type="text" name="collection" id="textarea2" >
                            <label for="textarea2"><?php echo lang('Lang.view_adventure.name');?></label>
                            <br>
                            <br>
                            <input type="submit" value="save" class="btn btn-large">
                        </div>
                    </div>
            </div>
    </form>
</div>
</div>

</form>
</div>
<script>
    const locationcomp = <?=json_encode($comps)?>;
</script>
<?php

function distance($lat1, $lon1, $lat2, $lon2)
{

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
<?= $this->endSection() ?>

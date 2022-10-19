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
    #plant_percentage{
        background: conic-gradient(#60A53B  <?= $percentage ?>deg, #e2f3d9ce <?= $percentage ?>deg 359deg);
    }
</style>

<div class="container center-align">
    <br/>

    <img src="<?=$img?>" class="responsive-img" width="440" height="250"/>

</div>
<div class="container center-align">
    <h4 class="halfway-fab"><?=$title?></h4>
</div>
<div id="descript" class="container">
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
<div class="item">

    <h5 class="center-align"><?=$plant_species?></h5>

<div class="rowitem">
    <div id="plant_percentage" class="number_wrapper col s5 center-align ">
        <img src="<?=$ex_image?>" class="circle waves-effect" width="60" height="auto" alt="">
    </div>
</div>

</div>


<div id="mapid" class="container center-align border-treatment" style="width: 350px; height: 200px; margin-bottom: 20px;"></div>
<div class="container">
    <div class="row">
        <div class="col s6 center-align">
            <a href='#' class="waves-effect waves-teal dropdown-trigger btn" data-target='dropdown1'>
                <i class="flaticon-save"></i>
            </a>
        </div>
        <div class="col s6 center-align">
            <a href="javascript:void();" class="waves-effect waves-teal btn-flat">
                <i data-id="<?=$id?>" class="material-icons card-favorite">
                    <?php
                    $found = 0;
                    if (isset($array_sna_f)){
                        foreach ($array_sna_f as $sna_f)
                            if ($id == $sna_f->id_snapp) $found = 1;
                    }
                    if($found == 1)
                        echo "favorite";
                    else
                        echo "favorite_border";
                    ?>
                </i>
            </a>
        </div>
    </div>
</div>
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!"><?php echo lang('Lang.view_snapp.ex_col');?></a></li>
    <li class="divider" tabindex="-1"></li>
    <?php foreach ($coll as $co):?>
        <li><a class="modal-trigger" href="#<?=$co->collectionName?>"><?=$co->collectionName?></a></li>
    <?php endforeach;?>
    <li class="divider" tabindex="-1"></li>
    <li><a class="modal-trigger" href="#addingCollection"><?php echo lang('Lang.view_snapp.create_col');?></a></li>
</ul>

<div style="height: 60px; width: 100%;"></div>
<!-- Dropdown Structure
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!">Existing collections</a></li>
    <li class="divider" tabindex="-1"></li>
    <?php foreach ($coll as $co):?>
       <a class="modal-trigger" href="#modal1"><li><?=$co->collectionName?></a>
    <?php endforeach;?>
    <li class="divider" tabindex="-1"></li>
    <li><a href="#!">Create a new collection...</a></li>
</ul>
-->
<!-- Modal Structure -->

<?php foreach($coll as $collection):?>
    <div id="<?=$collection->collectionName?>" class="modal">
        <form method="post" action="<?=base_url()?>/Snapp/view/<?=$id?>" onsubmit="myButton.disabled = true; return true;">
            <div class="modal-content">
                <h4><?php echo lang('Lang.view_snapp.note');?></h4>
                <div class="row">
                    <form class="col s6">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="last">
                                <label for="textarea1"><?php echo lang('Lang.view_snapp.t_note');?></label>
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

                <a href="#!" class="modal-close waves-effect waves-green btn-flat"><?php echo lang('Lang.view_snapp.cancel');?></a>
            </div>
        </form>
    </div>
<?php endforeach;?>
<div id="addingCollection" class="modal">
    <form method="post" action="<?=base_url()?>/Snapp/view2/<?=$id?>" onsubmit="myButton.disabled = true; return true;">
        <div class="modal-content">
            <h4><?php echo lang('Lang.view_snapp.note');?></h4>
            <div class="row">
                <form class="col s6">
                    <div class="row">
                        <br>
                        <div class="input-field col s12">
                            <input type="text" name="collection" id="textarea2" >
                            <label for="textarea2"><?php echo lang('Lang.view_snapp.name');?></label>
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
    const location_lat = "<?=$location_lat?>";
    const location_lon = "<?=$location_lon?>";
</script>

<?= $this->endSection() ?>



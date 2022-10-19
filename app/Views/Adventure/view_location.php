<?= $this->extend('common') ?>

<?= $this->section('body') ?>
    <div class="adv_loc_next-prev_placeholder">

        <a
            <?php if ($prevadv !== -1): ?>
                href="<?=base_url()?>/Adventure/view_location/<?=$prevadv?>"
            <?php endif; ?>
            <?php if ($prevadv == -1): ?>
                style="opacity: 0"
            <?php endif; ?>
                class="btn-floating waves-effect waves-light"><i class="large material-icons">keyboard_arrow_left</i></a>

        <a href="<?=base_url()?>/snapp/view_adv/<?=$advloc->adv_id?>" class="chip z-depth-2 waves-effect"><?php echo lang('Lang.view_location.adv_step');?><?=$advloc->advorder + 1?></a>


        <a
            <?php if ($nextadv !== -1): ?>
                href="<?=base_url()?>/Adventure/view_location/<?=$nextadv?>"
            <?php endif; ?>
            <?php if ($nextadv == -1): ?>
                style="opacity: 0"
            <?php endif; ?>
        class="btn-floating waves-effect waves-light"><i class="large material-icons">keyboard_arrow_right</i></a>

    </div>
    <div class="container center-align" style="margin-top: 80px">

    </div>
    <div class="container center-align">
        <h4 class="halfway-fab"><?=$advloc->title?></h4>
    </div>

    <div class="container">
        <div class="row">
            <div class="column s12">
                <img src="<?=$advloc->pic?>" class="border-treatment center-align" style="max-width: 100%"/>
            </div>
        </div>
        <div class="row">
            <div class="column s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><?php echo lang('Lang.view_location.description');?></span>
                        <p>
                            <?= $description ?>
                        </p>
                        <br>
                        <span class="card-title"><?php echo lang('Lang.view_location.voice_recording');?></span>
                        <audio controls="controls">
                            <source src=<?= $voice ?> />
                        </audio>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="mapid" class="container center-align border-treatment" style="width: 100%; height: 250px;"></div>
        </div>
        <div class="row"></div>
    </div>
<script>
    const location_lat = "<?=$location_lat?>";
    const location_lon = "<?=$location_lon?>";
</script>

<?= $this->endSection() ?>
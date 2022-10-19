<?= $this->extend('common') ?>

<?= $this->section('body') ?>

 <div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3 class="center-align"><?php echo lang('Lang.crate_col.create_col');?></h3>
                
                <?php if( $page_title === 'Create SNapp Collections'): ?>
                    <form class="" action="<?=base_url()?>/User/create_collection" method="post">
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="collectionName"><?php echo lang('Lang.crate_col.title');?></label>
                                <input type="text" class="form-control" name="collectionName" id="collectionName" value="<?= set_value('collectionName') ?>">
                            </div>
                            <!-- <div class="form-group col-12 col-sm-6">
                                <label for="collectionPic">Last name</label>
                                <input type="text" class="form-control" name="collectionPic" id="collectionPic" value="<?= set_value('collectionPic') ?>">
                            </div> -->
                        </div>

                        <div class="form-group center-align">
                            <button type="submit"  class="btn btn-primary btn-xl btn-block col s12 light-blue darken-4"><?php echo lang('Lang.crate_col.create');?></button>
                        </div>
                    </form>
                <?php elseif ($page_title === 'Create Adventure Collections'): ?>
                    <form class="" action="<?=base_url()?>/User/create_adv_collection" method="post">
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="collectionName"><?php echo lang('Lang.crate_col.title');?></label>
                                <input type="text" class="form-control" name="collectionName" id="collectionName" value="<?= set_value('collectionName') ?>">
                            </div>
                            <!-- <div class="form-group col-12 col-sm-6">
                                <label for="collectionPic">Last name</label>
                                <input type="text" class="form-control" name="collectionPic" id="collectionPic" value="<?= set_value('collectionPic') ?>">
                            </div> -->
                        </div>

                        <div class="form-group center-align">
                            <button type="submit"  class="btn btn-primary btn-xl btn-block col s12 light-blue darken-4"><?php echo lang('Lang.crate_col.create');?></button>
                        </div>
                    </form>
                <?php endif; ?> 







                
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>

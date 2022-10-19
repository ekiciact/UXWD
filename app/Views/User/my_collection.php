
<?= $this->extend('common') ?>

<?= $this->section('navcontent') ?>
    <?php if( $page_title === 'SNapp Collection'): ?>
        <div class="nav-content">
            <ul class="tabs">
                <li class="tab"><a class="active" href="<?=base_url('/User/my_collection')?>"><i class="material-icons">collections</i><?php echo lang('Lang.my_collection.snapp');?></a></li>
                <li class="tab"><a href="<?=base_url('/User/my_collection_adventures')?>"><i class="material-icons">map</i><?php echo lang('Lang.my_collection.adventures');?></a></li>
            </ul>
        </div>

    <?php elseif ($page_title === 'Adventure Collection'): ?>

        <div class="nav-content">
            <ul class="tabs">
                <li class="tab"><a href="<?=base_url('/User/my_collection')?>"><i class="material-icons">collections</i><?php echo lang('Lang.my_collection.snapp');?></a></li>
                <li class="tab"><a class="active" href="<?=base_url('/User/my_collection_adventures')?>"><i class="material-icons">map</i><?php echo lang('Lang.my_collection.adventures');?></a></li>
            </ul>
        </div>
    <?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('body') ?>
    <div class="container list-container">
    <h4 class="center-align"> <?=$page_title?> </h4>

        <div class="parent center-align">
        <?php foreach ($collection as $collec): ?>

            <div class="child">
                <div class="col s5 m6 l12 offset-s1">
                    <?php if( $page_title === 'SNapp Collection'): ?>
                        <a class="waves-effect" href="<?=base_url('/User/view_collection/'. $collec->id_collection); ?>">
                            <img class="responsive-img" src="<?=$collec->collectionPicture?>" width="80" height="80"/>
                        </a>
                    <?php elseif ($page_title === 'Adventure Collection'): ?>
                        <a class="waves-effect" href="<?=base_url('/User/view_adventure_collection/'. $collec->id_adventure_collection); ?>">
                            <img class="responsive-img" src="<?=$collec->collectionPic?>" width="80" height="80"/>
                        </a>
                    <?php endif; ?>
                    <h6>  <?=$collec->collectionName?> </h6>
                </div>
            </div>
           
        <?php endforeach; ?>
        </div>

        <!-- create a new collection button -->
        <div class="col s6 center-align">
            <?php if( $page_title === 'SNapp Collection'): ?>
                <a class="btn-floating btn-large waves-effect waves-light photo_button" href="<?=base_url()?>/User/create_collection">
                    <i class="material-icons" >add</i><!--<img class="responsive-img" src="<?php echo base_url('assets/images/plusSign.svg'); ?>"/> -->
                </a>
            <?php elseif ($page_title === 'Adventure Collection'): ?>
                <a class="btn-floating btn-large waves-effect waves-light photo_button" href="<?=base_url()?>/User/create_adv_collection">
                    <i class="material-icons" >add</i><!--<img class="responsive-img" src="<?php echo base_url('assets/images/plusSign.svg'); ?>"/> -->
                </a>
            <?php endif; ?>    
                
        </div>
    </div>
<?= $this->endSection() ?>


<?= $this->extend('common') ?>

<?= $this->section('body') ?>
<div class="container">
    <h3 class="center-align"><?php echo lang('Lang.friendsfeed.friend');?></h3>
    <?php foreach ($feed as $fe): ?>
        <div class="col s12 m7">
            <div href="#" class="card horizontal find_snapp_card">
                <a href="<?=base_url()?>/snapp/view/<?=$fe->id_snapp?>" class="find_snapp_link waves-effect"></a>
                <div class="card-image">
                    <!-- Picture should be of ratio 3:4 -->
                    <img class="find_snapp_list_image" src="https://picsum.photos/120/160">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title"><?=$fe->name?> <?php echo lang('Lang.friendsfeed.snapp');?></span>
                        <p class="snapp_descripiton"><?=$fe->name?> <?=$fe->description?></p>
                    </div>
                    <div class="card-action">
                        <div class="chip"><?=$fe->time?></div>
                        <div>
                            <a href="#"> <i class="material-icons">share</i> </a>
                            <a href="#"> <i class="material-icons card-favorite">favorite_border</i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>

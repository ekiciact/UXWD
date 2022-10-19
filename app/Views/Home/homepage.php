<?= $this->extend('common') ?>



<?= $this->section('body') ?>

<div class="hide">
    <?= session()->get('id_user') ?>
    <?= session()->get('isLoggedIn') ?>
</div>

<!-- Modal Trigger -->
<div class="home-content">
    <div id="vertical-menu" <?php if (!isset($_SESSION['isLoggedIn']) || session()->get('isLoggedIn') == false): ?> class="modal-trigger" href="#modal1" <?php endif; ?>>

        <div class="container">
            <h5><?php echo lang('Lang.homepage.m_liked'); ?></h5>
            <!--        <h5 class="center-align halfway-fab">Popular Adventures & SNapps</h5>-->

            <?= $content ?>

        </div>
    </div>
</div>


<!-- Modal Structure -->
<?php if (!isset($_SESSION['isLoggedIn']) || session()->get('isLoggedIn') == false): ?>
    <div id="modal1" class="modal">
        <div class="modal-header">
            <i class="material-icons modal-close right">close</i>
        </div>
        <div class="modal-content center-align">
            <p><?php echo lang('Lang.homepage.plz_reg'); ?></p>
            <div class="container">
                <a class="waves-effect waves-light btn"
                   href="<?= base_url() ?>/User/register"><?php echo lang('Lang.homepage.register'); ?></a>
                <a class="waves-effect waves-light btn"
                   href="<?= base_url() ?>/User/login"><?php echo lang('Lang.homepage.login'); ?></a>
            </div>
        </div>
    </div>
<?php endif; ?>

<!--<div id="modal2" class="modal">-->
<!--    <div class="modal-header">-->
<!--        <i class="material-icons modal-close right">close</i>-->
<!--    </div>-->
<!--    <div class="modal-content">-->
<!---->
<!--        <form action="#">-->
<!--            <div id="upload" class="file-field input-field">-->
<!--                <div class="btn">-->
<!--                    <span><i class="material-icons">photo</span>-->
<!--                    <input id="upload_image" type="file" accept="image/*" multiple>-->
<!--                </div>-->
<!--                <div class="file-path-wrapper">-->
<!--                    <input class="file-path validate" type="text" placeholder="Upload one or more files">-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--        <div class="col-md-8 text-center">-->
<!--            <div id="image_demo" style="width:350px; margin-top:30px"></div>-->
<!--            <div id="uploaded_image"></div>-->
<!--        </div>-->
<!--        <div class="col-md-4" style="padding-top:30px;">-->
<!--            <button class="btn crop_image">Crop & Upload Image</button>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->

<?= $this->endSection() ?>


<!--<h5> nihaoa --><? //= session()->get('email') .$_SESSION['isLoggedIn']?><!--</h5>-->

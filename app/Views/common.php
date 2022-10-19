<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title> <?= isset($page_title) ? $page_title : "Snapp" ?> </title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/icon.ico"/>
    <!-- Importing of css -->
    <?php foreach ($styles as $cssstyle) : ?>
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/<?= $cssstyle ?>"/>
    <?php endforeach; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

<!-- Navbar -->
<div class="navbar-fixed">
    <nav class="nav-extended">
        <div class="nav-wrapper">
            <a href="#" data-target="slide-out" class="sidenav-trigger show-on-medium-and-up"><i class="center material-icons">menu</i></a>
            <a href="#" class="brand-logo">{Snapp}</a>
            <!-- Modal Trigger -->
            <a class="right btn-small btn-floating waves-effect waves-light modal-trigger hide" id="info" style="margin: 10px" href="#modalInfo"><i class=" material-icons">info_outline</i></a>
            <!-- Modal Structure -->
            <div id="modalInfo" class="modal">
                <div class="modal-content">
                    <h4 class="header_info" ><?php echo lang('Lang.common.ad_info');?></h4>
                    <p class="paragraph_info"><?php echo lang('Lang.common.info');?></p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat"><?php echo lang('Lang.common.got_it');?></a>
                </div>
            </div>
            </ul>
        </div>
        <?= $this->renderSection('navcontent') ?>
    </nav>
</div>

<!-- Sidebar -->


<ul id="slide-out" class="sidenav">
    <li>

        <div class="user-view">

            <div class="background"></div>

            <div class="profile_container">
                <div class="profile_info btn-primary">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('profile_image') === NULL): ?>
                            <a href="<?= base_url() ?>/User/profile"><img class="circle"
                                                                        src="data:image/png;base64,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 "></a>
                        <?php endif; ?>
                        <?php if (session()->get('profile_image') !== NULL): ?>
                            <a href="<?= base_url() ?>/User/profile"><img class="circle"
                                                                          src="<?= session()->get('profile_image') ?>"></a>
                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if (!session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url() ?>/User/login"><img class="circle"
                                                                    src="data:image/png;base64,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 "></a>
                    <?php endif; ?>
                    <a href="#name"><span class="white-text name"><?= session()->get('firstname') ?></span></a>
                    <a href="#email"><span class="white-text email"><?= session()->get('email') ?></a>
                </div>
            </div>
        </div>
    </li>


    <li><a class="waves-effect" href="<?=base_url()?>/Home/homepage"><i class="material-icons">home</i><?php echo lang('Lang.common.home');?></a></li>
    <li><div class="divider"></div></li>

    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION["isLoggedIn"] == true): ?>
        <li> <a class="header"><i class="material-icons">photo_camera</i><?php echo lang('Lang.common.snapp');?></a></li>
        <li><a class="waves-effect suboption" href="<?=base_url()?>/Snapp/find_a_snapp"><?php echo lang('Lang.common.discover_snapp');?></a></li>
        <li><a class="waves-effect suboption" href="<?=base_url()?>/Snapp/create_a_snapp"><?php echo lang('Lang.common.create_snapp');?></a></li>
        <li><div class="divider"></div></li>
        <li> <a class="header"><i class="material-icons">explore</i><?php echo lang('Lang.common.adventures');?></a></li>

        <li><a class="waves-effect suboption" href="<?=base_url()?>/Adventure/find_an_adventure"><?php echo lang('Lang.common.discover_adventures');?></a></li>

        <li>
            <a class="waves-effect suboption" href="<?= base_url() ?>/Adventure/create_an_adventure">
                <?php if (isset($_SESSION['editing_adventure'])): ?>
                    <?php echo lang('Lang.common.edit_adventure');?>
                <?php endif; ?>
                <?php if (!isset($_SESSION['editing_adventure'])): ?>
                    <?php echo lang('Lang.common.create_adventure');?>
                <?php endif; ?>
            </a>
        </li>

        <li><div class="divider"></div></li>
        <li><a class="waves-effect" href="<?=base_url()?>/User/my_collection"><i class="material-icons">collections</i><?php echo lang('Lang.common.my_collection');?></a></li>

        <li><a class="header" href="<?=base_url()?>/logout"><i class="material-icons">login</i><?php echo lang('Lang.common.logout');?></a></li>
        

    
    <?php endif; ?>

    <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION["isLoggedIn"] == false): ?>
        <li><a class="header" href="<?=base_url()?>/User/register"><i class="material-icons">assignment_ind</i><?php echo lang('Lang.common.register');?></a></li>
        <li><a class="header" href="<?=base_url()?>/User/login"><i class="material-icons">login</i><?php echo lang('Lang.common.login');?></a></li>


    <?php endif; ?>
    <li class="center">
        <form action="<?=base_url()?>/Language/switch" method="post">
            <div>
                <button  type="submit" id="pref_lang1" name="pref_lang" value="en" class="btn btn-small waves-effect <?php if ($_SESSION["pref_lang"] !== 'en'): ?>hoverable<?php endif; ?> "<?php if ($_SESSION["pref_lang"] == 'en'): ?>disabled<?php endif; ?>>EN</button>
                <button  type="submit" id="pref_lang2" name="pref_lang" value="be" class="btn btn-small waves-effect<?php if ($_SESSION["pref_lang"] !== 'be'): ?>hoverable<?php endif; ?>" <?php if ($_SESSION["pref_lang"] == 'be'): ?>disabled<?php endif; ?>>NL</button>
                <button  type="submit" id="pref_lang3" name="pref_lang" value="tr" class="btn btn-small waves-effect <?php if ($_SESSION["pref_lang"] !== 'tr'): ?>hoverable<?php endif; ?>" <?php if ($_SESSION["pref_lang"] == 'tr'): ?>disabled<?php endif; ?>>TR</button>
            </div>
        </form>
    </li>
</ul>

<!-- Bottom bar -->
<div class="bottomNav">
    <!--    <div class="slider"></div>-->
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">

                <div class="nav-content">
                    <a class="cam btn-floating btn-large halfway-fab waves-effect waves-light green photo_button" href="<?=base_url()?>/Snapp/create_a_snapp">
                        <i class="material-icons">camera_alt</i>
                    </a>
                </div>

                <ul class="menus">
                    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION["isLoggedIn"] == true): ?>
                        <li><a class="waves-effect" href="<?=base_url()?>/Home/homepage"><i class="material-icons">home</i><span><?php echo lang('Lang.common.home');?></span></a></li>
                        <li><a class="waves-effect" href="<?=base_url()?>/Snapp/find_a_snapp"><i class="material-icons">image_search</i><span><?php echo lang('Lang.common.snapp');?></span></a></li>

                        <li class="gap"><a class="btn-flat disabled"><i></i></a></li>

                        <li><a class="waves-effect" href="<?=base_url()?>/Adventure/find_an_adventure"><i class="material-icons">explore</i><span><?php echo lang('Lang.common.adventures');?></span></a></li>
                        <li><a class="waves-effect" href="<?=base_url()?>/User/profile"><i class="material-icons">person</i><span><?php echo lang('Lang.common.profile');?></span></a></li>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION["isLoggedIn"] == false): ?>
                        <li><a class="waves-effect" href="<?=base_url()?>/Home/homepage"><i class="material-icons">home</i><span><?php echo lang('Lang.common.home');?></span></a></li>
                        <li class="gap"><a class="btn-flat disabled"><i></i></a></li>
                        <li><a class="waves-effect" href="<?=base_url()?>/User/login"><i class="material-icons">person</i><span><?php echo lang('Lang.common.login');?></span></a></li>
                    <?php endif; ?>
                </ul>

            </div>

        </nav>
    </div>
</div>

<!-- Main content -->
<div class="padding_body_section">
    <?= $this->renderSection('body') ?>
    <div style="height: 60px; width: 100%;"></div>
</div>



<!-- Importing of js -->
<script>
    const base_url = "<?=base_url()?>";
</script>
<?php foreach ($scripts as $jsscript) : ?>
    <script src="<?= base_url() ?>/assets/js/<?= $jsscript ?>"></script>
<?php endforeach; ?>

<?= $this->renderSection('script') ?>




</body>

</html>


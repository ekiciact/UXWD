<?= $this->extend('common') ?>

<?= $this->section('navcontent') ?>
    <div class="nav-content">
        <ul class="tabs">
            <li class="tab"><a class="active" href="#listview"><i class="material-icons">list</i><?php echo lang('Lang.find_snapp.list');?></a></li>
            <li class="tab"><a href="#mapview"><i class="material-icons">map</i><?php echo lang('Lang.find_snapp.map');?></a></li>
        </ul>
    </div>
<?= $this->endSection() ?>



<?= $this->section('body') ?>
    <div class="algolia-container">
        <a href="#"> <i class="material-icons algolia-location">my_location</i> </a>
        <input type="search" id="address" class="algolia-search" placeholder="<?php echo lang('Lang.find_snapp.search_location');?>" />
    </div>


    <div id="listview" class="tabsview">
        <div id="list-container" class="container list-container">

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
    <div id="mapview" class="tabsview">
        <div id="mapid"></div>
        <a class="waves-effect waves-light btn" id="search_this_area"><?php echo lang('Lang.find_snapp.search_area');?></a>
    </div>

<script>

</script>

<?= $this->endSection() ?>


<?= $this->section('dropdown-menu') ?>
    <li><a href="#!"><?php echo lang('Lang.find_snapp.example');?></a></li>
<?= $this->endSection() ?>
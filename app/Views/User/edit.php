<?= $this->extend('common') ?>

<?= $this->section('body') ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h4><?php echo lang('Lang.edit.edit');?></h4>
                <form class="" action="<?= base_url() ?>/User/edit" method="post">

                    <div class="row">


                        <div class="input-field col s12">
                            <input type="text" name="firstname" id="firstname" required minlength="3"
                                   value="<?= session()->get('firstname') ?>"/>
                            <label for="firstname"><?php echo lang('Lang.edit.firstname');?></label>

                        </div>
                        <div class="input-field col s12">
                            <input type="text" class="form-control" name="lastname" id="lastname" required minlength="3"
                                   value="<?= session()->get('lastname') ?>">
                            <label for="lastname"><?php echo lang('Lang.edit.lastname');?></label>
                        </div>

                        <div class="input-field col s12">
                            <input type="text" class="form-control" name="username" id="username" required minlength="3"
                                   maxlength="10" value="<?= session()->get('username') ?>">
                            <label for="username"><?php echo lang('Lang.edit.username');?></label>
                        </div>
                        <div class="input-field col s12">
                            <input type="email" class="validate form-control" name="email" id="email" required
                                   value="<?= session()->get('email') ?>">
                            <label for="email"><?php echo lang('Lang.edit.email');?></label>
                        </div>
                        <div class="input-field col s12">
                            <input type="date" class="form-control" name="birthdate" id="birthdate" required
                                   value="<?= session()->get('birthdate') ?>">
                            <label for="birthdate"><?php echo lang('Lang.edit.birthdate');?></label>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate passwords' type='password' name='password' minlength="8" id='password'/>
                                <label for='password'><?php echo lang('Lang.edit.password');?></label>
                                <span class="field-icon toggle-password" onclick="togglePassword()"><span
                                            class="material-icons">visibility_off</span></span>
                            </div>

                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate passwords' type='password' name='password_confirm' minlength="8" id='password_confirm'/>
                                <label for='password_confirm'><?php echo lang('Lang.edit.password_confirm');?></label>
                                <span class="field-icon toggle-password" onclick="togglePassword()"><span
                                            class="material-icons">visibility_off</span></span>
                            </div>
                        </div>

                        <?php if (isset($validation)): ?>
                            <div class="row" id="alert_box">
                                <div class="col s12 m12">
                                    <div class="card red darken-1">
                                        <div class="row">
                                            <div class="col s12 m10">
                                                <div class="card-content white-text">
                                                    <?= $validation->listErrors() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col s6" >
                            <a type="button" href="<?= base_url() ?>/User/profile" class="btn waves-effect waves-light btn-block col s12 red"><?php echo lang('Lang.edit.discard');?>
                            </a>
                        </div>
                        <div class="col s6">
                            <div class="form-group center-align mTop10">
                                <button type="submit" class="btn waves-effect waves-light btn-block col s12"><?php echo lang('Lang.edit.save');?>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

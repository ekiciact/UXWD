<?= $this->extend('common') ?>

<?= $this->section('body') ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?php echo lang('Lang.login.login');?></h3>

                <form class="" action="<?=base_url()?>/User/login" method="post">
                    <div class="input-field col s12">

                        <input type="text" class="form-control" name="email_username" id="email_username" required value="<?= set_value('email_username') ?>">
                        <label for="email_username"><?php echo lang('Lang.login.email_username');?></label>
                    </div>
                    <div class="input-field col s12">

                        <input type="password" class="form-control passwords" name="password" id="password" required minlength="8" value="<?= set_value('password') ?>">
                        <label for="password"><?php echo lang('Lang.login.password');?></label>
                        <span class="field-icon toggle-password" onclick="togglePassword()"><span class="material-icons">visibility_off</span></span>
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
                    <div class="row">
                        <div class="form-group center-align mTop10">
                            <button type="submit" class="btn waves-effect waves-light btn-block col s12"><?php echo lang('Lang.login.login');?></button>
                        </div>
                    </div>
                    <div class="mTop10">
                        <div class="form-group center-align">
                            <a href="<?=base_url()?>/User/register"><?php echo lang('Lang.login.account');?></a>
                        </div>
                        <div class="form-group center-align">
                            <a href="<?=base_url()?>/User/passwordforgot"><?php echo lang('Lang.login.forgot');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

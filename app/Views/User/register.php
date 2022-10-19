<?= $this->extend('common') ?>

<?= $this->section('body') ?>
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?php echo lang('Lang.register.register');?></h3>

                <form class="" action="<?=base_url()?>/User/register" method="post">

                    <div class="row">

                        <div class="input-field col s12">
                            <input type="text" name="firstname" id="firstname" required minlength="3"  value="<?= set_value('firstname') ?>" />
                            <label for="firstname"><?php echo lang('Lang.register.firstname');?></label>

                        </div>
                        <div class="input-field col s12">
                            <input type="text" class="form-control" name="lastname" id="lastname" required minlength="3" value="<?= set_value('lastname') ?>">
                            <label for="lastname"><?php echo lang('Lang.register.lastname');?></label>

                        </div>

                            <div class="input-field col s12">

                                <input type="text" class="form-control" name="username" id="username" required minlength="3" maxlength="10" value="<?= set_value('username') ?>">
                                <label for="username"><?php echo lang('Lang.register.username');?></label>
                            </div>
                            <div class="input-field col s12">

                                <input type="email" class="validate form-control" name="email" id="email" required value="<?= set_value('email') ?>">
                                <label for="email"><?php echo lang('Lang.register.email');?></label>
                            </div>
                            <div class="input-field col s12">

                                <input type="date" class="form-control" name="birthdate" id="birthdate" required value="<?= set_value('birthdate') ?>">
                                <label for="birthdate"><?php echo lang('Lang.register.birthdate');?></label>
                            </div>
                            <div class="col s12">
                                <label for="gender"><?php echo lang('Lang.register.gender');?></label><br>

                                <div class="col s12">
                                    <div class="col s12 m4 l2">
                                        <label>
                                            <input class="with-gap" type="radio" id="male" name="gender" required value="male">
                                            <span for="male"><?php echo lang('Lang.register.male');?></span>
                                        </label>

                                    </div>
                                    <div class="col s12 m4 l2">
                                        <label>
                                            <input class="with-gap" type="radio" id="female" name="gender" required value="female">
                                            <span for="female"><?php echo lang('Lang.register.female');?></span>
                                        </label>

                                    </div>
                                    <div class="col s12 m4 l2">
                                        <label>
                                            <input class="with-gap" type="radio" id="other" name="gender" required checked value="other">
                                            <span for="other"><?php echo lang('Lang.register.other');?></span>
                                        </label>

                                    </div>
                                </div>

                            </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate passwords' type='password' name='password' required minlength="8" id='password' value="<?= set_value('password') ?>" />
                                <label for='password'><?php echo lang('Lang.register.password');?></label>
                                <span class="field-icon toggle-password" onclick="togglePassword()"><span class="material-icons">visibility_off</span></span>
                            </div>

                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate passwords' type='password' name='password_confirm' required minlength="8" id='password_confirm' value="<?= set_value('password_confirm') ?>" />
                                <label for='password_confirm'><?php echo lang('Lang.register.password_confirm');?></label>
                                <span class="field-icon toggle-password" onclick="togglePassword()"><span class="material-icons">visibility_off</span></span>
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
                        <div class="form-group center-align">
                            <button type="submit" class="btn waves-effect waves-light btn-block col s12"><?php echo lang('Lang.register.register');?></button>
                        </div>

                    </div>
                    <div class="mTop10">
                        <div class="form-group center-align">
                            <a href="<?=base_url()?>/User/login"><?php echo lang('Lang.register.account');?></a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

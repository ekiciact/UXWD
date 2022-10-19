<?= $this->extend('common') ?>

<?= $this->section('body') ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?php echo lang('Lang.password_forgot.forgot');?></h3>

                <form method="post" onsubmit="myButton.disabled = true; return true;">
                    <div class="input-field col s12">

                        <input type="text" name="email_username">
                        <label for="email_username"><?php echo lang('Lang.password_forgot.email');?></label>
                    </div>


                    <div class="row">
                        <div class="form-group center-align mTop10">
                            <button type="submit" class="btn waves-effect waves-light btn-block col s12"><?php echo lang('Lang.password_forgot.reset');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
















<?= $this->endSection() ?>

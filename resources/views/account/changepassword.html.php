<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css'); ?>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('modules/accountmodule/css/changepassword.css'); ?>" />
<?php $view['slots']->stop(); ?>

<div id="change-password-panel">
    <h1>Change Password</h1>
    <p>Please enter your old password and your new password.</p>
    <form action="<?php echo $view['router']->generate('AccountModule_Change_Password_Save'); ?>" method="post">
        <div class="form-group">
            <label for="userOldPassword">Old Password</label>
            <input name="userOldPassword" type="password" class="form-control" id="userOldPassword" placeholder="Old Password">
        </div>
        <div class="form-group">
            <label for="userPassword">New Password</label>
            <input name="userPassword" type="password" class="form-control" id="userPassword" placeholder="New Password">
        </div>
        <div class="form-group">
            <label for="userConfirmPassword">Confirm New Password</label>
            <input name="userConfirmPassword" type="password" class="form-control" id="userConfirmPassword" placeholder="Confirm New Password">
        </div>

        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>

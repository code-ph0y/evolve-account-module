<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css'); ?>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('modules/accountmodule/css/editmyprofile.css'); ?>" />
<?php $view['slots']->stop(); ?>

<div id="edit-my-profile-panel">
    <h1>Edit My Profile</h1>
    <hr />
    <form method="post" action="<?php echo $view['router']->generate('AccountModule_Save_My_Profile'); ?>">
        <div class="form-group">
            <label for="accountFirstName">First Name <em>*</em></label>
            <input type="text" name="accountFirstName" class="form-control" id="accountFirstName" placeholder="First Name" value="<?php echo $account->getFirstName(); ?>">
        </div>

        <div class="form-group">
            <label for="accountLastName">Last Name <em>*</em></label>
            <input type="text" name="accountLastName" class="form-control" id="accountLastName" placeholder="Last Name" value="<?php echo $account->getLastName(); ?>">
        </div>

        <div class="form-group">
            <label for="accountEmail">Email Address</label>
            <input type="text" name="accountEmail" class="form-control" id="accountEmail" placeholder="Last Name" value="<?php echo $account->getEmail(); ?>">
            <span class="help-block">If Email Address field is updated this will change your Login Email Address</span>
        </div>

        <div class="form-group">
            <label for="accountMobile">Mobile Number</label>
            <input type="text" name="accountMobile" class="form-control" id="accountMobile" placeholder="Mobile Number" value="<?php echo $account->getMobile(); ?>">
        </div>

        <div class="form-group">
            <label for="accountAddress1">Address 1</label>
            <input type="text" name="accountAddress1" class="form-control" id="accountAddress1" placeholder="Address 1" value="<?php echo $account->getAddress1(); ?>">
        </div>

        <div class="form-group">
            <label for="accountAddress2">Address 2</label>
            <input type="text" name="accountAddress2" class="form-control" id="accountAddress2" placeholder="Address 2" value="<?php echo $account->getAddress2(); ?>">
        </div>

        <div class="form-group">
            <label for="accountCity">City</label>
            <input type="text" name="accountCity" class="form-control" id="accountCity" placeholder="City" value="<?php echo $account->getCity(); ?>">
        </div>

        <div class="form-group">
            <label for="accountState">State</label>
            <input type="text" name="accountState" class="form-control" id="accountState" placeholder="State" value="<?php echo $account->getState(); ?>">
        </div>

        <div class="form-group">
            <label for="accountCountry">Country</label>
            <input type="text" name="accountCountry" class="form-control" id="accountCountry" placeholder="Country" value="<?php echo $account->getCountry(); ?>">
        </div>

        <div class="form-group">
            <label for="accountZipCode">Zip Code</label>
            <input type="text" name="accountZipCode" class="form-control" id="accountZipCode" placeholder="Zip Code" value="<?php echo $account->getZipCode(); ?>">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i> Save
        </button>

        <input name="accountUserId" type="hidden" value="<?php echo $account->getUserId(); ?>" />
    </form>
</div>

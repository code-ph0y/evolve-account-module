<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css'); ?>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('modules/accountmodule/css/myprofile.css'); ?>" />
<?php $view['slots']->stop(); ?>

<div id="my-profile-panel">
    <h1>My Profile</h1>
    <a
    class="btn btn-default"
    role="button"
    href="<?php echo $view['router']->generate(
        'AccountModule_Edit_My_Profile',
        array('user_id' => $user->getId())
    ); ?>">Edit My Profile</a>

    <div class="row">
        <div class="col-xl-4">
            <img src="<?php echo $view['assets']->getUrl($profile_image); ?>" />
        </div>
        <div class="col-xl-4">
            <div class="t-main">
                <div class="t-tr">
                    <div class="t-td bold">
                        Name
                    </div>
                    <div class="t-td">
                        <?php echo $user->getFullName(); ?>
                    </div>
                </div>
                <div class="t-tr">
                    <div class="t-td bold">
                        Email Address
                    </div>
                    <div class="t-td">
                        <?php echo $user->getEmail(); ?>
                    </div>
                </div>
                <div class="t-tr">
                    <div class="t-td bold">
                        Mobile
                    </div>
                    <div class="t-td">
                        <?php echo $user_account->getMobile(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">

        </div>
    </div>

    <h2>Address Details</h2>

    <div class="row">
        <div class="col-md-12">
            <div class="t-main">
                <div class="t-tr">
                    <div class="t-td bold">
                        Address 1
                    </div>
                    <div class="t-td">
                        <?php echo $user_account->getAddress1(); ?>
                    </div>
                </div>
                <div class="t-tr">
                    <div class="t-td bold">
                        Address 2
                    </div>
                    <div class="t-td">
                        <?php echo $user_account->getAddress2(); ?>
                    </div>
                </div>
                <div class="t-tr">
                    <div class="t-td bold">
                        City
                    </div>
                    <div class="t-td">
                        <?php echo $user_account->getCity(); ?>
                    </div>
                </div>
                <div class="t-tr">
                    <div class="t-td bold">
                        State
                    </div>
                    <div class="t-td">
                        <?php echo $user_account->getState(); ?>
                    </div>
                </div>
                <div class="t-tr">
                    <div class="t-td bold">
                        Country
                    </div>
                    <div class="t-td">
                        <?php echo $user_account->getCountry(); ?>
                    </div>
                </div>
                <div class="t-tr">
                    <div class="t-td bold">
                        Zip Code
                    </div>
                    <div class="t-td">
                        <?php echo $user_account->getZipCode(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

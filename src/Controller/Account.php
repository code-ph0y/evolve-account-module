<?php
# @todo - Make functions secure i.e call isLoggedIn function
namespace AccountModule\Controller;

use AccountModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Account extends SharedController
{
    public function myprofileAction()
    {
        $loggedUser   = $this->getService('auth.security')->getUser();
        $user         = $this->getService('auth.user.storage')->getById($loggedUser->getId());
        $user_account = $this->getService('account.useraccount.storage')->getByUserId(
            $loggedUser->getId()
        );

        # @todo - factor in gender default profile images
        $profile_image = '';
        if ($user_account->getProfileImage() == '') {
            $profile_image = 'modules/accountmodule/images/m_default_profile_image.png';
        } else {
            $profile_image = $user_account->getProfileImage();
        }

        return $this->render('AccountModule:account:myprofile.html.php', compact('user', 'user_account', 'profile_image'));
    }

    public function editmyprofileAction()
    {
        $loggedUser = $this->getService('auth.security')->getUser();
        $account    = $this->getService('account.useraccount.storage')->getByUserId($loggedUser->getId());
        return $this->render('AccountModule:account:editmyprofile.html.php', compact('account'));
    }

    public function savemyprofileAction(Request $request)
    {
        $post = $request->request->all();
        // Get storage classes
        $userStorage        = $this->getService('account.user.storage');
        $userAccountStorage = $this->getService('account.useraccount.storage');

        // Validate input
        $missingFields = array();
        $requiredKeys  = array(
            'accountFirstName',
            'accountLastName',
            'accountEmail'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || trim($post[$field]) == '') {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the user
        if (!empty($missingFields)) {
            $this->setFlash('danger', 'Some required fields were blank. Please re-evaluate your input and try again.');
            return $this->render('AccountModule:account:editmyprofile.html.php');
        }

        // Check if email address has changed
        if ($userStorage->isEmailChanged($post['accountUserId'], $post['accountEmail'])) {
            // Check that email isn't already in the system
            if ($userStorage->existsByEmail($post['accountUserId'])) {
                $this->setFlash('danger', 'Email Address already exists. Please re-evaluate your input and try again.');
                return $this->render('AccountModule:account:editmyprofile.html.php');
            }
        }

        // Prepare user data for update
        $userData = array(
            'first_name' => $post['accountFirstName'],
            'last_name' => $post['accountLastName'],
            'email' => $post['accountEmail']
        );

        // Update user data
        $userStorage->update($post['accountUserId'], $userData);

        // Prepare user account data for update
        $userAccountData = array(
            'address_1' => $post['accountAddress1'],
            'address_2' => $post['accountAddress2'],
            'city' => $post['accountCity'],
            'state' => $post['accountState'],
            'country' => $post['accountCountry'],
            'zip_code' => $post['accountZipCode'],
            'mobile' => $post['accountMobile']
        );

        // Update user account data
        $userAccountStorage->update($post['accountUserId'], $userAccountData);

        $this->setFlash('success', 'Account details updated successfully');
        return $this->redirectToRoute('AccountModule_Edit_My_Profile', array('user_id' => $post['accountUserId']));
    }

    public function changepasswordAction(Request $request)
    {
        return $this->render('AccountModule:account:changepassword.html.php');
    }

    public function changepasswordsaveAction(Request $request)
    {
        $post = $request->request->all();

        // Get config
        $config = $this->getConfig();

        // Get security helper
        $security    = $this->getService('auth.security');
        $userStorage = $this->getService('auth.user.storage');

        // Get logged in user details
        $loggedUser = $security->getUser();

        // Get user from db just incase logged in details are out of date.
        $user       = $userStorage->getById($loggedUser->getId());
        $userEmail  = $loggedUser->getEmail();

        $missingFields = array();
        $requiredKeys  = array(
            'userOldPassword',
            'userPassword',
            'userConfirmPassword'
        );

        // Old Password
        $user_old_password_array = array(
            'password' => $post['userOldPassword']
        );

        // New Password
        $user_new_password_array = array(
            'password' => $post['userPassword']
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || trim($post[$field]) == '') {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the user
        if (!empty($missingFields)) {
            $this->setFlash('danger', 'Some required fields were blank. Please re-evaluate your input and try again.');
            return $this->render('AccountModule:account:changepassword.html.php');
        }

        // Check if the user's passwords do not match
        if ($post['userPassword'] !== $post['userConfirmPassword']) {
            $this->setFlash('danger', 'Passwords do not match. Please try again.');
            return $this->render('AccountModule:account:changepassword.html.php');
        }

        // Check old password is correct
        if (!$security->checkAuth($user->getEmail(), $user_old_password_array['password'], $userStorage)) {
            $this->setFlash('danger', 'Old password was not correct.');
            return $this->render('AccountModule:account:changepassword.html.php');
        }

        // Encrypt New Password
        $newEncPassword = $security->saltPass(
            $user->getSalt(),
            $config['authSalt'],
            $user_new_password_array['password']
        );

        // Update user password
        $userStorage->updatePassword(
            $user->getId(),
            $newEncPassword
        );

        $this->setFlash('success', 'Password was changed successfully.');
        return $this->redirectToRoute('Homepage');
    }
}

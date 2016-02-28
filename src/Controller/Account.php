<?php
namespace AccountModule\Controller;

use AccountModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Account extends SharedController
{
    public function profileAction()
    {
        return $this->render('AccountModule:account:profile.html.php');
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

        // If any fields were missing, inform the client
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

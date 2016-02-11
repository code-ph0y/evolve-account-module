<?php
namespace AccountModule\Controller;

use AccountModule\Controller\Shared as SharedController;
use PPI\Framework\Http\Request as Request;

class Account extends SharedController
{
    public function signupAction(Request $request)
    {
        return $this->render('AccountModule:account:signup.html.php');
    }
}

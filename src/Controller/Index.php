<?php
namespace AccountModule\Controller;

use AccountModule\Controller\Shared as SharedController;
use Psr\Http\Message\RequestInterface;

class Index extends SharedController
{
    public function indexAction(RequestInterface $request)
    {
        return $this->render('AccountModule:index:index.html.php');
    }
}

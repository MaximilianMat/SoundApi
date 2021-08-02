<?php

class logoutController extends Controller
{
    private $request = null;

    public function __construct($request)
    {

        $this->request = $request;
        $this->innerView = new View();

        parent::__construct($request);

        $this->logout();

    }


    public function logout()
    {
        $_SESSION[authenticated] = false;
        header('Location: index.php');
        return;
    }

}

?>
<?php

class loginController extends Controller
{
    private $request    = null;

    public function __construct($request)
    {

        $this->request      = $request;
        $this->innerView    = new View();

        parent::__construct($request);


        if(isset($request['username']) && $request['password'])
        {
            $this->authenticate();
        }else
        {
            $this->login();
        }

    }

    public function authenticate()
    {
        if (userModel::validate($this->request['username'], $this->request['password'])) {
            $_SESSION['authenticated'] = true;
        }
        header('Location: index.php');
        return;
    }

    public function login()
    {
        // innere View für die Startseite setzen
        $this->innerView->setTemplate('login');
    }

}

?>
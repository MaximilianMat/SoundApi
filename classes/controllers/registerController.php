<?php


class registerController extends Controller
{
    private $request    = null;

    public function __construct($request)
    {

        $this->request      = $request;
        $this->innerView    = new View();

        parent::__construct($request);


        if(isset($request['register']))
        {
            $this->register();
        }else
        {
            $this->index();
        }

    }

    public function register()
    {
        userModel::addUser($this->request['username'],$this->request['password']);
        header('Location: index.php');
    }

    public function index()
    {
        // innere View für die Startseite setzen
        $this->innerView->setTemplate('register');
    }

}
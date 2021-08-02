<?php

class indexController extends Controller
{
    private $request    = null;

    public function __construct($request)
    {

        $this->request      = $request;
        $this->innerView    = new View();

        parent::__construct($request);


        if(isset($request['function']))
        {
            if($this->isMethodExists($this, $request['function']) && is_callable(array(get_class($this), $request['function'])))
            {
                call_user_func(array(get_class($this), $request['function']));
            }

        }else
        {
            $this->index();
        }

    }


    public function index()
    {
        // innere View für die Startseite setzen
        $this->innerView->setTemplate('home');
    }

}

?>
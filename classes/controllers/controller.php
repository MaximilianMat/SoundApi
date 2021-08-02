<?php

class Controller {

    private $request        = null;
    protected $view           = null;

    // Vererbt in z.B. contactController, indexController, wird dort gesetzt...
    protected $innerView    = null;

    public function __construct($request)
    {
        // Übergabe aller Requests ($_POST & $_GET)
        $this->request      = $request;
    }

    /**
     *
     * Prüfen ob die Methode existiert die über den function Parameter aufgerufen werden soll.
     * @param $class
     * @param $method
     * @return bool
     */
    public function isMethodExists($class, $method)
    {
        if (method_exists(get_class($class), $method))
        {
            // Zur Sicherheit, sollte die Methode nur aufgerufen werden können, wenn sie auch public ist.
            $reflection = new ReflectionMethod($class, $method);
            if ($reflection->isPublic())
            {
                return true;
            }else
            {
                exit("Methode $method ist nicht public in ".get_class($class));
            }

        }else
        {
            exit("Methode $method existiert nicht in ".get_class($class));
        }

    }

    /**
     * Ausgabe des kompletten Templates
     */
    public function display()
    {
        // View erstellen
        $this->view = new View();

        // Innere View hinzufügen (assign)
        $this->view->assign('content', $this->innerView->loadTemplate());

        // Äußere View (main.php)
        $this->view->setTemplate('main');

        // Rückgabe komplettes Template
        return $this->view->loadTemplate();
    }
}

?>
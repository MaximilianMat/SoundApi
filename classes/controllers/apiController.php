<?php

class apiController extends Controller
{

    private $request = null;

    public function __construct($request)
    {
        // alle $_GET & $_POST Parameter setzen
        $this->request = $request;

        // neue innere View (in Controller)
        $this->innerView = new View();

        parent::__construct($request);

        if (isset($request['function'])) {
            if ($this->isMethodExists($this, $request['function']) && is_callable(array(get_class($this), $request['function']))) {
                call_user_func(array(get_class($this), $request['function']));
            }

        } else {
            $this->apiSatus();
        }

    }

    public function apiSatus()
    {    //Funktion zur überprüfung der Verbindung
        $this->innerView->assign('jsonData', array('Status' => 'OK'));
        $this->innerView->setTemplate('json');
    }

    public function getSong()
    {      //liefert Song, nicht angegebene Parameter werden vernachlässigt

        if (isset($this->request["ID"]) && !empty($this->request["ID"])) {
            $sID = $this->request['ID'];
            $sID = preg_replace("[ ,.;:!?-]", '', $sID);
        } else {
            $sID = "%";
        }

        if (isset($this->request["name"]) && !empty($this->request["name"])) {
            $sname = $this->request['name'];
            $sname .= "%";            //Einfügen eines '%' damit nur teile von Namen gefunden werden
        } else {
            $sname = "%";
        }

        if (isset($this->request["album"]) && !empty($this->request["album"])) {
            $salbum = $this->request['album'];
            $salbum = preg_replace("[ ,.;:!?-]", '', $salbum);
            $salbum .= "%";
        } else {
            $salbum = "%";
        }

        if (isset($this->request["interpret"]) && !empty($this->request["interpret"])) {
            $sinterpret = $this->request['interpret'];
            $sinterpret = preg_replace("[ ,.;:!?-]", '', $sinterpret);
            $sinterpret .= "%";
        } else {
            $sinterpret = "%";
        }

        if (isset($this->request["genre"]) && !empty($this->request["genre"])) {
            $sgenre = $this->request['genre'];
            $sgenre = preg_replace("[ ,.;:!?-]", '', $sgenre);
            $sgenre .= "%";
        } else {
            $sgenre = "%";
        }


        //Remove ID Column from Songs
        $array = array();
        foreach (songModel::getSongData($sID, $sname, $salbum, $sinterpret, $sgenre) as $i => $song){
            $array[$i] = array_slice($song, 1);
        }

        $this->innerView->assign('jsonData', $array);
        $this->innerView->setTemplate('json');
    }

    private function addSong()
    {   //mit nochmaliger überprüfung der Parameter und regex für symbole
        $ok = true;
        if (isset($this->request["name"]) && !empty($this->request["name"])) {
            $sname = $this->request['name'];
            $sname = preg_replace("[ ,.;:!?-]", '', $sname);
        } else {
            $ok = false;
        }

        if (isset($this->request["album"]) && !empty($this->request["album"])) {
            $salbum = $this->request['album'];
            $salbum = preg_replace("[ ,.;:!?-]", '', $salbum);
        } else {
            $ok = false;
        }

        if (isset($this->request["interpret"]) && !empty($this->request["interpret"])) {
            $sinterpret = $this->request['interpret'];
            $sinterpret = preg_replace("[ ,.;:!?-]", '', $sinterpret);
        } else {
            $ok = false;
        }

        if (isset($this->request["genre"]) && !empty($this->request["genre"])) {
            $sgenre = $this->request['genre'];
            $sgenre = preg_replace("[ ,.;:!?-]", '', $sgenre);
        } else {
            $ok = false;
        }

        if ($ok) {
            $this->innerView->assign('jsonData', songModel::addNewSong($sname, $salbum, $sinterpret, $sgenre));
        } else {
            $this->innerView->assign('jsonData', "Invalid/Missing arguments!");
        }
        $this->innerView->setTemplate('json');
    }


    public function getSongFile()
    {
        if (isset($this->request["fname"]) && !empty($this->request["fname"])) {
            $fname = $this->request["fname"];
            if (empty($path = songModel::getSongFile($fname))) {
                $this->innerView->assign('jsonData', 'File not Found');
            } else {
                $this->fileTransfer($path);
                $this->innerView->assign('jsonData', 'File Transfer initiated!');
            }

        } else {
            $this->innerView->assign('jsonData', 'ID missing!');
        }
        $this->innerView->setTemplate('json');
    }

    public function getCover()
    {
        if (isset($this->request["fname"]) && !empty($this->request["fname"])) {
            $fname = $this->request["fname"];
            if (empty($path = songModel::getCoverImage($fname))) {
                $this->innerView->assign('jsonData', 'File not Found');
            } else {
                $this->fileTransfer($path);
                $this->innerView->assign('jsonData', 'File Transfer initiated!');
            }

        } else {
            $this->innerView->assign('jsonData', 'ID missing!');
        }
        $this->innerView->setTemplate('json');
    }

    private function fileTransfer($path)
    {   //startet Dateiübertragung aus dem angegebenen Pfad
        header("Content-Type: application/octet-stream");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . substr($path, strlen($path) - 36));
        header("Content-Transfer-Encoding: binary");
        header("Content-length: " . filesize($path));
        readfile($path);
    }


    public function display()       //Wird überschreiben weil das Standart Template nicht genutzt wird
    {
        // View erstellen
        $this->view = new View();

        // Innere View hinzufügen (assign)
        $this->view->assign('content', $this->innerView->loadTemplate());

        // Äußere View (main.php)
        $this->view->setTemplate('empty');

        // Rückgabe komplettes Template
        return $this->view->loadTemplate();
    }
}
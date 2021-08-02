<?php

class newSongController extends Controller{

    private $request    = null;


    public function __construct($request)
    {
        $this->request  = $request;
        $this->innerView = new View();

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
        // Template setzen
        $this->innerView->setTemplate('newSong');
    }

    public function addNewSong(){
        $ok = true;
        if(isset($this->request["name"]) && !empty($this->request["name"])) {
            $sname = $this->request['name'];
        }else{
            $ok=false;
        }

        if(isset($this->request["album"]) && !empty($this->request["album"])) {
            $salbum = $this->request['album'];
            $salbum = preg_replace("[ ,.;:!?-]", '', $salbum);
        }else{
            $ok=false;
        }

        if(isset($this->request["interpret"]) && !empty($this->request["interpret"])) {
            $sinterpret = $this->request['interpret'];
            $sinterpret = preg_replace("[ ,.;:!?-]", '', $sinterpret);
        }else{
            $ok=false;
        }

        if(isset($this->request["genre"]) && !empty($this->request["genre"])) {
            $sgenre = $this->request['genre'];
            $sgenre = preg_replace("[ ,.;:!?-]", '', $sgenre);
        }else{
            $ok=false;
        }
        if(!$ok){
            $this->innerView->assign('content', "Invalid arguments!");
            $this->innerView->setTemplate('error');
        }else{
            songModel::addNewSong($sname, $salbum, $sinterpret, $sgenre);

            try {
                if (isset($_FILES["songFile"]) && !empty($_FILES["songFile"])) {
                    //TODO abfrage Dateiformat einfügen
                    if (!songModel::addSongFile(songModel::getLastID(), bin2hex(random_bytes(16)), $_FILES["songFile"])) {
                        $this->innerView->assign('content', "Error saving File!");
                        $this->innerView->setTemplate('error');
                    }
                }

                if (isset($_FILES["coverImage"]) && !empty($_FILES["coverImage"])) {
                    //TODO abfrage Dateiformat einfügen
                    if (!songModel::addCoverImage(songModel::getLastID(), bin2hex(random_bytes(16)), $_FILES["coverImage"])) {
                        $this->innerView->assign('content', "Error saving File!");
                        $this->innerView->setTemplate('error');
                    }
                }
            } catch (Exception $e) {
            }

            $this->innerView->assign('content', "Song hinzugefügt!");
            $this->innerView->setTemplate('empty');

        }

    }

}
?>
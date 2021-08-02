<?php

/*TODO Methode zur Änderung der Einträge/Dateien
  eventuell über JS in Kombination mit einer funktion hier
  im Controller
*/

class adminPanelController extends Controller{

    private $request    = null;


    public function __construct($request)
    {
        // alle $_GET & $_POST Parameter setzen
        $this->request  = $request;

        // neue innere View (in Controller)
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
        $page= "<table class=\"table table-responsive-sm table-hover\">";
        $table = songModel::getSongData('%','%','%','%','%');

        $page = $page."<tr>";
        foreach ($table[0] as $key => $value){
            if($key != 'ID' && $key != 'Dateipfad' && $key != 'Coverpfad')
                $page = $page."<th>". $key;
        }
        $page = $page."<th>Datei";
        $page = $page."<th>Cover";

        foreach($table as $song){
            $page = $page."<tr>";
            foreach ($song as $key => $value){
                if($key != 'ID' && $key != 'Dateipfad' && $key != 'Coverpfad')
                    $page = $page."<td>". $value;
            }
            if(!empty(songModel::getSongFile($song['Dateipfad']))){
                $page = $page."<td><a href='?controller=api&function=getSongFile&fname=".$song['Dateipfad']. "'>Download";
            }else{
                $page = $page."<td>";
            }
            if(!empty(songModel::getCoverImage($song['Coverpfad']))){
                $page = $page."<td><a href='?controller=api&function=getCover&fname=".$song['Coverpfad']. "'>Download";
            }else{
                $page = $page."<td>";
            }
            $page = $page."<td><a href='?controller=adminPanel&function=deleteSong&ID=".$song['ID']. "'>Löschen";

        }
        $page = $page."</table>";
        $this->innerView->assign('content', $page);

        // Template setzen
        $this->innerView->setTemplate('adminPanel');
    }

    public function deleteSong(){
        if(isset($this->request["ID"]) && !empty($this->request["ID"])){
            if(count(songModel::getSongData($this->request["ID"], "%", "%", "%", "%")) == 1){
                songModel::deleteByID($this->request["ID"]);
                header('Location: index.php?controller=adminPanel');
            }else{
                $this->innerView->assign('content', 'ID not Found');
                $this->innerView->setTemplate('error');
            }
        }else{  //this Point should´nt be reached at any point!!!
            $this->innerView->assign('content', 'ID missing!');
            $this->innerView->setTemplate('error');
        }
    }

}
?>
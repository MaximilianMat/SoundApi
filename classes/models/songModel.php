<?php


class songModel
{

    public static function getSongData($id, $name, $album, $interpret, $genre)
    {

        $sql = "SELECT * FROM Song Where ID like :id AND Name like :name AND Album like :album AND Interpret like :interpret AND Genre like :genre";
        $params = array(
            'id' => $id,
            'name' => $name,
            'album' => $album,
            'interpret' => $interpret,
            'genre' => $genre
        );

        return DB::exe($sql, $params);

    }

    public static function addNewSong($name, $album, $interpret, $genre)
    {

        $sql = "INSERT INTO Song (Name, Album, Interpret, Genre) VALUES(:name, :album, :interpret, :genre)";
        $params = array(
            'name' => $name,
            'album' => $album,
            'interpret' => $interpret,
            'genre' => $genre
        );

        return DB::exe($sql, $params);

    }

    public static function getSongFile($fname)
    {
        if ($fname == "") return null;
        foreach (glob(SONGFILE_PATH . $fname . ".*") as $filename) {
            return $filename;
        }
    }

    public static function addSongFile($ID, $fname, $file)
    {
        $sql = "UPDATE Song SET Dateipfad = :fname WHERE ID = :id";
        $params = array(
            'id' => $ID,
            'fname' => $fname,
        );
        DB::exe($sql, $params);

        $target_file = SONGFILE_PATH . $fname . "." . strtolower(pathinfo(basename($file["name"]), PATHINFO_EXTENSION));
        return move_uploaded_file($file["tmp_name"], $target_file);
    }

    public static function getCoverImage($fname)
    {
        if ($fname == "") return null;
        foreach (glob(SONGCOVER_PATH . $fname . ".*") as $filename) {
            return $filename;
        }
    }

    public static function addCoverImage($ID, $fname, $file)
    {
        $sql = "UPDATE Song SET Coverpfad = :fname WHERE ID = :id";
        $params = array(
            'id' => $ID,
            'fname' => $fname,
        );
        DB::exe($sql, $params);

        $target_file = SONGCOVER_PATH . $fname . "." . strtolower(pathinfo(basename($file["name"]), PATHINFO_EXTENSION));
        return move_uploaded_file($file["tmp_name"], $target_file);
    }

    public static function deleteByID($id)
    {
        $song = self::getSongData($id, "%", "%", "%", "%");
        $file = $song[1]['Dateipfad'];
        $cover = $song[1]['Coverpfad'];

        $sql = "DELETE FROM Song where ID = :id LIMIT 1";
        $params = array(
            'id' => $id,

        );

        unlink(self::getSongFile($file));
        unlink(self::getCoverImage($cover));

        return DB::exe($sql, $params);
    }

    public static function getLastID()
    {
        $sql = "SELECT * FROM Song Order by ID DESC LIMIT 1";
        return DB::exe($sql, null)[0]['ID'];
    }
}
<?php


class userModel
{
    public static function validate($username, $password){
        if($username == ROOT_USER && $password == ROOT_PASS){
            return true;
        }

        $sql = 'SELECT Passwort FROM User WHERE Username Like :username LIMIT 1';
        $params = array(
            'username'        => $username
        );

        $passHash = DB::exe($sql, $params)[0]['Passwort'];
        return password_verify($password, $passHash);
    }

    public static function addUser($username, $passwort){
        $sql = 'INSERT INTO User VALUES (:username, :passwort)';
        $params = array(
            'username'        => $username,
            'passwort'        => password_hash($passwort, PASSWORD_DEFAULT)
        );

        return DB::exe($sql, $params);
    }

}
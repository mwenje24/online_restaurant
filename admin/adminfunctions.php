<?php

require_once "../assets/functions.php";

class func{
    public static function loginstate($db){
        if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])){
            session_start();
        }
        if(isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])){

            $statement = $db->prepare("SELECT * FROM sessions WHERE session_userid = :userid AND session_token = :token  AND session_serial = :serial");
            

            $userid = $_COOKIE['id'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            
            $statement->bindValue(':userid', $userid);
            $statement->bindValue(':token', $token);
            $statement->bindValue(':serial', $serial);
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            if($row['session_userid'] > 0){
                if (
                    $row['session_userid'] == $_COOKIE['userid'] &&
                    $row['session_token'] == $_COOKIE['token'] &&
                    $row['session_serial'] == $_COOKIE['serial']
                    ){
                        if(
                        $row['session_userid'] == $_SESSION['userid'] &&
                        $row['session_token'] == $_SESSION['token'] &&
                        $row['session_serial'] == $_SESSION['serial']
                            ){
                                return true;
                            }
                    }
            }

        }
    }

    public static function createRecord($db, $username, $userid){
        $stmt = $db->prepare('DELETE FROM sessions WHERE session_userid = :session_userid');
        $stmt->bindValue(':session_userid', $userid);
        $stmt->execute();

        $token =randomId(10);//randomString
        $serial =randomId(10);//randomString
        func::createCookies($username, $userid, $token, $serial);
        func::createSessions($username, $userid, $token, $serial);

        $statement = $db->prepare('INSERT INTO sessions (session_userid, session_token, session_serial, session_date)
         VALUES(:userid, :token, :serial, "19/08/2017")');
        $statement->bindValue(':userid', $userid);
        $statement->bindValue(':token', $token);
        $statement->bindValue(':serial', $serial);
        $statement->execute();
    }
    public static function createCookies($username, $userid, $token, $serial){
        setcookie('userid', $userid, time() + (86400) * 30, "/");
        setcookie('usernaem', $username, time() + (86400) * 30, "/");
        setcookie('token', $token, time() + (86400) * 30, "/");
        setcookie('serial', $serial, time() + (86400) * 30, "/");
    }
    public static function createSessions($username, $userid, $token, $serial){
        if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])){
            session_start();
        }
        $_SESSION['username'] = $username;
    }
}

?>
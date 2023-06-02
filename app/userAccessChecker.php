<?php
class LoggedUser
{

    private $database;
    public  function __construct()
    {
        require_once("dbQuery.php");
        $this->database = new DB();
    }

    public static function checkLogin()
    {
        $sessionStatus = session_status();
        if ($sessionStatus == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["fms_user"]) && !empty($_SESSION["fms_user"])) {
            return true;
        } else {
            return false;
        }
    }

    public static function loggedUserData()
    {
        $sessionStatus = session_status();
        if ($sessionStatus == PHP_SESSION_NONE) {
            session_start();
        }
        $sessionData = $_SESSION["fms_user"];
        if (!$sessionData) {
            return null;
        }

        $query = "SELECT * FROM `users` WHERE `email`=? AND `password`=?";
        $loggeduser = new LoggedUser();
        $stmt1 = $loggeduser->database->prepare($query, "ss", array($sessionData["email"], $sessionData["password"]));
        $results = $stmt1->get_result();

        $_SESSION["fms_user"] = $results->fetch_assoc();

        return $_SESSION["fms_user"] ?? null;
    }


    public static function logOut()
    {
        $sessionStatus = session_status();
        if ($sessionStatus == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["fms_user"] == "";
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        // Destroy the session
        session_destroy();

        return true;
    }

    public static function updateSession($password)
    {
        $sessionStatus = session_status();
        if ($sessionStatus == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["fms_user"])) {
            return false;
        }

        $sessionData = $_SESSION["fms_user"];
        $query = "SELECT * FROM `users` WHERE `email`=? AND `password`=?";
        $loggeduser = new LoggedUser();
        $stmt1 = $loggeduser->database->prepare($query, "ss", array($sessionData["email"], $password));
        $results = $stmt1->get_result();

        $_SESSION["fms_user"] = $results->fetch_assoc();

        return true;
    }
}

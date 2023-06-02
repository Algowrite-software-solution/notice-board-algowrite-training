<?php

class ErrorSender
{
    public static function sendError($responseObject)
    {
        $responseJsonText = json_encode($responseObject); // for arrays and objects
        echo ($responseJsonText);
        die();
    }
}

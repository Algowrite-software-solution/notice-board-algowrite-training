<?php
class ServerDataFetcher
{
    public static function getRootUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $FOLDER_STRUCTURE = "ceygenic/travel-mems-web-application/";
        $server_root_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/" . $FOLDER_STRUCTURE;
        return $server_root_url;
    }
}

<?php
    require_once("Config/Config.php");
    require_once("Helpers/Helpers.php");
    $url = !empty($_GET['url']) ? $_GET['url'] : "home/home";

    $arrayurl = explode("/",$url);
    $controller= $arrayurl[0];
    $method = $arrayurl[0];
    $params = "";

    if (!empty($arrayurl[1]))
    {
        if($arrayurl[1] != "")
        {
            $method = $arrayurl[1];
        }
    }

    if(!empty($arrayurl[2]))
    {
        if($arrayurl[2] != "")
        {
            for ($i = 2; $i < count($arrayurl); $i++)
            { 
                $params .= $arrayurl[$i].', ';
            }
            $params = trim($params,', ');
        }
    }

    require_once("Libraries/Core/Autoload.php");
    require_once("Libraries/Core/Load.php");
?>
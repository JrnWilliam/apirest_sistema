<?php
    function UrlBase()
    {
        return BASE_URL;
    }

    function Media()
    {
        return BASE_URL . "/Assets";
    }

    function Formato($data)
    {
        $formato = print_r('<pre>');
        $formato .= print_r($data);
        $formato .= print_r('</pre>');
        return $formato; 
    }

    function LimpiarCadena($cadena)
    {
        // $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $cadena);
        // $string = trim($string);
        // $string = stripslashes($string);
        // $string = str_ireplace("<string>","",$string);
        // $string = str_ireplace("</string>","",$string);
        // $string = str_ireplace("<script src>","",$string);
        // $string = str_ireplace("<script type=>","",$string);
        // $string = str_ireplace("SELECT * FROM","",$string);
        // $string = str_ireplace("DELETE FROM","",$string);
        // $string = str_ireplace("INSERT INTO","",$string);
        // $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        // $string = str_ireplace("DROP TABLE","",$string);
        // $string = str_ireplace("OR '1'='1","",$string);
        // $string = str_ireplace('OR "1"="1"',"",$string);
        // $string = str_ireplace('OR ´1´=´1´',"",$string);
        // $string = str_ireplace("is NULL; -- ","",$string);
        // $string = str_ireplace("is NULL; -- ","",$string);
        // $string = str_ireplace("LIKE '","",$string);
        // $string = str_ireplace('LIKE "',"",$string);
        // $string = str_ireplace("LIKE ´","",$string);
        // $string = str_ireplace("OR 'a'='a","",$string);
        // $string = str_ireplace('OR "a"="a',"",$string);
        // $string = str_ireplace("OR ´a´=´a","",$string);
        // $string = str_ireplace("OR ´a´=´a","",$string);
        // $string = str_ireplace("--","",$string);
        // $string = str_ireplace("^","",$string);
        // $string = str_ireplace("[","",$string);
        // $string = str_ireplace("]","",$string);
        // $string = str_ireplace("=","",$string);

        $string = preg_replace('/\s+/', ' ', trim($cadena));

        // Eliminar caracteres peligrosos y palabras clave usadas en SQL Injection
        $patronesSQL = [
            "<script src>", "<script type=>", "SELECT * FROM", "DELETE FROM", "INSERT INTO", 
            "SELECT COUNT(*) FROM", "DROP TABLE", "OR '1'='1", 'OR "1"="1"', 'OR ´1´=´1´', 
            "is NULL; -- ", "LIKE '", 'LIKE "', "LIKE ´", "OR 'a'='a", 'OR "a"="a"', "OR ´a´=´a", 
            "--", "^", "[", "]", "="
        ];
    
        // Reemplazar todos los patrones por una cadena vacía
        foreach ($patronesSQL as $patron)
        {
            $string = str_ireplace($patron, '', $string);
        }
    
        // Eliminar las barras invertidas si la cadena ha sido escapada previamente
        $string = stripslashes($string);
        
        return $string;
    }

    function JSONRespuesta(array $arrData, int $codigo)
    {
        if(is_array($arrData))
        {
            header("HTTP/1.1 " . $codigo);
            header("Content-Type: application/json");
            echo json_encode($arrData,true);
        }
    }
?>
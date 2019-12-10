<?php

class AcortadorA
{

    public function ouo($enlace,$ouo_Key)
    {
        $acortado = @file_get_contents(
                    "https://ouo.io/api/"
                    . urlencode($ouo_Key)
                    . "?s="
                    . urlencode($enlace));
                    
        return $acortado;
    }

    public function universal($enlace, $universal_Key, $dominio)
    {
        $enlacesD = urlencode($enlace);

        $json = file_get_contents("https://".$dominio."/api?api=".$universal_Key."&url=".$enlacesD);
        $ll = json_decode($json, true);

        return $ll['shortenedUrl'];
    }
}

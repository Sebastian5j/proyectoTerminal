<?php
//include 'conectarBD.php';
function isItThere($nPings, $id, $db)
{
    $getIP = "select ip from interface where dispositivo_idDispositivo = ".$id."  and estado = 'up                    up' and ip != 'unassigned' limit 1;";
    $result =  $db->execute($getIP);
    while($row = $result->fetch_assoc())
    {
        $ip = $row["ip"];
    }
    $command = 'ping -c '.$nPings.' '.$ip;
    $result = shell_exec($command);
    $regexp = "/.*[1-9] received.*/";
    if(preg_match($regexp,$result) == 1)
        return 1;
    else
        return 0;
    
    //$db->disconnect();
}
//if(isItThere(2, 4, $db) == 1)
//    echo "si";

?>

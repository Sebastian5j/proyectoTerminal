<?php
include 'conectarBD.php';

$id = $_GET["id"];
$interfaces = $_GET["interfaces"];
$idVlan = $_GET["idVlan"];

$noJSON = json_decode($interfaces);
$db->connect();
$deviceName = $db->execute("select nombre from dispositivo where idDispositivo = ".$id." LIMIT 1;");

while($row1 = $deviceName->fetch_assoc())
{
			$r1 = $row1["nombre"];                     
            $ip = $db->execute("select ip from interface where dispositivo_idDispositivo = ".$id." AND estado = 'up                    up' AND ip <> 'unassigned' LIMIT 1");
            while($row2 = $ip->fetch_assoc())
            {
                $r2 = $row2["ip"];
                $query = '/usr/bin/python2.7 /var/www/html/pt/mainCreateVlan.py '.$r1.' '.$r2.' '.$idVlan.' ';  
            }
}
for($i = 0; $i < count($noJSON); $i++)
{
    $query.=$noJSON[$i]->name;
    $query.=" ";
}
echo $query;
$result = system($query.'\n');
echo $result;

$db->disconnect();

?>


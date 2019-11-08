<?php
include 'conectarBD.php';

$id = $_GET["id"];
$interfaces = $_GET["interfaces"];
$accesList = $_GET["accesList"];
$inOut = $_GET["inOut"];
/*
echo "----";
echo $id;
echo $interfaces;
echo $accesList;
echo $inOut;
echo "---";
*/
echo $accesList;
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
                $query = '/usr/bin/python2.7 /var/www/html/pt/mainCreateAccesList.py '.$r1.' '.$r2.' '.$inOut.' '.$accesList.' ';  
            }
}
for($i = 0; $i < count($noJSON); $i++)
{
    $query.=$noJSON[$i]->name;
    $query.=" ";
}
echo $query;

$result = system($query);
echo $result;

$db->disconnect();


?>

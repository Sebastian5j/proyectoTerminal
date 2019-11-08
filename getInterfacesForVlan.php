<?php
include 'conectarBD.php';
$db->connect();
$idVlan = $_GET["id"];
//$idVlan = 4;
$getNodos = "select nombre from interface where dispositivo_idDispositivo = ".$idVlan." and nombre not like 'Vlan%';";
$interfacesName = $db->execute($getNodos);

if($interfacesName->num_rows > 0)
{
	while($row = $interfacesName->fetch_assoc())
	{
	    $interfaces[] = ['name' => $row['nombre'] ];
    }
}
echo json_encode($interfaces);

$db->disconnect();
?>
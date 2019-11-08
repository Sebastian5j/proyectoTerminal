<?php
include 'conectarBD.php';
include 'isNodoAlive.php';
$db->connect();

$getNodos = "select * from dispositivo;";
$result =  $db->execute($getNodos);
$matriz = [ [ ], [ ] ];

while($row = $result->fetch_assoc())
{
		if(isItThere(1,(int)$row['idDispositivo'], $db) == 1)
		$matriz[0][] = [ 'id' => (int)$row['idDispositivo'], 'name' => $row['nombre'] , 'tipo' => $row['tipo']];
		
}

$getNeighborhod = "select DISTINCT LEAST(dispositivo_idDispositivo, dispositivo_idDispositivo1), GREATEST(dispositivo_idDispositivo, dispositivo_idDispositivo1) from enlace;";
$result = $db->execute($getNeighborhod);
while($row = $result->fetch_assoc())
{
	$matriz[1][] = ['dispositivo_idDispositivo' => (int) $row['LEAST(dispositivo_idDispositivo, dispositivo_idDispositivo1)'], 
					'dispositivo_idDispositivo1' => (int) $row['GREATEST(dispositivo_idDispositivo, dispositivo_idDispositivo1)']];
}
echo json_encode($matriz);

$db->disconnect();
?>

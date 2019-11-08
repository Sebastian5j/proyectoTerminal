<?php
include 'conectarBD.php';
$db->connect();
$db->execute("delete from enlace");
$users = $db->execute("select idDispositivo, nombre, tipo from dispositivo");
if($users->num_rows > 0)
{
	while($row = $users->fetch_assoc())
	{
		$id = $row["idDispositivo"];
		$name = $row["nombre"];
		$tipo = $row["tipo"];
		if($tipo=="router")
		{
		
		$interfaces = $db->execute("select ip from interface where dispositivo_idDispositivo = (select idDispositivo from dispositivo where nombre = '".$name."') AND estado = 'up                    up' LIMIT 1");
		}
		else
		{
		$interfaces = $db->execute("select ip from interface where dispositivo_idDispositivo = (select idDispositivo from dispositivo where nombre = '".$name."') AND estado = 'up                    up' AND ip <> 'unassigned' LIMIT 1");
		}
		while($row1 = $interfaces->fetch_assoc())
		{
			$ip = $row1["ip"];
			$query = '/usr/bin/python2.7 /var/www/html/pt/mainInsertNeighbors.py '.$name.'     '.$ip;
			$result = system($query);
			echo $result;
		}
	}
}

$db->disconnect();
?>

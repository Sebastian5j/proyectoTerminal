<?php
$id = $_GET["id"];
$command = $_GET["inst"];
$query = '/usr/bin/python2.7 /var/www/html/pt/mainSendInstruction.py '.$id.'  '.$command;
$result =  system($query);
echo $result;
?>

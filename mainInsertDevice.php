
<?php
$name = $_GET["name"];
$ip = $_GET["ip"];

$query = '/usr/bin/python2.7 /var/www/html/pt/mainInsertDevice.py '.$name.' '.$ip;
#echo "ejecutare: ".$query."\n";
$ret = system($query);
echo $ret;

$query = '/usr/bin/python2.7 /var/www/html/pt/mainInsertInterfaces.py '.$name.' '.$ip;
$ret = system($query);
echo $ret;

?>

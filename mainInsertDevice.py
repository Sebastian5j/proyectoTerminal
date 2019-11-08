#!/usr/bin/python2.7
import requests
import sys
#sys.path.append("/home/sebastian/.local/lib/python2.7/site-packages")
import cgitb; cgitb.enable()
from manager import *
import re as myreg
from sys import argv
scriptName,   deviceName, IP  = argv
user = ['1','sebas','1197sebas']
manager = manager()
device = ['1', IP, deviceName]
devices = []
devices.append(device)
connections = manager.createConnections(devices,user)
result   =  manager.execute(connections, "sh version \n")
print(result)

dataBase.connect()
##### verificar tipo de dispositivo

if(myreg.findall("vios_l2 Software",result[0])):
	print("encontre un switch")
	query = "insert into dispositivo(nombre, tipo, users_idusers) values('"+deviceName+"','switch',1);"
	dataBase.execute(query)
else:
	query = "insert into dispositivo(nombre, tipo, users_idusers) values('"+deviceName+"','router',1);"
	dataBase.execute(query)
######

dataBase.disconnect()
print("aqui ya debe haber insertado")

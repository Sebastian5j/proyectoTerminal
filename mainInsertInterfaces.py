from manager import *
from sys import argv

user = ['1','sebas','1197sebas']
scriptName,  deviceName, IP = argv
manager = manager()
#device = manager.createDevice(deviceName, IP)

device = ['1', IP, deviceName]
devices = []
devices.append(device)

connections = manager.createConnections(devices, user)
interfaces = manager.getInterfaces(connections)
interfaceName, IP, status = manager.parseInterfaces(interfaces)

dataBase.connect()
query = "select idDispositivo from dispositivo where nombre = '"+ deviceName + "' LIMIT 1;"
idDevice = dataBase.execute(query)
idDevice = idDevice[0][0]

for i in range(0, len(interfaceName[0])):
	query = "insert into interface(nombre, ip, estado, dispositivo_idDispositivo) values ('" +interfaceName[0][i][0]+ "','"+IP[0][i][0]+"','" + status[0][i][0] + "',"+str(idDevice)+");"
	dataBase.execute(query)
dataBase.disconnect()


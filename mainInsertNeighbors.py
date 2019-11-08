from manager import *
from sys import argv
user = ['1','sebas','1197sebas']
scriptName, deviceName, IP = argv
manager = manager()
device = ['1', IP, deviceName]
devices = []
devices.append(device)
connections = manager.createConnections(devices, user)
neighbors = manager.getNeighbors(connections)
neighborNames = manager.parseNeighbors(neighbors)
print(neighborNames)

dataBase.connect()
query = "select idDispositivo from dispositivo where nombre = '"+ deviceName+ "' LIMIT 1;"
idDevice = dataBase.execute(query)
idDevice = idDevice[0][0]
print(idDevice)
for i in range(0, len(neighborNames[0])):
	query = "select idDispositivo from dispositivo where nombre = '"+ neighborNames[0][i]+ "' LIMIT 1;"
	idNeighbor = dataBase.execute(query)
	idNeighbor = idNeighbor[0][0]
	query = "insert into enlace(dispositivo_idDispositivo, dispositivo_idDispositivo1) values("+str(idDevice)+","+str(idNeighbor)+");"
	dataBase.execute(query)
dataBase.disconnect()

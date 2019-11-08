from manager import *
from sys import argv

user = ['1','sebas','1197sebas']
scriptName, idDevice , instruction= "",1,""
instruction = ""
for i in range(0, len(argv)):
	if(i==0):
		scriptName = argv[0]
	if(i==1):
		idDevice = argv[1]
	if(i>1):
		instruction += argv[i] + " "
	#print(instruction)

instruction += "\n end"	
user = ['1','sebas','1197sebas']

manager = manager()
#conn = dbConnection(dbHost, username, password, dataBaseName)
conn = dataBase
conn.connect()
query = "select nombre from dispositivo where idDispositivo = " + idDevice
deviceName = conn.execute(query)
deviceName = deviceName[0][0]
query = "select ip from interface where dispositivo_idDispositivo = "+idDevice + " AND estado = 'up                    up' AND ip <> 'unassigned' LIMIT 1"
ip = conn.execute(query)
ip = ip[0][0]
#print(ip)
device = [str(idDevice), ip, deviceName]
devices = []
devices.append(device)
connections = manager.createConnections(devices,user )
result   =  manager.execute(connections, instruction)  
#result += manager.execute(connections, "ip dhcp excluded-address 1.1.1.2")
for i in result[0].split("\r\n"):
	print(i)

conn.disconnect()

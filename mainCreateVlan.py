from manager import *
from sys import argv
user = ['1','sebas','1197sebas']
scriptName, deviceName, IP, idVlan = argv[0], argv[1], argv[2], argv[3]
manager = manager()
#print(scriptName, deviceName, IP, idVlan)
interfaces = []
for i in range(4,len(argv)):
	interface = argv[i]
	interfaces.append(interface)
#print(interfaces)
device = ['1',IP, deviceName]
devices = []
devices.append(device)


connections = manager.createConnections(devices, user)
connections[0].connect()

print(connections[0].sendInstruction("enable\n"))
print(connections[0].sendInstruction("configure terminal\n"))
for i in range(0, len(interfaces)):	
	#print(connections[0].sendInstruction('configure terminal \n'))
	print(connections[0].sendInstruction("interface "+interfaces[i] + "\n"))
	print(connections[0].sendInstruction("switchport access vlan "+ idVlan + "\n"))
	print(connections[0].sendInstruction("exit\n"))
connections[0].sendInstruction("end\n")
connections[0].disconnect()



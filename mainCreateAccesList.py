from manager import *
from sys import argv
user = ['1','sebas','1197sebas']
scriptName, deviceName, IP, inOut = argv[0], argv[1], argv[2], argv[3]
manager = manager()
interfaces = []
accesList = ""
for i in range(4, len(argv)):
    if(re.search("^GigabitEthernet|^FastEthernet",argv[i])):
        interfaces.append(argv[i])
    else:
        accesList+=argv[i]+" "

device = ['1', IP, deviceName]
devices = []
devices.append(device)
print("mi acces list queda ", accesList)
connections = manager.createConnections(devices, user)
connections[0].connect()
print(connections[0].sendInstruction("configure terminal\n"))
print(connections[0].sendInstruction(accesList))
for i in range(0, len(interfaces)):
    print(connections[0].sendInstruction("interface "+interfaces[i]))
    print(connections[0].sendInstruction("ip access-group "+argv[5]+" "+inOut))
    print(connections[0].sendInstruction("exit"))

connections[0].sendInstruction("end\n")
connections[0].disconnect()
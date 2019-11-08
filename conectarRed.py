from pexpect import pxssh
#conecta a los dispositivos
class deviceConnection:
	def __init__(self, ip,name, user, password):
		self.conn = pxssh.pxssh()
		self.ip = ip
		self.name = name
		self.user = user
		self.password = password
	
	def connect(self):
		self.conn.login(self.ip, self.user, self.password, auto_prompt_reset= False)
		
	
	def sendInstruction(self, instruction):
		self.conn.sendline(instruction)
		self.conn.expect(self.name)
		response = self.conn.before
		return response

	def disconnect(self):
		self.conn.logout()
		self.conn.close()


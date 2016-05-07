#encoding=utf-8
#如果出现socket.error: [Errno 98] Address already in use的问题
#
#运行lsof -i:21230， 查找到对应的pid，如为16598
#运行sudo kill -9 16598 才强行杀死
#即可重新监听端口
#
#

import os
import json
from BaseHTTPServer import HTTPServer
from BaseHTTPServer import BaseHTTPRequestHandler  



class MyHttpHandler(BaseHTTPRequestHandler):    
	def do_GET(self):  
		if "search" in self.path:  

			buf = "It works"  
			self.protocal_version = "HTTP/1.1"  
			self.send_response(200)  
			self.send_header("Welcome", "Contect")         
			self.end_headers()  
			self.wfile.write(buf)

	def do_POST(self):
		if "search" in self.path:

			result = self.rfile.read(int(self.headers['content-length']))

			aobject = ascene = aperiod = aperson = averb = ''
			for key_value in result.split('&'):
				info = key_value.split('=')
				if info[0] == 'object':
					aobject = info[1]
				elif info[0] == 'scene':
					ascene = info[1]
				elif info[0] == 'period':
					aperiod = info[1]
				elif info[0] == 'person':
					aperson = info[1]
				elif info[0] == 'verb':
					averb = info[1]

			returnlist = []			
			
			info={}
			info["eid"]=0
			info["text"]="American Civil War : A day after Union forces capture Richmond, Virginia , U.S. President Abraham Lincoln visits the Confederate capital."
			info["tag"]=["a", "aa", "aaaa", "aaaaa"]
			returnlist.append(info)

			info={}
			info["eid"]=1
			info["text"]="World War II - Fuehrerbunker : Adolf Hitler marries his long-time partner Eva Braun in a Berlin bunker and designates Admiral Karl Dönitz as his successor."
			info["tag"]=["b", "bb", "bbb", "bbbb"]
			returnlist.append(info)

			info={}
			info["eid"]=2
			info["text"]="General Douglas MacArthur fulfills his promise to return to the Philippines when he commands an Allied assault on the islands, reclaiming them from the Japanese during the Second World War ."
			info["tag"]=["c", "cc", "ccc", "cccc"]
			returnlist.append(info)

			info={}
			info["eid"]=2
			info["text"]="General Douglas MacArthur fulfills his promise to return to the Philippines when he commands an Allied assault on the islands, reclaiming them from the Japanese during the Second World War ."
			info["tag"]=["c", "cc", "ccc", "cccc"]
			returnlist.append(info)

			info={}
			info["eid"]=0
			info["text"]="President Dwight D. Eisenhower signs the Alaska Statehood Act into United States law ."
			info["tag"]=["cb", "cbc", "bbbbb", "bbb"]
			returnlist.append(info)

			info={}
			info["eid"]=1
			info["text"]="Nat Turner's slave rebellion revolt commences just after midnight in Southampton, Virginia , leading to the deaths of more than 50 whites and several hundred African Americans who were killed in retaliation for the uprising."
			info["tag"]=["cdd", "ccddd", "ccdc", "cccdc"]
			returnlist.append(info)
			
			info={}
			info["eid"]=2
			info["text"]="zzzzzzzzzzzcccccccccccccccccczzzzzzzzzzzccccccccccccccccccz"
			info["tag"]=["c", "cc", "ccc", "cccc"]
			returnlist.append(info)



			returnstr = json.dumps(returnlist)
			  
			self.protocal_version = "HTTP/1.1"   
			self.send_response(200)  
			self.send_header("Welcome", "Contect")         
			self.end_headers()  
			self.wfile.write(returnstr)


LISTEN_PORT = 21230     #服务侦听端口


httpd = HTTPServer(('127.0.0.1', LISTEN_PORT), MyHttpHandler)
httpd.serve_forever()

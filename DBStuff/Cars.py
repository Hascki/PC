import urllib
import httplib
import time

f=open('insert.txt','a')
x=open('carid.txt','r')
headers={"Content-Type": "application/json, text/javascript, */*"}
domain="www.mobile.de"
de="Name\":\""
connection=httplib.HTTPConnection(domain,80)
connection.set_debuglevel(0)
for ModelId in range (1,112):
    
    carID=x.readline()
    print 'Am citit '+carID
    url="http://www.mobile.de/ro/internal/car/"+str(carID).strip()+"/models"
    print 'URL:'+url
    connection.request("GET", url,body="", headers=headers)
    response = connection.getresponse()
    rasp = ""
    if response.status == 200:
        rasp =  response.read()
        print rasp
    index=rasp.find(de)
    a=rasp
    while(index!=-1):
        a=a[index+7:]
        b=a.find("\"");
        model=a[:b]
        if model=="Altele":
            break
        else:
            f.write ("INSERT INTO `proiectcolectiv`.`modele` (`MakeId`, `ModelName`, `Type`) VALUES ("+str(ModelId)+", '"+model+"', 1);\n")
        a=a[b:]
        index=a.find(de)
    time.sleep(2)
    
f.close()
x.close()

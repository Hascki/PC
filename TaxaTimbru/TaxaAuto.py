__author__ = 'Stefan'
import urllib
import urllib2
import json
import datetime
import time
from bs4 import BeautifulSoup

url = 'http://www.4tuning.ro/calculator-timbru-mediu-2013/'
jsonFile = open('produse.json', 'r')
values = json.load(jsonFile)
update=open('update.txt','a')


cur_date = datetime.datetime.now()
cur_date.strftime("%Y-%m-%d")

for product in values:
    id = product["IdAnunt"]
    date = product["DataFabricatie"]
    cap = product["Capacitate"]
    euro = product["ClasaEuro"]
    emis = product["Emisi"]
    fuel = product["Combustibil"]


    date=datetime.datetime.strptime(date, "%Y-%m-%d")
    date = abs((cur_date - date).days)
    if date == 0:
        age=1
    elif date <= 30 and date > 0:
        age=2
    elif date <= 90 and date > 30:
        age=3
    elif date <= 180 and date > 90:
        age=4
    elif date <= 270 and date > 180:
        age=5
    elif date <= 365 and date > 270:
        age=6
    elif date <= 365 and date > 270:
        age=7
    elif date <= 730 and date > 365:
        age=8
    elif date <= 1095 and date > 730:
        age=9
    elif date <= 1460 and date > 1095:
        age=10
    elif date <= 1825 and date > 1460:
        age=11
    elif date <= 2190 and date > 1825:
        age=12
    elif date <= 2555 and date > 2180:
        age=13
    elif date <= 2920 and date > 2555:
        age=14
    elif date <= 3285 and date > 2920:
        age=15
    elif date <= 3650 and date > 3285:
        age=16
    elif date <= 4015 and date > 3650:
        age=17
    elif date <= 4380 and date > 4015:
        age=18
    elif date <= 4745 and date > 4380:
        age=19
    elif date <= 5110 and date >  4745:
        age=20
    else:
        age=21


    if(fuel == 3 or euro == 6):
         values = {'categ' : '1',
            'euro' : '-1',
            'co2' : emis,
            'age' : age,
            'cc' : cap,
            'combustibil' : '1',
            'send' : 'Calculeaza+taxa+auto+2015'}
    else :
        values = {'categ' : '1',
            'euro' : euro,
            'co2' : emis,
            'age' : age,
            'cc' : cap,
            'combustibil' : '1',
            'send' : 'Calculeaza+taxa+auto+2015'}

    data = urllib.urlencode(values)
    req = urllib2.Request(url, data)
    response = urllib2.urlopen(req)
    the_page = response.read()
    parsed_page = BeautifulSoup(the_page)

    needed_from_page =parsed_page.body.findAll('div', class_="tax_results_right")
    fuel_type=[]
    for res in needed_from_page:
        fuel_type.append(res.text)

    gasolineTax=fuel_type[0].split()[0]
    gasolineTax= gasolineTax.replace(',','')
    dieselTax=fuel_type[1].split()[0]
    dieselTax= dieselTax.replace(',','')
    if(gasolineTax=="EURO" or dieselTax=="EURO"):
        gasolineTax="0"
        dieselTax="0"
    #print fuel
    if(fuel=='1'):
        #print gasolineTax
        update.write("UPDATE proiectcolectiv.produse SET CostTimbru="+str(gasolineTax)+" WHERE 'IdAnunt'="+str(id)+";\n")
    else:
        #print dieselTax
        update.write("UPDATE proiectcolectiv.produse SET CostTimbru="+str(dieselTax)+" WHERE 'IdAnunt'="+str(id)+";\n")
    #else:
     #   print 'hibrid'
      #  update.write("UPDATE proiectcolectiv.produse SET CostTimbru="+str(gasolineTax)+" WHERE IdAnunt="+str(id)+";\n")
    time.sleep(2)
update.close()
import lxml.html
import requests
import os, sys, csv, optparse
from lxml import etree
from lxml import html
from lxml.html.clean import clean_html
from datetime import datetime, timedelta


class SkipException (Exception):
    def __init__(self, value):
		self.value = value
		
airport = sys.argv[1]

if len(sys.argv) !=3:
	yest = datetime.today() - timedelta(days=1)
	date = '%02.f-%02.f-%02.f' %( yest.year, yest.month, yest.day)
else:
	date = sys.argv[2]
	yest = datetime.datetime(2013, 1, 14, 0, 9)
	
	newtime = datetime.strptime('%02.f-%02.f-%02.f' %( yest.year, yest.month, yest.day) + ' ' + oldtime,'%Y-%m-%d %H:%M %p')
# Set the time periods to query
queryTimes = ['3','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23']

outfile = 'FSScrape_%s.csv' % airport
output = csv.writer(open(outfile, 'w'), delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)

for idqt, qT in enumerate(queryTimes):
	page = requests.get('http://www.flightstats.com/go/FlightStatus/flightStatusByAirport.do?airportCode=%s&airportQueryDate=%s&airportQueryTime=%s&airportQueryType=0&queryNext=false&queryPrevious=false&sortField=3&airportToFilter=--+All+Airports+--&codeshareDisplay=0&airlineToFilter=--+All+Airlines+--' % (airport, date, qT))
	tree = html.fromstring(page.text)
	tbl = tree.xpath('//td[@id="mainAreaLeftColumn"]/table/tr')

	print "Found %s rows for %s in QueryTime %.f" % (len(tbl), airport, idqt)
	for r in tbl:
		# data = r.xpath("td")
		data = r
		try:  # in a try so we drop lines that don't have enough data
			line = list()
			src = data[0].xpath("a")[0]
			if type(src.text) is str:
				line.append(src.text)
			else:
				line.append(src.text)
				
			x = data[1][0]
			if type(x.text) is str:
				line.append(x.text.replace('\n',''))
			else:
				line.append('')
						
			for idx, x in enumerate(data[3:9]):
				if idx in (1,2):
					if type(x.text) is str:
						oldtime = x.text.replace('\n','')
						newtime = datetime.strptime('%02.f-%02.f-%02.f' %( yest.year, yest.month, yest.day) + ' ' + oldtime,'%Y-%m-%d %H:%M %p')
						line.append('%02.f' % (newtime - datetime.utcfromtimestamp(0)).total_seconds())
					else:
						line.append('')
				if type(x.text) is str:
					line.append(x.text.replace('\n',''))
				else:
					line.append('')
					
			output.writerow(line)	
		except:
			pass

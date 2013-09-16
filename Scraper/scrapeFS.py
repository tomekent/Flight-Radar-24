import lxml.html
import requests
import os, sys, csv
from lxml import etree
from lxml import html
from lxml.html.clean import clean_html


class SkipException (Exception):
    def __init__(self, value):
		self.value = value
airport = sys.argv[1]
queryTimes = ['3','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23']

outfile = 'scrape_%s.csv' % airport
output = csv.writer(open(outfile, 'w'), delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)

for qT in queryTimes:
	page = requests.get('http://www.flightstats.com/go/FlightStatus/flightStatusByAirport.do?airportCode=%s&airportQueryDate=2013-09-15&airportQueryTime=%s&airportQueryType=0&queryNext=false&queryPrevious=false&sortField=3&airportToFilter=--+All+Airports+--&codeshareDisplay=0&airlineToFilter=--+All+Airlines+--' % (airport, qT))
	tree = html.fromstring(page.text)
	tbl = tree.xpath('//td[@id="mainAreaLeftColumn"]/table/tr')

	print "Found %s rows for %s in QueryTime %s" % (len(tbl), airport, qT)
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
						
			for x in data[1:9]:
				if type(x.text) is str:
					line.append(x.text.replace('\n',''))
				else:
					line.append('')
					
			output.writerow(line)	
		except:
			pass

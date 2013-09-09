#!/bin/python
# Filename: F24.py

def F24(year,month,day,hour,minute):

	#import the urllib commands to use.
	from StringIO import StringIO
	import gzip
	import urllib
	import urllib2

	#Set the url of the flightradar24 php to post to
	url = 'http://db.flightradar24.com/playback/'

	#define the user agent to be something 
	user_agent = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT)'

	date_str=''
	fname='F24data_'
	date_str +=str(year)
	#date_str +='-'
	
	# remove any errors arising from the int input of for example 01 being truncated to 1.
	if int(month)<10:
		date_str +='0'
		
	date_str +=str(month)	
	#date_str +='-'
	
	if int(day)<10:
		date_str +='0'

	date_str +=str(day)
	fname +=date_str
	date_str +='/'
	fname +='_'

	if int(hour)<10:
		date_str +='0'
		fname +='0'

	date_str +=str(hour)
	fname +=str(hour)
	#date_str +='/'
	fname +='-'

	if int(minute)<10:
		date_str +='0'
		fname +='0'

	date_str +=str(minute)
	fname +=str(minute)
	date_str +='00'
	fname +='-00'

	#set the post data.

	# for example: values = {'date' : '2012-10-17 00:10:00'}
	#values = {'date' : date_str}

	#set the url headers
	headers = { 'User-Agent' : user_agent }

	#encode the url with the post data.
	#data = urllib.urlencode(values)
	data =None
	url +=date_str
	url +='.js?callback=fetch_playback_cb'
	req = urllib2.Request(url, data, headers)
	response = urllib2.urlopen(req)
	
	if response.info().get('Content-Encoding') == 'gzip':
	    buf = StringIO( response.read())
	    f = gzip.GzipFile(fileobj=buf)
	    json_data = f.read()
	else:
		json_data = response.read()
	
	#Open a file for printing this data to. 
	fname +='.json'
	f = open(fname,'w')
	f.write(json_data)

	return date_str
	
# set the arguments from calling the py file
import sys
year=int(sys.argv[1])
month=int(sys.argv[2])
day=int(sys.argv[3])
hour=int(sys.argv[4])
minute=int(sys.argv[5])

# run the above define function
F24(year,month,day,hour,minute)
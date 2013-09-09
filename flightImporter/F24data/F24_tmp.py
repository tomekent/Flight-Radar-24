#!/bin/python
# Filename: F24_tmp.py
def F24_tmp(year,month,day,hour,minute):
	#import the urllib commands to use.
	import urllib
	import urllib2


	#Set the url flightradar24 
	url = 'http://www.flightradar24.com/PlaybackFlightsService.php'

	#define the user agent to be something 
	user_agent = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT)'

	date_str=''
	fname='F24data_'
	date_str +=str(year)
	date_str +='-'
	
	if int(month)<10:
		date_str +='0'
		
	date_str +=str(month)	
	date_str +='-'
	
	if int(day)<10:
		date_str +='0'
		
	date_str +=str(day)
	fname +=date_str
	date_str +=' '
	fname +='_'
	
	if int(hour)<10:
		date_str +='0'
		fname +='0'
		
	date_str +=str(hour)
	fname +=str(hour)
	date_str +=':'
	fname +='-'
	
	if int(minute)<10:
		date_str +='0'
		fname +='0'
		
	date_str +=str(minute)
	fname +=str(minute)
	date_str +=':00'
	fname +='-00'

	#set the post data.
	# for example: values = {'date' : '2012-10-17 00:10:00'}
	values = {'date' : date_str}

	#set the url headers
	headers = { 'User-Agent' : user_agent }

	#encode the url with the post data.
	data = urllib.urlencode(values)
	req = urllib2.Request(url, data, headers)
	response = urllib2.urlopen(req)
	the_page = response.read()

	#Open a file for printing this data to. 
	# fname='F24data_'
	# 	fname +=date_str
	fname +='.json'
	f = open(fname,'w')
	f.write(the_page)
	# print year, month
	return date_str
	
import sys
# print sys.argv[1:6]	
# year=int(raw_input('Enter a year: '))
# month=int(raw_input('Enter a month: '))
# day=int(raw_input('Enter a day: '))
# hour=int(raw_input('Enter an hour: '))
# minute=int(raw_input('Enter a minute: '))
year=int(sys.argv[1])
month=int(sys.argv[2])
day=int(sys.argv[3])
hour=int(sys.argv[4])
minute=int(sys.argv[5])
# (year, month, day, hour, minute) = sys.argv[1:6]
# print year, month, day, hour, minute
F24_tmp(year,month,day,hour,minute)
# f.close
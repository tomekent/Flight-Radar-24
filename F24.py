#!/usr/bin/env python
#=============================================================================
# appl    : Flight 24 Data grabber
# script  : F24.py
# version : 1.1
# author  : Tom Kent (Tomekent@hotmail.com)
#=============================================================================

def F24(year,month,day,hour,minute):

	from StringIO import StringIO # possible Python 3 issue need io #from io import StringIO 
	import gzip, urllib, urllib2, json, csv, datetime, sys
	
	#check the input
	timedelta = (datetime.datetime.utcnow() - datetime.datetime(year,month,day,hour,minute,0))
	if timedelta.total_seconds() < 0:
		sys.exit('Date is in the future, make sure input is correct and try again.')

	if timedelta.total_seconds() > (60*60*24*28):
		sys.exit('Date is too far in the past, must be within 28 days.')

	#Set the url of the flightradar24 php to post to
	url = 'http://db.flightradar24.com/playback/'

	#define the user agent to be something 
	user_agent = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT)'

	# remove any errors arising from the int input of for example 01 being truncated to 1.
	# month = '%02.f' % float(month)
	# day = '%02.f' % float(day)
	# hour = '%02.f' % float(hour)
	# minute = '%02.f' % float(minute)
	# 	
	# date_str += str(year) + str(month) + str(day) + '/' + str(hour) + str(minute) + '00'	
	# fname += str(year) + str(month) + str(day) + '_' + str(hour) + '-' +  str(minute) + '-00'

	date_str = '%02.f%02.f%02.f/%02.f%02.f00' %(float(year),float(month),float(day),float(hour),float(minute))
	fname = 'F24data_%02.f%02.f%02.f_%02.f-%02.f-00' %(float(year),float(month),float(day),float(hour),float(minute))
	print 'Getting data for %02.f:%02.f on %02.f/%02.f/%02.f' %(float(hour),float(minute),float(day),float(month),float(year))
	#set the url headers
	headers = { 'User-Agent' : user_agent, 'Accept-encoding' : 'gzip' }

	#encode the url with the post data.
	fullurl = url + date_str + '.js?callback=fetch_playback_cb'
	
	req = urllib2.Request(fullurl, None, headers)
	response = urllib2.urlopen(req)
	
	if response.info().get('Content-Encoding') == 'gzip':
	    buf = StringIO( response.read())
	    f = gzip.GzipFile(fileobj=buf)
	    json_data = f.read()
	else:
		json_data = response.read()
	
	
	jsonheaders = "{'Flight Code':[,'Hex','Lat','Lon','Track','Altitude','Speed','Squark','Radar','Aircraft','reg','Time Stamp','Dept Airport','Dest Airport','Flight Code Short','','','Flight Code','Time Stamp 2'],"
	fieldnames = ['Flight Code','Hex','Lat','Lon','Track','Altitude','Speed','Squark','Radar','Aircraft','reg','Time Stamp','Dept Airport','Dest Airport','Flight Code Short','','','Flight Code','Time Stamp 2']
		#jsonheaders = str(headers)
	
	#Lets try some parsing of the raw json data
	json_data_start =json_data[:19]
	json_data_end =json_data[-33:]
	json_data_mid =json_data[19:-33]
	
	#the row count
	count =json_data_end[str.find(json_data_end,'full_count":',0)+len('''full_count":'''):str.find(json_data_end,',"version"',0)]
	
	json_str = '{' + json_data_mid +'}'
	js = json.loads(json_str, "utf-8")
	csvfile = fname + '.csv'
	f =csv.writer(open(csvfile,"w+"))
	print 'CSV data saved to: %s' % csvfile
	#write header
	f.writerow(fieldnames)
	for K in js.keys():
		f.writerow([K] + js[K])
	
	#Open a file for printing this data to. 
	fname +='.json'
	f = open(fname,'w')
	f.write(str(jsonheaders))
	f.write(json_data_mid)
	print 'Json data saved to: %s' %fname
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
print 'Process Complete.'
#!/usr/bin/env python
#=============================================================================
# appl    : Flight 24 JSON Importer
# script  : import.py
# version : 1.1
# author  : Gareth Parker (garethparker@gmail.com)
#-----------------------------------------------------------------------------

#=============================================================================

import sys, os, os.path, json, sqlite3, datetime, urllib,urlib2,csv,gzip

if len(sys.argv) != 2:  # the program name and the two arguments
  # stop the program and print an error message
  sys.exit("Must provide database path'")

# Convert the two arguments from strings into numbers

dataDirectory = sys.argv[1]
databaseLocation = sys.argv[1]
scriptLocation = os.path.abspath(__file__)
fullLocation = os.path.dirname(scriptLocation)

DBFileLocation = os.path.join(fullLocation, databaseLocation)
query = ('INSERT INTO data (callsign, hex, lat, lon, track, altitude, speed, squark, radar, aircraft, reg, time_stamp_a, dept_airport, dest_airport,flight_code_a,other_a, other_b,flight code_b, time_stamp_b) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')
print ("Database file is: %s" % DBFileLocation)

# Check the location of the data directory
try:
   with open(databaseLocation) as f: pass
except IOError as e:
   raise SystemExit('Could not find database: ' + dataDirectory + '. Exiting....')

# Connect to the database
db = sqlite3.connect(DBFileLocation, isolation_level=None)

url = 'http://db.flightradar24.com/playback/'

user_agent = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT)'
headers = { 'User-Agent' : user_agent, 'Accept-encoding' : 'gzip' }

interval = 600 # seconds ie ten minutes
start = datetime.datetime(2013,9,10,06,00)
end = datetime.datetime(2013,9,10,12,00)
total_seconds = (end - start).total_seconds()
maxcount = int( total_seconds / interval)

for n in range(0,maxcount)


fileList = os.listdir(JSONDirectory)
fileCounter = 0
insertCounter = 0


		for K in js.keys():
			c = db.cursor()
			values = js[K][:]
			try:
				c.execute(query, values)
				insertCounter = insertCounter+1
			except sqlite3.OperationalError, e:
				print(e)
			c.close()

print('Processing complete. Inserted %s items into the database.' % insertCounter)

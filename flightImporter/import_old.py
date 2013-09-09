#!/usr/bin/env python
#=============================================================================
# appl    : Flight 24 JSON Importer
# script  : import.py
# version : 1.0
# author  : Gareth Parker (garethparker@gmail.com)
#-----------------------------------------------------------------------------
# Purpose : Used to import JSON files from Flight 24 into a sqlite DB.
#-----------------------------------------------------------------------------
# chg#  date       author     purpose 
# ~~~~~ ~~~~~~~~~~ ~~~~~~~~~~ ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# 00001 25/10/2012 G.Parker  Initial Commit
#=============================================================================

import sys, os, os.path, json, sqlite3

if len(sys.argv) != 3:  # the program name and the two arguments
  # stop the program and print an error message
  sys.exit("Must provide data directory and database name in the format import.py 'dataDirectory' 'database.db'")

# Convert the two arguments from strings into numbers
dataDirectory = sys.argv[1]
databaseLocation = sys.argv[2]
scriptLocation = os.path.abspath(__file__)
fullLocation = os.path.dirname(scriptLocation)
JSONDirectory = os.path.join(fullLocation, dataDirectory)
DBFileLocation = os.path.join(fullLocation, databaseLocation)
query = ('INSERT INTO data (callsign, hex, lon, lat, track, altitude, speed, squark, radar, aircraft, reg, time_stamp, dept_airport, dest_airport) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)')
print ("JSON Directory is: %s" % JSONDirectory)
print ("Database file is: %s" % DBFileLocation)

# Check the location of the data directory
if not os.path.exists(JSONDirectory):
        try:
            os.makedirs(JSONDirectory)
        except OSError:
            raise SystemExit('Could not find directory: ' + JSONDirectory + '. Exiting....')
            
amountOfFiles = sum(1 for item in os.listdir(JSONDirectory) if (os.path.isfile(os.path.join(JSONDirectory, item)) and item.endswith('.json')))

# Check the location of the data directory
try:
   with open(databaseLocation) as f: pass
except IOError as e:
   raise SystemExit('Could not find database: ' + dataDirectory + '. Exiting....')


print("JSON directory contains %s files. Processing will now begin." % amountOfFiles)

# Connect to the database
db = sqlite3.connect(DBFileLocation, isolation_level=None)

fileList = os.listdir(JSONDirectory)
fileCounter = 0
insertCounter = 0
for fileName in fileList:
	if(fileName.endswith('.json')):
		fileCounter = fileCounter+1
		print('Processing file '+ str(fileCounter) + ' of '+ str(amountOfFiles) + ': '+fileName)
		traffic = json.load(open(os.path.join(JSONDirectory,fileName)))
		for one, two in traffic.iteritems():
			c = db.cursor()
			values = [one, two[0], two[1], two[2], two[3], two[4], two[5], two[6], two[7], two[8], two[9], two[10], two[11], two[12]]
			try:
				c.execute(query, values)
				insertCounter = insertCounter+1
			except sqlite3.OperationalError, e:
				print(e)
			c.close()

print('Processing complete. Inserted %s items into the database.' % insertCounter)

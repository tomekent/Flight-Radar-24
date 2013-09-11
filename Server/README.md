######### README ########

Server.py

>>> python Server.py

Runs a httpd server on port 8001 
Anything in the same folder as Server.py can be accessed via 
http://localhost:8001/FILENAME

You can run python, js, perl etc scripts or whatever you like. 


####### Example Usage ########

Can be used to grab flightradar24 data and display it locally. 
For example a Google Earth kml file with a network link calls 
http://localhost:8001/F24_server.py
which prints KML code for Google earth to display.

The file ../GE/example_F24.kml does this

It updates every minute or whenever the view area is moved. 
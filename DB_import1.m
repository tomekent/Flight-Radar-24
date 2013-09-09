DB1 = mksqlite('open', '~/flightImporter/flightdata_Oct01.db');
data = mksqlite('SELECT * FROM "data" WHERE "time_stamp" == "01-10-2012 10:30:00" AND "dest_airport" != "" ORDER BY "ROWID" COLLATE NOCASE ASC');
RouteDatanew = cell(length(data),9);

for i=1:length(data)
    if isfield(Airports,data(i).dept_airport)==0
        lonlat = IATA2lonlat2(data(i).dept_airport);
        evalc(char(strcat('Airports.',data(i).dept_airport,'=lonlat;')));
    elseif isfield(Airports,data(i).dest_airport)==0
        lonlat = IATA2lonlat2(data(i).dest_airport);
        evalc(char(strcat('Airports.',data(i).dest_airport,'=lonlat;')));
    end
    RouteDatanew{i,1} = strcat(data(i).dept_airport,data(i).dest_airport);
    evalc(char(strcat('RouteDatanew{i,2} = Airports.',data(i).dept_airport,'(1);')));
    evalc(char(strcat('RouteDatanew{i,3} = Airports.',data(i).dept_airport,'(2);')));
    evalc(char(strcat('RouteDatanew{i,4} = Airports.',data(i).dest_airport,'(1);')));
    evalc(char(strcat('RouteDatanew{i,5} = Airports.',data(i).dest_airport,'(2);')));
    RouteDatanew{i,6}=1;
    RouteDatanew{i,7} = data(i).aircraft;
    ts = data(i).time_stamp;
    tnum = (str2num(ts(12:13))*60 + str2num(ts(15:16)))/(24*60);
    RouteDatanew{i,8} = tnum;
end

% FlightDatanew

for i = 1:length(data)
    evalc(char(strcat('FlightDataAdHoc.',RouteDatanew(i,1),' = Flight_timingsold(i,RouteDatanew,AircraftData)')));
end

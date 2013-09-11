%F24 test
% r=6371;
% axis equal
% phi=linspace(0,pi,19);
% theta=linspace(0,2*pi,37);
% [phi,theta]= meshgrid(phi,theta);
% 
% surf(r*sin(phi).*cos(theta),r*sin(phi).*sin(theta),r*cos(phi),'EdgeColor', 'none');
% colormap('summer');

hold on
drawnow
for K = 1:20
    regname = regs(K).reg;
regA = mksqlite(['SELECT ROWID, * FROM "data" WHERE "reg" == "',regname,'" ORDER BY "ROWID" COLLATE NOCASE ASC LIMIT 0,10000']);
lonlats = [str2num(str2mat(regA(1:end).lat)),str2num(str2mat(regA(1:end).lon)),str2num(str2mat(regA(1:end).altitude)).*0.003048 ];
for i=1:length(lonlats)-1
    hold on
v = greatcircle_latlon(lonlats(i,2),lonlats(i,1),lonlats(i+1,2),lonlats(i+1,1),r+lonlats(i,3),[1,0.5,0.7],1);
plot3(v(1,:),v(2,:),v(3,:),'r-');
end
% Rpts = lonlat2point2(lonlats(:,1:2),lonlats(:,3) + r);
% plot3(Rpts(:,1),Rpts(:,2),Rpts(:,3),'r-');
% routes
drawnow
end
DB1 = mksqlite('open', 'flightImporter/flightdata_Oct01.db');
% callsigns = mksqlite('SELECT DISTINCT "callsign" FROM "data" ORDER BY "ROWID" COLLATE NOCASE ASC LIMIT 1000,1000')
% regs = mksqlite('SELECT DISTINCT "reg" FROM "data" ORDER BY "ROWID" COLLATE NOCASE ASC LIMIT 1000,1000')
% EWR_to_LHR = mksqlite('SELECT ROWID, * FROM "data" WHERE "dest_airport" == "EWR" AND "dept_airport" == "LHR" ORDER BY "ROWID" COLLATE NOCASE ASC LIMIT 0,1000');
%     EWR_to_LHR = mksqlite('SELECT ROWID, * FROM "data" WHERE ("dest_airport" == "EWR" OR "dest_airport" == "JFK" OR "dest_airport" == "MIA") AND "dept_airport" == "LHR" ORDER BY "ROWID" COLLATE NOCASE ASC LIMIT 0,1000');


for hr=0:1
    for min = 0:2:4
          
        hr = num2str(hr);
        min = num2str(min);
if numel(hr)==1
    hr = strcat('0',hr);
end
if numel(min)==1
    min = strcat('0',min);
end

timestring = strcat(hr,':',min,':','00');
time1 = mksqlite(['SELECT ROWID, * FROM "data" WHERE "time_stamp" == "01-10-2012 ',char(timestring),'" ORDER BY "ROWID" COLLATE NOCASE ASC LIMIT 0,10000']);

for i = 1:length(time1)
    
%    if ~exist(['FN_',time1(i).callsign])
%     pt = lonlat2point2([str2double(time1(i).lat);str2double(time1(i).lon)],6371);
%     eval(sprintf('FN_%s = plot3(pt(1),pt(2),pt(3),''r.'');', time1(i).callsign));
%    else
%        
       pt = lonlat2point2([str2double(time1(i).lat);str2double(time1(i).lon)],6371);
       set(sprintf('FN_%s',time1(i).callsign), 'XData',pt(1),'YData',pt(2),'ZData',pt(3));
%    end
   
end
drawnow
% delete(FlightHandles)

    
    end

end
% end
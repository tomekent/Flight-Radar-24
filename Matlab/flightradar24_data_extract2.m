function[data] = flightradar24_data_extract(hour,minute,day,month)
%This function takes the inputs:
% Hour - hour in 24 hour clock 0-23
% minutes 0-59
% day - numeric day 1-31
% month - numeric month 1-12
%
% Year is assumed to be current year, as playback query is limited to 4
% weeks
% timezone as we need to be in UTC 
time_now = floor(clock);
year = time_now(1);
if nargin == 0
    now_bin=1;
    month=time_now(2);
    day=time_now(3);
    hour=time_now(4);
    if hour==0 %switch back an hour as we want to be in UTC not BST.
        hour =23;
        if day==1
            switch month
                case {1,3,5,7,8,10,12} %31 days
                    day = 30;
                case {4,6,9,11} %30 days
                    day =29;
                case {2}
                    day =27;
            end
            if month==1
                month =12;
                year = year-1;
            end
        end
    else
        hour = hour-1;
    end
            
                    
    minute=time_now(5);
else now_bin=0;
end



%% ----------------------------input check-------------------------------%
if (hour - floor(hour))==0
    if hour>=0 && hour<24
    else
        error('error: Hour Must be between 0-23');
    end
else
    error('error Hour must be a whole number');
end

if (minute - floor(minute))==0
    if minute>=0 && minute<60
    else 
        error('error: Minute Must be between 0-59');
    end
else
    error('error minute must be a whole number');
end

if (day - floor(day))==0
    if day>=1 && day<32
    else
        error('error: Day Must be between 1-31');
    end
else
    error('error Day must be a whole number');
end

if (month - floor(month))==0
    if month>=1 && month<13
    else
        error('error: Month Must be between 1-12');
    end
else
    error('error Month must be a whole number');
end

year = num2str(year);
month = num2str(month);
day = num2str(day);
hour = num2str(hour);
minute = num2str(minute);


%make sure each is a two digit number
if numel(month)==1
    month = strcat('0',month);
end
if numel(day)==1
    day = strcat('0',day);
end
if numel(hour)==1
    hour = strcat('0',hour);
end
if numel(minute)==1
    minute = strcat('0',minute);
end


var_date = strcat(year,'-',month,'-',day,{' '},hour,':',minute,':00');
elapsed_time = etime((clock),(datevec(var_date)));
if elapsed_time<0
    error('error The time input is in the future')
end

if (elapsed_time>2419200) %4 weeks
    error('error date request is not possible as it is more than 4 weeks in the past');
end
%%
% content=urlread('http://flightradar24.com/zones/full.json?');
if now_bin==1
    [content status] = urlread('http://flightradar24.com/zones/full.json?');
else
    [content status] = urlread('http://flightradar24.com/PlaybackFlightsService.php','post',{'date',var_date});
end

if status==0
    error('error occured with urlread - make sure the inputs are correct and try again');
end
%replace the 10-digit unix timecode with a normal one
% Unixtimestamp = regexpi(content,',');
% Unixtimestamp = str2double(content(Unixtimestamp(10)+1:Unixtimestamp(11)-1));
% timestamp = char(datestr(datenum([1970 1 1 0 0 Unixtimestamp])));
% content = regexprep(content,num2str(Unixtimestamp),strcat('''',timestamp,''''));

%find the number of elements in the list
% countstart=regexpi(content2,'"full_count":');
% countend=regexpi(content2(countstart+13:end),',')-2;
% count=str2double(content2(countstart+13:countstart+13+countend));
count = numel(regexpi(content,':['));
idx=[1,regexpi(content,'],'),length(content)-1];

%edit the data strings so they are in a cell style format
predata = cell(count,1);
A=content(idx(1)+1:idx(2));
    A = regexprep(A,'"','''');
    A = regexprep(A,':[',',');
    A = regexprep(A,']','}');
    A = regexprep(A,'null','''null''');
    A = strcat('{',A);
predata(1)=cellstr(A);
for i=2:count
    A=content(idx(i)+2:idx(i+1));
    A = regexprep(A,':[',',');
    A = regexprep(A,'"','''');
%     A = regexprep(A,'[','{');
    A = regexprep(A,']','}');
    A = regexprep(A,'null','''null''');
    A = strcat('{',A);
   
%     if now_bin==0
%         A = regexprep(A,'}',','''','''',''''}');
%     end
%     
%     for j=1:count
%     na = 15-numel(regexpi(A,','));
%     for k=1:na
%         A = regexprep(A,'}',',''''}');
%     end
%     end
        
    predata(i)=cellstr(A);
end


data=cell(count,17);

%create headers
headers = {'Flight Code','Hex','Lon','Lat','Track','Altitude','Speed','Squark','Radar','Aircraft','reg','Time Stamp','Dept Airport','Dest Airport','Flight','',''};
dbstop('error')
for i=1:count 
    Z = eval(char(predata(i)));
    if size(Z,2)<16
    for k= size(Z,2):17
        Z{k}='';
    end
    end
    data(i,:)=Z;
%     data(i,12) = char(datestr(datenum([1970 1 1 0 0 cell2mat(data(i,12))])));
%      data(i,12)= {char(datestr(datenum([1970 1 1 0 0 cell2mat(data(i,12))])))};
    data(i,12) = {char(var_date)};
end

%Finally sort the the rows by Flight code and add the headers
data = [headers;sortrows(data,1)];


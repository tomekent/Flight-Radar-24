<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8" />
        <meta name="keywords" content="flightradar, flight, radar, plane, tracker, spotter, live, coverage, airplane, air, traffic, real, time" />
        <meta name="description" content="Flightradar24 is the best live flight tracker that shows air traffic in real time. Best coverage and cool features!" />
        <meta http-equiv="author" content="Flightradar24" />
        <meta http-equiv="content-language" content="en" />
        <meta name="apple-itunes-app" content="app-id=382069612">
        <title>Flightradar24.com - Live flight tracker!</title>
        <link href="http://flightradar24static.appspot.com/static/_fr24/css/jquery.ui.theme.css?v=tAma51" rel="stylesheet" />
        <link href="http://flightradar24static.appspot.com/static/_fr24/css/jquery.ui.slider.css?v=tAma51" rel="stylesheet" />
        <link href="http://flightradar24static.appspot.com/static/_fr24/css/jquery.jscrollpane.css?v=tAma51" rel="stylesheet" />
        <link href="http://flightradar24static.appspot.com/static/_fr24/css/screen_new.css?v=tAma51d" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="http://flightradar24static.appspot.com/static/_fr24/images/favicon.png" />

        <script src="http://maps.google.com/maps/api/js?v=3.9&sensor=false&language=en&libraries=weather"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
			<script src="http://flightradar24static.appspot.com/static/_fr24/js/jquery.ui.selectmenu.js?v=tAma51"></script>
		<script src="http://flightradar24static.appspot.com/static/_fr24/js/jquery.hashchange.min.js?v=tAma51"></script>
		<script src="http://flightradar24static.appspot.com/static/_fr24/js/jquery.mousewheel.js?v=tAma51"></script>
		<script src="http://flightradar24static.appspot.com/static/_fr24/js/mwheelIntent.js?v=tAma51"></script>
		<script src="http://flightradar24static.appspot.com/static/_fr24/js/jquery.jscrollpane.js?v=tAma51"></script>
    
              
		<script src="http://www.flightradar24.com/js/zones.js.php?v=tAma51&js=1"></script>
		<script src="http://www.flightradar24.com/js/_js.php"></script>
			<script src="http://flightradar24static.appspot.com/static/_fr24/js/js_new.js?v=tAma511"></script>
		<script src="http://flightradar24static.appspot.com/static/_fr24/js/errorReport.js?v=tAma51"></script>
		<script src="http://flightradar24static.appspot.com/static/_fr24/js/pilotView.js?v=tAma51"></script>
        	            <script>
        var static_version = '?v=tAma51';
        
        $().ready(function() {
            $("a#chat-link").live("click", function() {
                window.open("http://www.flightradar24.com/chat/index.php", "Chat", "menubar=no,width=550,height=600,toolbar=no" );
            }); 
            $("ul.topBarMenu li.hasDropdown").mouseenter(function() {
                $(this).find("a").eq(0).addClass("hoverState");
                $(this).find("div.dropdownMenuContainer").show();
            }).mouseleave(function() {
                $(this).find("div.dropdownMenuContainer").hide();
                $(this).find("a").eq(0).removeClass("hoverState");
            });            
        });
                    </script>
        
	</head>
	<body id="map">
             <div id="modalBlackout" style="display: none;"></div>
		<div id="disable-page-text" style="display: none;"><h1>Updates disabled</h1><p>You have been inactive for too long, <a href="http://www.flightradar24.com">please reload the page.</a></div>
		

		<div id="preload-active" style="height: 0; width: 0;"></div>

		<div class="modalContainer" id="settingsContainer" style="display: none;">
			<div class="modalContent" id="settingsContent">
				<a class="modalContentClose" id="settingsContentClose" title="Close"></a>
				
				<div class="modalHeader">
					<div class="modalHeaderContent">
						<h1>Settings</h1>
					</div>
				</div>
				
				<div class="modalMainContainer">
                    <div class="modalHeaderBottomOp"></div>
					
                    <div class="modalMain">
						<div style="padding: 15px;">
							
							<div class="left">
							
								<h4>Show airports</h4>
								<a class="handleOnOff active" id="showAirports"></a>
								
								<h4 style="margin-top: 10px;">Show ground traffic</h4>
								<a class="handleOnOff active" id="showGroundTraffic"></a>
								
								<h4 style="margin-top: 10px;">Show FAA traffic</h4>
								<a class="handleOnOff active" id="showFAATraffic"></a>

								<h4 style="margin-top: 10px;">Animate aircraft</h4>
								<a class="handleOnOff active" id="animateAircraft"></a>
                                
 								<h4 style="margin-top: 10px;">Show clouds</h4>
								<a class="handleOnOff" id="showClouds"></a>

								<h4 style="margin-top: 10px;">Show weather</h4>
								<a class="handleOnOff" id="showWeather"></a>
                                
                                							</div>
							
							<div class="left" style="margin-left: 70px;">

								<h4>Map brightness</h4>
								<div class="slider-container" style="width: 111px;">
									<div id="sliderBrightness" style="width: 100px;"></div>
								</div>
								<div class="settingsHelpText" style="width: 116px; margin-top: -5px;">
									<span class="left">Light</span>
									<span class="right">Dark</span>
									<br class="clear" />
								</div>
                        
                        <h4 style="margin-top: 10px;">Aircraft size</h4>
								<ul class="settingBoxes aircraftSize settingsHelpText">
									<li>
										<input type="radio" name="aircraftSize" id="aircraftSizeAuto" value="auto" /><br />
										<label for="aircraftSizeAuto">Auto</label>
									</li>
									<li>
										<input type="radio" name="aircraftSize" id="aircraftSizeSmall" value="small" /><br />
										<label for="aircraftSizeSmall">Small</label>
									</li>
									<li>
										<input type="radio" name="aircraftSize" id="aircraftSizeNormal" value="normal" /><br />
										<label for="aircraftSizeNormal">Medium</label>
									</li>
									<li>
										<input type="radio" name="aircraftSize" id="aircraftSizeLarge" value="large" /><br />
										<label for="aircraftSizeLarge">Large</label>
									</li>
									<br class="clear" />																			
								</ul>

								<h4 style="margin-top: 10px;">Aircraft color</h4>
								<ul class="settingBoxes aircraftColor settingsHelpText">
									<li>
										<input type="radio" name="aircraftColor" id="aircraftColorYellow" value="yellow" /><br />
										<label for="aircraftColorYellow">Yellow</label>
									</li>
									<li>
										<input type="radio" name="aircraftColor" id="aircraftColorBlue" value="blue" /><br />
										<label for="aircraftColorBlue">Blue</label>
									</li>
									<li>
										<input type="radio" name="aircraftColor" id="aircraftColorGrey" value="grey" /><br />
										<label for="aircraftColorGrey">Grey</label>
									</li>
									<br class="clear" />																			
								</ul>
								
								<h4 style="margin-top: 10px;">Aircraft labels</h4>						
								<a class="handleOnOff active" id="showLabels"></a>
								<ul class="settingsHelpText" style="margin-top: 10px;">
									<li>
										<select id="labelRow1" class="labelRow" style="width: 130px;">
                                            <option value="cs">Callsign</option>
                                            <option value="reg">Registration</option>
									  </select>
									</li>
									<li>
										<select id="labelRow2" class="labelRow" style="width: 130px;">
                                            <option value="">- Row 2 -</option>
                                            <option value="acreg">Type & registration</option>
                                            <option value="altspeed">Altitude & speed</option>
                                            <option value="tofrom">To & from</option>
                                            <option value="ac">Type</option>
                                            <option value="reg">Registration</option>
                                            <option value="alt">Altitude</option>
                                            <option value="speed">Speed</option>
									  </select>
									</li>
									<li>
										<select id="labelRow3" class="labelRow" style="width: 130px;">
                                            <option value="">- Row 3 -</option>
                                            <option value="acreg">Type & registration</option>
                                            <option value="altspeed">Altitude & speed</option>
                                            <option value="tofrom">To & from</option>
                                            <option value="ac">Type</option>
                                            <option value="reg">Registration</option>
                                            <option value="alt">Altitude</option>
                                            <option value="speed">Speed</option>
									  </select>
									</li>
								</ul>
								<p class="settingsHelpText" style="width: 250px; padding-top: 5px;">Labels appear when there are less than 250 aircraft on map. The second and third row will appear only when the map is zoomed in.</p>							
							</div>
							<br class="clear" />
						</div>
					</div>
				</div>	
			</div>
		</div>
		
		<div class="modalContainer" id="filterContainer" style="display: none;">
			<div class="modalContent" id="filterContent" style="width: 650px;">
				<a class="modalContentClose" id="filterContentClose" title="Close"></a>
				
				<div class="modalHeader">
					<div class="modalHeaderContent">
						<h1>Filter</h1>
					</div>
				</div>
				
				<div class="modalMainContainer">
                    <div class="modalHeaderBottomOp"></div>
					<div class="modalMain">
						<div style="padding: 15px;">
							
							<div class="left">
								<h4>Filter type</h4>
								<ul class="settingBoxes settingsHelpText filterTypes">
									<li>
										<input type="radio" name="filterType" id="filterTypeCallsign" value="Callsign" /><br />
										<label for="filterTypeCallsign">Callsign</label>
									</li>
									<li>
										<input type="radio" name="filterType" id="filterTypeAirport" value="Airport" /><br />
										<label for="filterTypeAirport">Airport</label>
									</li>
									<li>
										<input type="radio" name="filterType" id="filterTypeAltitude" value="Altitude" /><br />
										<label for="filterTypeAltitude">Altitude</label>
									</li>
									<li>
										<input type="radio" name="filterType" id="filterTypeSpeed" value="Speed" /><br />
										<label for="filterTypeSpeed">Speed</label>
									</li>
									<li>
										<input type="radio" name="filterType" id="filterTypeAircraft" value="Aircraft" /><br />
										<label for="filterTypeAircraft">Aircraft</label>
									</li>
									<li>
										<input type="radio" name="filterType" id="filterTypeRegistration" value="Registration" /><br />
										<label for="filterTypeRegistration">Registration</label>
									</li>                           
									<li>
										<input type="radio" name="filterType" id="filterTypeRadar" value="Radar" /><br />
										<label for="filterTypeRadar">Radar</label>
									</li>			
									<br class="clear" />																																	
								</ul>
								
								<div style="margin: 5px 0 0 20px; width: 300px;">
									
									<div class="filterTypeDiv" id="filterCallsign">
										<span class="settingsHelpText block" style="padding-bottom: 5px;">Type the beginning of the callsigns you want to display. For example, if you want to display all British Airways aircraft, type <b>BAW</b>.</span>
										<label class="settingsHelpText"><b>Callsign</b></label><br />
										<input id="filter-callsign-value" type="text" maxwidth="8" style="width: 80px; text-transform: uppercase;" /><br />
										<input type="button" value="Add filter" class="standardButton" id="filterCallsignAdd" style="margin-top: 5px;" />
									</div>
									
									<div class="filterTypeDiv" id="filterAirport" style="display: none;">
										<span class="settingsHelpText block" style="padding-bottom: 5px;">Choose if you want to display inbound, outbound, or both inbound/outbound flights for a specific airport.</span>
										<div class="left settingsHelpText" style="width: 70px;"><b>IATA code</b></div>
										<div class="left settingsHelpText"><b>Filter type</b></div>
										<br class="clear" />
										<div class="left" style="width: 70px;">
											<input type="text" id="filter-airport-iata" maxlength="3" style="width: 50px; text-transform: uppercase;" />
										</div>
										<div class="left">
											<select id="filter-airport-type">
												<option value="inout">Inbound/outbound</option>
												<option value="in">Inbound</option>
												<option value="out">Outbound</option>						
											</select>
										</div>					
										<br class="clear" />
										<input type="button" value="Add filter" class="standardButton" id="filterAirportAdd" style="margin-top: 5px;" />
									</div>								
									
									<div class="filterTypeDiv" id="filterAltitude" style="display: none;">
										<span class="settingsHelpText block" style="padding-bottom: 5px;">Use the handlers to select the range of altitudes you want to display.</span>
										<div class="settingsHelpText"><span class="left">0 ft</span><span class="right">53 000 ft</span><br class="clear" /></div>
										<div class="slider-container">
											<div id="slider-altitude" style="width: 289px;"></div>
										</div>
										<div class="settingsHelpText"><span class="left">0 m</span><span class="right">16 200 m</span><br class="clear" /></div>
										<div style="text-align: center;">
											<p id="filter-altitude-feet" style="font-size: 1.5em;">0 ft - 53000 ft</p>
											<p id="filter-altitude-meters">0 m - 16200 m</p>
										</div>
										<input type="hidden" id="altitude-min" value="0" /><input type="hidden" id="altitude-max" value="41000" />
										<input type="button" value="Add filter" class="standardButton" id="filterAltitudeAdd" />
									</div>

									<div class="filterTypeDiv" id="filterSpeed" style="display: none;">
										<span class="settingsHelpText block" style="padding-bottom: 5px;">Use the handlers to select the range of speeds you want to display.</span>
										<div class="settingsHelpText"><span class="left">0 kts</span><span class="right">700 kts</span><br class="clear" /></div>
										<div class="slider-container">
											<div id="slider-speed" style="width: 289px;"></div>
										</div>
										<div class="settingsHelpText"><span class="left">0 km/h</span><span class="right">1 300 km/h</span><br class="clear" /></div>
										<div style="text-align: center;">
											<p id="filter-speed-knots" style="font-size: 1.5em;">0 kts - 700 kts</p>
											<p id="filter-speed-kmh">0 km/h - 1 300 km/h</p>
										</div>
										<input type="hidden" id="speed-min" value="0" /><input type="hidden" id="speed-max" value="700" />
										<input type="button" value="Add filter" class="standardButton" id="filterSpeedAdd" />
									</div>

									<div class="filterTypeDiv" id="filterAircraft" style="display: none;">
										<span class="settingsHelpText block" style="padding-bottom: 5px;">Type the ICAO designator, or the beginning of it, of the aircraft type you want to display. For example, if you want to display all Boeing 747's, type <b>B74</b>.</span>
										<label class="settingsHelpText"><b>ICAO designator</b></label><br />
										<input id="filter-aircraft-value" type="text" maxwidth="8" style="width: 80px; text-transform: uppercase;" /><br />
										<input type="button" value="Add filter" class="standardButton" id="filterAircraftAdd" style="margin-top: 5px;" />
									</div>
                            
									<div class="filterTypeDiv" id="filterRegistration" style="display: none;">
										<span class="settingsHelpText block" style="padding-bottom: 5px;">Type the beginning of the registrations you want to display. For example, if you want to display all Swedish aircraft, type <b>SE</b>.</span>
										<label class="settingsHelpText"><b>Registration</b></label><br />
										<input id="filter-registration-value" type="text" maxwidth="8" style="width: 80px; text-transform: uppercase;" /><br />
										<input type="button" value="Add filter" class="standardButton" id="filterRegistrationAdd" style="margin-top: 5px;" />
									</div>                            

									<div class="filterTypeDiv" id="filterRadar" style="display: none;">
										<span class="settingsHelpText block" style="padding-bottom: 5px;">Select one or more radars that you want to display.</span>
										<label class="settingsHelpText"><b>Radar</b></label><br />
										<select id="filter-radar-value">
										</select><br />
										<input type="button" value="Add filter" class="standardButton" id="filterRadarAdd" style="margin-top: 5px;" />
									</div>

								</div>
							</div>
							<div class="left" style="margin-left: 20px;">
								<h4>Active filters</h4>
								<div id="active-filters"></div>
							</div>
							<br class="clear" />
												
						</div>
					</div>
				</div>	
			</div>
		</div>

		<div class="modalContainer" id="modalContainer" style="display: none;">
			<div class="modalContent" id="modalContent">
				<a class="modalContentClose" id="modalContentClose" title="Close"></a>
				<div id="modalHeaderMarker"></div>
				<div id="modalHeaderSelect">
					<select id="airportListType" style="width: 90px;">
						<option value="in">Inbound</option>
						<option value="out">Outbound</option>
					</select>
				</div>	
				
				<div class="modalHeader" id="modalHeader">
					<div class="modalHeaderContent" id="modalHeaderContent">
						<h2 id="airportCity"></h2>
						<h2 id="airportName"></h2>
					</div>				
				</div>
				<div class="modalHeaderBottom" id="modalHeaderBottom"></div>
				
				<div class="modalMainContainer" id="modalMainContainer">
					<div class="modalMain" id="modalMain">
						<img id="airportLoader" src="http://flightradar24static.appspot.com/static/_fr24/images/loading_32.gif" alt="Loading..." style="margin: 30px 0 10px 259px;" />
						<table id="airportInboundList" class="flightList" style="display: none;">
							<thead>
								<tr class="dark">
									<td style="width: 65px;" class="first">Callsign</td>
									<td style="width: 60px;">Flight</td>
									<td style="width: 150px;">From</td>
									<td style="width: 35px;">Type</td>
									<td style="width: 90px;">ETA <span class="small">(UTC)</span></td>
									<td></td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<table id="airportOutboundList" class="flightList" style="display: none;">
							<thead>
								<tr class="dark">
									<td style="width: 65px;" class="first">Callsign</td>
									<td style="width: 60px;">Flight</td>
									<td style="width: 150px;">To</td>
									<td style="width: 35px;">Type</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			
				<div class="modalBottom" id="modalBottom">
					<div id="bottomLeft">
						<ul id="weatherWidget">
							<li id="weatherWidgetTemp">
								<img src="http://flightradar24static.appspot.com/static/_fr24/images/pixel.png" class="" />
								<span class="left"></span>
								<br class="clear" />
							</li>
							<li id="weatherWidgetWind">
								<img src="http://flightradar24static.appspot.com/static/_fr24/images/pixel.png" class="" />
								<span class="left"></span>
								<br class="clear" />
							</li>
							<br class="clear" />
						</ul>
						<p></p>
					</div>
					<div id="bottomSeparator"></div>
					<div id="bottomRight">
						<a href="http://flightdiary.net" target="_blank" id="flightdiaryLogo"></a>
						<br class="clear" />
						<div id="airportRating"><a href="http://flightdiary.net" target="_blank"><img src="http://flightdiary.net/img/ratings/black/0.png" /></a></div>
						<a id="airportComment" href="http://flightdiary.net" target="_blank"></a>
					</div>
					<br class="clear" />
				</div>
			</div>
		</div>
        
      
		<div class="modalContainer" id="pilotContainer" style="display: none;">
			<div class="modalContent" id="pilotContent">
				<a class="modalContentClose" id="pilotContentClose" title="Close"></a>
				
				<div class="modalHeader">
					<div class="modalHeaderContent">
						<h1 style="line-height: 0.9em;">Cockpit View</h1>
                 		<input type="text" class="select-on-focus" value="" style="width: 300px; font-size: 0.85em; border: 0; background: none; outline: none;" />
					</div>
				</div>
				
				<div class="modalMainContainer">
            	<div class="modalHeaderBottomOp" style="position: absolute; z-index: 10;"></div>
					<div class="modalMain">
						<div style="padding: 0px;">
							<iframe id="map_alert_frame" style="position: absolute; height: 59px; width: 402px; top: 200px; left: 250px; z-index:1000; background: white"></iframe>							
							<div id="map_alert" style="top: 200px; left: 250px; position: absolute; z-index: 1001; display: block;"></div>
							
							<iframe id="mini_map_frame" style="position: absolute; height: 152px; width: 202px; top: 330px; left: 690px; z-index:1000; background: white"></iframe>							
							<div id="mini_map" style="height: 150px; width: 200px; top: 330px; left: 690px; border: 1px solid black; position: absolute; z-index: 1001; display: block;"></div>
							
                            <div id="map3d" style="height: 480px; width: 900px;"></div>
                            <div id="pilotSwitchPanel">
								<div class="switch-button">
									<span class="switch-indicator-on">ON</span>
									<a href="#" id="panel-switch"><span>PANEL</span></a>
									<span class="switch-indicator-off">OFF</span>
								</div>
								<div class="switch-button">
									<span class="switch-indicator-on">ON</span>
									<a href="#" class="switch-button" id="map-switch"><span>MAP</span></a>
									<span class="switch-indicator-off">OFF</span>
								</div>
								<div class="switch-button">
									<span class="switch-indicator-on">COCKPIT</span>
									<a href="#" class="switch-button" id="view-switch"><span>VIEW</span></a>
									<span class="switch-indicator-off">AIRCRAFT</span>
								</div>
								<a href="#" class="push-button" id="rotate-view">ROTATE<br/>VIEW</a>
                  			</div>
						</div>
					</div>
				</div>
			</div>
		</div> 
		
		<div class="overlayBoxContainer" id="playbackOverlay" style="display: none;">
			<a class="overlayBoxClose"></a>
			<div class="overlayBoxArrow"></div>
			<div class="overlayBoxContent">
				<h3>Playback</h3>
				<ul style="margin-bottom: 5px;">
					<li class="left">
						<label style="font-weight: bold; font-size: 0.9em;">Date</label><br />
						<select id="playback-date" style="width: 100px;">
							<option value="2012-10-23">Today</option><br><option value="2012-10-22">Yesterday</option><br><option value="2012-10-21">2012-10-21</option><br><option value="2012-10-20">2012-10-20</option><br><option value="2012-10-19">2012-10-19</option><br><option value="2012-10-18">2012-10-18</option><br><option value="2012-10-17">2012-10-17</option><br><option value="2012-10-16">2012-10-16</option><br><option value="2012-10-15">2012-10-15</option><br><option value="2012-10-14">2012-10-14</option><br><option value="2012-10-13">2012-10-13</option><br><option value="2012-10-12">2012-10-12</option><br><option value="2012-10-11">2012-10-11</option><br><option value="2012-10-10">2012-10-10</option><br><option value="2012-10-09">2012-10-09</option><br><option value="2012-10-08">2012-10-08</option><br><option value="2012-10-07">2012-10-07</option><br><option value="2012-10-06">2012-10-06</option><br><option value="2012-10-05">2012-10-05</option><br><option value="2012-10-04">2012-10-04</option><br><option value="2012-10-03">2012-10-03</option><br><option value="2012-10-02">2012-10-02</option><br><option value="2012-10-01">2012-10-01</option><br><option value="2012-09-30">2012-09-30</option><br><option value="2012-09-29">2012-09-29</option><br><option value="2012-09-28">2012-09-28</option><br><option value="2012-09-27">2012-09-27</option><br><option value="2012-09-26">2012-09-26</option><br><option value="2012-09-25">2012-09-25</option><br>						</select>

					</li>
					<li class="right">
						<label style="font-weight: bold; font-size: 0.9em;">Time (UTC)</label><br />
							<select id="playback-hour" style="width: 45px;">
								<option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>							</select>
							<select id="playback-minute" style="width: 45px;">
								<option value="00">00</option><option value="05">05</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="35">35</option><option value="40">40</option><option value="45">45</option><option value="50">50</option><option value="55">55</option>							</select>

					</li>
					<br class="clear" />
				</ul>
				<button type="button" value="Start playback" class="standardButton" id="playback-start"><span>Start playback</span></button>
			</div>
		</div>
		
		<div id="playbackControlsOverlay" style="display: none;">
			<a class="overlayBoxClose" id="playback-exit" title="Close and exit playback"></a>
			<a class="modalContentClose" id="settingsContentClose" title="Close"></a>
			<ul>
				<li class="first">
					<button class="playbackButton" id="playback-step-back"><img class="rwd" src="http://flightradar24static.appspot.com/static/_fr24/images/pixel.png" /></button>	
				</li>			
				<li>
					<button class="playbackButton" id="playback-pause"><img class="pause" src="http://flightradar24static.appspot.com/static/_fr24/images/pixel.png" /></button>	
				</li>
				<li class="last">
					<button class="playbackButton" id="playback-step-forward"><img class="fwd" src="http://flightradar24static.appspot.com/static/_fr24/images/pixel.png" /></button>	
				</li>
				<li class="none">
					<label style="font-weight: bold; font-size: 0.9em;">Speed: <span id="slider-playbackSpeed-value" data-playback-speed="24">24x</span></label>
					<div class="slider-container" style="width: 200px;">
						<div id="slider-playbackSpeed" style="width: 189px;"></div>
					</div>				
				</li>
				<br class="clear" />		
			</ul>
				
		</div>
      
		<div class="overlayBoxContainer" id="premiumOverlay" style="display: none;">
			<a class="overlayBoxClose"></a>
			<div class="overlayBoxArrow"></div>
			<div class="overlayBoxContent">
				            <h3>Sign in to premium</h3>
                        <form action="http://www.flightradar24.com" method="post">
                <ul class="signInForm">
                    <li>
                        <input type="text" name="email" placeholder="Email" />
                    </li>
                    <li>
                        <input type="password" name="password" placeholder="Password" />
                    </li>                
                </ul>
                <input type="checkbox" name="remember" value="1" id="checkbox-remember" /> <label for="checkbox-remember">Remember me</label>
                <input type="submit" class="standardButton" value="Sign in" style="width: 100%; margin-top: 5px;" />
            </form>
            <p class="infoText"><a href="http://www.flightradar24.com/premium">Get a premium account</a></p>
            
			</div>
		</div>      

		<div id="leftCol">
			<div id="mainView">
			<h1 id="pageLogo">
				<a title="Flightradar24" href="http://www.flightradar24.com"></a>
			</h1>
				<ul class="menuChoices">
					<li class="active">
						<a title="Map" href="http://www.flightradar24.com" class="ajax menuChoice">
							<span class="icon map"></span>
							<span class="choiceTitle">Map</span>
							<span class="choiceValue" id="menuMapValue">0</span>
						</a>
						<ul class="subChoices">
							<li class="first">
								<a style="text-align: right;">
									<input type="text" id="searchBox" placeholder="Search flight..." />
								</a>
							</li>
							<li>
								<a title="Playback" id="playbackButton" style="cursor: pointer;">
									<span class="icon playback"></span>
									<span class="choiceTitle" id="playbackChoice">Playback</span>						
								</a>
							</li>
							<li>
								<a title="Settings" id="settingsButton" style="cursor: pointer;">
									<span class="icon cog"></span>
									<span class="choiceTitle" id="settingsChoice">Settings</span>								
								</a>
							</li>
							<li>
								<a title="Filter" id="filterButton" style="cursor: pointer;">
									<span class="icon filter"></span>
									<span class="choiceTitle" id="filterChoice">Filter</span>
									<span class="right" id="filterLeds"></span>								
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a title="Planes" href="http://www.flightradar24.com/planes.php" class="ajax menuChoice">
							<span class="icon planes"></span>
							<span class="choiceTitle">Planes</span>
							<span class="choiceValue" id="menuPlanesValue">0</span>
						</a>
					</li>	
					<li>
						<a title="Premium" class="menuChoice" id="premiumButton" >
							<span class="icon user"></span>
                                          	<span class="choiceTitle">Premium</span>
                     						</a>
					</li>
               <li class="buttons">
                   <div id="fb-like" style="height: 25px; width: 88px; float:left;">
                        <div id="fb-root" style="display:none;"></div>
                        <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=408785569177192";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>

                        <div class="fb-like" data-href="http://www.facebook.com/flightradar24" data-send="false" data-layout="button_count" data-width="140" data-show-faces="false" data-colorscheme="dark"></div>
                   </div>
                   <div id="twitter-like" style="float:left; margin-left: 5px;">
                        <a href="https://twitter.com/flightradar24" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false"></a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>

                    <div id="gp-like" style="float: left; margin-left: 5px;">
                        <g:plusone size="medium" annotation="none" href="http://www.flightradar24.com"></g:plusone>
                        <script type="text/javascript">
                        (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                        </script>    
                    </div>                    
               </li>
				</ul>            
			</div>            
			
			<div id="secondaryView">
				<div style="padding: 9px;" >
					
					<h5>Map link</h5>
					<div style="margin-right: 9px;">
						<input type="text" class="insetBox select-on-focus" style="width: 100%; margin-top: 5px; font-size: 0.65em;" id="map-link" />
					</div>
					
					<h5 class="twitter" style="margin-top: 5px;">Latest twitter</h5>
					<p class="insetBox" style="margin: 5px 0 10px 0;"><span id="latestTwitterContainer"></span><br /><span class="right" id="latestTwitterTime"></span><br class="clear" /></p>

					<h5 class="facebook">Latest Facebook</h5>
					<p class="insetBox" style="margin: 5px 0 10px 0;"><span id="latestFacebookContainer"></span><br /><span class="right" id="latestFacebookTime"></span><br class="clear" /></p>
			
				</div>
			</div>
			
			            <div id="ad-container">
            <script type="text/javascript"><!--
            google_ad_client = "ca-pub-0223260809600052";
            /* FR24 Index */
            google_ad_slot = "0056269134";
            google_ad_width = 200;
            google_ad_height = 200;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
			</div>	
            		</div>
		

		<div id="leftColOverlay" style="display: none;">
			<div id="leftColOverlayHeader">
				<h3 id="headerTitle"></h3>
				<a class="close" title="Close"></a>
				<a class="followAircraft" id="follow-aircraft" title="Follow aircraft"></a>
				<br class="clear" />
				
				<div id="leftColAircraftImage"></div>
			</div>
			<div id="headerBottom"></div>
			<div id="leftColAircraftDataContainer">
				<div id="leftColAircraftData"></div>
			</div>
		</div>
      
              
      

          
          
    
        <div id="topBar" class="" style="">
            <div class="left">
            <h1 id="pageLogoTop">
                <a title="Flightradar24" href="/"></a>
            </h1>
            </div>
            <div class="left">
                <ul class="topBarMenu">
                                            <li class="">
                            <a href="/apps" class=""  >
                                <span class="icon apps"></span>
                                <span class="choiceTitle">APPS</span>
                            </a>
                                                    </li>                       
                                                <li class="">
                            <a href="/increase-coverage" class=""  >
                                <span class="icon ic"></span>
                                <span class="choiceTitle">INCREASE COVERAGE</span>
                            </a>
                                                    </li>                       
                                                <li class="hasDropdown">
                            <a href="/about" class=""  >
                                <span class="icon about"></span>
                                <span class="choiceTitle">ABOUT</span>
                            </a>
                                                            <div class="dropdownMenuContainer" style="display: none;">
                                    <span class="dropdownMenuArrow"></span>
                                    <ul class="dropdownMenu">
                                                                                    <li>
                                                <a href="/how-it-works">How it works</a>
                                            </li>                                            
                                                                                    <li>
                                                <a href="/faq">FAQ</a>
                                            </li>                                            
                                                                                    <li>
                                                <a href="/contact-us">Contact us</a>
                                            </li>                                            
                                                                                    <li>
                                                <a href="/privacy-policy">Privacy policy</a>
                                            </li>                                            
                                                                            </ul>
                                </div>
                                                    </li>                       
                                                <li class="hasDropdown">
                            <a href="/data" class=""  >
                                <span class="icon data"></span>
                                <span class="choiceTitle">DATABASE</span>
                            </a>
                                                            <div class="dropdownMenuContainer" style="display: none;">
                                    <span class="dropdownMenuArrow"></span>
                                    <ul class="dropdownMenu">
                                                                                    <li>
                                                <a href="/data/airplanes">Airline fleets</a>
                                            </li>                                            
                                                                                    <li>
                                                <a href="/data/airports">World airports</a>
                                            </li>                                            
                                                                                    <li>
                                                <a href="/data/flights">Flights</a>
                                            </li>                                            
                                                                                    <li>
                                                <a href="/data/changes">Latest changes</a>
                                            </li>                                            
                                                                            </ul>
                                </div>
                                                    </li>                       
                                                <li class="">
                            <a href="http://forum.flightradar24.com" class="" target="_blank" >
                                <span class="icon forum"></span>
                                <span class="choiceTitle">FORUM</span>
                            </a>
                                                    </li>                       
                                                <li class="">
                            <a  class=""  id="chat-link">
                                <span class="icon chat"></span>
                                <span class="choiceTitle">CHAT</span>
                            </a>
                                                    </li>                       
                                            <br class="clear" />
                </ul>
            </div>

                        <div class="right">
                <div class="left utcLabel">
                    UTC
                </div>
                <div class="insetBox timeWidget left">
                    <span class="nr0"></span>
                    <span class="nr0"></span>
                    <span class="nrx"></span>
                    <span class="nr0"></span>
                    <span class="nr0" style="margin-right: 0;"></span>
                    <br class="clear" />
                    <div class="timeOverlay"></div>
                </div>
                <br class="clear" />				
            </div>
                        <br class="clear" />
        </div> 
      
     
      
      
          <div id="bottomRightOverlays">
                
        <a id="planecolor_badge">
            <span class="badge_dismiss" id="planecolor_badge_dismiss" title="Dismiss"></span>
        </a>
                  
        <a href="http://www.flightradar24.com/apps" id="apppage_badge" title="Want Flightradar24 on your smartphone or tablet?">
            <span class="badge_dismiss" id="apppage_badge_dismiss" title="Dismiss"></span>
        </a>
              </div>
          
<div id="content-container"><script type="text/javascript">
	if(document.getElementById('topBar')==null) {
		window.location = location.href.replace("?ajax","");
	}

	$().ready(function() {
		//if(!(window.location.href.indexOf('#!/')!=-1 && window.location.href.split('#!/')[1].split('?')[0]!='')) {
	  		  	initialize_map();
	  //}
	
	});
</script>
<div id="map_canvas"></div>

</div><script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-51622-13']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</body>
</html>
<?php
include_once '../../konfiguracija.php';
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../Predlosci/glava.php';
		?>
	</head>
	<body>
		<header>
			<?php
			include_once '../../Predlosci/zaglavlje.php';
			?>
			<?php
				include_once '../../Predlosci/izbornik.php';
			?>
		</header>

		<h1>jQuery Week Calendar (full demo)</h1>
	
	<div id='calendar'></div>
	<div id="event_edit_container">
		<form>
			<input type="hidden" />
			<ul>
				<li>
					<span>Date: </span><span class="date_holder"></span> 
				</li>
				<li>
					<label for="start">Start Time: </label><select name="start"><option value="">Select Start Time</option></select>
				</li>
				<li>
					<label for="end">End Time: </label><select name="end"><option value="">Select End Time</option></select>
				</li>
				<li>
					<label for="title">Title: </label><input type="text" name="title" />
				</li>
				<li>
					<label for="body">Body: </label><textarea name="body"></textarea>
				</li>
			</ul>
		</form>
	</div>
	<div id="about">
		<h2>Summary</h2>
		<p>
			This calendar implementation demonstrates further usage of the calendar with editing and deleting of events. 
			It stops short however of implementing a server-side back-end which is out of the scope of this plugin. It 
			should be reasonably evident by viewing the demo source code, where the points for adding ajax should be. 
			Note also that this is **just a demo** and some of the demo code itself is rough. It could certainly be 
			optimised.
		</p>
		<p>
			***Note: This demo is straight out of SVN trunk so may show unreleased features from time to time.
		</p>
		<h2>Demonstrated Features</h2>
		<p>
			This calendar implementation demonstrates the following features:
		</p>
		<ul class="formatted">
			<li>Adding, updating and deleting of calendar events using jquery-ui dialog. Also includes 
				additional calEvent data (body field) not defined by the calEvent data structure to show the storage 
				of the data within the calEvent</li>
			<li>Dragging and resizing of calendar events</li>
			<li>Restricted timeslot rendering based on business hours</li>
			<li>Week starts on Monday instead of the default of Sunday</li>
			<li>Allowing calEvent overlap with staggered rendering of overlapping events</li>
			<li>Use of the 'getTimeslotTimes' method to retrieve valid times for a given event day. This is used to populate
				select fields for adding, updating events.</li>
			<li>Use of the 'eventRender' callback to add a different css class to calEvents in the past</li>
			<li>Use of additional calEvent data to enforce readonly behaviour for a calendar event. See the event
				titled "i'm read-only"</li>
		</ul>
	</div>

			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	</body>
</html>

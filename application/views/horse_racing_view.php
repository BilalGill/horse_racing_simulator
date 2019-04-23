<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<script type="text/javascript"  language="javascript">

	$(document).ready(function() {

		get_current_races();
		get_past_races();
		get_best_horse_data();
	});

	function show_current_races(data){

		$('#content_div').empty();
		$( ".content_div" ).append( '<div style="margin:10px;" id="user_data_content"><h3>Current Races : </h3></div>' );

		var race_num = 0;
		var is_data_empty = true;
		$.each(data, function (key, horse_item) {

			var content_data = "";
			is_data_empty = false;
			race_num++;

			$.each(horse_item, function(title, value){

				content_data += "<tr>";
				var horse_pos = title+1;

					content_data += "<td>" + horse_pos + "</td>";

				if (typeof value['time_duration'] == 'undefined')
					content_data += "<td></td>";
				else
					content_data += "<td>" + value['time_duration'] + "</td>";

				if (typeof value['distance_covered'] == 'undefined')
					content_data += "<td></td>";
				else
					content_data += "<td>" + value['distance_covered'] + "</td>";

				content_data += "</tr>";
			});

			var tableHeaders = "<table id='data_table'><tr>";
			tableHeaders += "<th>Horse Position</th>";
			tableHeaders += "<th>Time Duration</th>";
			tableHeaders += "<th>Distance Covered</th>";
			content_data = tableHeaders + content_data + "</table>";

			$( ".content_div" ).append( '<div style="margin:10px;" id="user_data_content"><p>Race # ' + race_num + ' : </p></div>' );
			$( ".content_div" ).append( '<div style="margin:10px;" id="user_data_content">'+content_data+'</div>' );
		});

		if(is_data_empty)
			$( ".content_div" ).append( '<div style="margin:10px;" id="user_data_content"><p>No Record Exists !!!</p></div>' );
	}

	function show_past_races(data){

		$('#past_race_div').empty();
		$( ".past_race_div" ).append( '<div style="margin:10px;" id="user_data_content"><h3>Past Races : </h3></div>' );

		var race_num = 0;
		var is_data_empty = true;

		$.each(data, function (key, horse_item) {

			var content_data = "";
			is_data_empty = false;
			race_num++;

			$.each(horse_item, function(title, value){

				content_data += "<tr>";
				if (typeof value['horse_id'] == 'undefined')
					content_data += "<td></td>";
				else
					content_data += "<td>" + value['horse_id'] + "</td>";

				if (typeof value['completion_time'] == 'undefined')
					content_data += "<td></td>";
				else
					content_data += "<td>" + value['completion_time'] + "</td>";

				if (typeof value['horse_pos'] == 'undefined')
					content_data += "<td></td>";
				else
					content_data += "<td>" + value['horse_pos'] + "</td>";
				content_data += "</tr>";
			});

			var tableHeaders = "<table id='data_table'><tr>";
			tableHeaders += "<th>Horse Id</th>";
			tableHeaders += "<th>Completion Time</th>";
			tableHeaders += "<th>position</th>";
			content_data = tableHeaders + content_data + "</table>";

			$( ".past_race_div" ).append( '<div style="margin:10px;" id="user_data_content"><p>Race # ' + race_num + ' : </p></div>' );
			$( ".past_race_div" ).append( '<div style="margin:10px;" id="user_data_content">'+content_data+'</div>' );
		});

		if(is_data_empty)
			$( ".past_race_div" ).append( '<div style="margin:10px;" id="user_data_content"><p>No Record Exists !!!</p></div>' );
	}

	function show_best_horse(data){

		$('#best_horse_div').empty();
		$( ".best_horse_div" ).append( '<div style="margin:10px;" id="user_data_content"><h3>Best Horse Data : </h3></div>' );

		var content_data = "";
		$.each(data, function(title, value){

			content_data = "<tr>";

			if (typeof value['strength'] == 'undefined')
				content_data += "<td></td>";
			else
				content_data += "<td>" + value['strength'] + "</td>";

			if (typeof value['speed'] == 'undefined')
				content_data += "<td></td>";
			else
				content_data += "<td>" + value['speed'] + "</td>";

			if (typeof value['endurance'] == 'undefined')
				content_data += "<td></td>";
			else
				content_data += "<td>" + value['endurance'] + "</td>";

			if (typeof value['time_duration'] == 'undefined')
				content_data += "<td></td>";
			else
				content_data += "<td>" + value['time_duration'] + "</td>";

			content_data += "</tr>";
		});

		if(content_data != ""){

			var tableHeaders = "<table id='data_table'><tr>";
			tableHeaders += "<th>Strength</th>";
			tableHeaders += "<th>Speed</th>";
			tableHeaders += "<th>Endurance</th>";
			tableHeaders += "<th>Completion Time</th>";
			content_data = tableHeaders + content_data + "</table>";

			$( ".best_horse_div" ).append( '<div style="margin:10px;" id="user_data_content">'+content_data+'</div>' );
		}
		else {
			$( ".best_horse_div" ).append( '<div style="margin:10px;" id="user_data_content"><p>No Record Exists !!!</p></div>' );
		}
	}

	function get_current_races()
	{
		var save_url = "<?php echo base_url(); ?>" + "index.php/Get_current_races";

		$.ajax({
			type: "GET",
			url: save_url,
			dataType: 'json',
			cache: false,
			success: function(data) {
				show_current_races(data['raceData']);
			}
		});
	}

	function get_past_races()
	{
		var save_url = "<?php echo base_url(); ?>" + "index.php/Get_race_History";

		$.ajax({
			type: "GET",
			url: save_url,
			dataType: 'json',
			cache: false,
			success: function(data) {
				show_past_races(data['pastRaceData']);
			}
		});
	}

	function get_best_horse_data()
	{
		var save_url = "<?php echo base_url(); ?>" + "index.php/Get_best_horse";

		$.ajax({
			type: "GET",
			url: save_url,
			dataType: 'json',
			cache: false,
			success: function(data) {
				show_best_horse(data['bestHorseData']);
			}
		});
	}

	function create_race()
	{
		$("#save_status").html("Creating race...");
		$("#save_status").css("display", "block");

		var save_url = "<?php echo base_url(); ?>" + "index.php/Create_race";

		$.ajax({
			type: "GET",
			url: save_url,
			success: save_document_completed,
			dataType: 'json',
			cache: false
		});
	}

	function save_document_completed(data)
	{
		get_current_races();
		$("#save_status").html(data["MESSAGE"]);
		$('#save_status').fadeOut(3000, function() {
			$("#save_status").html(data["MESSAGE"]);
		});
	}

	function progress_race()
	{
		$("#save_status").html("Progressing !!!");
		$("#save_status").css("display", "block");

		var save_url = "<?php echo base_url(); ?>" + "index.php/Progress_race";

		$.ajax({
			type: "GET",
			url: save_url,
			success: progress_race_completed,
			dataType: 'json',
			cache: false
		});
	}

	function progress_race_completed(data)
	{
		show_current_races(data['raceData']);
		get_past_races();
		get_best_horse_data();

		$("#save_status").html("Progressed Successfully !!!");
		$('#save_status').fadeOut(3000, function() {
		});
	}

</script>

<style>
#data_table
{
width: 50%;
}

#data_table th
{
font-size:0.8em;
text-align:left;
/*padding-top:5px;*/
/*padding-bottom:4px;*/
background-color:#cecece;
color:black;
}
#data_table td, #data_table th
{
font-size:0.8em;
border:1px solid #cecece;
/*padding:3px 7px 2px 7px;*/
text-align:center;
}

.button {
	background-color: #4CAF50;
	border: none;
	border-radius: 10px;
	color: white;
	padding: 7px 25px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
	margin: 4px 2px;
	cursor: pointer;
}

.save_status{
	position:fixed;
	top:0px;
	background:#FFFF66;
	z-index:100000;
	left: 50%;
	padding:3px;
	margin-left:-40px;
	border:2px solid yellow;
	border-radius:3px;
	display:none;
}

</style>


<!DOCTYPE html>
<html lang="en">
<body>

<div class="save_status" id="save_status">
	Saving...
</div>
<button type="button" class="button" onclick="create_race();">Create race</button>
<button type="button" class="button" onclick="progress_race();">Progress Race</button>

<div id="content_div" class="content_div" style="display:block;"></div>
<div id="past_race_div" class="past_race_div" style="display:block;"></div>
<div id="best_horse_div" class="best_horse_div" style="display:block;"></div>
<!--	<div style="margin:10px;" id="user_data_content"></div>-->

</body>
</html>
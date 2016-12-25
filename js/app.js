$(document).ready(function(){
	$.ajax({
		url: "http://localhost/project/RaspberryPi/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var date = [];
			var gas = [];

			for(var i in data) {
				date.push(data[i].date);
				gas.push(data[i].gas);
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Gas (%) ',
						backgroundColor: 'black',
						borderColor: 'black',
						hoverBackgroundColor: 'grey',
						hoverBorderColor: 'grey)',
						data: gas
					}
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});

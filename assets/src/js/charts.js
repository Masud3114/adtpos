import Chart from 'chart.js/auto';
const axios = require('axios');
axios({
	method: 'POST',
	headers: {'X-Requested-With': 'XMLHttpRequest'},
	url: 'report.php',
	data: {
		ppg: 'home',
	}
}).then(function (response) {
	new Chart(document.getElementById("present_chart"), {
		"type": "bar",
		"data": {
			"labels": response.data.present.lebel,
			"datasets": [{
				"label": "Late Present",
				"data": response.data.present.late_present,
				"type": "line",
				"fill": false,
				"borderColor": "rgb(249 115 22)"
			}, {
				"label": "Present",
				"data": response.data.present.total_present,
				"borderColor": "rgb(255, 99, 132)",
				"backgroundColor": "rgba(29, 78, 216, 0.7)"
			}]
		}
	});
	new Chart(document.getElementById("absent_chart"), {
		"type": "line",
		"data": {
			"labels": response.data.absent.lebel,
			"datasets": [{
				"label": "Absent",
				"data": response.data.absent.total_absent,
				"fill": false,
				"borderColor": "rgb(190 18 60)",
				"lineTension": 0.1
			}]
		}
	});
});
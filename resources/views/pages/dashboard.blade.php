{{-- extend layout --}}
@extends('layouts.admin')

{{-- page title --}}
@section('title','Home')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Dashboard</h1>
	</div>
	<div class="col-sm-6">

	</div>
</div>
@endsection

{{-- page content --}}
@section('content')

    <div class="card">
		<div class="card-header">
			<div class="pull-left">

	        </div>
	        <div class="pull-right">

	        </div>
        </div>

		<div class="card-body">

			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
					<div class="inner">
						<h3>{{count($orders)}}</h3>

						<p>New Orders</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="{{ route('transactions/orders')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
					<div class="inner">
						<h3>{{$success_perc}}<sup style="font-size: 20px">%</sup></h3>

						<p>Bounce Rate</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
                <!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
					<div class="inner">
                        @php
                        $total_amount=0;
                        if(!empty($payments))
                        {
                            foreach($payments as $payment)
                            {
                                $total_amount+=$payment->amount;
                            }
                        }
                        @endphp
						<h3>₹{{number_format($total_amount,2)}}</h3>

						<p>Total Payments Amount</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="{{ route('transactions/payments') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
					<div class="inner">
						<h3>{{count($users)}}</h3>

						<p>Total Users</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
			</div>
			<!-- /.row -->

			<div class="row" style="margin-top: 30px;">
				<div class="col-lg-4 col-4">
					<div class="row">
						<div class="col-lg-9">
							<select class="form-control" name="suc_transaction" onchange="show_trans_graph()">
								<option value="" disabled>Select format</option>
								<option value="monthly">Monthly</option>
								<option value="yearly">Yearly</option>
							</select>
						</div>
						<div class="col-lg-3">
							<button id="btn-download1" class="btn btn-xs btn-info">Download</button>
						</div>
					</div>
					<canvas id="lineChart1" style="width:100%; height: 600px; max-width:600px"></canvas>
				</div>
				<div class="col-lg-4 col-4">
					<div class="row">
						<div class="col-lg-9">
							<select class="form-control" name="total_transaction">
								<option value="" disabled>Select format</option>
								<option value="monthly">Monthly</option>
								<option value="yearly">Yearly</option>
							</select>
						</div>
						<div class="col-lg-3">
							<button id="btn-download2" class="btn btn-xs btn-primary">Download</button>
						</div>
					</div>
					<canvas id="lineChart2" style="width:100%; height: 600px;max-width:600px"></canvas>
				</div>
				<div class="col-lg-4 col-4">
					<div class="row">
						<div class="col-lg-9">
							<select class="form-control" name="suc_rate">
								<option value="" disabled>Select format</option>
								<option value="monthly">Monthly</option>
								<option value="yearly">Yearly</option>
							</select>
						</div>
						<div class="col-lg-3">
							<button id="btn-download3" class="btn btn-xs btn-warning">Download</button>
						</div>
					</div>
					<canvas id="lineChart3" style="width:100%; height: 600px;max-width:600px"></canvas>
				</div>
			</div>



			<div class="row" style="margin-top: 30px;">
				<div class="col-lg-6 col-6">
					<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
				</div>
				<div class="col-lg-6 col-6">
					<div id="piechart"></div>
				</div>
			</div>
		</div>
	</div>



@endsection


@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" ></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "Sept"];
var yValues = [200, 58, 125, 110, 175, 148, 221, 315, 112];
var barColors = ["red", "green","blue","orange","brown", "black", "beige", "yellow"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Monthly Payment Data"
    }
  }
});




</script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Transaction data Volume'],
  ['Payment', 800],
  ['Refund', 200],
  ['Batch Refund', 400],
  ['Orders', 200],
  ['Disputes', 600]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Transaction data Volume', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}




var xValues1 = ['JAN17','JAN18','JAN19','JAN20','JAN21','JAN22','JAN23','JAN24','JAN25'];
var yValues1 = [7,8,8,9,9,9,10,11,14];
new Chart("lineChart1", {
  type: "line",
  data: {
    labels: xValues1,
    datasets: [{
      fill: true,
	  borderJoinStyle: 'round',
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "white",
      data: yValues1
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    },
	title: {
      display: true,
      text: "Successful Transaction"
    }
  }
});


var xValues2 = ['MAR17','MAR18','MAR19','MAR20','MAR21','MAR22','MAR23','MAR24','MAR25'];
var yValues2 = [700,208,820,609,922,359,107,101,214];
new Chart("lineChart2", {
  type: "line",
  data: {
    labels: xValues2,
    datasets: [{
      fill: true,
	  borderJoinStyle: 'round',
	  borderColor: 'white',
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "white",
      data: yValues2
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 100, max:1000}}],
    },
	title: {
      display: true,
      text: "Total Collection"
    }
  }
});


var xValues3 = ['APR17','APR18','APR19','APR20','APR21','APR22','APR23','APR24','APR25'];
var yValues3 = [500,808,320,409,222,759,907,601,214];
new Chart("lineChart3", {
  type: "line",
  data: {
    labels: xValues3,
    datasets: [{
      fill: true,
	  borderJoinStyle: 'round',
	  borderColor: 'white',
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "white",
      data: yValues3
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 100, max:1000}}],
    },
	title: {
      display: true,
      text: "Total Collection"
    }
  }
});


function show_trans_graph(){
	var xValues1 = ['JAN','FEB','MAR','APR','MAY','JUNE','JULY','AUG','SEPT'];
	var yValues1 = [70,87,18,79,91,39,100,301,214];
	new Chart("lineChart1", {
	type: "line",
	data: {
		labels: xValues1,
		datasets: [{
		fill: true,
		borderJoinStyle: 'round',
		lineTension: 0,
		backgroundColor: "rgba(0,0,255,1.0)",
		borderColor: "white",
		data: yValues1
		}]
	},
	options: {
		legend: {display: false},
		scales: {
		yAxes: [{ticks: {min: 0, max:500}}],
		},
		title: {
		display: true,
		text: "Successful Transaction"
		}
	}
	});
}

document.getElementById('btn-download1').onclick = function() {
	var xValues1 = ['JAN','FEB','MAR','APR','MAY','JUNE','JULY','AUG','SEPT'];
	var yValues1 = [70,87,18,79,91,39,100,301,214];
	var print_chart = new Chart("lineChart1", {
	type: "line",
	data: {
		labels: xValues1,
		datasets: [{
		fill: true,
		borderJoinStyle: 'round',
		lineTension: 0,
		backgroundColor: "rgba(0,0,255,1.0)",
		borderColor: "white",
		data: yValues1
		}]
	},
	options: {
		legend: {display: false},
		scales: {
		yAxes: [{ticks: {min: 0, max:500}}],
		},
		title: {
		display: true,
		text: "Successful Transaction"
		}
	}
	});
	// Trigger the download
	var a = document.createElement('a');
	a.href = print_chart.toBase64Image();
	a.download = 'my_file_name.png';
	a.click();
}
</script>
@endsection

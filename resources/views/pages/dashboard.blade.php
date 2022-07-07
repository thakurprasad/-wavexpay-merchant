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
				<label for="first_name"><strong>Payment Date Range</strong><For></For></label>
				<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
					<i class="fa fa-calendar"></i>&nbsp;
					<span></span> <i class="fa fa-caret-down"></i>
				</div>
	        </div>
	        <div class="pull-right">
				<label for="first_name"><strong>Transaction Filter</strong><For></For></label>
				<select class="form-control" style="width: 300px;" id="status_filter">
					<option value="" disabled selected>Select Transaction Status</option>
					<option value="failed">Failed</option>
					<option value="authorized">Successful</option>
				</select>
	        </div>
        </div>

		<div class="card-body">

			<!-- Small boxes (Stat box) -->
			<div class="row">
				
				<div class="col-lg-4 col-6">
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
				<div class="col-lg-4 col-6">
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
				
				<div class="col-lg-4 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
					<div class="inner">
						<h3>{{$success_perc}}<sup style="font-size: 20px">%</sup></h3>
						<p>Success Rate</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /.row -->

			<div class="row" style="margin-top: 30px;">
				<div class="col-lg-6 col-6">
					<div class="row">
						<div class="col-lg-10">
							<select class="form-control" id="suc_transaction" name="suc_transaction" onchange="show_trans_graph()">
								<option value="" disabled selected>Select format</option>
								<option value="monthly">Monthly</option>
								<option value="yearly">Yearly</option>
							</select>
						</div>
						<div class="col-lg-2">
							<button id="btn-download1" class="btn btn-xs btn-info">Download</button>
						</div>
					</div>
					<canvas id="lineChart1" style="width:100%; height: 300px; max-width:500px"></canvas>
				</div>
				<!--<div class="col-lg-4 col-4">
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
				</div>-->
				<div class="col-lg-6 col-6">
					<div class="row">
						<div class="col-lg-10">
							<select class="form-control" name="suc_rate" id="suc_rate" onchange="show_suc_graph()">
								<option value="" disabled selected>Select format</option>
								<option value="monthly">Monthly</option>
								<option value="yearly">Yearly</option>
							</select>
						</div>
						<div class="col-lg-2">
							<button id="btn-download3" class="btn btn-xs btn-warning">Download</button>
						</div>
					</div>
					<canvas id="lineChart3" style="width:100%; height: 300px;max-width:500px"></canvas>
				</div>
			</div>



			<div class="row" style="margin-top: 30px;">
				<div class="col-lg-6 col-6">
					<!--<canvas id="myChart" style="width:100%;max-width:600px"></canvas>-->
					<div id="myPlot" style="width:100%;max-width:700px"></div>
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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" ></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});


$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
  console.log(picker.startDate.format('YYYY-MM-DD'));
  console.log(picker.endDate.format('YYYY-MM-DD'));
});
</script>



<script>
    $(function(){
      // bind change event to select
      $('#status_filter').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              //window.location = '{{ url("/") }}/transactions/payments/status?status='+url; // redirect
			  window.open('{{ url("/") }}/transactions/payments/status?status='+url, '_blank');
          }
          return false;
      });
    });
</script>

<script>
var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "Sept"];
var yValues = [200, 58, 125, 110, 175, 148, 221, 315, 112];
var barColors = ["red", "green","blue","orange","brown", "black", "beige", "yellow"];

/*new Chart("myChart", {
  type: "bar",
  data: {
    labels: {!! $xValue !!},
    datasets: [{
      backgroundColor: barColors,
      data: {{$yValue}}
    }]
  },
  options: {
    legend: {display: false},
	scales: {
      y: {
        beginAtZero: true
      }
    },
    title: {
      display: true,
      text: "Monthly Payment Data"
    }
  }
});*/


var data = [{
  x: {!! $xValue !!},
  y: {{$yValue}},
  type: "bar"  }];
var layout = {title:"Monthly Payment Data"};

Plotly.newPlot("myPlot", data, layout);




</script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Transaction data Volume'],
  {!! $new_pie_chart_volume_data !!}
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Transaction data Volume', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}





new Chart("lineChart1", {
  type: "line",
  data: {
    labels: {!! $paymentxvalue1 !!},
    datasets: [{
      fill: true,
	  borderJoinStyle: 'round',
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "white",
      data: {{$paymentyvalue1}}
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      //yAxes: [{ticks: {min: {{$paymentminValue}}, max:{{$paymentmaxValue}}}}],
	  yAxes: [{ticks: {min: 50, max:2000}}],
    },
	title: {
      display: true,
      text: "Successful Transaction"
    }
  }
});




new Chart("lineChart3", {
  type: "line",
  data: {
    labels: {!! $orderxvalue1 !!},
    datasets: [{
      fill: true,
	  borderJoinStyle: 'round',
	  borderColor: 'white',
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "white",
      data: {{$orderyvalue1}}
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      //yAxes: [{ticks: {min: {{$orderminValue}}, max:{{$ordermaxValue}}}}],
	  yAxes: [{ticks: {min: 50, max:25000}}],
    },
	title: {
      display: true,
      text: "Total Collection"
    }
  }
});


function show_trans_graph(){
	var suc_transaction = $("#suc_transaction").val();
	var xValues = ['N/A'];
	var yValues = [0];
	var min = 0;
	var max = 1000;
	$.ajax({
        url: '{{url("getsuccesstransactiongraphdata")}}',
        data: {data_format: suc_transaction},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){          
			xValues = data.paymentxvalue1;
			yValues = data.paymentyvalue1;
			min = data.paymentminValue;
			max = data.paymentmaxValue;			
			create_ajax_payment_chart(xValues,yValues,min,max);
        }
    });
}

function create_ajax_payment_chart(xValues,yValues,min,max){
	console.log(xValues);
	var canv = document.createElement("canvas");
	canv.width = 200;
	canv.height = 200;
	canv.setAttribute('id', 'lineChart1');
	document.body.appendChild(canv);
	var C = document.getElementById(canv.getAttribute('id'));
	if (C.getContext) 
	{              
    	if (C.getContext) 
		{
			new Chart("lineChart1", {
			type: "line",
			data: {
				labels: (xValues.trim()).split(','),
				datasets: [{
				fill: true,
				borderJoinStyle: 'round',
				lineTension: 0,
				backgroundColor: "rgba(0,0,255,1.0)",
				borderColor: "white",
				data: (yValues.trim()).split(",")
				}]
			},
			options: {
				legend: {display: false},
				scales: {
				yAxes: [{ticks: {min: 50, max:2000}}],
				},
				title: {
				display: true,
				text: "Successful Transaction"
				}
			}
			});
		}
	}

}





function show_suc_graph()
{
	var suc_rate = $("#suc_rate").val();
	var xValues = ['N/A'];
	var yValues = [0];
	var min = 0;
	var max = 1000;
	$.ajax({
        url: '{{url("getsuccessrategraphdata")}}',
        data: {data_format: suc_rate},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){          
			xValues = data.paymentxvalue1;
			yValues = data.paymentyvalue1;
			min = data.paymentminValue;
			max = data.paymentmaxValue;			
			create_ajax_success_chart(xValues,yValues,min,max);
        }
    });
}


function create_ajax_success_chart(xValues,yValues,min,max){
	console.log(xValues);
	var canv = document.createElement("canvas");
	canv.width = 200;
	canv.height = 200;
	canv.setAttribute('id', 'lineChart3');
	document.body.appendChild(canv);
	var C = document.getElementById(canv.getAttribute('id'));
	if (C.getContext) 
	{              
    	if (C.getContext) 
		{
			new Chart("lineChart3", {
			type: "line",
			data: {
				labels: (xValues.trim()).split(','),
				datasets: [{
				fill: true,
				borderJoinStyle: 'round',
				lineTension: 0,
				backgroundColor: "rgba(0,0,255,1.0)",
				borderColor: "white",
				data: (yValues.trim()).split(",")
				}]
			},
			options: {
				legend: {display: false},
				scales: {
				yAxes: [{ticks: {min: 0, max:2500000}}],
				},
				title: {
				display: true,
				text: "Total Collection"
				}
			}
			});
		}
	}

}






document.getElementById('btn-download1').onclick = function() {
	show_trans_graph();
	var print_chart = new Chart("lineChart1");
	// Trigger the download
	var a = document.createElement('a');
	a.href = print_chart.toBase64Image();
	a.download = 'Successful Transaction.png';
	a.click();
}

document.getElementById('btn-download3').onclick = function() {
	show_suc_graph();
	var print_chart = new Chart("lineChart3");
	// Trigger the download
	var a = document.createElement('a');
	a.href = print_chart.toBase64Image();
	a.download = 'Orders.png';
	a.click();
}
</script>
@endsection

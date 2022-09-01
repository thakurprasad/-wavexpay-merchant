@extends('newlayout.app')
@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
.modal {
    overflow-y: auto;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    @if(isset($dashboard_header) && $dashboard_header->title!='')
	<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<strong>@php if(isset($dashboard_header) && $dashboard_header->title!='') { echo $dashboard_header->title; } @endphp!</strong> @php if(isset($dashboard_header) && $dashboard_header->description!='') { echo $dashboard_header->description; } @endphp.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif


   
    <div class="row">
        <div class="col-xl-5">
            <label for="first_name"><strong>Payment Date Range</strong><For></For></label>
            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 80%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
        </div>
        <div class="col-xl-2">
            
        </div>
        <div class="col-xl-5">
            <label for="first_name"><strong>Transaction Filter</strong><For></For></label>
            <select class="form-control" style="width: 100%;" id="status_filter">
                <option value="authorized">Successful</option>
                <option value="pending">Pending</option>
                <option value="all">All</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-xl12">
            &nbsp;
        </div>
    </div>
    

    <!-- Content Row -->
    <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Orders</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($orders)}}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
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
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Payments Amount</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{number_format($total_amount,2)}}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Success Rate</div>
                <div class="row no-gutters align-items-center">
                <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$success_perc}}%</div>
                </div>
                <div class="col">
                    <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    

    </div>

    <!-- Content Row -->

    <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Payment Overview</h6>
            <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
            <canvas id="myAreaChart1"></canvas>
            </div>
        </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Order Overview</h6>
            <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myBarChart1"></canvas>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Content Row -->
    <div class="row">

    <!-- Content Column 
    <div class="col-lg-6 mb-4">

        
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
        </div>
        <div class="card-body">
            <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
            <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
            <div class="progress mb-4">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
            <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
            <div class="progress mb-4">
            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
            <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        </div>-->

        <!-- Color System 
        <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card bg-primary text-white shadow">
            <div class="card-body">
                Primary
                <div class="text-white-50 small">#4e73df</div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-success text-white shadow">
            <div class="card-body">
                Success
                <div class="text-white-50 small">#1cc88a</div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-info text-white shadow">
            <div class="card-body">
                Info
                <div class="text-white-50 small">#36b9cc</div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-warning text-white shadow">
            <div class="card-body">
                Warning
                <div class="text-white-50 small">#f6c23e</div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-danger text-white shadow">
            <div class="card-body">
                Danger
                <div class="text-white-50 small">#e74a3b</div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card bg-secondary text-white shadow">
            <div class="card-body">
                Secondary
                <div class="text-white-50 small">#858796</div>
            </div>
            </div>
        </div>
        </div>

    </div>-->

    <!--<div class="col-lg-6 mb-4">

        
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('newdesign/img/undraw_posting_photo.svg') }}" alt="">
            </div>
            <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
            <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
        </div>
        </div>

        
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
        </div>
        <div class="card-body">
            <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
            <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
        </div>
        </div>

    </div>-->
    </div>

</div>
@endsection


@section('page-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

    /*var start = moment().subtract(29, 'days');
    var end = moment();
	var start = moment().startOf('month');*/
	var start = moment();
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
    var start_date = picker.startDate.format('YYYY-MM-DD');
    var end_date = picker.endDate.format('YYYY-MM-DD');

	var status_filter = $("#status_filter").val();
	
	$.ajax({
        url: '{{url("getsuccesstransactiongraphdata")}}',
        data: {start_date : start_date, end_date: end_date, status_filter: status_filter},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){      
			console.log(data);    
			create_ajax_payment_chart(data.paymentxvalue1,data.paymentyvalue1);
			create_ajax_order_chart(data.orderxvalue1,data.orderyvalue1);
			$("#order_count").html(data.total_order);
			$("#total_payment_amount").html('₹'+(data.total_payment_amount).toFixed(2));
			$("#success_rate_container").html(data.success_perc+'<sup style="font-size: 20px">%</sup>');
        }
    });
});


function create_ajax_payment_chart(xValues,yValues){
	console.log(xValues);
	var canv = document.createElement("canvas");
	canv.width = 200;
	canv.height = 200;
	canv.setAttribute('id', 'chart-line');
	document.body.appendChild(canv);
	var C = document.getElementById(canv.getAttribute('id'));
	if (C.getContext) 
	{              
    	if (C.getContext) 
		{
			var ctx = $("#chart-line");
			var myLineChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: (xValues.trim()).split(','),
					datasets: [{
						data: (yValues.trim()).split(','),
						label: "Monthly Payment Data",
						borderColor: "#"+Math.floor((Math.random() * 100) + 1)+"8af7",
						backgroundColor:'#'+Math.floor((Math.random() * 100) + 1)+'458af7',
						fill: false
					}]
				},
				options: {
					title: {
						display: true,
						text: 'Daily wise Monthly Payment (in INR)'
					}
				}
			});
		}
	}
}


function create_ajax_order_chart(oxValues,oyValues){
	console.log(oxValues);
	var canv = document.createElement("canvas");
	canv.width = 200;
	canv.height = 200;
	canv.setAttribute('id', 'chart-line2');
	document.body.appendChild(canv);
	var C = document.getElementById(canv.getAttribute('id'));
	if (C.getContext) 
	{              
    	if (C.getContext) 
		{
			var ctx = $("#chart-line2");
			var myLineChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: (oxValues.trim()).split(','),
					datasets: [{
						data: (oyValues.trim()).split(','),
						label: "Order Payment Data",
						borderColor: "#"+Math.floor((Math.random() * 100) + 1)+"8af7",
						backgroundColor:'#'+Math.floor((Math.random() * 100) + 1)+'458af7',
						fill: false
					}]
				},
				options: {
					title: {
						display: true,
						text: 'Daily wise Monthly Order (in INR)'
					}
				}
			});
		}
	}

}
</script>



<script>
    $(function(){
      $('#status_filter').on('change', function () {
          var url = $(this).val(); 
          if (url) { 
              //window.location = '{{ url("/") }}/transactions/payments/status?status='+url; // redirect
			  window.open('{{ url("/") }}/transactions/payments/status?status='+url, '_blank');
          }
          return false;
      });
    });
</script>



<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}


// Area Chart Example
var ctx = document.getElementById("myAreaChart1");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: {!! $paymentxvalue1 !!},
    datasets: [{
      label: "Payment",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: {{$paymentyvalue1}},
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '₹' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});



// Bar Chart Example
var ctx2 = document.getElementById("myBarChart1");
var myBarChart = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: {!! $orderxvalue1 !!},
    datasets: [{
      label: "Revenue",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: {{$orderyvalue1}},
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '₹' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});
</script>
@endsection

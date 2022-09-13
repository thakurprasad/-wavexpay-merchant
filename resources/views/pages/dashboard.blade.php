@extends('newlayout.app')
@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
.modal {
    overflow-y: auto;
}
</style>


<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
  width: 100%;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #00008B;
  width: 100%;
  color: #FFFFFF;
}

/* Style the tab content */
.tabcontent {
  display: none;
  height: 354px;
  padding: 6px 12px;
  -webkit-animation: fadeEffect 1s;
  animation: fadeEffect 1s;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page Heading 
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    -->
    @if(isset($dashboard_header) && $dashboard_header->title!='')
	<div class="alert alert-primary alert-dismissible fade show" role="alert" style="background-color:#4e73df;color:#FFFFFF;">
		<strong>@php if(isset($dashboard_header) && $dashboard_header->title!='') { echo $dashboard_header->title; } @endphp!</strong> @php if(isset($dashboard_header) && $dashboard_header->description!='') { echo $dashboard_header->description; } @endphp.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif


   
    <div class="row">
        <div class="col-xl-6">
            <label for="first_name" style="color:#00008B;"><strong>Payment Date Range</strong><For></For></label>
            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 66%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
        </div>
        <div class="col-xl-2">
            
        </div>
        <div class="col-xl-4">
            <label for="first_name" style="color:#00008B;"><strong>Transaction Filter</strong><For></For></label>
            <select style="background: #fff; cursor: pointer; padding: 8px 10px; border: 1px solid #ccc; width: 100%" id="status_filter">
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
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><strong>New Orders</strong></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><strong>{{count($orders)}}</strong></div>
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
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><strong>Total Payments Amount</strong></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><strong>₹{{number_format($total_amount,2)}}</strong></div>
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
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><strong>Success Rate</strong></div>
                <div class="row no-gutters align-items-center">
                <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><strong>{{$success_perc}}%</strong></div>
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
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold" style="color: #00008B;">Payment Overview</h6>
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
            <h6 class="m-0 font-weight-bold" style="color: #00008B;">Order Overview</h6>
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


    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold" style="color: #00008B;">Payment Overview</h6>
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
        <div class="card-body">
            <div class="chart-area">
                <canvas id="mymethodChart"></canvas>
            </div>
        </div>
        </div>
    </div>


    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold" style="color: #00008B;">Minimum and Maximum Transaction</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Minimum Transaction
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Maximum Transaction
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <div class="tab">
          <div class="row">
            <div class="col-lg-4"><button class="tablinks firstclass" onclick="openCity(event, 'London')">Payment</button></div>
            <div class="col-lg-4"><button class="tablinks" onclick="openCity(event, 'Paris')">Settlement</button></div>
            <div class="col-lg-4"><button class="tablinks" onclick="openCity(event, 'Tokyo')">Refund</button></div>
          </div>
        </div>

        <div id="London" style="heght:354px;" class="tabcontent active">
          <table class="table table-responsive">
            <tbody>
              @if(!empty($payments))
              @foreach($payments as $payment)
              <?php
              $date1=date_create("now");
              $date2=date_create($payment->payment_created_at);
              $diff=date_diff($date1,$date2);
              ?>
              <tr>
                <td>₹{{$payment->amount}}</td>
                <td>{{$payment->payment_id}}</td>
                <td>{{ltrim($diff->format("%R%a days"),"-")}} ago</td>
                <td><span class="badge badge-info">{{$payment->status}}</span></td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div id="Paris" class="tabcontent">
          <table class="table table-responsive">
            <tbody>
              @if(!empty($settlements->items))
              @foreach($settlements->items as $settlement)
              <?php
              $date1=date_create("now");
              $date2=date_create($settlement['created_at']);
              $diff=date_diff($date1,$date2);
              ?>
              <tr>
                <td>₹{{number_format($settlement['fees']/100,2)}}</td>
                <td>{{$settlement['id']}}</td>
                <td>{{ltrim($diff->format("%R%a days"),"-")}} ago</td>
                <td><span class="badge badge-info">{{$settlement['status']}}</span></td>
              </tr>
              @endforeach
              @else 
              <tr>
                <td>&nbsp;</td>
                <td>No Data Found</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>

        <div id="Tokyo" class="tabcontent">
          <table class="table table-responsive">
            <tbody>
              @if(!empty($refunds))
              @foreach($refunds as $refund)
              <?php
              $date1=date_create("now");
              $date2=date_create($refund['created_at']);
              $diff=date_diff($date1,$date2);
              ?>
              <tr>
                <td>₹{{number_format($refund->amount,2)}}</td>
                <td>{{$refund->payment_id}}</td>
                <td>{{ltrim($diff->format("%R%a days"),"-")}} ago</td>
                <td>{{$refund->status}}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    </div>

    <!-- Content Row -->
    <div class="row">

    </div>

</div>
@endsection


@section('page-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {
    $(".firstclass").addClass('active');
    document.getElementById("London").style.display = "block";
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

    //$(".firstclass").click();
    

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
      create_ajax_method_chart(data.paymentmethodxvalue,data.paymentmethodyvalue);
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
            var ctx = document.getElementById("myAreaChart1");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: (xValues.trim()).split(','),
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
                data: (yValues.trim()).split(','),
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




			/*var ctx = $("#chart-line");
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
			});*/
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
            var ctx2 = document.getElementById("myBarChart1");
            var myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: (oxValues.trim()).split(','),
                datasets: [{
                label: "Revenue",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: (oyValues.trim()).split(','),
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





			/*var ctx = $("#chart-line2");
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
			});*/
		}
	}

}


function create_ajax_method_chart(pxValues,pyValues){
  console.log(pxValues);
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
      var ctxmethod3 = document.getElementById("mymethodChart");
      var myBarChart3 = new Chart(ctxmethod3, {
        type: 'bar',
        data: {
          labels: (pxValues.trim()).split(','),
          datasets: [{
            label: "Revenue",
            backgroundColor: "#6f42c1",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: (pyValues.trim()).split(','),
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
                unit: 'Method'
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
                max: 500,
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
            titleFontColor: '#00008B',
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





			/*var ctx = $("#chart-line2");
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
			});*/
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
      borderColor: "#00008B",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "#00008B",
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
      backgroundColor: "#00008B",
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
      titleFontColor: '#00008B',
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



// Bar Chart Example
var ctxmethod = document.getElementById("mymethodChart");
var myBarChart2 = new Chart(ctxmethod, {
  type: 'bar',
  data: {
    labels: {!! $paymentmethodxvalue !!},
    datasets: [{
      label: "Revenue",
      backgroundColor: "#6f42c1",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: {{$paymentmethodyvalue}},
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
          unit: 'Method'
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
          max: 500,
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
      titleFontColor: '#00008B',
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



// Pie Chart Example
var ctx3 = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx3, {
  type: 'doughnut',
  data: {
    labels: ["Minimum Transaction", "Maximum Transaction"],
    datasets: [{
      data: {{$min_max_transacion}},
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
</script>



<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection

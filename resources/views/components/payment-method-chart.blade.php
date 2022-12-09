<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<!-- <figure class="highcharts-figure">
  <div id="payment_method_chart"></div>
</figure> -->


<div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold" style="color: #00008B;">Payment Method Wize Chart </h6>
    </div>
        <div class="card-body">
            <figure class="highcharts-figure">
              <div id="payment_method_chart"></div>
            </figure>
        </div>
    </div>
</div>

<style type="text/css">
    table#highcharts-data-table-1 th, table#highcharts-data-table-1 td {
    width: 50%;
    border: 1px solid #ccc;
    padding: 0px 10px;
}
</style>

<script>
  // Create the chart
Highcharts.chart('payment_method_chart', {
  chart: {
    type: 'pie'
  },
  title: {
    text: 'Payment Method Chart'
  },
  subtitle: {
    text: ''
  },

  accessibility: {
    announceNewData: {
      enabled: true
    },
    point: {
      valueSuffix: 'Rs.'
    }
  },

  plotOptions: {
    series: {
      dataLabels: {
        enabled: true,
        format: '{point.name}: Rs. {point.y:.1f} '
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>Rs. {point.y:.2f}</b> of total<br/>'
  },

  series: [
    {
      name: "Payment Method",
      colorByPoint: true,
      data: [
        {
          name: "UPI",
          y: parseFloat("{{ $upi }}"),
          drilldown: "UPI"
        },
        {
          name: "Card",
          y: parseFloat("{{ $card }}"),
          drilldown: "Card"
        },
        {
          name: "Wallet",
          y: parseFloat("{{ $wallet }}"),
          drilldown: "Wallet"
        }
        ,
        {
          name: "Net Banking",
          y: parseFloat("{{ $netbanking }}"),
          drilldown: "Net Banking"
        }
      ]
    }
  ]
});
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold" style="color: #00008B;">Payment Overview</h6>
        <!-- <div class="dropdown no-arrow">
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
        </div> -->
    </div>
    <!-- Card Body -->
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="container"></div>
                <p class="highcharts-description">
                   <!-- highcharts-description .... -->
                </p>
            </figure>
        </div>
    </div>
</div>

<style type="text/css" href="{{ url('newdesign/heigh-charts/css/style.css') }}"></style>

<script type="text/javascript">
let Dates =  "{{ $data->Dates }}";
let Amounts = "{{ $data->Amounts }}";
Amounts = Amounts.split(',');

Amounts.forEach(stringToInt)
function stringToInt(item, index, arr) {
  arr[index] = parseInt(item);
}

   // console.log(Amounts);



    var xAxis1 = Dates.split(',');  
    var yAxis_1 = Amounts;   

    console.log(xAxis1, yAxis_1);
 
    /*let xAxis1 =  ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    let yAxis_1 = [15.2, 15.7, 18.7, 13.9, 18.2, 21.4, 25.0, 22.8, 17.5, 12.1, 7.6];
    let yAxis_2 = [4.6, 13.3, 5.9, 100.5, 13.5, 14.5, 14.4, 11.5, 8.7, 4.7, 2.6]; */
</script>

<script type="text/javascript" src="{{ url('newdesign/heigh-charts/js/heigh-charts-1.js') }}"></script>
@extends('master')
@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Three charts -->
  <!-- ============================================================== -->
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-12">
      <div class="white-box analytics-info">
        <h3 class="box-title">Time</h3>
        <script type="text/javascript">
        function displayTime(){
          var clientTime=new Date();
          var time=new Date(clientTime.getTime());
          var sh=time.getHours().toString();
          var sm=time.getMinutes().toString();
          var ss=time.getSeconds().toString();
        document.getElementById("jam").innerHTML=(sh.length==1?"0"+sh:sh)+":"+(sm.length==1?"0"+sm:sm)+":"+(ss.length==1?"0"+ss:ss);
    }
        </script>
    <body  onload="setInterval('displayTime()', 1000);">
      <h3 id="jam" class="counter text-purple"></h3>
      </div>
    </div>

    <div class="col-lg-4 col-md-12">
      <div class="white-box analytics-info">
        <h3 class="box-title">Status</h3>
        <div class="status">
        <h3 class="counter text-purple" id="status">@isset($temperature[0]) @if($temperature[0]->nilai > 40) Kebakaran @else Aman @endif @else - @endisset</h3>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12">
      <div class="white-box analytics-info">
        <h3 class="box-title">Suhu Ruangan</h3>
        <div class="nilai">
          <h3 class="counter text-purple" id="suhu">@isset($temperature[0]) {{ $temperature[0]->nilai }} @else - @endisset °C</h3>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- PRODUCTS YEARLY SALES -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="white-box">
        <div class="text-center">
          <h3>Grafik Sensor Secara Realtime</h3>
          <p>Data yang ditampilkan 10 data terakhir</p>
        </div>
        <div class="d-md-flex">
          <ul class="list-inline d-flex ms-auto">
            <li class="ps-3">
              <h5><i class="fa fa-circle me-1 text-info"></i>Humidity (%)</h5>
            </li>
            <li class="ps-3">
              <h5>
                <i class="fa fa-circle me-1 text-inverse"></i>Temperature (°C)</h5>
            </li>
          </ul>
        </div>
        <div id="ct-visits" style="height: 405px">
          <div class="chartist-tooltip" style="top: -17px; left: -12px">
            <span class="chartist-tooltip-value">6</span>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section("script")

<script>
  let chartLine = new Chartist.Line(
    "#ct-visits",
    {
      labels: [
        @foreach ($temperature as $item)
          "{{ $item->time }}",
        @endforeach
      ],
      series: [
        [
          @foreach ($temperature as $item)
            {{ $item->nilai }},
          @endforeach
        ],
        [
          @foreach ($humidity as $item)
            {{ $item->nilai }},
          @endforeach
        ],
      ],
    },
    {
      top: 0,
      low: 1,
      showPoint: true,
      fullWidth: true,
      plugins: [Chartist.plugins.tooltip()],
      axisY: {
        labelInterpolationFnc: function (value) {
          return value;
        },
      },
      showArea: true,

    }
  );

  var chart = [chartLine];


  function updateStatus() {
    $.ajax({
      url: "{{ route('update-status') }}",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#status").html(data.status);
      },
    });
  }

  function updateChart() {
    $.ajax({
      url: "{{ route('update-chart') }}",
      type: "GET",
      dataType: "json",
      success: function (data) {
        chart[0].update({
          labels: data.time,
          series: [data.temperature, data.humidity],
        });
      },
    });
  }

  // update suhu
  function updateSuhu() {
    $.ajax({
      url: "{{ route('update-suhu') }}",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#suhu").html(data.suhu);
      },
    });
  }

  setInterval(updateStatus, 3000);
  setInterval(updateChart, 3000);
  setInterval(updateSuhu, 3000);
</script>

@endsection
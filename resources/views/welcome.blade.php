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
                <h3 class="counter text-purple">Aman</h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="white-box analytics-info">
                <h3 class="box-title">Suhu Ruangan</h3>
                <div class="nilai">
                  <h3 class="counter text-purple">32 °C</h3>
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
              <div class="container" style="text-align:center;">
                <h3>Grafik Sensor Secara Realtime</h3>
                <p>Data yang ditampilkan 5 data terakhir</p>
          
              </div>
              </div>
            </div>
          </div>
          

@endsection

@extends('admin.layout.app')

@section('style')
  <style>
      .dataTables_wrapper .dataTables_processing {
          position: absolute;
          top: 24% !important;
          left: 9% !important;
          /*background: #FFFFCC;*/
          /*border: 1px solid black;*/
          border-radius: 3px;
          font-weight: bold;
        }
  </style>
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/chartist.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/owlcarousel.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/prism.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/daterange-picker.css')}}">
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="row pt-4">
      <div class="col-xl-6 col-sm-6 box-col-4">
        <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-body">
            <div class="media">
              <div class="social-font">
                <i class="fa fa-home fa-2x" aria-hidden="true"></i>
              </div>
              <div class="media-body">
                <h4>Houses Surveyed</h4>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col text-center">
                <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$house_servey}}</h5>
                <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Total</h6>   
              </div>
              <div class="col text-center">
                <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$weekly_servey}}</h5>
                <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Weekly</h6>   
              </div>
              <div class="col text-center">
                <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$monthly_servey}}</h5>
                <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Monthly</h6>   
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-6 box-col-4">
        <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-body">
            <div class="media">
              <div class="social-font">
                <i class="fa fa-bug fa-2x" aria-hidden="true"></i>
              </div>
              <div class="media-body">
                <h4>Breeding Spots</h4>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col text-center">
                  <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$total_breeding_spots}}</h5>
                  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Total</h6>   
                </div>
                <div class="col text-center">
                  <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$weekly_breeding_spots}}</h5>
                  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Weekly</h6>   
                </div>
                <div class="col text-center">
                  <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$monthly_breeding_spots}}</h5>
                  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Monthly</h6>   
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-6 box-col-4">
        <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-body">
            <div class="media">
              <div class="social-font">
                <i class="fa fa-bug fa-2x" aria-hidden="true"></i>
              </div>
              <div class="media-body">
                <h4>Source Reduction</h4>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col text-center">
                  <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$source_reduction_cleared}}</h5>
                  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Cleared</h6>   
                </div>
                <div class="col text-center">
                  <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$source_reduction_sprayed}}</h5>
                  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Sprayed</h6>   
                </div>
                <div class="col text-center">
                  <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$source_reduction_pending}}</h5>
                  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Pending</h6>   
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-6 box-col-4">
        <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-body">
            <div class="media">
              <div class="social-font">
                <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
              </div>
              <div class="media-body">
                <h4>Wards Covered</h4>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col text-center">
                  <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;">{{$ward_count}}</h5>
                  <h6 class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Total</h6>   
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-md-12 box-col-8">
        <div class="card" style=" box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-header pb-0 ps-2 pt-3">
            <h5 class="">GIS Dashboard last 30 days data</h5>
          </div>
          <div class="chart-widget-top">
            <div class="card-body p-2" style="min-height:514px;">
              <div id="map" style="min-height:500px;border-radius: 15px">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-sm-12 box-col-12">
        <div class="card " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-header">
            <h5 class="mb-0"> Zone Wise Analysis </h5>
            <div class="w-25 mt-3">
              <label for="">Date Range</label>
              <input id="date_range" class="form-control digits date_range" type="text" name="date_range">
            </div>
          </div>
          <div class="card-body px-4 pb-4">
            <div class="table-responsive p-1">
              <table class="display p-2" id="zone" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Zone</th>
                    <th class="text-center">Houses surveyed</th>
                    <th class="text-center">Breeding Spot</th>
                    <th class="text-center">Source Reduction</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xl-6 box-col-6">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-header pb-0">
            <h5 class="">Breeding spots from inception</h5>
          </div>
          <div class="card-body p-3 chart-block">
            <div class="chart-overflow" id="pie-chart2"></div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-12 box-col-6">
        <div class="card " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-header pb-0">
            <h5 class=""> Inactive Asha Workers </h5>
          </div>
          <div class="card-body pt-2 p-4">
            <div class="table-responsive" style="max-height:298px;">
              <table class="display" id="content" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Ward</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                    $cust =  [];//DB::table('customers')
                                //->select('customers.*')
                                //->leftJoin('pick', 'customers.id', '=', 'pick.cust_id','left') 
                                //->where('customers.roles', 1)
                                //->whereNull('pick.cust_id')
                                //->get();
                    @endphp                            
                    @foreach($inactive_asha as $asha_worker)
                    <tr>
                    <td>{{$asha_worker->username}}</td>
                    <td> 
                      @php $wrd =  DB::table('ward')->where('id', $asha_worker->ward)->first(); @endphp
                      @if($wrd)
                      {{$wrd->name}}
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-xl-12 box-col-6">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
          <div class="card-header pb-0">
            <h5 class="">Breeding Spots VS Source Reduction from inception</h5>
          </div>
          <div class="card-body p-3 chart-block">
            <div class="chart-overflow" id="column-chart1"></div>
          </div>
        </div>
      </div>
    </div>    
    <div class="col-sm-12 box-col-12">
      <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
        <div class="card-body p-3 chart-block">
          <div class="chart-overflow" id="line-chart"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('admin/assets/js/prism/prism.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/counter/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/counter/jquery.counterup.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/counter/counter-custom.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable/datatable-extension/custom.js') }}"></script> 
  <script src="{{ asset('admin/assets/js/chart/google/google-chart-loader.js') }}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/daterange-picker.custom.js')}}"></script>
  <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});
    var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));
    e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);
    a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));
    a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));
    d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "{{env('GOOGLE_MAPS_API_KEY')}}", v: "weekly"});
  </script>
  <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
  <script>
    var geodata = [];
    const green_marker =  "http://maps.google.com/mapfiles/ms/micons/green-dot.png";
    const red_marker =  "http://maps.google.com/mapfiles/ms/micons/red-dot.png";
    @foreach($locations as $location)
      @if($location->latit)        
        @if($location->source_reduction == 'Done')
          geodata.push({lat:{{explode(',', $location->latit)[0]}},lng:{{explode(',', $location->latit)[1]}}, dark: '#114232', light: '#87A922'});
        @else
          geodata.push({lat:{{explode(',', $location->latit)[0]}},lng:{{explode(',', $location->latit)[1]}}, dark: '#A94438', light: '#D24545'});
        @endif
      @endif
    @endforeach
    async function initMap() {
      const { Map, InfoWindow } = await google.maps.importLibrary("maps");
      const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
        "marker",
      );
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 11, 
        center: { lat: 12.9716, lng: 77.5946 },
        mapId: "ZONE_SERVEY_MAP",
      });
      const infoWindow = new google.maps.InfoWindow({
        content: "",
        disableAutoPan: true,
      });

      const markers = geodata.map((data, i) => {
        const pinGlyph = new google.maps.marker.PinElement({
          // glyph: ,
          background: data.light,
          borderColor: data.dark,
          glyphColor: data.dark,
        });
        const marker = new google.maps.marker.AdvancedMarkerElement({
          position: { lat: data.lat, lng: data.lng },
          content: pinGlyph.element,
        });
        // open info window when marker is clicked
      /*  marker.addListener("click", () => {
          infoWindow.setContent(position.lat + ", " + position.lng);
          infoWindow.open(map, marker);
        }); */
          return marker;
      });
      new markerClusterer.MarkerClusterer({ markers, map });

    let areaPolygon = [];
    let Coords = '';
    let bermudaTriangle = '';
    let random_color = '#FF0000';
    
    @foreach($wards as $key => $ward)
      areaPolygon = [];
        @php 
          $boundries = explode('|', $ward->boundry);
        @endphp
        @foreach($boundries as $boundry)
          @php
            $cords = explode(',',$boundry);
          @endphp
          @if(isset($cords[0]) && isset($cords[1]))
          Coords = {lat: {{$cords[0]}}, lng: {{$cords[1]}}};
          areaPolygon.push(Coords);
          @endif
        @endforeach
      random_color = "#FF0000";
      bermudaTriangle = new google.maps.Polygon({
        paths: areaPolygon,
        strokeColor: random_color,
        strokeOpacity: 0.6,
        strokeWeight: 1,
        fillColor: random_color,
        fillOpacity: 0,
      });
      bermudaTriangle.setMap(map);
    @endforeach
    @foreach($zones as $key => $zone)
      areaPolygon = [];
        @php 
          $boundries = explode('|', $zone->boundry);
        @endphp
        @foreach($boundries as $boundry)
          @php
            $cords = explode(',',$boundry);
          @endphp
          Coords = {lat: {{$cords[0]}}, lng: {{$cords[1]}}};
          areaPolygon.push(Coords);
        @endforeach
      random_color = "{{$zone->color??'#FF0000'}}";
      bermudaTriangle = new google.maps.Polygon({
        paths: areaPolygon,
        strokeColor: random_color,
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: random_color,
        fillOpacity: 0.2,
      });
      bermudaTriangle.setMap(map);
    @endforeach

    }

    initMap();
  </script>
  <script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.load('current', {'packages':['line']});
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawBasic);
    function drawBasic() {
      if ($("#column-chart1").length > 0) {
          var a = google.visualization.arrayToDataTable([
            ["Zones", "Breeding Spots", "Source reduction    ."],
            @foreach($pie_chart as $data)
            ['{{$data['zone']}}',{{$data['breeding_spots']}},{{$data['source_reduction']}}],
            @endforeach
          ]),
          b = {
            chart: {
              title: "",
              subtitle: ""
            },
            bars: "vertical",
            vAxis: {
              format: "decimal"
            },
            height: 400,
            width:'90%',
              colors: ['#6362E7', "#51BB25"]


          },
        c = new google.charts.Bar(document.getElementById("column-chart1"));
        c.draw(a, google.charts.Bar.convertOptions(b))
      }
      if ($("#pie-chart2").length > 0) {
          var data = google.visualization.arrayToDataTable([
            ['Zone', 'Breeding Spots'],
            @foreach($pie_chart as $data)
            ['{{$data['zone']}}',{{$data['breeding_spots']}}],
            @endforeach
          ]);
          var options = {
            title: '',
            is3D: true,
            width:'90%',
            height: 300,
            colors: ["#DC3545", "#51bb25" , "#6362E7", "#130f40" , "#22a6b3", "#535c68", "#f0932b", "#A927F9" ]
          };
          var chart = new google.visualization.PieChart(document.getElementById('pie-chart2'));
          chart.draw(data, options);
      }
      if ($("#line-chart").length > 0) {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'date');
          data.addColumn('number', 'Survey');
          data.addColumn('number', 'Breeding Spots');
          data.addColumn('number', 'Source Reduction    .');
          data.addRows([
            @foreach($line_chart as $data)
            ['{{$data['date']}}', {{$data['survey']}}, {{$data['breeding_spots']}}, {{$data['source_reduction']}}],
            @endforeach
          ]);
          var options = {
            chart: {
              title: 'Daily trend line graph',
              subtitle: ''
            },
            colors: ["#6362E7" , "#FFC500" , "#51bb25"],
            height: 500,
            width:'100%',
          };
          var chart = new google.charts.Line(document.getElementById('line-chart'));
          chart.draw(data, google.charts.Line.convertOptions(options));
      }
    }
  </script>
  <script>
    $(document).ready(function(){
      $('.date_range').daterangepicker({
        opens: 'right',
        autoUpdateInput: false,
        autoApply: true,
        locale: {format: 'DD/MM/YYYY'}
      });
      $('.date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        table.draw();
      });
      $('.date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');table.draw();
      });
      var table = $('#content').DataTable({
                    dom: '<"top">t<"bottom"><"clear">'
                  });
      var table = $('#zone').DataTable({
        dom:'rt',
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{route('admin.zone_data')}}",
          data: function(data) {
            data.date_range = $("#date_range").val();
          }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', className: 'text-center' },
            { data: 'zone', className: 'text-center' },
            { data: 'survey', className: 'text-center' },
            { data: 'spots', className: 'text-center' },
            { data: 'reduction', className: 'text-center' },
        ]
      });
    });
  </script>
@endsection
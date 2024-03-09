@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')
<div class="page-body">
    
   <?php
        $pickUpGeoLocn = "";
        $dumpGeoLocn = "";
        
        foreach($pickUpWasteInfo as $wi)
        {
            $pickUpImg = $wi->Pickup_img;
            //$pickUpGeoLocn = $wi->Pickup_Geolocn;
            //$pickUpImgGeoLocn = $wi->Pickup_ImgGeolocn;
            $pickUpDateTime = $wi->Pick_up_timestamp;
            $pickUpAddress = $wi->descp;
            $pickupPhone = $wi->phone;
            $pickupWasteType = $wi->waste;
            
            $wastePickupZone = $wi->Zone;
            $wastePickupDivision = $wi->Division;
            $wastePickupWard = $wi->Ward;
            
            //echo "<script>console.log('Pickup lat long = $pickUpGeoLocn'); </script>";
        }
        
        foreach($dumpWasteInfo as $dwi)
        {
            $dumpImg = $dwi->Dump_img;
            //$dumpGeoLocn = $dwi->Dump_Geolocn;
            //$dumpImgGeoLocn = $dwi->Dump_ImgGeolocn;
            $dumpAddress = $dwi->descp;
            $dumpPhone = $dwi->phone;
            $dumpDateTime = $dwi->Dump_timestamp;
            $dStatus = $dwi->Dump_status;
            $wasteDumpZone = $dwi->Zone;
            $wasteDumpDivision = $dwi->Division;
            $wasteDumpWard = $dwi->Ward;
            
            
            //echo "<script>console.log('Dump lat long = $dumpGeoLocn'); </script>";
        }
        
        foreach($driverDetails as $driDets)
        {
            $driverName = $driDets->dname;
            $driverPhnum = $driDets->dphone;
            $driverAddress = $driDets->daddress;
        }
        
        foreach($ownerDetails as $ownerDets)
        {
            $ownerName = $ownerDets->oname;
            $ownerPhnum = $ownerDets->ophone;
            $ownerAddress = $ownerDets->address;
        }
   ?>
    
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Waste Information details</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Waste Information</li>
          </ol>
        </div>
      </div><br><br>

      <div id="map" class="pt-3" style="width: 100%; height: 400px;"></div>





    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
           
          </div>



          

          <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header pb-0">
                  <!-- <h5>Details</h5> -->
                </div>
                <div class="card-body p-5">
                  <div class="default-according default-according-page" id="accordion">
                    <div class="card">
                      <div class="card-header pb-0" id="headingOne">
                        <h4 class="mb-0 b-r-5">
                          <button class="btn btn-link   accordion-button collapsed b-r-5" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: #eeeee4;color:black;">Status Information<span class="text-end badge badge-primary text-end">Progress</span></button>
                        </h4>
                      </div>
                      <div class="collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordion">
                        <div class="card-body">
                          <div class="row">

                            <div class="col-lg-6">
                              <h5 class="text-center">Pick Up Information</h5>
                              <div class="text-center">
                                <!--<img src="{{ asset('admin/assets/images/p.webp') }}" height="150px;" width="150px;" alt="">-->
                                
                                <img src="{{asset('uploads/pick')}}/{{$pickUpImg}}" height="150px" width="150px" alt="">
                              </div>
                              
                              <!--<div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Geo Location</label>
                                <input type="text" class="form-control btn-square" id="add-zn needs-validation" required="" value="" readonly/>
                              </div>-->
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Date & Time</label>
                                
                                <!--<span class="form-control btn-square" id="datetime1" required="" type="" readonly ></span>-->
                                  
                                <input type="text" class="form-control btn-square" id="datetime1" required="" value="{{ $pickUpDateTime }}" readonly/> 
                              </div>
                              
                              <!--<div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Image Geo Location</label>
                                <input type="text" class="form-control btn-square" id="add-zn needs-validation" required="" value="" readonly />
                              </div>-->
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Zone</label>
                                <input type="text" class="form-control btn-square" id="pickupzoan" required="" value="{{ $wastePickupZone }}" readonly/>
                              </div>
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Division</label>
                                <input type="text" class="form-control btn-square" id="pickupdivishan" required="" value="{{$wastePickupDivision}}" readonly/>
                              </div>
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Ward</label>
                                <input type="text" class="form-control btn-square" id="pickupwaard" required="" value="{{$wastePickupWard}}" readonly/>
                              </div>
                             
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">House/Site Owner</label>
                                <textarea class="form-control btn-square" id="add-zn needs-validation" required="" readonly>{{ $pickUpAddress }}</textarea>
                                <!--<div class="invalid-feedback">please enter the address </div>-->
                              </div>
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Mobile Number</label>
                                <input class="form-control btn-square" id="add-zn needs-validation" required="" type="text" readonly value="{{$pickupPhone}}" />
                                <!--<div class="invalid-feedback">please enter the mobile number here..</div>-->
                              </div>
                              
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Waste Type</label>
                                <input type="text" class="form-control btn-square" id="add-zn needs-validation" required="" readonly value="{{$pickupWasteType}}" />
                                <!--<div class="invalid-feedback">please enter the mobile number here..</div>-->
                              </div>
                            </div>
                            
                            
                            <div class="col-lg-6">
                              <h5 class="text-center">Dump Information</h5>
                              <div class="text-center">
                                <!--<img src="{{ asset('admin/assets/images/cd.jpg') }}" height="150px;" width="150px;" alt="">-->
                                
                                <img src="{{asset('uploads/dump')}}/{{$dumpImg}}" height="150px" width="150px" alt="">
                              </div>
                              
                              
                              <!--<div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Geo Location</label>
                                <input type="text" class="form-control btn-square" id="add-zn needs-validation" required="" readonly value="{{$dumpGeoLocn}}" />
                              </div>-->
                              
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5"> Date & Time</label>
                                
                                <!--<span class="form-control btn-square" id="datetime2" required="" type="" readonly ></span>-->
                                
                                <input type="text" class="form-control btn-square" id="datetime2" required="" value="{{ $dumpDateTime }}" readonly/>
                                <!--<div class="invalid-feedback">please enter the lat and  long</div>-->
                              </div>
                              
                              
                              <!--<div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5"> Image Geo Location</label>
                                <input class="form-control btn-square" id="add-zn needs-validation" required="" type="text" readonly value="" />
                              </div>-->
                              
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Zone</label>
                                <input type="text" class="form-control btn-square" id="dumpzoan" required="" value="{{$wasteDumpZone}}" readonly/>
                              </div>
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Division</label>
                                <input type="text" class="form-control btn-square" id="dumpdivishan" required="" value="{{$wasteDumpDivision}}" readonly/>
                              </div>
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Ward</label>
                                <input type="text" class="form-control btn-square" id="dumpwaard" required="" value="{{$wasteDumpWard}}" readonly/>
                              </div>
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Owner Address</label>
                                <textarea class="form-control btn-square " id="add-zn needs-validation" required="" readonly>{{$dumpAddress}}</textarea>
                                <!--<div class="invalid-feedback">please enter the address </div>-->
                              </div>
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Mobile Number</label>
                                <input class="form-control btn-square" id="add-zn needs-validation" required="" type="text" readonly value="{{$dumpPhone}}" />
                                <!--<div class="invalid-feedback">please enter the mobile number here..</div>-->
                              </div>
                              
                              
                              <div class="m-5 draggable">
                                <label for="input-text-1 needs-validation fs-5">Status</label>
                                <input type="text" class="form-control btn-square" id="dumpwaard" required="" value="{{$dStatus}}" readonly/>
                              </div>
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header pb-0" id="headingTwo">
                        <h4 class="mb-0">
                          <button class="btn btn-link accordion-button collapsed text-start  b-r-5" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: #eeeee4;color:black;">Vehicle Details<span></span></button>
                        </h4>
                      </div>
                      <div class="collapse " id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                        <div class="card-body ">
                          <div class="row">
                    <h5 class="fs-6 text-center">Driver Details</h5>

                            <div class="col-md-4 mb-3">
                              <label class="form-label" for="validationCustom05">Driver Name : <span class="error-sign">*</span></label>
                              <input class="form-control dt" id="drivName" value="{{$driverName}}" type="text" required="" readonly>
                            </div>
                            
                            
                            <div class="col-md-4 mb-3">
                              <label class="form-label" for="validationCustom05">Mobile Number : <span class="error-sign">*</span></label>
                              <input class="form-control dt" id="drivPhnum" value="{{$driverPhnum}}" type="text" required="" readonly>
                            </div>
                            
                            
                            <div class="col-md-4 mb-3">
                              <label class="form-label" for="validationCustom05">Address : <span class="error-sign">*</span></label>
                              <input class="form-control dt" id="drivAddr" value="{{$driverAddress}}" type="text" required="" readonly>
                            </div>
                            
                            <!--<div class="col-md-4 mb-3">
                              <label class="form-label" for="validationCustom05">Area Name:<span class="error-sign">*</span></label>
                              <input class="form-control dt" id="validationCustom05" value="kuvempunagar" type="text" required="" readonly>
                            </div>
                            
                            
                            <div class="col-md-4 mb-3">
                              <label class="form-label" for="validationCustom05">Street:<span class="error-sign">*</span></label>
                              <input class="form-control dt" id="validationCustom05" value="23 rd cross" type="text" required="" readonly>
                            </div>-->
                            
                            
                            <!-- <div class="col-md-4 mb-3">
                              <label class="form-label" for="validationCustom05">Area : <span class="error-sign">*</span></label>
                              <input class="form-control dt" id="validationCustom05" value="Jaynagar" type="text" required="" readonly>
                            </div> -->
                            
                            
                            <!--<div class="col-md-4 mb-3">
                              <label class="form-label" for="validationCustom05">Pincode:<span class="error-sign">*</span></label>
                              <input class="form-control dt" id="validationCustom05" value="65023" type="text" required="" readonly>
                            </div>--> 
                          </div>
                          
                          
                          <div class="row">
                            <h5 class="text-center fs-6">Owner Details</h5>
                            
                                <div class="col-md-4 mb-3">
                                  <label class="form-label" for="validationCustom05">Owner Name : <span class="error-sign">*</span></label>
                                  <input class="form-control dt" id="owner_name" value="{{$ownerName}}" type="text" required="" readonly>
                                </div>
                                
                                
                                <div class="col-md-4 mb-3">
                                  <label class="form-label" for="validationCustom05">Mobile Number : <span class="error-sign">*</span></label>
                                  <input class="form-control dt" id="owner_mobile" value="{{$ownerPhnum}}" type="text" required="" readonly>
                                </div>
                                
                                
                                <div class="col-md-4 mb-3">
                                  <label class="form-label" for="validationCustom05">Address : <span class="error-sign">*</span></label>
                                  <input class="form-control dt" id="owner_addr" value="{{$ownerAddress}}" type="text" required="" readonly>
                                </div>
                                
                                
                                <!--<div class="col-md-4 mb-3">
                                  <label class="form-label" for="validationCustom05">Area name:<span class="error-sign">*</span></label>
                                  <input class="form-control dt" id="validationCustom05" value="Jaynagar" type="text" required="" readonly>
                                </div>
                                
                                
                                <div class="col-md-4 mb-3">
                                  <label class="form-label" for="validationCustom05">Street:<span class="error-sign">*</span></label>
                                  <input class="form-control dt" id="validationCustom05" value="23 rd cross" type="text" required="" readonly>
                                </div>-->
                                
                                
                                <!-- <div class="col-md-4 mb-3">
                                  <label class="form-label" for="validationCustom05">Area : <span class="error-sign">*</span></label>
                                  <input class="form-control dt" id="validationCustom05" value="Jaynagar" type="text" required="" readonly>
                                </div> -->
                                
                                
                                <!--<div class="col-md-4 mb-3">
                                  <label class="form-label" for="validationCustom05">Pincode:<span class="error-sign">*</span></label>
                                  <input class="form-control dt" id="validationCustom05" value="65023" type="text" required="" readonly>
                                </div>--> 
                            
                            </div>
                        </div>
                      </div>
                    </div>
                  
                     
                  </div>
                </div>
              </div>
            </div>














        
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent

<script src="{{asset('admin/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('admin/assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/email-app.js')}}"></script>
<script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>
<script>

	const map = L.map('map').setView([12.9524297, 77.7065271], 13);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
	
	const markerstyle = new L.Icon({
	iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
	shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
	});

	const markerstyleone = new L.Icon({
	iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
	shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
	});

    //console.log(<?php echo $pickUpGeoLocn ?>);
    //console.log(<?php echo $dumpGeoLocn ?>);
    
	//L.marker([12.9524297,77.7065271],{icon: markerstyle}).addTo(map).bindPopup(
	
	/*L.marker([<?php echo $pickUpGeoLocn ?>],{icon: markerstyle}).addTo(map).bindPopup(
        '<b>Start Point</b><br>'
        +'<b>Zone:</b> '+"South"+', <br>'
        +'<b>Ward :</b> '+"Vidya Peeta"+', <br>'
        +'<b>Segment Area:</b> '+3423+' Sqm'*/
        
    L.marker([<?php echo $pickUpGeoLocn ?>],{icon: markerstyle}).addTo(map).bindPopup(
        '<b>Start Point</b><br>'
        +'<b>Zone:</b> '+"South"+'<br>'
        +'<b>Ward :</b> '+"Sarakki"   
  )

  L.marker([<?php echo $dumpGeoLocn ?>],{icon: markerstyleone}).addTo(map).bindPopup(
        '<b>End Point</b><br>'
        +'<b>Zone:</b> '+"South"+'<br>'
        +'<b>Ward :</b> '+"Shakambari Nagar"
  )
  
  /*var latlngs = [
    [12.9524297,77.7065271],
    [12.9426297,77.7165271]
    ];*/
    
    var latlngs = [
    [<?php echo $pickUpGeoLocn ?>],
    [<?php echo $dumpGeoLocn ?>]];
    
    var polyline = L.polyline(latlngs, {color: 'SteelBlue'}).addTo(map);
  
    map.fitBounds(polyline.getBounds());
</script>




<!--<script>
var dt = new Date();
document.getElementById("datetime1").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
</script>


<script>
var dt = new Date();
document.getElementById("datetime2").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
</script>-->


<!-- <script>
var dt = new Date();

var hours = dt.getHours();
var minutes = dt.getMinutes();
var ampm = hours >= 12 ? 'pm' : 'am';
hours = hours % 12;
hours = hours ? hours : 12; // the hour '0' should be '12'
minutes = minutes < 10 ? '0'+minutes : minutes;
var timeIn12HrFormat = hours + ':' + minutes + ' ' + ampm;
  
document.getElementById("datetime1").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ timeIn12HrFormat;
document.getElementById("datetime2").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ timeIn12HrFormat;
</script> -->

@endsection
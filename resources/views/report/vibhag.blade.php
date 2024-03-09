<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<title>VBF</title>
<link rel="manifest" href="{{ url('public/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/app/icons/icon-192x192.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/fonts/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/styles/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('public/styles/style.css') }}">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
  
</head>
    
<body class="theme-light">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
   
    
    <div class="page-content">
        <div class="page-title page-title-small">
            <h2></a>RSSKDP REPORT DASHBOARD</h2>
            <!--<a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="images/avatars/5s.png"></a>-->
        </div>
        <div class="card header-card shape-rounded" data-card-height="150">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
        </div>
        

        <div class="card card-style">
            <div class="card-body">
                
                <div class="content">
                    <form method="post" action="">
            @csrf
            
            <div class="input-style input-style-always-active has-borders no-icon my-4">
					<label for="form2a" class="color-highlight">Select a Report</label>
					<select id="form2a" name="report" required>
						<option value="1">KDP</option>
                        <option value="2">Vibhag</option>
                        <option value="3">Bhag</option>
                        <option value="4">Nagar</option>
					</select>
					<span><i class="fa fa-chevron-down"></i></span>
					<i class="fa fa-check disabled valid color-green-dark"></i>
					<i class="fa fa-check disabled invalid color-red-dark"></i>
					<em></em>
				</div>
				
            
            <div class="input-style no-borders no-icon mb-4">
                    <label for="form5a" class="color-highlight">Select a Report</label>
                    <select id="form5a">
                        <option value="default" disabled="" selected="">Select a Value</option>
                        <option value="1">KDP</option>
                        <option value="2">Vibhag</option>
                        <option value="3">Bhag</option>
                        <option value="4">Nagar</option>
                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <i class="fa fa-check disabled invalid color-red-dark"></i>
                    <em></em>
                </div>
                
                <a href="#" data-menu="menu-wizard-2" class="btn btn-full rounded-sm btn-m btn-margins bg-highlight font-700 text-uppercase">Submit</a>

            
            </form>
                </div>
                
            </div>
        </div>
        


            
       
    </div>    
    
 
    
    
</div>    



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ url('public/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/scripts/custom.js') }}"></script>
</body>

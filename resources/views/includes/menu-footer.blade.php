<div class="footer card card-style mx-0 mb-0">
  <div class="content mb-4">
    <div class="row justify-content-center mb-1">
      <div class="col-12 ps-0 footernemusub1">
          
        <a href="#" class="footer-title pt-4">{{ __('messages.Pojecttitlefull') }}</a>
        <br>
        <div class="text-center mb-3">
          <a href="#" target="_blank" class="icon icon-xs rounded-sm shadow-l me-1 bg-facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" target="_blank" class="icon icon-xs rounded-sm shadow-l me-1 bg-twitter"><i class="fab fa-twitter"></i></a>
          <a href="https://wa.me/919066798311" target="_blank" class="a-green icon icon-xs rounded-sm shadow-l me-1 bg-whatsapp"><i class="fab fa-whatsapp"></i></a>
          <a href="#" target="_blank" class="icon icon-xs rounded-sm shadow-l me-1 bg-linkedin"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" target="_blank" class="icon icon-xs rounded-sm shadow-l me-1 bg-red-dark"><i class="fa-brands fa-youtube"></i></a>
          <a href="#" class="back-to-top icon icon-xs rounded-sm shadow-l bg-highlight color-white"><i class="fa fa-arrow-up"></i></a>
          
        </div>
        <p class="boxed-text-l">For any technical support kindly contact through <br>WhatsApp message preferably <br> <a href="https://wa.me/919066798311" target="_blank">9066798311</a> </p>
    
      </div>
      <!--<div class="col-6 ps-0">-->
      <!--  <img src="{{ url('public/images/avatars/noimage.png') }}" class="rounded-sm mx-auto mt-1" width="170" height="170">-->
      <!--</div>-->
    </div>
  </div>
  <p class="footer-copyright pb-3 mb-1">{{ __('messages.copyright') }} &copy; <a href="https://bbmp.gov.in/" target="__blank">{{ __('messages.copyrightservice') }}</a> <span id="copyright-year">{{date('Y')}}</span>{{ __('messages.rights') }}</p>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    @php
           $foot = DB::table('versions')->where('status', 1)
                ->orderBy('id', 'desc')->limit(1)
                ->first();
                
            @endphp
            @if(!empty($foot))
        <div class="text-center">
           
                                <a href="{{route('versions.home')}}" target="__blank" class="bg-highlight color-white p-1  icon icon-xs float-center m-0">Version.{{$foot->versions}}</a>
                            </div>
                           
             @endif 
  </div>
</div>
<div class="footer-card card shape-rounded " style="height:230px">
  <div class="card-overlay bg-highlight opacity-90"></div>
</div>


 
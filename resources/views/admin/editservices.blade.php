@extends('admin.main')

@section('menubar_script')
@parent
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
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Services</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Services</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Edit Services</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.services.update', ["id"=>$services->services_id])}}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
              <div class="col-sm-12">
                <div class="mb-3">
                  <label for="validationCustom01">Title</label>
                  <input class="form-control" id="validationCustom01" type="text" name="title" placeholder="Add Services Title" value="{{$services->title}}" required>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="validationTextarea">Content</label>
                  <textarea id="editor" class="form-control is-invalid"  name="textbox" cols="10" rows="2" required="">{{$services->descp}}</textarea>
                </div>
                <div class=" mb-3">
                  <label class="form-label" for="fileInput">Upload Image</label><span>(SVG format)</span>
                  <input type="file" class="form-control" id="fileInput" name="image"   accept=".svg"  >
                </div>
                <div class="mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/services')}}/<?=$services->image;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                          <div>
                              <img src="{{asset('uploads/services')}}/<?=$services->image;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="150" height="90">
                              </div>
                        </a>
                        <figcaption itemprop="caption description"><?=$services->image;?></figcaption>
                    </figure>
                      <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
              <!--
              Background of PhotoSwipe.
              It's a separate element, as animating opacity is faster than rgba().
              -->
              <div class="pswp__bg"></div>
              <!-- Slides wrapper with overflow:hidden.-->
              <div class="pswp__scroll-wrap">
                <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                <div class="pswp__container">
                  <div class="pswp__item"></div>
                  <div class="pswp__item"></div>
                  <div class="pswp__item"></div>
                </div>
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                <div class="pswp__ui pswp__ui--hidden">
                  <div class="pswp__top-bar">
                    <!-- Controls are self-explanatory. Order can be changed.-->
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                    <!-- element will get class pswp__preloader--active when preloader is running-->
                    <div class="pswp__preloader">
                      <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                          <div class="pswp__preloader__donut"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                  </div>
                  <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                  <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                  <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                  </div>
                </div>
              </div>
            </div>
                </div>
                <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                          @php
                          $chk = $services->status == '1' ? "checked" : " ";
                          @endphp
                          
                          <input type='checkbox' name='status' <?=$chk;?> >
                         
                        <span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                </div>    
              </div>
              <div class="btn-showcase text-end">
                <input class="btn btn-primary" type="submit" value="Submit">
                <input class="btn btn-light" type="reset" value="Cancel">
              </div>
            </form>
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

    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.js')}}"></script>

@endsection
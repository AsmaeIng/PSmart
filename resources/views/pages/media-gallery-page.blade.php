{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Media Gallery Page')

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/magnific-popup/magnific-popup.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section">
  <div class="section">
    <div class="card">
      <div class="card-content">
        <p class="caption">Masonry with Magnific Popup is a responsive lightbox & dialog script with focus on
          performance and providing best experience for user with any device</p>
      </div>
    </div>
    <div class="masonry-gallery-wrapper">
      <div class="popup-gallery">
        <div class="gallery-sizer"></div>
        <div class="row">
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/1.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/1.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/2.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/2.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/3.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/3.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/4.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/4.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/5.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/5.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/6.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/6.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/7.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/7.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/8.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/8.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/9.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/9.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/10.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/10.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/11.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/11.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/12.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/12.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/13.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/13.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/14.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/14.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/15.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/15.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/16.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/16.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/17.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/17.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/18.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/18.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/19.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/19.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/20.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/20.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/21.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/21.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/22.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/22.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/23.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/23.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
          <div class="col s12 m6 l4 xl2">
            <div>
              <a href="{{asset('images/gallery/24.png')}}" title="The Cleaner">
                <img src="{{asset('images/gallery/24.png')}}" class="responsive-img mb-10" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('vendors/imagesloaded.pkgd.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/media-gallery-page.js')}}"></script>
@endsection
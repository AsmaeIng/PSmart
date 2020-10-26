<body
  class="{{$configData['mainLayoutTypeClass']}} @if(!empty($configData['bodyCustomClass']) && isset($configData['bodyCustomClass'])) {{$configData['bodyCustomClass']}} @endif"
  data-open="click" data-menu="horizontal-menu" data-col="2-columns">

  <!-- BEGIN: Header-->
  <header class="page-topbar" id="header">
    @include('panels.horizontalNavbar')
  </header>
  <!-- BEGIN: SideNav-->
  @include('panels.sidebar')
  <!-- END: SideNav-->

  <!-- BEGIN: Page Main-->
  <div id="main">
    <div class="row">
      @if($configData["navbarLarge"] === true && isset($configData["navbarLarge"]))
      {{-- navabar large  --}}
      <div class="content-wrapper-before {{$configData["navbarLargeColor"]}}"></div>
      @endif

      @if ($configData["pageHeader"] === true && isset($breadcrumbs))
        {{-- breadcrumb --}}
        @include('panels.breadcrumb')
      @endif
      <div class="col s12">
        <div class="container">
          {{-- main page content  --}}
          @yield('content')
          {{-- right sidebar  --}}
          @include('pages.sidebar.right-sidebar')
          
          @if($configData["isFabButton"] === true)
            @include('pages.sidebar.fab-menu')
          @endif
        </div>
        {{-- overlay --}}
        <div class="content-overlay"></div>
      </div>
    </div>
  </div>

  <!-- END: Page Main-->


  @if($configData['isCustomizer'] === true && isset($configData['isCustomizer']))
    <!-- Theme Customizer -->
    @include('pages.partials.customizer')
    <!--/ Theme Customizer -->
    {{-- buy now button section --}}
    @include('pages.partials.buy-now')
  @endif



  {{-- main footer  --}}
  @include('panels.footer')

  {{-- vendors and page scripts file   --}}
  @include('panels.scripts')
</body>
<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      <span>&copy; <?php $today = date("Y");   echo $today; ?> <a href="http://104.168.145.129/smart-emarketing/t"
          target="_blank">Smart-emarketing</a> All rights reserved.
      </span>
      <span class="right hide-on-small-only">
        Design and Developed by <a href="http://104.168.145.129/smart-emarketing/">Smart-emarketing</a>
      </span>
    </div>
  </div>
</footer>

<!-- END: Footer-->
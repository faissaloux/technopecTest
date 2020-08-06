@if(session()->has('success'))
  <div class="successFlash">
    <p>{{ session()->get('success') }}</p>
  </div>
@elseif(session()->has('failed'))
  <div class="failedFlash">
    <p>{{ session()->get('failed') }}</p>
  </div>
@endif
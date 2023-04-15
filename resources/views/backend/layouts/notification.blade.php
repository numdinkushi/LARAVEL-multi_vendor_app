@if(session('success'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('success')}}
  </div>
@else()
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('error')}}
  </div>
@endif
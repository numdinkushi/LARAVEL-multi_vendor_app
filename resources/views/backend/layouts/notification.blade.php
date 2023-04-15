@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
        <div> {{session('success')}}</div>
   </div> 
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
         {{session('error')}}
</div>
@endif
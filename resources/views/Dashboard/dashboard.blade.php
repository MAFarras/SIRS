@extends('dashboard.admin_design')
@section('content')

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
@if( Auth::user()->id_jabatan == 1 ||Auth::user()->id_jabatan == 2 )
 <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="{{ url('/user') }}"> <i class="icon-user"></i> <span class="label label-important">{{ $user }}</span> User </a> </li>
        <li class="bg_ly"> <a href="{{ url('/dokter') }}"> <i class="icon-user-md"></i><span class="label label-success">{{ $doctor }}</span> Doctor </a> </li>
        <li class="bg_lo"> <a href="{{ url('/specialization') }}"> <i class="icon-star"></i><span class="label label-success">{{ $specialization }}</span> Specialization</a> </li>
        <li class="bg_ls"> <a href="{{ url('/room_status') }}"> <i class="icon-sitemap"></i><span class="label label-success">{{ $room }}</span> Room</a> </li>
        <li class="bg_lg"> <a href="{{ url('/doctor_schedule') }}"> <i class="icon-calendar"></i> Calendar</a> </li>

      </ul>
    </div>  
    <hr/>
  </div>
</div>

@elseif(Auth::user()->id_jabatan == 3 )
 <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ly"> <a href="{{ url('/dokter') }}"> <i class="icon-user-md"></i><span class="label label-success">{{ $doctor }}</span> Doctor </a> </li>
        <li class="bg_lo"> <a href="{{ url('/specialization') }}"> <i class="icon-star"></i><span class="label label-success">{{ $specialization }}</span> Specialization</a> </li>
        <li class="bg_lg"> <a href="{{ url('/doctor_schedule') }}"> <i class="icon-calendar"></i> Calendar</a> </li>

      </ul>
    </div>  
    <hr/>
  </div>
</div>

@elseif(Auth::user()->id_jabatan == 4 )
 <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls"> <a href="{{ url('/room_status') }}"> <i class="icon-sitemap"></i><span class="label label-success">{{ $room }}</span> Room</a> </li>
      </ul>
    </div>  
    <hr/>
  </div>
</div>

@elseif(Auth::user()->id_jabatan == 5 )
 <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls"> <a href="{{ url('/room_status') }}"> <i class="icon-sitemap"></i><span class="label label-success">{{ $room }}</span> Room</a> </li>
      </ul>
    </div>  
    <hr/>
  </div>
</div>

@endif
 

<!--end-main-container-part-->

@endsection
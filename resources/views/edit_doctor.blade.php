<!DOCTYPE html>
<html lang="en">
<head>
<title>SIRS</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/uniform.css') }}" />
<link rel="stylesheet" href="{{ asset('css/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/matrix-media.css') }}" />
<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="icon" href="{{ asset('img/icon2.png') }}">
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome {{ Auth::user()->nama }}</span></a>
    </li>
    <li class=""><a title="" href="{{ url('/edit_profile') }}"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
    <li class=""><a title="" href="{{ url('/logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
@if( Auth::user()->id_jabatan == 1 ||Auth::user()->id_jabatan == 2 )
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li ><a href="{{ url('/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li><a href="{{ url('/user') }}"><i class="icon icon-user"></i> <span>User</span></a> </li>
    <li><a href="{{ url('/dokter') }}"><i class="icon icon-user-md"></i> <span>Doctor</span></a></li>
    <li><a href="{{ url('/specialization') }}"><i class="icon icon-star"></i> <span>Specialization</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-sitemap"></i> <span>Room</span></a>
      <ul>
        <li><a href="{{ url('/room_history') }}">Room History</a></li>
        <li><a href="{{ url('/room_status') }}">Room Status</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-calendar"></i> <span>Schedule</span></a>
      <ul>
        <li><a href="{{ url('/schedule_history') }}">Schedule History</a></li>
        <li><a href="{{ url('/doctor_schedule') }}">Doctor Schedule</a></li>
      </ul>
    </li>
  </ul>
</div>

@elseif(Auth::user()->id_jabatan == 3 )
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li ><a href="{{ url('/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li><a href="{{ url('/dokter') }}"><i class="icon icon-user-md"></i> <span>Doctor</span></a></li>
    <li><a href="{{ url('/specialization') }}"><i class="icon icon-star"></i> <span>Specialization</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-calendar"></i> <span>Schedule</span></a>
      <ul>
        <li><a href="{{ url('/schedule_history') }}">Schedule History</a></li>
        <li><a href="{{ url('/doctor_schedule') }}">Doctor Schedule</a></li>
      </ul>
    </li>
  </ul>
</div>

@elseif(Auth::user()->id_jabatan == 4 )
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li ><a href="{{ url('/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-sitemap"></i> <span>Room</span></a>
      <ul>
        <li><a href="{{ url('/room_history') }}">Room History</a></li>
        <li><a href="{{ url('/room_status') }}">Room Status</a></li>
      </ul>
    </li>
  </ul>
</div>

@elseif(Auth::user()->id_jabatan == 5 )
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li ><a href="{{ url('/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li><a href="{{ url('/room_status') }}"><i class="icon icon-sitemap"></i> <span>Room</span></a>
    </li>
  </ul>
</div>
@endif

<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Doctor</a> <a href="#" class="current">Edit Doctor</a> </div>
    <h1>Edit Doctor</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Form Doctor</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="#" name="form_doctor" id="form_doctor" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                  <input type="text" class="span11" name="doctor_name" id="doctor_name" value="{{ $doctor->nama }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Specialization</label>
                <div class="controls">
                  <select name="specialization">                    
                  @foreach($specialization as $spec)
                    <option value="{{ $spec->id }}" 
                      @if($spec->id == $doctor->id_jenis) 
                          @php 
                          echo "selected";
                          @endphp
                        @endif>{{ $spec->nama }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Telephone Number</label>
                <div class="controls">
                  <input type="text" class="span11" name="doctor_phone_number" id="doctor_phone_number" value="{{ $doctor->no_telp }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Practical Number</label>
                <div class="controls">
                  <input type="text" class="span11" name="practical_number" id="practical_number" value="{{ $doctor->no_praktek }}">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/select2.min.js') }}"></script> 
<script src="{{ asset('js/jquery.validate.js') }}"></script> 
<script src="{{ asset('js/matrix.js') }}"></script> 
<script src="{{ asset('js/matrix.form_validation.js') }}"></script>
</body>
</html>
<?php
$a=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SIRS</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
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
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Room Status</a> </div>
    <h1>Room Status</h1>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-danger" role="alert-block">
      <strong>{!! session('flash_message_error') !!}</strong>
    </div>
    @endif    
    @if(Session::has('flash_message_success'))
    <div class="alert alert-success" role="alert-block">
      <strong>{!! session('flash_message_success') !!}</strong>
    </div>
    @endif 
  </div>
  <div class="container-fluid">
    <hr>
    <a type="submit" href="{{ url('/add_room') }}" class="btn btn-success" /> Add Room</a>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>List of Room Status</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Room Name</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
             <tbody>
               @foreach($status_ruangan as $statruang)
               <tr class="gradeX">
                  <td>{{ $a++ }}</td>
                  <td>{{ $statruang->nama }}</td>
                  <td>{{ $statruang->keteranganJenis->nama }}</td>
                  <td>{{ $statruang->status }}</td>
                  <td class="center">
                    @if(Auth::user()->id_jabatan == 5)
                      <a href="{{url ('/edit_status_room/'.$statruang->id) }}" class="btn btn-primary btn-mini">Ubah Status</a>
                      <a href="{{url ('/off_room/'.$statruang->id) }}" class="deletebtn btn btn-danger btn-mini">Off Limit</a>
                    @else
                      <a href="{{url ('/edit_status_room/'.$statruang->id) }}" class="btn btn-primary btn-mini">Ubah Status</a>
                      <a href="{{url ('/edit_room/'.$statruang->id) }}" class="btn btn-primary btn-mini">Edit</a>  
                      <a href="{{url ('/delete_room/'.$statruang->id) }}" class="deletebtn btn btn-danger btn-mini">Delete</a>
                      <a href="{{url ('/off_room/'.$statruang->id) }}" class="deletebtn btn btn-danger btn-mini">Off Limit</a>
                    @endif
                  </td>
                </tr>
              @endforeach
             </tbody>
            </table>
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
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
</body>
</html>

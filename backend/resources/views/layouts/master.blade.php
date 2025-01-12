@extends('layouts.app')
@section('content')
    <main class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
     



            <!-- Navbar -->
              @include('partials.navbar')
            <!-- /.navbar -->
          
            <!-- Main Sidebar Container -->
            @include('partials.sidebar')
          
            <!-- Content Wrapper. Contains page content -->
               <div class="content-wrapper">
                  @yield('admincontent')
                  <div id="loader" class="loader" style="display: none;">
                     <div class="spinner"></div>
                 </div>
                </div>
            <!-- /.content-wrapper -->
            @include('partials.footer')
          
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
              <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
          </div>
    </main>
@endsection
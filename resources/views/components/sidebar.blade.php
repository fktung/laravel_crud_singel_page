<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="index.html" class="brand-link mb-2 text-decoration-none">
      {{-- <img src="#" alt="Logo" class="brand-image"> --}}
      <span class="ml-1 brand-text font-weight-light">
         <strong>Logo</strong>
      </span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-header">ADMINISTRATOR</li>

            <li class="nav-item">
               <a href="{{ url('/') }}" class="nav-link" data-nav="{{ $menu ?? '' }}">
                  <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                  <p>Dashboard</p>
               </a>
            </li>

            @if(Auth::user()->roleId === 1)
            <li class="nav-item">
               <a href="{{ url('/user') }}" class="nav-link" data-nav="{{ $menu ?? '' }}">
                  <i class="nav-icon fas fa-fw fa-users"></i>
                  <p>User</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{ url('/role') }}" class="nav-link" data-nav="{{ $menu ?? '' }}">
                  <i class="nav-icon fas fa-fw fa-check"></i>
                  {{-- <i class="fa-regular fa-circle-check"></i> --}}
                  <p>Role</p>
               </a>
            </li>
            @endif


            <li class="nav-header">Transaction</li>

            <li class="nav-item">
               <a href="{{ url('/product') }}" class="nav-link" data-nav="{{ $menu ?? '' }}">
                  <i class="nav-icon fas fa-fw fa-box"></i>
                  <p>Product</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{ url('/transaction') }}" class="nav-link" data-nav="{{ $menu ?? '' }}">
                  <i class="nav-icon fas fa-fw fa-cash-register"></i>
                  <p>Transaction</p>
               </a>
            </li>

            <li class="nav-header">USER</li>

            <li class="nav-item">
               <a href="#" class="nav-link" data-nav="{{ $menu ?? '' }}">
                  <i class="nav-icon fas fa-fw fa-user"></i>
                  <p>Akun</p>
               </a>
            </li>

            {{-- <li class="nav-header">ARSIP</li>
            <li class="nav-item">
               <a href="data-arsip.html" class="nav-link" data-nav="{{ $menu ?? '' }}">
            <i class="nav-icon fa-fw fas fa-book"></i>
            <p>Data arsip</p>
            </a>
            </li>
            <li class="nav-item">
               <a href="catatan.html" class="nav-link" data-nav="{{ $menu ?? '' }}">
                  <i class="nav-icon fa-fw fas fa-edit"></i>
                  <p>Catatan</p>
               </a>
            </li> --}}

      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>
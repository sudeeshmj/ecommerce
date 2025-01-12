<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('images/book_icon.png')}}" alt="AdminLTE Logo" >
    <span class="brand-text font-weight-light">BOOK STORE</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
 



    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
             
            </p>
          </a>
         
        </li>
        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            
            <i class="nav-icon fas fa-book"></i>
            <p>
              Book Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('sub-categories.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('languages.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Languages</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('authors.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Authors</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('books.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Books</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            
            <i class="nav-icon fas fa-book"></i>
            <p>
              Inventory
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('customers.index') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('orders.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Orders</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Orders
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('settings.index') }}" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
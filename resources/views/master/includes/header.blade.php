<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
            </a>
            <ul class="user-account dropdown-menu" style="top: 56px">
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li>
                    <!-- Task item -->
                    <a @click="logout('{{url('/logout')}}')" href="#">
                      <!-- Task title and progress text -->
                      <h3 style="font-size: 1.2em;">
                        Logout
                      </h3>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
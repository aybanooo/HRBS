<?php

$phpDIR = dirname(__FILE__, 2);
require_once "$phpDIR/directories/directories.php";
require __initDB__;

$companyInfo = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `companyinfo` LIMIT 1;"), MYSQLI_ASSOC)[0];

/*
# Wala pang conditions 'to 
# Initialize this on main file and change string values to
# active before including

DASHBOARD
  L Reservations
  L Analytics
PAGES
  L Rooms
  L Amenities
ACCOUNTS
BILLING
SETTINGS
  L System
  L Appearance
  L Webpage (Changed to "Hotel Info")
  L My Account
LOGOUT

# USAGE
# put this at the end of the page body (so it's organize) or anywhere after the including of __F_NAVIGATION__.
# change the :nth-child(n) value to change active navigation. 
<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(1)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(1) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>


*/
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-4">

  <!-- Brand Logo -->
  <a href="/admin/" class="brand-link">
      <img src="/public_assets/images/logo_100x100.png" alt="AdminLTE Logo" class="brand-image bg-transparent" style="opacity: .8">
      <span class="brand-text font-weight-light">
        <?php print $companyInfo['companyName']==="" ? "&nbsp;" :  $companyInfo['companyName']; ?>
      </span>
  </a>


  
  <!-- Sidebar -->
  <div class="sidebar" style="overflow-y: auto;">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/images/profilePictures/<?php print $_SESSION['userInfo']->id; ?>.jpg" class="img-circle elevation-2" alt="User picture">
        </div>
        <div class="info">
          <a href="profile" class="d-block"><?php print $_SESSION['userInfo']->first_name." ".$_SESSION['userInfo']->last_name;?></a>
        </div>
      </div>
      
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./" class="nav-link">
                <i class="fas fa-receipt nav-icon"></i>
                <p>Reservations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="analytics" class="nav-link">
                <i class="fas fa-chart-pie nav-icon"></i>
                <p>Web Analytics</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Pages -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="rooms" class="nav-link">
                <i class="fas fa-door-closed nav-icon"></i>
                <p>Rooms</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="amenities" class="nav-link">
                <i class="fas fa-car nav-icon"></i>
                <p>Amenities</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Accounts -->
        <li class="nav-item">
          <a href="accounts" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Accounts
            </p>
          </a>
        </li>

        <!-- Billing -->
        <li class="nav-item">
          <a href="billing" class="nav-link">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Billing
            </p>
          </a>
        </li>

        <!-- Vouchers -->
        <li class="nav-item">
          <a href="vouchers" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Vouchers
            </p>
          </a>
        </li>

        <!-- Settings -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="settings-system" class="nav-link">
                <i class="fas fa-cog nav-icon"></i>
                <p>System</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="appearance" class="nav-link">
                <i class="fas fa-image nav-icon"></i>
                <p>Appearance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="settings-hotel" class="nav-link">
                <i class="fas fa-file nav-icon"></i>
                <p>Hotel Info</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="profile" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
                <p>My Account</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Logout -->
        <li class="nav-item">
          <a href="logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

  <!-- Custom Area -->
  <div class="sidebar-custom d-flex justify-content-center">
    <div class="form-group w-100 d-block text-center">
      <label id="lbutton-darkmode" for="toggle-darkMode"><i class="fas fa-lightbulb fa-lg"></i></label>
      <div class="custom-control custom-switch d-none">
        <input type="checkbox" class="custom-control-input" id="toggle-darkMode">
      </div>
    </div>
  </div>

</aside>
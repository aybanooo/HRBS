<?php

$phpDIR = dirname(__FILE__, 2);
require_once "$phpDIR/directories/directories.php";

# Wala pang conditions 'to 

/*
DASHBOARD
  L Reservations
  L Analytics
PAGES
  L Rooms
  L Amenities
ACCOUNTS
BILLING
SETTINGS
  L Appearance
  L Webpage
  L My Account
LOGOUT

*/
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  <a href="./" class="brand-link text-center">
    <span class="brand-text font-weight-light">Hotel Reservation System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar" style="overflow-y: auto;">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!-- Dashboard -->
        <li class="nav-item menu-close">
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
        <li class="nav-item menu-close">
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
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="appearance" class="nav-link">
                <i class="fas fa-image nav-icon"></i>
                <p>Appearance</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="webpage" class="nav-link active">
                <i class="fas fa-file nav-icon"></i>
                <p>Webpage</p>
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
          <a href="login" class="nav-link">
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
</aside>
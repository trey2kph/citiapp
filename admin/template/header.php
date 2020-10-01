<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SYSTEMNAME; ?> | <?php echo $page_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <!--meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"-->
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="" name="keywords">
  <meta name="robots" content="index, follow">
        
        <link rel="shortcut icon" href="<?php echo WEB; ?>/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo WEB; ?>/favicon.ico" type="image/x-icon">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo WEB; ?>/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo CSS; ?>/fontawesome-all.min.css">  
  <link rel="stylesheet" href="<?php echo WEB; ?>/dist/css/style.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo WEB; ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo WEB; ?>/dist/css/skins/skin-blue.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo WEB; ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo WEB; ?>/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo WEB; ?>/plugins/iCheck/all.css">
  <link href="<?php echo WEB; ?>/plugins/iCheck/flat/blue.css" rel="stylesheet">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo WEB; ?>/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Lightbox -->  
  <link rel="stylesheet" href="<?php echo WEB; ?>/plugins/lightbox/css/lightbox.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IAP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo SITENAME; ?></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <?php if ($logged) : ?>
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="fa fa-bars"></span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php if ($profile_sex == 'm') : ?>
              <img src="<?php echo WEB; ?>/dist/img/avatar.png" class="user-image" alt="User Image">
              <?php else : ?>
              <img src="<?php echo WEB; ?>/dist/img/avatar3.png" class="user-image" alt="User Image">
              <?php endif; ?>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $profile_full; ?></span>
            </a>
          </li>
        </ul>
      </div>
      <?php endif; ?>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <?php if ($logged) : ?>    
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo WEB; ?>/dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $profile_full; ?></p>
          <!-- Status -->
          <a href="<?php echo WEB; ?>/logout"><i class="fa fa-circle text-success"></i> Logout</a>
        </div>
      </div>
      <?php endif; ?>

      <!-- search form (Optional) -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <?php if (!$logged) : ?>    
        <li<?php echo $section == 'login' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/login"><i class="fas fa-key"></i>&nbsp;&nbsp;<span>Login</span></a></li>
        <?php else : ?>
        <li<?php echo !$section ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;<span>Dashboard</span></a></li>
        <?php if ($profile_level == 2 || $profile_level >= 8) : ?>  
        <li<?php echo $section == 'product' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/product"><i class="fa fa-tv"></i>&nbsp;&nbsp;<span>Products</span></a></li>  
        <li<?php echo $section == 'brand' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/brand"><i class="fa fa-star"></i>&nbsp;&nbsp;<span>Brand</span></a></li>  
        <li<?php echo $section == 'category' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/category"><i class="fa fa-th"></i>&nbsp;&nbsp;<span>Category</span></a></li> 
        <?php endif; ?>  
        <?php if ($profile_level == 3 || $profile_level >= 8) : ?>  
        <li<?php echo $section == 'content' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/content"><i class="fa fa-align-left"></i>&nbsp;&nbsp;<span>Content</span></a></li>  
        <li<?php echo $section == 'promo' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/promo"><i class="fa fa-tags"></i>&nbsp;&nbsp;<span>Promo</span></a></li>
        <?php endif; ?> 
        <?php if ($profile_level == 6 || $profile_level >= 8) : ?>  
        <li<?php echo $section == 'order' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/order"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<span>Order</span></a></li>  
        <li<?php echo $section == 'wishlist' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/wishlist"><i class="fa fa-gift"></i>&nbsp;&nbsp;<span>Wishlist</span></a></li> 
        <?php endif; ?>
        <?php if ($profile_level == 3 || $profile_level >= 8) : ?> 
        <li<?php echo $section == 'stores' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/stores"><i class="fa fa-map-marker-alt"></i>&nbsp;&nbsp;<span>Stores</span></a></li>    
        <?php endif; ?>  
        <?php if ($profile_level == 5 || $profile_level >= 8) : ?>  
        <li<?php echo $section == 'career' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/career"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;<span>Career</span></a></li>  
        <?php endif; ?>
        <?php if ($profile_level >= 8) : ?>  
        <li<?php echo $section == 'users' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/user"><i class="fa fa-users"></i>&nbsp;&nbsp;<span>User</span></a></li> 
        <?php endif; ?>
        <?php if ($profile_level >= 8) : ?>  
        <li<?php echo $section == 'setting' ? ' class="active"' : ''; ?>><a href="<?php echo WEB; ?>/setting"><i class="fa fa-cogs"></i>&nbsp;&nbsp;<span>Setting</span></a></li> 
        <?php endif; ?>
        <?php endif; ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php if ($section != 'login') : ?>
      <h1 style="float: none; margin: 0px auto;">
      <?php else : ?>    
      <h1 class="col-md-6" style="float: none; margin: 0px auto;">
      <?php endif; ?>
        <?php echo $page_title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
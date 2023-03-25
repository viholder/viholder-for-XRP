  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url('assets/admin') ?>/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar    -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light"> 
  
     <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>




    <!-- Right navbar links -->


    <ul class="navbar-nav ml-auto" >
      <li class="nav-item" style="margin-right:5px;" >
      <a href="<?php echo url('portfolio');?>">    <div style="margin-top:0px;position:relative;top:5px;margin-right:2px" class="btn btn-block btn-outline-secondary btn-sm valuedashboard"><b>  <div   class="valuedashboard">  $0.00  </div> </b></div></a>
      </li>
      <!-- Navbar Search -->
   

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown" style="margin-right:5px;">
        <button data-toggle="dropdown" href="#" type="button" style="margin-top:0px;position:relative;top:5px;border:1px solid #efefef;background:#efefef;margin-right:2px;" class="btn btn-block btn-outline-secondary btn-sm"> <?php echo supported_languages()->{getUserlang()}->nativeName; ?></button>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right text-right">
          <?php foreach(supported_languages() as $key => $value){ ?>
            <?php if( getUserlang()!=$key ) { ?>
            <a href="<?php echo url('profile/change_language/'.$key.'?back='.urlencode(current_url())) ?>" class="dropdown-item"><?php echo $value->name.' <span class="text-muted">('.$value->nativeName.')</span>' ?></a>
            <?php } ?>
          <?php } ?>
        </div>
      </li>

    
     


      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown" style="margin-right:5px;">
        <a class="nav-link" data-toggle="dropdown" href="#" style="padding:0px;margin:0px;">
      <!--  <i class="far fa-bell notify_btn"></i> -->
      
      <button type="button" style="margin-top:0px;position:relative;top:5px;border: 1px solid #efefef;background:#efefef" class="btn btn-block btn-outline-secondary btn-sm">  <i class="fas fa-bell"></i> </button>


          <span class="badge badge-danger navbar-badge notifymsg" style=" border-radius:50%;top:-5px;right:-5px;"></span>
          
        </a>
        <div id="msgbell" class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
        
          <div class="dropdown-divider"></div>
          <a href="<?php echo url('/notifications/list/'); ?>" class="dropdown-item dropdown-footer"><?php echo lang('App.see-all-messages'); ?></a>
        </div>
      </li>

      <?php if (hasPermissions('on_developer')): ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

       <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <?php endif; ?>
      <!-- User Account: style can be found in dropdown.less -->
      <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo userProfile(logged('id')) ?>" class="user-image img-circle"  style="margin-top:-4px;">
            <span class="d-none d-md-inline"><?php echo logged('name') ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-dark">
                <img src="<?php echo userProfile(logged('id')) ?>" class="img-circle elevation-2" alt="">

                <p>
                  <?php echo logged('name') ?>
                  <small>Member since <?= date('M, Y', strtotime(logged('created_at'))) ?></small>
                </p>
              </li>
         
      </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="<?php echo url('profile') ?>" class="btn btn-default"><?php echo lang('App.profile') ?></a>
            <a href="<?php echo url('/auth/logout') ?>" class="btn btn-default float-right"><?php echo lang('App.signout') ?></a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container  
  <aside class="main-sidebar sidebar-light-danger elevation-4"> -->
  <aside class="main-sidebar sidebar-light-danger" style="border-right: 1px solid; border-color:#f0f0f0;">
    <!-- Brand Logo -->
   
    <!-- Brand Logo -->
    <a href="<?php echo url('/') ?>" class="brand-link" style="text-align:center;border-right: 1px solid; border-color:#f0f0f0;" >
    <!--  <img src="<?php echo assets_url('admin') ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light;"><?php echo setting('company_name') ?></span>
    </a>


    <!-- Sidebar  -->
    <div class="sidebar">  
       <!-- SidebarSearch Form  
      <div class="form-inline" style="margin-top:20px;" >
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
    -->
      <?= $this->include('admin/layout/partials/aside-nav') ?>
    </div>
    <!-- /.sidebar -->
  </aside>

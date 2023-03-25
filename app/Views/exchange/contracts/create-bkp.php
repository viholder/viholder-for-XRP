<?php
 $this->extend('admin/layout/default');
 ?>
<?= $this->section('content') ?>
 
<!-- Content Header (Page header) -->
 <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-2">
        <h1><?php echo lang('App.create_new_contract') ?></h1>
      </div>
              <div class="col-sm-10  page-vh-menu">

              <?= $this->include("admin/layout/partials/contracts-menu") ?>

              </div> 
    </div>
  </div>
</section>
 vvssss
 <?= $this->include("exchange/contracts/contract_future") ?>

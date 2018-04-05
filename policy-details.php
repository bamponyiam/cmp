<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Navbar (Header) Starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container-fluid">
  <div class="navbar-header">
	<button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	  <h3><i class="ft-clipboard"></i> Policy information </h3>
  </div>
  <?php include('navbar.php'); ?>
</div>
</nav>
<!-- Navbar (Header) Ends-->
<div class="main-panel">
<div class="main-content">
<div class="content-wrapper"><!--Statistics cards Starts-->
<div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card-block">
            <ul class="nav nav-tabs">
              <li class="nav-item"><a class="nav-link active" id="base-info" data-toggle="tab" aria-controls="info" href="#info" aria-expanded="true">General Information</a></li>
              <li class="nav-item"><a class="nav-link" id="base-policy" data-toggle="tab" aria-controls="policy" href="#policy" aria-expanded="false">Risk / Details</a></li>
              <li class="nav-item"><a class="nav-link" id="base-invoice" data-toggle="tab" aria-controls="document" href="#invoice" aria-expanded="false">Invoice</a></li>
			  <li class="nav-item"><a class="nav-link" id="base-bi" data-toggle="tab" aria-controls="bi" href="#bi" aria-expanded="false">BI</a></li>
            </ul>
            <div class="tab-content px-1 pt-1">
              <div class="tab-pane active" id="info" aria-expanded="true" aria-labelledby="base-info">
                <?php include('policy-tab-info.php'); ?>
              </div>
              <div class="tab-pane" id="policy" aria-labelledby="base-policy">
                <?php include('policy-tab-risk.php'); ?>
              </div>
              <div class="tab-pane" id="invoice" aria-labelledby="base-invoice">
                <?php include('policy-tab-invoice.php'); ?>
              </div>
			  <div class="tab-pane" id="bi" aria-labelledby="base-bi">
                <?php include('policy-tab-bi.php'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>

<footer class="footer footer-static footer-light">
<p class="clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; 2018 <a href="#" id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Poe-ma insurances </a>, All rights reserved. </span></p>
</footer>

</div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<?php include('notification.php'); ?>
<?php include('footer.php'); ?>

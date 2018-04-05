<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Navbar (Header) Starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container-fluid">
  <div class="navbar-header">
	<button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	  <h3><i class="ft-bar-chart-2"></i> Dashboard </h3>
  </div>
  <?php include('navbar.php'); ?>
</div>
</nav>
<!-- Navbar (Header) Ends-->
<div class="main-panel">
<div class="main-content">
<div class="content-wrapper"><!--Statistics cards Starts-->
<div class="row">
	<div class="col-xl-3 col-lg-6 col-md-6 col-12">
		<div class="card gradient-blackberry">
			<div class="card-body">
				<div class="card-block pt-2 pb-0">
					<div class="media">
						<div class="media-body white text-left">
							<h3 class="font-large-1 mb-0">$2156</h3>
							<span>Total Tax</span>
						</div>
						<div class="media-right white text-right">
							<i class="icon-pie-chart font-large-1"></i>
						</div>
					</div>
				</div>
				<div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">					
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-12">
		<div class="card gradient-ibiza-sunset">
			<div class="card-body">
				<div class="card-block pt-2 pb-0">
					<div class="media">
						<div class="media-body white text-left">
							<h3 class="font-large-1 mb-0">$1567</h3>
							<span>Total Cost</span>
						</div>
						<div class="media-right white text-right">
							<i class="icon-bulb font-large-1"></i>
						</div>
					</div>
				</div>
				<div id="Widget-line-chart1" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">					
				</div>

			</div>
		</div>
	</div>
	
</div>
<!--Statistics cards Ends-->


<div class="row match-height">
	<div class="col-xl-4 col-lg-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Statistics</h4>
			</div>
			<div class="card-body">

				<p class="font-medium-2 text-muted text-center pb-2">Last 6 Months Sales</p>
				<div id="Stack-bar-chart" class="height-300 Stackbarchart mb-2">				
				</div>

			</div>
		</div>
	</div>
	<div class="col-xl-8 col-lg-12 col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Shopping Cart</h4>
			</div>
			<div class="card-body">
				<table class="table table-responsive-sm text-center">
					<thead>
						<tr>
							<th>Image</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Status</th>
							<th>Amount</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><img class="media-object round-media height-50" src="app-assets/img/elements/01.png" alt="Generic placeholder image" /></td>
							<td>Ferrero Rocher</td>
							<td>1</td>
							<td>
								<a class="btn white btn-round btn-primary">Active</a>
							</td>
							<td>$19.94</td>
							<td>
								<a class="danger" data-original-title="" title="">
									<i class="ft-x"></i>
								</a>
							</td>
						</tr>
						<tr>
							<td><img class="media-object round-media height-50" src="app-assets/img/elements/07.png" alt="Generic placeholder image" /></td>
							<td>Headphones</td>
							<td>2</td>
							<td>
								<a class="btn white btn-round btn-danger">Disabled</a>
							</td>
							<td>$99.00</td>
							<td>
								<a class="danger" data-original-title="" title="">
									<i class="ft-x"></i>
								</a>
							</td>
						</tr>
						<tr>
							<td><img class="media-object round-media height-50" src="app-assets/img/elements/11.png" alt="Generic placeholder image" /></td>
							<td>Camera</td>
							<td>1</td>
							<td>
								<a class="btn white btn-round btn-info">Paused</a>
							</td>
							<td>$299.00</td>
							<td>
								<a class="danger" data-original-title="" title="">
									<i class="ft-x"></i>
								</a>
							</td>
						</tr>
						<tr>
							<td><img class="media-object round-media height-50" src="app-assets/img/elements/14.png" alt="Generic placeholder image" /></td>
							<td>Beer</td>
							<td>2</td>
							<td>
								<a class="btn white btn-round btn-success">Active</a>
							</td>
							<td>$24.51</td>
							<td>
								<a class="danger" data-original-title="" title="">
									<i class="ft-x"></i>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
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

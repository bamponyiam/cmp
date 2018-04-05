<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php 
	include_once("classes/Country.php");
	$country = Country::getInstance();
	$cou = $country->getAllCountry();

	include_once("classes/Client.php");
	$client = Client::getInstance();
	

	include_once("classes/User.php");
	$user = User::getInstance();
	$br = $user->getBranchByUser($_SESSION['user']);
?>

<!-- Navbar (Header) Starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container-fluid">
  <div class="navbar-header">
	<button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	  <h3><i class="ft-award"></i> All Clients </h3>
  </div>
  <?php include('navbar.php'); ?>
</div>
</nav>
<!-- Navbar (Header) Ends-->
<div class="main-panel">
<div class="main-content">
<div class="content-wrapper">
<!-- DOM - jQuery events table -->
<section id="dom">
    <div class="row">
        <div class="col-12">
			<div class="card">
				<div class="card-body collapse show">
					<div class="card-block card-dashboard">
						<form class="form" method="GET">
							<div class="form-body">
		                        <div class="row">
		                            <div class="col-md-2">
		                                <fieldset class="form-group">
		                                    <label for="basicSelect">Branch</label>
		                                    <select class="form-control" id="basicSelect" name="branch">
		                                      <option value="all">All</option>
												<?php foreach($br as $b){ ?>
												<option value="<?php echo $b['code_br']; ?>" <?php if(isset($_GET['branch']) && $_GET['branch'] == $b['code_br']){echo 'selected';} ?>><?php echo $b['name_br'] ?></option>
												<?php } ?>
		                                    </select>
		                                </fieldset>                                
		                            </div>
									<div class="col-md-2">
		                                <fieldset class="form-group">
		                                    <label for="basicSelect">Status</label>
		                                    <select class="form-control" name="status">
		                                      <option value="all" >All</option>
											  <option value="ACTIVE" <?php if(isset($_GET['status']) && $_GET['status'] == 'ACTIVE'){echo 'selected';} ?>>ACTIVE</option>
											  <option value="PENDING" <?php if(isset($_GET['status']) && $_GET['status'] == 'PENDING'){echo 'selected';} ?>>PENDING</option>
		                                    </select>
		                                </fieldset>                                
		                            </div>
									<div class="col-md-2"> 
										<button type="submit" class="btn btn-raised btn-primary" style="margin-top: 30px;"> Submit </button>
									</div>
		                        </div>
		                    </div>
		                </form>
					</div>
				</div>
			</div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Clients</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered default-list">
                            <thead>
                                <tr>
                                    
                                    
                                    <th>Fullname</th>
									<th>Client ID</th>
									<th>Branch</th>
                                    <th>Resident</th>
                                    <th>City / Province</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								if(!isset($_GET['branch']) && !isset($_GET['status'])){
									$all = $client->getAllClientByUser($_SESSION['user']);
								}else{
									$all = $client->getAllClientByUserBrStatus($_SESSION['user'],$_GET['branch'],$_GET['status']);
								}
								
								foreach($all as $a){ 
									$pro = $country->getDPINameById($a['dpi_code'],$a['resident']);
									$my_cc = $country->getCountryNameByCode($a['resident']);
									$branch = $client->getBranchById($a['crystal_client_branche_id']);
								?>
                                <tr>
									<?php if($a['title'] != ""){ ?>
									<td><a href="info-clients?id=<?php echo $a['id_client']; ?>"><?php echo $a['title'].'. '.$a['lastname'].' '.$a['firstname']; ?></a></td>
									<?php }else{ ?>
                                    <td><a href="info-clients?id=<?php echo $a['id_client']; ?>"><?php echo $a['lastname'].' '.$a['firstname']; ?></a></td>
									<?php } ?>
									<td><?php echo $a['crystal_client_code']; ?></td>
                                    <td><?php echo $branch['name_br']; ?></td>
                                    <td><?php echo $my_cc['country_name']; ?></td>
                                    <td><?php echo $a['city'].'/'.$pro['dpi_name']; ?></td>
                                    <td><?php echo $a['status']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Client ID</th>
                                    <th>Branch</th>
                                    <th>Fullname</th>
                                    <th>Resident</th>
                                    <th>City / Province</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- DOM - jQuery events table -->

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

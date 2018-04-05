<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<?php 
	include_once("classes/Country.php");
	$country = Country::getInstance();
	$cou = $country->getAllCountry();

	include_once("classes/Policy.php");
	$policy = Policy::getInstance();

	include_once("classes/Client.php");
	$client = Client::getInstance();

	include_once("classes/Divers.php");
	$divers = Divers::getInstance();

	include_once("classes/Product.php");
	$product = Product::getInstance();

	include_once("classes/Insurer.php");
	$ins = Insurer::getInstance();

	include_once("classes/User.php");
	$user = User::getInstance();
	$br = $user->getBranchByUser($_SESSION['user']);

	if(!isset($_GET['branch'])){
		$all = $policy->getAllPolicyByUser($_SESSION['user'],$year);
	}else{
		$all = $policy->getAllPolicyByUserBrYear($_SESSION['user'],$_GET['branch'],$_GET['year']);
	}
?>

<!-- Navbar (Header) Starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container-fluid">
  <div class="navbar-header">
	<button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	  <h3><i class="ft-clipboard"></i> All Policy </h3>
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
												<option value="<?php echo $b['code_br'] ?>" <?php if(isset($_GET['branch']) && $_GET['branch'] == $b['code_br']){echo 'selected';} ?>><?php echo $b['name_br'] ?></option>
												<?php } ?>
		                                    </select>
		                                </fieldset>                                
		                            </div>
									<div class="col-md-2">
		                                <fieldset class="form-group">
		                                    <label for="basicSelect">EFF Year</label>
		                                    <select class="form-control" name="year">
		                                      <option value="2018" >2018</option>
											  <option value="2017" <?php if(isset($_GET['year']) && $_GET['year'] == '2017'){echo 'selected';} ?>>2017</option>
											  <option value="2016" <?php if(isset($_GET['year']) && $_GET['year'] == '2016'){echo 'selected';} ?>>2016</option>
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
                    <h4 class="card-title">Policy</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered default-list">
                            <thead>
                                <tr>
                                    <th width="10%">Policy ID</th>
                                    <th>Branch</th>
                                    <th>Product</th>
                                    <th>Insurer</th>
                                    <th>Client</th>
								    <th>Eff.</th>
								    <th>Exp.</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($all as $a){ 
									$my = $client->getClientByPolicy($a['id_policy_crystal']);
									$pro = $product->getProductById($a['id_product']);
									$my_ins = $ins->getInsurerById($a['id_insurer']);
									$branch = $client->getBranchById($a['id_br']);

								?>
                                <tr>
                                    <td><a href="info-policy?po=<?php echo $a['id_policy_crystal']; ?>"><?php echo $a['id_policy_crystal']; ?></a></td>
                                    <td><?php echo $branch['name_br']; ?></td>
                                    <td><?php echo $pro['name_product']; ?></td>
                                    <td><?php echo $my_ins['name']; ?></td>
                                    <td><?php echo $my['title'].'. '.$my['lastname'].' '.$my['firstname']; ?></td>
									<td><?php echo $a['effective_date']; ?></td>
									<td><?php echo $a['expired_date']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Policy ID</th>
                                    <th>Branch</th>
                                    <th>Product</th>
                                    <th>Insurer</th>
                                    <th>Client</th>
								    <th>Eff.</th>
								    <th>Exp.</th>
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
 
<?php include('header.php'); ?>
<?php include('sidebar.php'); 

include_once("classes/Client.php");
$client = Client::getInstance();

include_once("classes/User.php");
$user = User::getInstance();

include_once("classes/Country.php");
$country = Country::getInstance();

$cou = $country->getAllCountry();
$title = $client->getAllTitle();
$br = $user->getBranchByUser($_SESSION['user']);
?>

<!-- Navbar (Header) Starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container-fluid">
  <div class="navbar-header">
	<button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	  <h3><i class="ft-plus"></i> New client </h3>
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
			<form class="form" method="POST" action="client-add-new-form-process.php" >
				<h4 class="form-section"><i class="ft-info"></i> Personal information</h4>
				
				<div class="row">
				<div class="col-md-2">
				  <div class="form-group">
					<label for="userinput1">Office / Branch :</label>
					<select class="form-control" name="crystal_client_branche_id" required>
						<option value=""> Select </option>
						<?php 
						foreach($br as $b){
							echo '<option value="'.$b['code_br'].'">'.$b['name_br'].'.</option>';
						}
						?>
					</select>
				  </div>
				</div>
				<div class="col-md-2">
				  <div class="form-group">
					<label for="userinput1">Status :</label>
					 <select class="form-control" name="status">
						 <option value="PENDING"> PENDING </option>
					  </select>
				  </div>
				</div>
				<div class="col-md-2">
				  <div class="form-group">
					<label for="userinput2">Register date :</label>
					<input type="text" id="userinput2" class="form-control" name="join_date" value="<?php echo date('Y-m-d'); ?>" readonly>
				  </div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-2">
				  <div class="form-group">
					<label for="userinput1">Title : <span class="required">*</span></label>
					<select class="form-control" name="title" required>
						<option value=""> Select title </option>
						<?php 
						foreach($title as $t){
							if($t['title'] != ""){
								echo '<option value="'.$t['title'].'">'.$t['title'].'.</option>';
							}
						}
						?>
					</select>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">First Name :</label>
					<input type="text" id="userinput1" class="form-control " name="firstname" value="<?php echo $my['firstname'] ?>">
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput2">Last Name : <span class="required">*</span></label>
					<input type="text" id="userinput2" class="form-control" name="lastname" value="<?php echo $my['lastname'] ?>">
				  </div>
				</div> 
				
				<div class="col-md-2">
				  <div class="form-group">
					<label for="userinput2">Nationality :</label>
					<select class="form-control" name="nationality">
						<option> Select nationality </option>
						<?php 
						foreach($cou as $c){
							echo '<option value="'.$c['country_name'].'">'.$c['country_name'].'</option>';
						}
						?>
					</select>
				  </div>
				</div> 
				<div class="col-md-2">
				  <div class="form-group">
					<label for="userinput2">DOB :</label>
					<input type="text" id="userinput2" class="form-control pickadate-dropdown" name="dob" >
				  </div>
				</div>
			  </div>
				
				
				<h4 class="form-section"><i class="ft-mail"></i> Contact information</h4>
			  <div class="row">
				<div class="col-md-8">
				  <div class="form-group">
					<label for="userinput4">Address Line 1 :</label>
					<input type="text" id="userinput4" class="form-control " name="adr" >
				  </div>
				</div>
				  <div class="col-md-4">
				  <div class="form-group">
					<label for="userinput4">Address Line 2 :</label>
					<input type="text" id="userinput4" class="form-control " name="adr2" >
				  </div>
				</div>

				  <div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">Country of resident :</label>
					<select class="form-control" name="resident" id="resident">
						<?php 
						foreach($cou as $c){
							echo '<option value="'.$c['country_code'].'">'.$c['country_name'].'</option>';
						}
						?>
					</select>
				  </div>
				</div>
				  
				  <div class="col-md-3">
				  <div class="form-group">
					<label for="userinput4">City / District : </label>
					<input type="text" id="userinput4" class="form-control " name="city" value="<?php echo $my['city'] ?>">
				  </div>
				</div>
				  <div class="col-md-3">
				  <div class="form-group">
					<label for="userinput4">Province : </label>
					<select class="form-control" name="dpi_code" id="dpi">
					<option> Select </option>
					</select>
				  </div>
				</div>
				  <div class="col-md-3">
				  <div class="form-group">
					<label for="userinput4">Zipcode :</label>
					<input type="text" id="userinput4" class="form-control " name="zipcode" value="<?php echo $my['zipcode'] ?>">
				  </div>
				</div>
				  <div class="col-md-3">
				  <div class="form-group">
					<label for="userinput4">Phone :</label>
					<input type="text" id="userinput4" class="form-control " name="phone" value="<?php echo $my['phone'] ?>">
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput4">Email :</label>
					<input type="text" id="userinput4" class="form-control " name="email" value="<?php echo $my['email'] ?>">
				  </div>
				</div>
				 <div class="col-md-6">
				  <div class="form-group">
					<label for="userinput4">Internal Note :</label>
					<input type="text" id="userinput4" class="form-control " name="note" value="<?php echo $my['note'] ?>">
				  </div>
				</div>
			  </div>

			<div class="form-actions center">
				<p> After click submit, we will send an email to service IT to add this information to Crystal Application</p>
				<button type="submit" class="btn btn-lg btn-raised btn-primary"> &nbsp;&nbsp;&nbsp;<i class="fa fa-check-square-o"></i> Submit &nbsp;&nbsp;&nbsp;</button>
			  <button type="submit" class="btn btn-lg btn-raised btn-default"> &nbsp;&nbsp;&nbsp;<i class="fa fa-reset"></i> Reset &nbsp;&nbsp;&nbsp;</button>
			  
			</div>
		  </form>
</div></div></div></div></div>
</div>

<footer class="footer footer-static footer-light">
<p class="clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; 2018 <a href="#" id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Poe-ma insurances </a>, All rights reserved. </span></p>
</footer>

</div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<?php include('notification.php'); ?>
<?php include('footer.php'); ?>
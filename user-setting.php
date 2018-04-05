<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php 
	include_once("classes/User.php");
	$user = User::getInstance();
	$my = $user->getUserByUsername($_SESSION['user']);
	$br = $user->getBranchByUserTxt($_SESSION['user']);
	
?>

<!-- Navbar (Header) Starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container-fluid">
  <div class="navbar-header">
	<button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	  <h3><i class="ft-user"></i> User setting </h3>
  </div>
  <?php include('navbar.php'); ?>
</div>
</nav>
<!-- Navbar (Header) Ends-->
<div class="main-panel">
<div class="main-content">
<div class="content-wrapper"><!--Statistics cards Starts-->
<div class="row match-height">
	<div class="col-md-6">
			<div class="card">
			  <div class="card-header">
				<h4 class="card-title" id="basic-layout-colored-form-control">User Profile</h4>
				<p class="mb-0"> View / Edit your information </p>
			  </div>
			  <div class="card-body">
				<div class="px-3">
				<?php if(isset($_GET['update']) && $_GET['update'] == 'ok'){ echo '<p class=" notice bg-success">Information has been updated </p>';} ?>
				  <form class="form" method="POST" action="save-user-setting-process.php">
					<div class="form-body">

					   <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label for="userinput1">First Name</label>
							<input type="text" id="userinput1" class="form-control border-primary" name="firstname" value="<?php echo $my['firstname'] ?>">
						  </div>
						</div>

						<div class="col-md-6">
						  <div class="form-group">
							<label for="userinput2">Last Name</label>
							<input type="text" id="userinput2" class="form-control border-primary" name="lastname" value="<?php echo $my['lastname'] ?>">
						  </div>
						</div> 
					  </div>

					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label for="userinput4">Email</label>
							<input type="text" id="userinput4" class="form-control border-primary" name="email" value="<?php echo $my['email'] ?>">
						  </div>
						</div>
					  </div>

					  <h4 class="form-section"><i class="ft-info"></i> Branch Available</h4>
						<p><?php echo $br; ?></p>

					<div class="form-actions right">

					  <button type="submit" class="btn btn-raised btn-primary">
						<i class="fa fa-check-square-o"></i> Save
					  </button>
					</div>
				  </form>

				</div>
			  </div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
	<div class="card">
	  <div class="card-header">
		<h4 class="card-title" id="basic-layout-colored-form-control">Change password</h4>
		<p class="mb-0"></p>
	  </div>
	  <div class="card-body">
		  <div class="px-3">
			  <?php if(isset($_GET['update']) && $_GET['update'] == 'pass_ok'){ echo '<p class=" notice bg-success">Information has been updated, please use your new password for next login </p>';} ?>
			  <?php if(isset($_GET['update']) && $_GET['update'] == 'pass_incorrect'){ echo '<p class=" notice bg-warning"> Current password incorrect, please try again </p>';} ?>
			  <div class="form-body">
				  <form class="form" method="POST" novalidate action="save-user-password-process.php">
					<div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label>Username</label>
							<input class="form-control border-primary" type="text" value="<?php echo $my['crystal_user_id']; ?>" readonly >
						  </div>
						 </div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Current password <span class="required">*</span></label>
							<input class="form-control" type="password" name="current_pass" placeholder="*************"  required>
						  </div>
						 </div>
					</div>

				  <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label>New password <span class="required">*</span></label>
							<input type="password" name="new_pass" class="form-control" required data-validation-required-message="This field is required">
						  </div>
						 </div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Re-new password <span class="required">*</span></label>
							<input type="password" name="password2" data-validation-match-match="new_pass"  class="form-control" required>
						  </div>
						 </div>
					</div>

					<div class="form-actions right">
					  <button type="submit" class="btn btn-raised btn-primary">
						<i class="fa fa-check-square-o"></i> Save
					  </button>
					</div>
			  </form>
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

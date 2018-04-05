<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php 
	include_once("classes/Country.php");
	$country = Country::getInstance();
	$cou = $country->getAllCountry();

	include_once("classes/User.php");
	$user = User::getInstance();
	$all = $user->getAllUser();
?>

<!-- Navbar (Header) Starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container-fluid">
  <div class="navbar-header">
	<button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	  <h3><i class="ft-users"></i> All Users </h3>
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
                <div class="card-header">
                    <h4 class="card-title">Users</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered default-list">
                            <thead>
                                <tr>
                                    <th>Fullname</th>
									<th>User</th>
									<th>Branch Available</th>
                                    <th>Email</th>
                                    <th>Status</th>
									<th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($all as $a){ 
										$mybr = $user->getBranchByUserTxt($a['crystal_user_id']);
								?>
                                <tr>
                                    <td><?php echo $a['firstname'].' '.$a['lastname']; ?></td>
									<td><?php echo $a['crystal_user_id']; ?></td>
									<td><?php echo $mybr; ?></td>
                                    <td><?php echo $a['email']; ?></td>
                                    <td><?php echo $a['status']; ?></td>
                                    <td><a href="details-user.php?id=<?php echo $a['id_user']; ?>"><i class="fa fa-edit"></i> View / Edit </a>&nbsp;|&nbsp;<a href="#"><i class="fa fa-trash"></i> Delete</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>User</th>
                                    <th>Country</th>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Status</th>
									<th></th>
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

<br />
<?php 
include_once("classes/Client.php");
$client = Client::getInstance();

include_once("classes/User.php");
$user = User::getInstance();

include_once("classes/Country.php");
$country = Country::getInstance();

$cou = $country->getAllCountry();


$my = $client->getClientByMyIs($_GET['id']);
$br = $user->getBranchById($my['crystal_client_branche_id']);

?>
		<?php if(isset($_GET['update']) && $_GET['update'] == 'ok'){ echo '<p class=" notice bg-success">Information has been updated </p>';} ?>
		  <form class="form" method="POST" action="client-tab-info-process.php" >
				<input type="hidden" name="id_client" value="<?php echo $_GET['id']; ?>" />
			  	<input type="hidden" name="crystal_client_id" value="<?php echo $my['crystal_client_id']; ?>" />
			   <div class="row">
				 
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">Crystal ID : </label>
					<input type="text" id="userinput1" class="form-control " name="crystal_client_code" value="<?php echo $my['crystal_client_code'] ?>" readonly>
				  </div>
				</div>  
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">Branch : </label>
					<input type="text" id="userinput1" class="form-control " value="<?php echo $br['name_br'] ?>" readonly>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">Date register :</label>
					<input type="text" id="userinput1" class="form-control" value="<?php echo $my['join_date'] ?>" readonly>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">Status :</label>
					 <select class="form-control" name="status">
						 <option value="ACTIVE" <?php if($my['status'] == 'ACTIVE'){ echo 'selected';} ?> > ACTIVE </option>
						 <option value="PENDING" <?php if($my['status'] == 'PENDING'){ echo 'selected';} ?>> PENDING </option>
						 <option value="INACTIVE" <?php if($my['status'] == 'INACTIVE'){ echo 'selected';} ?>> INACTIVE </option>
					  </select>
				  </div>
				</div>
				</div>
				<h4 class="form-section"><i class="ft-info"></i> Personal information</h4>
				 <div class="row">
				
				<div class="col-md-1">
				  <div class="form-group">
					<label for="userinput1">Title :</label>
					<input type="text" id="userinput1" class="form-control " name="title" value="<?php echo $my['title'] ?>">
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
					<label for="userinput2">Last Name :</label>
					<input type="text" id="userinput2" class="form-control" name="lastname" value="<?php echo $my['lastname'] ?>">
				  </div>
				</div> 
				
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput2">Nationality :</label>
					<select class="form-control" name="nationality">
						<option> Select nationality </option>
						<?php 
						foreach($cou as $c){
							if($my['nationality'] == $c['country_name']){
								echo '<option value="'.$c['country_name'].'" selected>'.$c['country_name'].'</option>';
							}else{
								echo '<option value="'.$c['country_name'].'">'.$c['country_name'].'</option>';
							}
							
						}
						?>
					</select>
				  </div>
				</div> 
				<div class="col-md-2">
				  <div class="form-group">
					<label for="userinput2">DOB :</label>
					<input type="text" id="userinput2" class="form-control pickadate-dropdown" name="dob" value="<?php echo $my['dob'] ?>">
				  </div>
				</div>
			  </div>
				
				
				<h4 class="form-section"><i class="ft-mail"></i> Contact information</h4>
			  <div class="row">
				<div class="col-md-8">
				  <div class="form-group">
					<label for="userinput4">Address Line 1 :</label>
					<input type="text" id="userinput4" class="form-control " name="adr" value="<?php echo $my['adr'] ?>">
				  </div>
				</div>
				  <div class="col-md-4">
				  <div class="form-group">
					<label for="userinput4">Address Line 2 :</label>
					<input type="text" id="userinput4" class="form-control " name="adr2" value="">
				  </div>
				</div>

				  <div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">Country of resident :</label>
					<select class="form-control" name="resident">
						<?php 
						foreach($cou as $c){
							if($my['resident'] == $c['country_code']){
								echo '<option value="'.$c['country_code'].'" selected>'.$c['country_name'].'</option>';
							}else{
								echo '<option value="'.$c['country_code'].'">'.$c['country_name'].'</option>';
							}
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
					<?php $all_dpi = $country->getAllDepByCountry($my['resident']); ?>
					<select class="form-control" name="dpi_code">
						<?php
						
						foreach($all_dpi as $d){
							if($my['dpi_code'] == $d['crystal_dpi_code']){
								echo '<option value="'.$d['crystal_dpi_code'].'" selected>'.$d['dpi_name'].'</option>';
							}else{
								echo '<option value="'.$d['crystal_dpi_code'].'">'.$d['dpi_name'].'</option>';
							}
						}
						?>
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
				<button type="submit" class="btn btn-lg btn-raised btn-primary"> &nbsp;&nbsp;&nbsp;<i class="fa fa-check-square-o"></i> Save &nbsp;&nbsp;&nbsp;</button>
			  <button type="submit" class="btn btn-lg btn-raised btn-default"> &nbsp;&nbsp;&nbsp;<i class="fa fa-reset"></i> Reset &nbsp;&nbsp;&nbsp;</button>
			  
			</div>
		  </form>


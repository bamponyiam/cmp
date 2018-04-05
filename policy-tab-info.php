<br />
<?php 
include_once("classes/Client.php");
$client = Client::getInstance();

include_once("classes/User.php");
$user = User::getInstance();

include_once("classes/Country.php");
$country = Country::getInstance();

include_once("classes/Policy.php");
$policy = Policy::getInstance();

include_once("classes/Product.php");
$product = Product::getInstance();

$cou = $country->getAllCountry();

?>


			   <div class="row">
				 
				<div class="col-md-4">
				  <div class="form-group">
					<label for="userinput1">Type of product : </label>
					<input type="text" id="userinput1" class="form-control " name="crystal_client_code" >
				  </div>
				</div>  
				<div class="col-md-4">
				  <div class="form-group">
					<label for="userinput1">Insurer : </label>
					<input type="text" id="userinput1" class="form-control " value="<?php echo $br['name_br'] ?>" >
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="form-group">
					<label for="userinput1">Office / Branch :</label>
					<input type="text" id="userinput1" class="form-control" value="<?php echo $my['join_date'] ?>" >
				  </div>
				</div>
				
				<div class="col-md-3">
				  <div class="form-group">
					<label>Effective date :</label>
					<div class="input-group">
					  <div class="input-group-prepend">
						<span class="input-group-text">
						  <span class="fa fa-calendar-o"></span>
						</span>
					  </div>
					  <input type='text' class="form-control pickadate-dropdown"  readonly />
					</div>
				  </div>
				</div>
				 <div class="col-md-3">
				  <div class="form-group">
					<label>Expired date :</label>
					<div class="input-group">
					  <div class="input-group-prepend">
						<span class="input-group-text">
						  <span class="fa fa-calendar-o"></span>
						</span>
					  </div>
					  <input type='text' class="form-control pickadate-dropdown" readonly />
					</div>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
					<label for="userinput1">Client : </label>
					<input type="text" id="userinput1" class="form-control " value="<?php echo $br['name_br'] ?>" >
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="form-group">
					<label for="userinput1">Policy Number : </label>
					<input type="text" id="userinput1" class="form-control " value="<?php echo $br['name_br'] ?>" >
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="form-group">
					<label>Movement date :</label>
					<div class="input-group">
					  <div class="input-group-prepend">
						<span class="input-group-text">
						  <span class="fa fa-calendar-o"></span>
						</span>
					  </div>
					  <input type='text' class="form-control pickadate-dropdown" readonly />
					</div>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
					<label for="userinput1">Details : </label>
					<input type="text" id="userinput1" class="form-control " value="<?php echo $br['name_br'] ?>" >
				  </div>
				</div>
			  </div>
				



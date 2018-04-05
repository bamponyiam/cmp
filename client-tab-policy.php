<?php 
include_once("classes/Policy.php");
$policy = Policy::getInstance();

include_once("classes/Product.php");
$product = Product::getInstance();

include_once("classes/Insurer.php");
$insurer = Insurer::getInstance();

$all = $policy->getAllPolicyByClient($_GET['id']);
//print_r($all);
?>
<section id="extended">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Policy</h4>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <table class="table table-responsive-md-md ">
                            <thead>
                                <tr>
                                    <th>Policy N.</th>
                                    <th>Product</th>
                                    <th>Insurer</th>
                                    <th>Eff.</th>
                                    <th>Exp.</th>
                                    <th>Frequency</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
									foreach($all as $a){ 
										$ins = $insurer->getInsurerById($a['id_insurer']);
										$pro = $product->getProductById($a['id_product']);
								?>
										<tr>
											<td><a href="info-policy?po=<?php echo $a['id_policy'] ?>"><?php echo $a['policy_number'] ?></a></td>
											<td><?php echo $pro['name_product'] ?></td>
											<td><?php echo $ins['name'] ?></td>
											<td><?php echo $a['effective_date'] ?></td>
											<td><?php echo $a['expired_date'] ?></td>
											<td><?php echo $a['frequency'] ?></td>
										</tr>
								<?php } ?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Extended Table Ends-->
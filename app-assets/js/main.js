function getProductByIns(id){
	$.post("get_product_by_ins_ajax.php",{ id: id},
		function(result){
			$('#id_product').html(result);
		//alert(result);
	});
}

function getFormulaByProduct(id){

	$.post("get_formula_by_product.php",{ id: id},
		function(result){
			$('#id_formula').html(result);
		//alert(result);
	});
}

function getClientByBr(id){

	$.post("get_client_by_br_ajax.php",{ id: id},
		function(result){
			$('#id_client').html(result);
		//alert(result);
	});
}


function getDpiByCountry(id){

	$.post("get_dpi_by_country_ajax.php",{ id: id},
		function(result){
			$('#dpi').html(result);
		//alert(result);
	});
}

$(document).ready(function() {
	$(".new-policy").click(function() {
	  $(".new-policy-form").toggle();
	});
	$(".new-document").click(function() {
	  $(".new-document-form").toggle();
	});
	
	$(".choose_client").change(function() {
		if($(".choose_client").val() == 1){
			$(".new_client").toggle();
			$(".exist_client").hide();
		}else{
			$(".new_client").hide();
			$(".exist_client").toggle();
		}
	  
	});
	
	$("#id_br").change(function() {
		//alert($("#id_br").val());
	  getClientByBr($("#id_br").val());
	});
	
	$("#resident").change(function() {
	  getDpiByCountry($("#resident").val());
	});
	
	$("#id_insurer").change(function() {
		//alert($("#id_insurer").val());
	  getProductByIns($("#id_insurer").val());
	});
	
	$(document).on('change', '#id_product', function() {
	  getFormulaByProduct($("#id_product").val());
	});
	

});





<!DOCTYPE html>
<html>
<head>
	<title>sales tax calculator</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="heading" style="text-align: center;">
			<h3>Sales tax calculator</h3>
		</div>
		<br><br><hr>
		<div class="col-md-3">
			<div class="mb-3">
			  <label for="productname" class="form-label">Product Name</label>
			  <input type="text" class="form-control" id="productname" placeholder="Enter Product Name">
			</div>
		</div>
		<div class="col-md-3">
			<div class="mb-3">
			  <label for="category" class="form-label">Category</label>
			  <select class="form-select" aria-label="Default select example" id="category">
				  <option selected>Product Category</option>
				  <option value="1">Books</option>
				  <option value="2">Foods</option>
				  <option value="3">Medical</option>
				  <option value="4">others</option>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="mb-3">
			  <label for="qty" class="form-label">Quantity</label>
			  <select class="form-select" aria-label="Default select example" id="qty">
				  <option selected>Quantity</option>
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="mb-3">
			  <label for="selfprice" class="form-label">Price</label>
			  <input type="text" class="form-control" id="selfprice" placeholder="Enter Amount">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<button type="button" id="additems" class="btn btn-success">Add</button>
			<button type="button" id="clearitems" class="btn btn-danger">clear</button>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 border">
			<div> <strong> Item details </strong> </div>
			<div>
				<ul class="list-group" id="itemdetails">
				</ul>
			</div>
		</div>
		<div class="col-md-6 border">
			<div> <strong> Amount details </strong> </div>
			<div>
				<ul class="list-group" id="costdetails">
				  
				</ul>
				<ul class="list-group float-right" id="completedetails" style="width: 20%; float: right;">
				  
				</ul>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	var addedproducts = [];
	$(document).ready(function(){
		$("#additems").on('click', function(){
			var productname = $('#productname').val();
			var productCategory = $('#category').val();
			var productcost = $('#selfprice').val();
			var qty = $('#qty').val();

			$.ajax({
				url:'calculatorapi.php',
				type:'post',
				data:{
					action:'add',
					productname:productname,
					productCategory:productCategory,
					productcost:productcost,
					qty:qty
				}
			}).done(function(data){
				getItems();
			});
			
		// 	var st = 10;
		// 	var imd = 5;
		// 	var stax=0;
		// 	var itemscost=0;
		// 	if(productCategory==1 || productCategory==2 || productCategory==3){
		// 		st = 0;
		// 		imd = 5;
		// 	}else if(productCategory==4){
		// 		st=10;
		// 		imd=5;
		// 	}

		// 	stax = qty*((st*productcost)/100 + (imd*productcost)/100);
		// 	itemscost = qty*productcost;
		// 	var productdetails = {pname:productname,pcategory:productCategory,pcost:productcost,pqty:qty,pstax:stax,itemscost:itemscost};
		// 	addedproducts.push(productdetails);
		// 	var itemdetails="";
		// 	var costdetails="";
		// 	var i=0;
		// 	var saletaxes=0;
		// 	var totalcosts=0;
		// 	$.each(addedproducts, function(key,val) {
	 //            itemdetails+='<li class="list-group-item">'+val.pqty+' '+val.pname+' at '+(Math.ceil((parseFloat(val.pcost))*20)/20).toFixed(2)+'</li>';
	 //            $("#itemdetails").html(itemdetails);
	 //            costdetails+='<li class="list-group-item">'+val.pqty+' '+val.pname+' : '+(Math.ceil((parseFloat(val.pcost))*20)/20).toFixed(2)+'</li>';
	 //            $("#costdetails").html(costdetails);
	 //            i++;
	 //            saletaxes+=val.pstax;
	 //            totalcosts+=parseFloat(val.itemscost)+saletaxes;
	 //            console.log(val.pcost);
	 //            costvalues = '<li class="list-group-item">Sales Taxes = <span> '+(Math.ceil((parseFloat(saletaxes))*20)/20).toFixed(2)+' </span></li><li class="list-group-item">Total Cost = <span> '+(Math.ceil((parseFloat(totalcosts))*20)/20).toFixed(2)+'</span></li>';
	 //        });
			
		// 	$('#completedetails').html(costvalues);
		});

		$('#clearitems').on('click',function(){
			$.ajax({
				url:'calculatorapi.php',
				type:'post',
				data:{
					action:'clear',
				}
			}).done(function(data){
				getItems();
			});
		});
	});

	function getItems(){
		$.ajax({
				url:'calculatorapi.php',
				type:'post',
				data:{
					action:'get'
				}
			}).done(function(data){
				responseData = JSON.parse(data);
				if(responseData.status==true){
					appendItems(JSON.parse(responseData.data));
				}else{
					$("#itemdetails").html('');
		            $("#costdetails").html('');
		            $('#completedetails').html('');
				}
				
			});
	}
	getItems();

	function appendItems(data){
			var itemdetails="";
			var costdetails="";
			var i=0;
			var saletaxes=0;
			var totalcosts=0;
			console.log(data);
			$.each(data, function(key,val) {
	            itemdetails+='<li class="list-group-item">'+val.pqty+' '+val.pname+' at '+(Math.ceil((parseFloat(val.pcost))*20)/20).toFixed(2)+'</li>';
	            $("#itemdetails").html(itemdetails);
	            costdetails+='<li class="list-group-item">'+val.pqty+' '+val.pname+' : '+val.pqty*(Math.ceil((parseFloat(val.pcost))*20)/20).toFixed(2)+'</li>';
	            $("#costdetails").html(costdetails);
	            i++;
	            saletaxes+=val.pstax;
	            totalcosts+=parseFloat(val.itemscost)+val.pstax;
	            console.log(val.pcost);
	        });
			costvalues = '<li class="list-group-item">Sales Taxes = <span> '+(Math.ceil((parseFloat(saletaxes))*20)/20).toFixed(2)+' </span></li><li class="list-group-item">Total Cost = <span> '+(Math.ceil((parseFloat(totalcosts))*20)/20).toFixed(2)+'</span></li>';
			$('#completedetails').html(costvalues);
	}
</script>
</body>
</html>
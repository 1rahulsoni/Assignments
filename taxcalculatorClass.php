<?php

/**
 * 
 */
class taxCalculator
{

	private $st = 10;
    private $imd = 5;
	private $stax=0;
	private $itemscost=0;
	private $addedproducts=array();
	private $products=array();
	public function addItems($itemdetails){
		if(isset($_COOKIE['addedproducts'])){
			$this->products = json_decode($_COOKIE['addedproducts'],true);
			if(count($this->products)>=1){
			$productJson = $this->addingLogic($itemdetails);
			setcookie('addedproducts',$productJson);
			}
			$this->addedproducts = json_decode($_COOKIE['addedproducts']);
		}else{
			$productJson = $this->addingLogic($itemdetails);
			setcookie('addedproducts',$productJson);
		}
		
		return true;
	}

	public function clearItems(){
		if (isset($_COOKIE['addedproducts'])) {
		    setcookie('addedproducts','', time() + 1000);
		    return true;
		}
	}

	public function fetchItems(){
		if (isset($_COOKIE['addedproducts'])) {
		    $alldata = json_decode($_COOKIE['addedproducts'],true);
		 //    $itemdetails="";
			// $costdetails="";
			// $i=0;
			// $saletaxes=0;
			// $totalcosts=0;
			// exit(print_r($alldata));
			// foreach($alldata as $key => $val) {
			// 	echo $val['pqty'];
	            // $itemdetails.="<li class='list-group-item'>".$val['pqty']." ".$val['pname']." at ".($this->rndfunc(($this->floatTo($val['pcost'])))."</li>";
	            // $returndata['itemdetails'] = $itemdetails;
	            // $costdetails.="<li class='list-group-item'>".$val['pqty']." ".$val['pname']." : ".($this->rndfunc(($this->floatTo($val['pcost'])))."</li>";
	            // $returndata['costdetails'] = $costdetails;
	            // $i++;
	            // $saletaxes+=$val['pstax'];
	            // $totalcosts+=$this->floatTo($val['itemscost'])+$saletaxes;
	            // $costvalues = "<li class='list-group-item'>Sales Taxes = <span> ".($this->rndfunc(($this->floatTo($saletaxes)))." </span></li><li class='list-group-item'>Total Cost = <span> ".($this->rndfunc(($this->floatTo($totalcosts)))."</span></li>";
	        // }
			
		    // $returndata['costvalues'] = $costvalues;

		    return json_encode($alldata);
		}else{
			return false;
		}
	}

	private function addingLogic($itemdetails){
		if($itemdetails['productCategory']==1 || $itemdetails['productCategory']==2 || $itemdetails['productCategory']==3){
				$this->st = 0;
				$this->imd = 5;
			}else if($itemdetails['productCategory']==4){
				$this->st=10;
				$this->imd=5;
			}

			$this->stax = $itemdetails['qty']*(($this->st*$itemdetails['productcost'])/100 + ($this->imd*$itemdetails['productcost'])/100);
			$this->itemscost =  $itemdetails['qty']*$itemdetails['productcost'];
			$productdetails = array('pname'=>$itemdetails['productname'],'pcategory'=>$itemdetails['productCategory'],'pcost'=>$itemdetails['productcost'],'pqty'=>$itemdetails['qty'],'pstax'=>$this->stax,'itemscost'=>$this->itemscost);
				array_push($this->products,$productdetails);
				return $productjson = json_encode($this->products);
	}

	private function rndfunc($x){
	  return round($x * 2, 1) / 2;
	}

	private function floatTo($p){
		return number_format((float)$p, 2, '.', '');
	}
}

?>
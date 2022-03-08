<?php
require 'taxcalculatorClass.php';
$classinstance = new taxCalculator();
$formData = $_POST;
if($formData['action']=='add'){
	$status = $classinstance->addItems($formData);
    if($status){
    	exit(json_encode(array('status'=>$status,'message'=>'item added successfully')));
    }
}else if($formData['action']=='clear'){
	$status = $classinstance->clearItems();
	if($status){
    	exit(json_encode(array('status'=>$status,'message'=>'items cleared')));
    }
}else if($formData['action']=='get'){
	$status = $classinstance->fetchItems();
	if($status){
		exit(json_encode(array('status'=>true,'data'=>$status)));
	}else{
		exit(json_encode(array('status'=>false,'message'=>'no data found!')));
	}
    
}


?>
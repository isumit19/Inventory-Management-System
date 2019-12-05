<?php 	
//ALTER TABLE `orders` ADD `payment_place` INT NOT NULL AFTER `payment_status`;
//TER TABLE `orders` ADD `gstn` VARCHAR(255) NOT NULL AFTER `payment_place`;
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 			= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 			= $_POST['clientName'];
  $clientContact 		= $_POST['clientContact'];
  //$subTotalValue 		= $_POST['subTotalValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 			= $_POST['discount'];
    $discount = min($discount, $totalAmountValue);
  //$grandTotalValue 		= $_POST['grandTotalValue'];
  //$paid 				= $_POST['paid'];
  //$dueValue 			= $_POST['dueValue'];
  $paymentType 			= $_POST['paymentType'];
  //$gstn 				= $_POST['gstn'];
  $userid 				= $_SESSION['userId'];

        $flag = true;
        if($discount < 0)
        {
            $flag = false;
            $valid['success'] = false;
		 	$valid['messages'] = "Invalid discount!!";
        }
      	
    
        if($flag){
  	    $cnt = array();
  	    $cntOfCustomerQuantity = array();
  	 	 $getQuantities = "SELECT product.product_id, product.quantity FROM product";
  	 	 $getData = $connect->query($getQuantities);
  			 
  	 	 while($temp = $getData->fetch_row())
  	 	 {
  	 	 	if(isset($cnt[$temp[0]]))
  	 	 		$cnt[$temp[0]] = $cnt[$temp[0]] + $temp[1];
  	 	 	else
  	 	 		$cnt[$temp[0]] = $temp[1];
  	 	 }
  	 	// echo json_encode($cnt);
   	for($x = 0; $x < count($_POST['productName']); $x++) {			
	//	 $updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
	//	 $updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		$temp = $_POST['productName'][$x];
		 $left = $cnt[$temp] - $_POST['quantity'][$x];
         if(isset($cntOfCustomerQuantity[$temp]))
         $cntOfCustomerQuantity[$temp] += $_POST['quantity'][$x];
         else
         $cntOfCustomerQuantity[$temp] = $_POST['quantity'][$x];
		// echo $flag;
        $sql = "SELECT product_name from product where product_id=".$temp."";
        $getId=$connect->query($sql);
        $Id=$getId->fetch_row();
		 if($left < 0)
		 {
		 	$flag = false;
		 	$valid['success'] = false;
		 	$valid['messages'] = "Not Sufficient Quantity for ".$Id[0]."";
		 }
		 else
		 	$cnt[$temp] = $cnt[$temp] - $_POST['quantity'][$x];
		}
            
        }
	if($flag){

				
	$sql = "INSERT INTO orders (order_date, client_name, client_contact, total_amount, discount, payment_type,order_status,user_id) VALUES ('$orderDate', '$clientName', '$clientContact', '$totalAmountValue', '$discount', $paymentType, 1,$userid)";
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

    $alreadyInserted = array();
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
            
			   $updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
                if(isset($alreadyInserted[$_POST['productName'][$x]])==false){
            
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity) 
				VALUES ('$order_id', ".$_POST['productName'][$x].", ".$cntOfCustomerQuantity[$_POST['productName'][$x]].")";
                    
                    $alreadyInserted[$_POST['productName'][$x]] = 1;
                    $connect->query($orderItemSql);
                }

						

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
    }
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);
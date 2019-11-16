<?php 	

require_once 'core.php';

$id = $_SESSION['userId'];

$sql = "SELECT order_id, order_date, client_name, client_contact, total_amount, discount FROM orders WHERE order_status = 1";
if(isset($_SESSION['userId']) && $_SESSION['userId']!=1){
    $sql = "SELECT order_id, order_date, client_name, client_contact, total_amount,discount FROM orders WHERE user_id = ".$id." and order_status = 1";
}
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 

 $x = 1;

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM order_item WHERE order_id = $orderId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


    $diff = ($connect->query("SELECT DATEDIFF(NOW(), '$row[1]');"))->fetch_row();
 	// active 
 	

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	   
       <li><a href="orders.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> View</a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>';       
	  
     
     $cancel='';
     
     if($diff[0]==0){
         $button.='<li><a type="button" data-toggle="modal" data-target="#cancelOrderModal" id="cancelOrderModalBtn" onclick="cancelOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Cancel Order</a></li>';
        
     }
     
     
    $button = $button.'</ul></div>';

 	$output['data'][] = array( 		
 		// image
 		$x,
 		// order date
 		$row[1],
 		// client name
 		$row[2], 
 		// client contact
 		$row[3], 		 	
 		$itemCountRow, 		 	
 		$row[4]-$row[5],
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);
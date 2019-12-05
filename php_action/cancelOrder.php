<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$orderId = $_POST['orderId'];

if($orderId) { 

    
    
 $sql = "UPDATE orders SET order_status = 2 WHERE order_id = {$orderId}";

 
        
    $Items = $connect->query("SELECT product_id, quantity from order_item where order_id = {$orderId};");
    
    $updated = 0;

    
    if($Items->num_rows > 0){
        
        while($row = $Items->fetch_array()){
            
            $product_id = $row[0];
            $quantity = $row[1];
            
            $Originalquantity = "SELECT product.quantity from product where product.product_id = {$product_id}";
            $res = $connect->query($Originalquantity);
            
            $updated = $res->fetch_row()[0] + $quantity;
            
            $query = "UPDATE product SET quantity = '".$updated."' where product_id = {$product_id}";
            
            $result = $connect->query($query);
            
            
        }
        
        
        
    }
//$product = "UPDATE product SET quantity = quantity"

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Cancelled";	
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while cancelling the Order";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST
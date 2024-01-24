<?php

require_once 'core.php';

$sql = "SELECT product.product_id, product.product_name, product.unit_cost, product.price,
		SUM(order_item.quantity) as quantity, SUM(order_item.quantity*order_item.price) as sales
		FROM product
		INNER JOIN order_item ON product.product_id=order_item.product_id 
		GROUP BY product.product_id";
$result = $connect->query($sql);

$output = array('data' => array());
$totalProfit = 0; // Variable to store the total profit

if ($result->num_rows > 0) {

    while ($row = $result->fetch_array()) {

        $output['data'][] = array(
            $row['product_id'],
            $row['product_name'],
            number_format($row['unit_cost'],2),
            number_format($row['price'],2),
            $row['quantity'],
            number_format($row['sales'],2)
        );

        // Calculate the total profit
        $totalProfit += $row['sales'];
    } // /while

}

$connect->close();

// Add the total profit row to the output data
$output['data'][] = array(
    '',
    '',
    '',
    '',
    'Total Sales',
    number_format($totalProfit,2)
);

echo json_encode($output);

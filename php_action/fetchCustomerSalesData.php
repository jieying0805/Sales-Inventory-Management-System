<?php

require_once 'core.php';

$sql = "SELECT customers.cust_id, customers.cust_name, COUNT(orders.order_id) AS purchase,
		SUM(order_item.quantity) as quantity, SUM(orders.sub_total) as sub_total
		FROM orders 
		INNER JOIN order_item ON orders.order_id=order_item.order_id 
		INNER JOIN customers ON orders.cust_id=customers.cust_id
		GROUP BY customers.cust_id";
$result = $connect->query($sql);

$output = array('data' => array());
$totalProfit = 0; // Variable to store the total profit

if ($result->num_rows > 0) {

    while ($row = $result->fetch_array()) {

        $output['data'][] = array(
            $row['cust_id'],
            $row['cust_name'],
            $row['purchase'],
            $row['quantity'],
            $row['sub_total'],
        );

        // Calculate the total profit
        $totalProfit += $row['sub_total'];
    } // /while

}

$connect->close();

// Add the total profit row to the output data
$output['data'][] = array(
    '',
    '',
    '',
    'Total Sales',
    number_format($totalProfit,2)
);

echo json_encode($output);

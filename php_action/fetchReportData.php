<?php
require_once 'core.php';

$userId = $_SESSION['userId'];
$sql = "SELECT orders.order_id, orders.order_date, orders.sub_total,
        orders.total_commission 
        FROM orders 
        INNER JOIN order_item ON orders.order_id=order_item.order_id 
        INNER JOIN product ON order_item.product_id=product.product_id
		WHERE orders.user_id=$userId
        GROUP BY orders.order_id";
$result = $connect->query($sql);

$output = array('data' => array());

$totalProfit = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output['data'][] = array(
            $row['order_id'],
            $row['order_date'],
            $row['sub_total'],
            $row['total_commission']
        );

        // Calculate the total profit
        $totalProfit += $row['total_commission'];
    }

    // Add the total profit row to the output data
    $output['data'][] = array(
        '',
        '',
        'Total Commission',
        number_format($totalProfit, 2)
    );
}

$connect->close();

echo json_encode($output);
?>


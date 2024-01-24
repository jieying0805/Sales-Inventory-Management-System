<?php
require_once 'core.php';

$sql = "SELECT orders.order_id, orders.order_date, orders.sub_total, SUM(product.unit_cost*order_item.quantity) AS total_cost,
        orders.total_commission, 
        SUM((product.price*order_item.quantity)-(product.commission*order_item.quantity)-(product.unit_cost*order_item.quantity)) AS profit
        FROM orders 
        INNER JOIN order_item ON orders.order_id=order_item.order_id 
        INNER JOIN product ON order_item.product_id=product.product_id
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
            $row['total_cost'],
            $row['total_commission'],
            $row['profit']
        );

        // Calculate the total profit
        $totalProfit += $row['profit'];
    }

    // Add the total profit row to the output data
    $output['data'][] = array(
        '',
        '',
        '',
        '',
        'Total Sales',
        number_format($totalProfit, 2)
    );
}

$connect->close();

echo json_encode($output);
?>


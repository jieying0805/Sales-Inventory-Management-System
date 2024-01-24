<?php
// Database connection
require_once 'php_action/db_connect.php';

if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Prepare the SQL statement
    $stmt = $connect->prepare("SELECT orders.order_id, orders.order_date, orders.sub_total, SUM(product.unit_cost*order_item.quantity) AS total_cost,
        orders.total_commission, 
        SUM(orders.sub_total-orders.total_commission-(product.unit_cost*order_item.quantity)) AS profit
        FROM orders 
        INNER JOIN order_item ON orders.order_id=order_item.order_id 
        INNER JOIN product ON order_item.product_id=product.product_id
        WHERE orders.order_date BETWEEN ? AND ?
        GROUP BY orders.order_id");
    
    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['order_id'] . '</td>';
            echo '<td>' . $row['order_date'] . '</td>';
            echo '<td>' . number_format($row['sub_total'], 2) . '</td>';
            echo '<td>' . number_format($row['total_cost'], 2) . '</td>';
            echo '<td>' . number_format($row['total_commission'], 2) . '</td>';
            echo '<td>' . number_format($row['profit'], 2) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No results found.</td></tr>';
    }

    $stmt->close();
    $connect->close();
}
?>

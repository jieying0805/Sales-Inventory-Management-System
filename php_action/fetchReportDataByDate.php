<?php
// Database connection
require_once 'core.php';

// Initialize total profit variable
$totalProfit = 0;

// Fetch search results
if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Prepare SQL statement
	$userId = $_SESSION['userId'];
    $stmt = $connect->prepare("SELECT orders.order_id, orders.order_date, orders.sub_total,
        orders.total_commission
        FROM orders 
        INNER JOIN order_item ON orders.order_id=order_item.order_id 
        INNER JOIN product ON order_item.product_id=product.product_id
        WHERE orders.user_id=$userId AND orders.order_date BETWEEN ? AND ?
        GROUP BY orders.order_id");

    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output the search results as table rows
            echo '<tr>';
            echo '<td>' . $row['order_id'] . '</td>';
            echo '<td>' . $row['order_date'] . '</td>';
            echo '<td>' . $row['sub_total'] . '</td>';
            echo '<td>' . $row['total_commission'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No results found.</td></tr>';
    }

    $stmt->close();
}

$connect->close();
?>

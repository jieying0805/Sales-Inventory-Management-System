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
    $stmt = $connect->prepare("SELECT customers.cust_id, customers.cust_name, COUNT(orders.order_id) AS purchase,
		order_item.quantity, orders.sub_total
		FROM orders 
		INNER JOIN order_item ON orders.order_id=order_item.order_id 
		INNER JOIN customers ON orders.cust_id=customers.cust_id
        WHERE orders.order_date BETWEEN ? AND ?
		GROUP BY customers.cust_id");

    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output the search results as table rows
            echo '<tr>';
            echo '<td>' . $row['cust_id'] . '</td>';
            echo '<td>' . $row['cust_name'] . '</td>';
            echo '<td>' . $row['purchase'] . '</td>';
            echo '<td>' . $row['quantity'] . '</td>';
            echo '<td>' . $row['sub_total'] . '</td>';
            echo '</tr>';

            // Sum up the profit
            $totalProfit += $row['subt_total'];
        }
    } else {
        echo '<tr><td colspan="6">No results found.</td></tr>';
    }

    $stmt->close();
}

$connect->close();
?>



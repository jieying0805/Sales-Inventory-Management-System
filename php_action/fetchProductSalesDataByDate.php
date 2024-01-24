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
	$stmt = $connect->prepare("SELECT product.product_id, product.product_name, product.unit_cost, product.price,
		order_item.quantity, SUM(order_item.quantity*order_item.price) as sales
		FROM product
		INNER JOIN order_item ON product.product_id=order_item.product_id
		INNER JOIN orders ON order_item.order_id = orders.order_id
		WHERE orders.order_date BETWEEN ? AND ?
		GROUP BY product.product_id");

    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output the search results as table rows
            echo '<tr>';
            echo '<td>' . $row['product_id'] . '</td>';
            echo '<td>' . $row['product_name'] . '</td>';
            echo '<td>' . $row['unit_cost'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>' . $row['quantity'] . '</td>';
            echo '<td>' . $row['sales'] . '</td>';
            echo '</tr>';

            // Sum up the profit
            $totalProfit += $row['sales'];
        }
    } else {
        echo '<tr><td colspan="6">No results found.</td></tr>';
    }

    $stmt->close();
}

$connect->close();
?>



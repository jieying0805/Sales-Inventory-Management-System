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
    $stmt = $connect->prepare("SELECT agents.agent_id, agents.agent_name, COUNT(customers.agent_id) AS cust,
		COUNT(orders.order_id) AS no,
		orders.sub_total, orders.total_commission,
		SUM(orders.total_commission-commission.amount) as unpaid
		FROM agents
		INNER JOIN customers ON agents.agent_id=customers.agent_id 
		INNER JOIN users ON agents.user_id=users.user_id
		INNER JOIN orders ON orders.user_id=users.user_id
		INNER JOIN commission ON agents.agent_id=commission.agent_id
        WHERE orders.order_date BETWEEN ? AND ?
		GROUP BY agents.agent_id");

    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output the search results as table rows
            echo '<tr>';
            echo '<td>' . $row['agent_id'] . '</td>';
            echo '<td>' . $row['agent_name'] . '</td>';
            echo '<td>' . $row['cust'] . '</td>';
            echo '<td>' . $row['no'] . '</td>';
            echo '<td>' . $row['sub_total'] . '</td>';
            echo '<td>' . $row['total_commission'] . '</td>';
            echo '<td>' . $row['unpaid'] . '</td>';
            echo '</tr>';

            // Sum up the profit
            $totalProfit += $row['unpaid'];
        }
    } else {
        echo '<tr><td colspan="6">No results found.</td></tr>';
    }

    $stmt->close();
}

$connect->close();
?>

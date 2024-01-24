<?php

require_once 'core.php';

$sql = "SELECT agents.agent_id, agents.agent_name, COUNT(customers.agent_id) AS cust,
		COUNT(orders.order_id) AS no,
		SUM(orders.sub_total) AS sub_total, SUM(orders.total_commission) AS total_commission,
		SUM(orders.total_commission-commission.amount) as unpaid
		FROM agents
		INNER JOIN customers ON agents.agent_id=customers.agent_id 
		INNER JOIN users ON agents.user_id=users.user_id
		INNER JOIN orders ON orders.user_id=users.user_id
		INNER JOIN commission ON agents.agent_id=commission.agent_id
		GROUP BY agents.agent_id";
$result = $connect->query($sql);

$output = array('data' => array());
$totalProfit = 0; // Variable to store the total profit

if ($result->num_rows > 0) {

    while ($row = $result->fetch_array()) {

        $output['data'][] = array(
            $row['agent_id'],
            $row['agent_name'],
            $row['cust'],
            $row['no'],
            $row['sub_total'],
            $row['total_commission'],
            $row['unpaid']
        );

        // Calculate the total profit
        $totalProfit += $row['unpaid'];
    } // /while

}

$connect->close();

// Add the total profit row to the output data
$output['data'][] = array(
    '',
    '',
    '',
	'',
	'',
    'Total Commission Unpaid',
    number_format($totalProfit,2)
);

echo json_encode($output);

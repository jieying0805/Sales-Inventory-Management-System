<?php
require_once 'core.php';

$output = array('data' => array());

if ($_SESSION['typeId'] == 2) {
    $agentId = $_SESSION['agentId'];
    $sql = "SELECT * FROM customers
            INNER JOIN agents ON customers.agent_id = agents.agent_id WHERE agents.agent_id=$agentId";
} elseif ($_SESSION['typeId'] == 1) {
    $sql = "SELECT * FROM customers
            LEFT JOIN agents ON customers.agent_id = agents.agent_id";
}

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $customerId = $row[0];

        $button = '<!-- Single button -->
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a type="button" data-toggle="modal" id="editCustomerModalBtn" data-target="#editCustomerModal" onclick="editCustomer('.$customerId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
            <li><a type="button" data-toggle="modal" data-target="#removeCustomerModal" id="removeCustomerModalBtn" onclick="removeCustomer('.$customerId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
          </ul>
        </div>';

        $agentid = $row[4];
        if ($agentid == 0) { // Use == for comparison
            $agent = "";
        } else {
            $agent = $row[6];
        }

        $output['data'][] = array(
            // customer ID
            $customerId,
            // rate
            $row[1],
            // quantity
            $row[2],
            // brand
            $row[3],
            $agent,
            $button
        );
    } // /while
} // if num_rows

$connect->close();

echo json_encode($output);

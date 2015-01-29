<?php 
if(session_id()==''){
	session_start();
}
require_once('MCAPI.class.php');

$mcKey = $_SESSION['mc_api_key'];
$mcID = $_SESSION['mc_list_id'];

$api = new MCAPI($mcKey);

$retval = $api->listMembers($mcID, 'subscribed', null, 0, 5000);

if ($api->errorCode){
	echo "Unable to load MailChimp Subscribers!";
	echo "Make sure your API Key and List ID are Correct.";
} else {
	echo '<table class="wp-list-table widefat fixed" style="max-width:768px;">';
	echo '<thead>';
	echo '<th>Subscribers</th>';
	echo '</thead>';
	echo '<tbody>';
	foreach($retval['data'] as $member){
	    echo '<tr>';
	    echo '<td>'.$member['email']."</td>";
	    echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
}

?>
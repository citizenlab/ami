<?php
require_once('private/db/db_connection.php');
$db_conn = connect();
$result = $db_conn->query("SELECT company, DATE(request_date) as request_date, COUNT(DISTINCT request_id) as requests from stats GROUP BY company, DATE(request_date) ORDER BY DATE(request_date) DESC");
?>
<table>
<tr>
<th>
Request Date
</th>
<th>
Company
</th>
<th>
Requests
</th>
</tr>
<?PHP
while($row = $result->fetch_array())
  {
?>
  	<tr>
  	<td>
  	<?PHP echo $row['request_date']; ?>
  	</td>
  	<td>
  	<?php echo $row['company']; ?>
  	</td>
  	<td style="font-family:monospace;">
  	<?php echo $row['requests']; ?>
  	</td>
  	</tr>
  	<?php
  }
  close($db_conn);
  ?>
 </table>

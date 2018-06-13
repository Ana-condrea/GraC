<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$document = new Dompdf();


//$document->loadHtml($page);

$connect = mysqli_connect("localhost", "root", "", "project");

$query = "SELECT Id, Name, Description,Price,Category FROM Autograph";

$result = mysqli_query($connect, $query);
$output = " 
<style>
	table {
		font-family : arial , sans-serif;
		border-collapse: collapse;
		width : 100%;
	}
	td,th {
		border: 2px solid #dddddd;
		text-alin: left;
		padding: 8px;
	}
	tr:first-child {
		background-color: #dddddd;
	}

</style>
<table>
	<tr>
		<th>Name</th>
		<th>Category</th>
		<th>Description</th>
		<th>Price</th>
	</th>
";
while($row = mysqli_fetch_array($result))
{	$output .= '
		<tr>
			<td>'.$row["Name"].'</td>
			<td>'.$row["Category"].'</td>
			<td>'.$row["Description"].'</td>
			<td>'.$row["Price"].'$</td>
		</tr>
	';
}

$output .= '</table>';

$document->loadHtml($output);

$document->setPaper('A4', 'landscape');

$document->render();

$document->stream("Web", array("Attachment"=>0));



?>
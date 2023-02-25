<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Manufacturer Query</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
$state = $_POST['state'];

$state = mysqli_real_escape_string($conn, $state);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT DISTINCT c.fname, c.lname, s.description
	FROM customer c
	JOIN orders o USING (customer_num)
    JOIN items i USING (order_num)
    JOIN stock s USING (stock_num)
    JOIN manufact m ON (s.manu_code=m.manu_code)
	WHERE m.manu_name = "."'".$state."'"."
	ORDER BY c.lname;";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[firstName]  $row[lastName]  $row[item]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="findOrdersState.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  
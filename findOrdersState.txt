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

$query = "SELECT DISTINCT firstName, lastName, city FROM customer WHERE state = ";
$query = $query."'".$state."' ORDER BY 2;";

$query = "SELECT DISTINCT c.fname, c.lname, s.description ";
$query = $query."FROM customer c ";
$query = $query."JOIN orders o USING (customer_num) ";
$query = $query."JOIN items i USING (order_num) ";
$query = $query."JOIN stock s USING (stock_num) ";
$query = $query."JOIN manufact m ON (s.manu_code=m.manu_code) ";
$query = $query."WHERE m.manu_name = "."'".$state."' ";
$query = $query."ORDER BY c.lname;";

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
    print "$row[fname]  $row[lname]  $row[description]";
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
	  
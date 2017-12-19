<?php
$year = intval($_GET['year']);
$gender = $_GET['gender'];
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'HW3';
$con = new mysqli($host,$user,$pass,$db);
if($year!="" && $gender!=""){
$sql="SELECT * FROM BabyNames WHERE year = '".$year."' and gender='".$gender."' and ranking<=5 order by ranking";
$result = mysqli_query($con,$sql);
echo "<table border='1'><tr><th>Name</th><th>Year</th><th>Ranking</th><th>Gender</th></tr>";
while($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
	echo "<td>" . $row[1] . "</td>";
	echo "<td>" . $row[2] . "</td>";
	echo "<td>" . $row[3] . "</td>";
	echo "</tr>";
	}
echo "</table>";
}
elseif($year!=""){
$sql_m="SELECT * FROM BabyNames WHERE year = '".$year."' and gender='m' and ranking<=5 order by ranking, gender";
$result_m = mysqli_query($con,$sql_m);
$sql_f="SELECT * FROM BabyNames WHERE year = '".$year."' and gender='f' and ranking<=5 order by ranking, gender";
$result_f = mysqli_query($con,$sql_f);

echo "<table border='1'><col>
  <colgroup span=\"2\"></colgroup>
  <colgroup span=\"2\"></colgroup>
  <tr>
    <td rowspan=\"2\"></td>
    <th colspan=\"2\" scope=\"colgroup\">Male</th>
    <th colspan=\"2\" scope=\"colgroup\">female</th>
  </tr>
  <tr><th scope=\"col\">Name</th><th scope=\"col\">Ranking</th><th scope=\"col\">Name</th><th scope=\"col\">Ranking</th></tr>";
while($row_m = mysqli_fetch_array($result_m)){
	$row_f = mysqli_fetch_array($result_f);
	echo "<tr>";
	echo "<th scope=\"row\">" . $row_m[1] . "</th>";
	echo "<td>" . $row_m[0] . "</td>";
	echo "<td>" . $row_m[2] . "</td>";
	echo "<td>" . $row_f[0] . "</td>";
	echo "<td>" . $row_f[2] . "</td>";
	echo "</tr>";
	}
echo "</table>";
}
elseif($gender!=""){
$sql="SELECT distinct year FROM BabyNames";
$result_y = mysqli_query($con,$sql);
while($row_y = mysqli_fetch_array($result_y)){	
$sql="SELECT * FROM BabyNames WHERE gender='".$gender."'and year = '".$row_y[0]."' and ranking<=5 order by year,ranking";
$result = mysqli_query($con,$sql);
echo "<table border='1'><caption>
    Most Popular Names for ".$row_y[0]."
  </caption><tr><th>Name</th><th>Ranking</th></tr>";
while($row = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
	echo "<td>" . $row[2] . "</td>";
	echo "</tr>";
	}
echo "</table>";
}
}
else {
$sql="SELECT distinct year FROM BabyNames";
$result_y = mysqli_query($con,$sql);
while($row_y = mysqli_fetch_array($result_y)){	
$sql_m="SELECT * FROM BabyNames WHERE gender='m'and year = '".$row_y[0]."' and ranking<=5 order by year,ranking";
$sql_f="SELECT * FROM BabyNames WHERE gender='f'and year = '".$row_y[0]."' and ranking<=5 order by year,ranking";
$result_m = mysqli_query($con,$sql_m);
$result_f = mysqli_query($con,$sql_f);
echo "<table border='1'><caption>
    Most Popular Names for ".$row_y[0]."
  </caption><colgroup span=\"2\"></colgroup>
  <colgroup span=\"2\"></colgroup>
  <tr>
    <td rowspan=\"2\"></td>
    <th colspan=\"2\" scope=\"colgroup\">Male</th>
    <th colspan=\"2\" scope=\"colgroup\">female</th>
  </tr>
  <tr><th scope=\"col\">Name</th><th scope=\"col\">Ranking</th><th scope=\"col\">Name</th><th scope=\"col\">Ranking</th></tr>";
while($row_m = mysqli_fetch_array($result_m)){
	$row_f = mysqli_fetch_array($result_f);
	echo "<tr>";
	echo "<th scope=\"row\">" . $row_m[1] . "</th>";
	echo "<td>" . $row_m[0] . "</td>";
	echo "<td>" . $row_m[2] . "</td>";
	echo "<td>" . $row_f[0] . "</td>";
	echo "<td>" . $row_f[2] . "</td>";
	echo "</tr>";
	}
echo "</table>";
}


}
mysqli_close($con);
?> 

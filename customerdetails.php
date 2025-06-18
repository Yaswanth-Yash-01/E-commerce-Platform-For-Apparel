<?php

include 'dbconnection.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM customers";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
   
    echo "<table>";
    
  
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Email</th>";
    echo "<th>Name</th>";
    echo "<th>Password</th>";
    echo "</tr>";

    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["cust_id"] . "</td>";
        echo "<td>" . $row["cust_email"] . "</td>";
        echo "<td>" . $row["cust_name"] . "</td>";
        echo "<td>" . $row["cust_password"] . "</td>";
        echo "</tr>";
    }

   
    echo "</table>";
} else {
    echo "No customers found.";
}


$conn->close();
?>

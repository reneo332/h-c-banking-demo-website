<!DOCTYPE html>
<html>
<head>
<style>
body {background-color: white;}
h1   {color: darkblue;
        font-family: verdana;}
p    {color: goldenrod;
        font-family: verdana;}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: darkblue;
}

li {
  float: left;
}

li a {
  display: block;
  color: goldenrod;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover{
  background-color: grey;
}


.btn-link {
    border: none;
    outline: none;
    background: none;
    cursor: pointer;
    color: #0000EE;
    padding: 0;
    text-decoration: underline;
    font-family: inherit;
    font-size: inherit;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
 }
 
</style>

</head>
<body>
<img src="HCLogo.png" alt="Logo" width = 5%; height = auto;>
<h1>H&C Banking</h1>


<p>Welcome to H&C Banking</p>
<ul>
  <li><a href="Accounts.php">Home</a></li>
  <li><a href="Transfer.php">Transfer | Zelle</a></li>
  <li style = "float:right;"><a href="About.php">About</a></li>
</ul>
<br>
<br>

<div id="table">
<?php
include "db_connection.php";
$conn = OpenCon();

$sql= "SELECT AccountNumber,AccountType,Balance FROM accounts WHERE UserID = '1'";
$result = $conn->query($sql);
$table = "";
    foreach($result as $a) 
    {            
      $table = $table. '<tr><td>'.$a["AccountType"].'</td>
      <td><form action = "Checkings.php" method = "post"><button type="submit" name="btn-link" value="'.$a["AccountNumber"].'" class="btn-link" >'.$a["AccountNumber"].'</button></form></td>
      <td>'.$a["Balance"].'</td></tr>';
    }
  ?>  
  <html> <table id="myTable">
    <tr class="header">
      <th style = "width:33%;" >Account Type</th>
      <th style = "width:33%;" >Account #</th>
      <th style = "width:33%;" >Account Balance</th>
    </tr>
 </html>
<?php 
 echo $table;   
 CloseCon($conn);
?>
</table>
</div>

</body>
</html>
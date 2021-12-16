<html>
<head>

<meta charset="utf-8" />
  <title>jQuery UI Accordion - Collapse content</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
  $(function() {
    $( "#accordion" ).accordion({
      collapsible: true,
      active: false
    });
  });
  </script>
  
<style>
.ui-accordion-header {color: darkblue;
        font-family: verdana;}
body {background-color: white;}
h1   {color: darkblue;
        font-family: verdana;}
h3   {color: darkblue;
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


/* #myTable {
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
 } */
 
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

<div id="accordion">
<?php
include "db_connection.php";
$conn = OpenCon();

$accountNumber = mysqli_real_escape_string($conn,$_POST['btn-link']);

$sql= "SELECT PaymentID, PaymentDate,PaymentAmount,Memo, Balance FROM paymentactivity_1 INNER JOIN accounts ON paymentactivity_1.AccountNumber = accounts.AccountNumber  WHERE paymentactivity_1.Accountnumber = '$accountNumber' ORDER BY PaymentID DESC";
$result = $conn->query($sql);
$accordian = "";
$tempBalance = 0;
$currentBalance = 0;
    foreach($result as $a) 
    { 
      $currentBalance = $a["Balance"] + $tempBalance;
      $accordian = $accordian. '<h3>'.$a["PaymentDate"].' - '.$a["Memo"].' </h3>
       <div>
       <p style = "font-weight:bold;">                
          Transaction Amount <span style = "float:right;"> Current Balance </span>
       </p>
       <p>                
         '.$a["PaymentAmount"].' <span style = "float:right;"> '.$currentBalance.'</span>
       </p>
       </div>';
       $tempBalance = $tempBalance - $a["PaymentAmount"];
    }
 echo $accordian;  
CloseCon($conn);
?>
</div>
<!-- <h3>Checkings Account History</h3>
<table id="myTable">
  <tr class="header">
    <th style="width:25%;">Date</th>
    <th style="width:25%;">Description</th>
    <th style="width:25%;">Amount</th>
    <th style="width:25%;">Available Balance</th>
  </tr>
  <tr>
    <td> <a href="Transfer.php">Processing</a></td>
    <td>BILL PAY HOLD ONLINE PAYMENT ON 10/22</td>
    <td>-359.07</td>
    <td>2,491.99</td>
  </tr>
  <tr>
    <td>10/21/2021</td>
    <td>VENMO DES: PAYMENT ID:XXXXXX458 INDN: JONAH ANDRES CO ID: XXXXXX213 WEB</td>
    <td>-2.70</td>
    <td>2,494.69</td>
  </tr>
  <tr>
    <td>10/03/2021</td>
    <td>POS Withdrawal Riot* / AN23QH8YTUQQ 866-373-9011 CAUS </td>
    <td>-49.99 </td>
    <td>2,544.68</td>
  </tr> -->
  
<!-- </table> -->
    

</body>
</html>
<html>
<head>
<style>
body {background-color: white;}
h1   {color: darkblue;
        font-family: verdana;}
h3   {text-align: center;
      color: darkblue;
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

input[name="Destination"]::-webkit-outer-spin-button,
input[name="Destination"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
</head>
<body>
    <img src="HCLogo.png" alt="Logo" width =5% height = auto; >
    <h1>H&C Banking</h1>
 <p>Welcome to H&C Banking</p>
<ul>
  <li><a href="Accounts.php">Home</a></li>
  <li><a href="Transfer.php">Transfer | Zelle</a></li>
  <li style = "float:right;"><a href="About.php">About</a></li>
</ul>
<br>
    <br>
    <h3>
    <form id ="Transfer" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
    <h3>
    <label for="Source"><b>Source Account Number: <b></label>
    <select name ="Source" id ="Source" form = "Transfer" required>
    <?php
      include "db_connection.php";
        $conn = OpenCon();

        $sql= "SELECT AccountNumber, Balance FROM accounts WHERE UserID = '1'";
        $result = $conn->query($sql);
        $options = "";
    foreach($result as $a) 
    {            
      $options = $options. '<option>' .$a["AccountNumber"]. "</option>";
    }
    echo $options;
    CloseCon($conn);   
    ?>
    </select>
    </h3>
    <br>
    <label for="destAcct"><b>Destination Account Number: <b></label>
    <label for = "Destination"> </label> 
    <input type="number" name ="Destination" required>
    </h3>
    <br>
    <h3>
    <label for="amnt"><b>Amount to send: <b></label>
    <input type="number" min="1" step="0.01" name="amnt" required>
    <div>
      <?php

        $conn = OpenCon();

         if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
          $Source = mysqli_real_escape_string($conn,$_POST['Source']);
          $Destination = mysqli_real_escape_string($conn,$_POST['Destination']);
          $Amnt = mysqli_real_escape_string($conn,$_POST['amnt']); 
          $destTestQuery = "SELECT AccountNumber, Balance FROM accounts WHERE UserID = '1' AND AccountNumber = '$Destination'";
          $destTest = $conn->query($destTestQuery);
          
          if ($Destination == $Source) 
          {
            echo "<label style='color:red;'>Must be two different accounts</label>";
          }
          else if($destTest->num_rows > 0)
          {
            $sql = "SELECT Balance FROM accounts WHERE AccountNumber='$Source' OR '$Destination'";
            $balances = $conn->query($sql);
            
            $i = 0;
            $row = array();

            foreach($balances as $test)
            { 
              $row[$i] = implode("",$test);
              $i = $i + 1;
            }

            if ($row[0] > $Amnt) 
            {
            $newSourceBalance = $row[0] - $Amnt;
            $newDestBalance = $row[1] + $Amnt;
            $sourceInstert = "INSERT INTO paymentactivity_1 (PaymentID, AccountNumber, PaymentDate, PaymentAmount, Memo) VALUES ('', '$Source', '" .date("Y/m/d"). "', -'$Amnt', 'Transfer')";
            $destInstert = "INSERT INTO paymentactivity_1 (PaymentID, AccountNumber, PaymentDate, PaymentAmount, Memo) VALUES ('', '$Destination', '" .date("Y/m/d"). "', '$Amnt', 'Transfer')";
            $sourceUpdate = "UPDATE accounts SET Balance = '$newSourceBalance' WHERE accounts.AccountNumber = '$Source' AND accounts.UserID = 1";
            $destUpdate = "UPDATE accounts SET Balance = '$newDestBalance'  WHERE accounts.AccountNumber = '$Destination' AND accounts.UserID = 1";
            $conn->query($sourceUpdate);
            $conn->query($destUpdate);
            $conn->query($destInstert);
            $conn->query($sourceInstert);
            } 
            else
            {
            echo "<label style='color:red;'>Can not send more money than in source account</label>";
            }
          } 
          else
          {
            echo "<label style='color:red;'>Destination Account Number does not exist please enter a valid account number</label>";
          }
        }
        CloseCon($conn);
      ?>
    </div>
    <br>
    <input type="submit">
    </h3>
</form>
</body>
</html>
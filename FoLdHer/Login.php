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

</style>
</head>
<body>
<img src="HCLogo.png" alt="Logo" width =10% height = auto; >
<h1>H&C Banking</h1>
<p>Welcome to H&C Banking</p>

<ul>
  <li><a href="#home">Home</a></li>
</ul>
<br>
<br>

<form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
  <div class="imgcontainer">
  </div>
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <br>
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
  <div>
  <?php
include "db_connection.php";
$conn = OpenCon();

$myusername = $mypassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $myusername = mysqli_real_escape_string($conn,$_POST['uname']);
  $mypassword = mysqli_real_escape_string($conn,$_POST['psw']); 

  $sql = "SELECT UserID, Username, Password FROM userlogin WHERE Username='$myusername' AND Password='$mypassword'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
  header("location: Accounts.php");
}
else
{
  echo "<label style='color:red;'>Wrong Username or Password</label>";
} 
}
CloseCon($conn);
?> 
</div>
</form>
</body>
</html> 
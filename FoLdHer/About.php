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

.float-container {
  display: flex;
}

.float-child {
    flex: 1;
    justify-content: center;
    align-items: center;
    text-align: center;
  
} 

.float-child img {
    flex-shrink: 0;
    min-width: 100%;
    min-height: 100%;  
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
  <li style = "float:right;"><a href="#about">About</a></li>
</ul>
<br>
<br>

<div class="float-container">
 <div class="float-child">
 <img src="Candice.png" alt="Candice" height = auto;>
 <p><b> Candice</b> </p>
 </div>
 <div class="float-child">
 <img width = 50% src="Scuffed.jpg" alt="Balls" height = auto;>
 <p><b> Ball</b> </p>
 </div>
 <div class="float-child">
 <img  src="Joner.png" alt="Howard" height = 300px;>
 <p><b> Howard</b></p>
 </div>
</div>

</body>
</html>
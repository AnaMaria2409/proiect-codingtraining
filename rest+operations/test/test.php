<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="/rest.php" method="POST">
  <input type="text" name="user" >
   <input type="text" name="pass" >
  <input type="submit" value="Submit">
</form> 

<form action="/rest.php" method="GET">
  <input type="text" name="token" >
  <input type="text" name="operation" >
    <input type="number" name="id" >

  <input type="submit" value="Submit">
</form> 
</body>
</html>

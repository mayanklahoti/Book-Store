<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
body {background-color: #4b4743}
</style>
</head>
<body>  

<?php
$nameErr = $emailErr = $genderErr = $commentErr= "";
$name = $email = $gender = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    

  if (empty($_POST["comment"])) {
    $commentErr = "Comment is required";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2 align="center">Feedback</h2>
<p align="center"><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<table align="center">
<tr>
<td>
  Name: </td><td><input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span></td></tr>
  <br><br><tr><td>&nbsp;</td></tr>
<tr>
<td>
  E-mail: </td><td><input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span></td></tr>
  <br><br><tr><td>&nbsp;</td></tr>
<tr>
<td>
  Comment: </td><td><textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
<span class="error">* <?php echo $commentErr;?></span></td></tr>
  <br><br><tr><td>&nbsp;</td></tr>
<tr>
<td>
  Gender: </td><td>
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <span class="error">* <?php echo $genderErr;?></span></td></tr>
  <br><br><tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td></td>
<td>
  <input type="submit" name="submit" value="Submit">  
</td>
</tr>
</table>
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>
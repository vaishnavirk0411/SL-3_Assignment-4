<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=Philosopher' rel='stylesheet' type='text/css'>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr  = $websiteErr = "";
$name = $email  = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $websiteErr = "URL is required";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2 style="margin-top: 70px;
  margin-left: 630px; font-family: 'Philosopher',serif;">PHP FORM</h2>
<p><span class="error"></span></p>
<form class="form" method="post" style="margin-top: 10px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <div class="container" style="padding: 10%;">&nbsp&nbsp&nbsp&nbsp&nbspName:&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"><br>*<?php echo $nameErr;?></span>
  <br><br>
  &nbsp&nbsp&nbsp&nbsp&nbspE-mail:&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error"><br>* <?php echo $emailErr;?></span>
  <br><br>
  &nbsp&nbsp&nbsp&nbspWebsite:&nbsp&nbsp <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><br>* <?php echo $websiteErr;?></span>
  <br><br>
  

  <br><br><div style="text-align: center; ">
    <button class="button" id="sub" type="submit" name="submit" value="Submit" style="background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px;
">Submit</button>
  </div>
  
</div>
</form>

</body>
</html>
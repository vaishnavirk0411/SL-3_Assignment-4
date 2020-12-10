<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=Philosopher' rel='stylesheet' type='text/css'>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr  = $websiteErr =  $passwordErr= $cpasswordErr="";
$name = $email  = $website = $password= $cpassword= "";

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
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";}
    if (empty($_POST["cpassword"])) {
    $cpasswordErr = "Confirm password is required";}
//Validates password & confirm passwords.
    if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"]))
     {
        $password = test_input($_POST["password"]);
        $cpassword = test_input($_POST["cpassword"]);
        if (strlen($_POST["password"]) <= '8') {
            $passwordErr = "Your Password Must Contain At Least 8 Characters!";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }
      }
     elseif(!empty($_POST["password"])) {
    $cpasswordErr = "Please enter same Password!";
       } else {
     $passwordErr = "Please enter password   ";
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
  <div class="container" style="padding: 10%;">Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"><br>*<?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error"><br>* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><br>* <?php echo $websiteErr;?></span>
  <br><br>
  Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error"><br>* <?php echo $passwordErr;?></span>
  <br><br>
  Confirm Password: <input type="password" name="cpassword" value="<?php echo $cpassword;?>">
  <span class="error"><br>* <?php echo $cpasswordErr;?></span>
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
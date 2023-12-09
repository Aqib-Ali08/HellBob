<?php
$msg = '';
require('../config/db.php');
require('../connection.inc.php');
require('../functions.inc.php');
if (isset($_POST['submit'])) {
  $email = get_safe_value($conn, $_POST['email']);
  $password = get_safe_value($conn, $_POST['password']);
  $sql = "select * from admin where email='$email'and password='$password'";
  $res = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($res);
  if ($count > 0) {
    $_SESSION['Admin_Login'] = 'yes';
    $_SESSION['Admin_Email'] = $email;
    header('Location:adminform.php');
    die();
  } else {
    $msg = 'Please enter correct login details';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./style_login.css" />
</head>

<body>
  <section class="login-box">
    <span>Login</span>


    <form method="post">
      <div class="username">
        <label for="username">Email:</label>
        <input type="text" id="email" name="email" required>
      </div>

      <div class="password">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit" name='submit'>Login</button>

    </form>
    <div class="fielderror"><?php echo $msg ?> </div>

  </section>
</body>

</html>

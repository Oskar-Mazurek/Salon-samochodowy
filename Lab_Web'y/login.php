<?php include('secure.php') ?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
<?php
function setMyCookie($cookieName, $cookieValue, $cookieExpireDate)
{
  setcookie($cookieName, $cookieValue, time() + ($cookieExpireDate * 86400), "/");
}

function readMyCookie($cookieName)
{
  if (!isset($_COOKIE[$cookieName])) {
    return null;
  } else {
    return $_COOKIE[$cookieName];
  }
}

function deleteMyCookie($cookieName)
{
  if (isset($_COOKIE[$cookieName])) {
    unset($_COOKIE[$cookieName]);
    setcookie($cookieName, null, -1, '/');
    return true;
  } else {
    return false;
  }
}
?>

<head>
  <meta charset="utf-8" />
  <title>Salon samochodowy - Logowanie</title>
  <link href="images/sport-car-1768.png" rel="icon" type="image/png">
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .logowanie {
      font-weight: bold;
    }

    #formularz {
      border: solid gray 1px;
      width: 30%;
      border-radius: 2px;
      margin: 120px auto;
      padding: 50px;
    }

    a {
      color: black;
      background-color: #D3D3D3;
      text-decoration: none;
      height: 1.2em;
      padding: 3px 6px;
      margin: 10px 0;
      border-left: 2px solid white;
      border-top: 2px solid white;
      border-right: 2px solid black;
      border-bottom: 2px solid black;
      border-radius: 10px;
    }

    #btn {
      color: black;
      background-color: #D3D3D3;
      text-decoration: none;
      height: 1.2em;
      padding: 3px 6px;
      margin: 10px 0;
      border-left: 2px solid white;
      border-top: 2px solid white;
      border-right: 2px solid black;
      border-bottom: 2px solid black;
      border-radius: 10px;
      padding: 7px;
      margin-left: 60%;
      height: auto;
    }
  </style>
</head>

<body>
  <div>

    <hr />
  </div>
  <div id="error">
    <?php if (count($errors) > 0) : ?>
      <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
      <?php endforeach ?>
    <?php endif ?>
  </div>
  <div id="formularz">
    <h2>Logowanie</h2>
    <form action="login.php" method="POST">
      <ul class="flex">

        <li class="form-group">
          <label for="uName">Nazwa u&#380;ytkownika:</label>
          <input type="text" name="uName" size=20 maxsize=30 required /><br />
        </li>
        <li class="form-group">
          <label for="pass">Has&#322;o:</label>
          <input type="password" name="pass" size=20 maxsize=50 required /><br />
        </li>

        <li class="form-group">
          <button type="submit" id="btn" name="Logowanie" id="przycisk">Zaloguj</button>
        </li>
        <li class="form-group">
          <p>
            Nie masz konta?
            <a href="register.php">Rejestracja</a>
            <a class="link" href="index.php">Strona główna</a>
            <?php
            $flag = 0;
            if (isset($_POST['Logowanie'])) {
              $username = $_POST['uName'];
              $password = md5($_POST['pass']);
              $dbHost = 'localhost';
              $dbUser = 'root';
              $dbPass = '';
              $dbName = "myDB";
              $dbTableName = "uzytkownicy";

              // Create connection
              $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $username = stripcslashes($username);
              $password = stripcslashes($password);
              $username = mysqli_real_escape_string($conn, $username);
              $password = mysqli_real_escape_string($conn, $password);

              $sql = "SELECT *FROM uzytkownicy WHERE user = '$username' AND password = '$password'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              $count = mysqli_num_rows($result);


              if ($count == 1) {
                echo "<div class='logowanie' style=color:green;> Zalogowano </div>";
                $flag = 1;
                setMyCookie("flag", $flag, 1);
              } else {
                echo "<div class='logowanie' style=color:red;> Niezalogowano. Nieprawidłowa nazwa użytkownika lub hasło.</div>";
                $flag = 0;
                setMyCookie("flag", $flag, 1);
              }
              $conn->close();
            }
            ?>
          </p>
        </li>
      </ul>
    </form>
  </div>
</body>

</html>
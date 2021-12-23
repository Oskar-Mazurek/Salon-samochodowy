<?php include('secure.php') ?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Salon samochodowy - Rejestracja</title>
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
    <h2>Rejestracja</h2>
    <form action="register.php" method="POST">
      <ul class="flex">
        <li class="form-group">
          <label for="fName">Imie:</label>
          <input type="text" name="fName" size=20 maxsize=30 required /><br />
        </li>
        <li class="form-group">
          <label for="lName">Nazwisko:</label>
          <input type="text" name="lName" size=20 maxsize=30 required /><br />
        </li>
        <li class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <label for="uName">Nazwa u&#380;ytkownika:</label>
          <input type="text" name="uName" size=20 maxsize=30 required /><br />
        </li>
        <li class="form-group">
          <label for="pass">Has&#322;o:</label>
          <input type="password" name="pass" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <label for="rpass">Powt&#243;rzone has&#322;o:</label>
          <input type="password" name="rpass" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <button type="submit" id="btn" name="rejestracja" id="przycisk">Zarejestruj</button>
        </li>
        <li class="form-group">
          <p>
            Masz ju&#380; konto?
            <a href="login.php">Logowanie</a>
            <a class="link" href="index.php">Strona&#160;główna</a>
            <?php
            if (isset($_POST['rejestracja'])) {
              $fName = $_POST['fName'];
              $lName = $_POST['lName'];
              $uName = $_POST['uName'];
              $email = $_POST['email'];
              $pass = md5($_POST['pass']);
              $rpass = md5($_POST['rpass']);
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
              $result = $conn->query("SELECT user FROM uzytkownicy WHERE user='$uName'");
              if (mysqli_num_rows($result) > 0) {
                echo "<div class='logowanie' style=color:red>Podana nazwa użytkownika jest już zajęta</div>";
              } elseif (mysqli_num_rows($result) == 0) {
                if ($pass != $rpass) {
                  echo '<div class="logowanie" style=color:red>Podane hasła nie są takie same</div>';
                } elseif ($pass === $rpass) {
                  $sql = "INSERT INTO uzytkownicy (imie, nazwisko, email, user, password)
            VALUES ('$fName', '$lName', '$email', '$uName', '$pass')";
                  if ($conn->query($sql) === TRUE) {
                    echo "<div class='logowanie' style=color:green>Rejestracja przebiegła pomyślnie</div>";
                  } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                }
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
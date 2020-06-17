<?php

INCLUDE $_SERVER['DOCUMENT_ROOT'] .'/configs/db.php';

if(
    isset($_POST["email"]) && isset($_POST["password"])
    && $_POST["email"] != "" && $_POST["password"] != ""
) {
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email LIKE '" . $_POST["email"] . "' AND password LIKE '" . $password .  "'";
    $result = mysqli_query($connect, $sql);
    $number_ofusers = mysqli_num_rows($result);
    if ($number_ofusers == 1) {
        $user = mysqli_fetch_assoc($result);
        setcookie("user_id", $user["id_user"], time() + 600);
        header("Location: /"); 
    } else {
        echo "<h2>Логин или пароль введены не верно</h2>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Autorisation</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" href="assets/style.css"/>
</head>
<body>
    <div id="content">
        <h2>Autorisation</h2>
        <form class="form-inline my-2 my-lg-0 col-3" action="login.php" method="POST">
            <p>
                Please input your email: <br/>
                <input class="form-control mr-sm-2" type="text" name="email">
            </p>
            <p>
                Please input your password: <br/>
                <input class="form-control mr-sm-2" type="text" name="password">
            </p>
            <P><br/>
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">LOG IN</button>
            </P>
        </form> 
        
        <a href="register.php">    Registration</a>
    </div>
</body>
</html>
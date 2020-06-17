<?php
include $_SERVER['DOCUMENT_ROOT'] .'/configs/db.php'; 

    if(isset($_GET['u_code'])) {
    $sql = "SELECT * FROM users WHERE confirm_mail='" . $_GET['u_code'] . "'";
    $result = $connect->query($sql);
    if($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        $sql = "UPDATE users SET verified = '1' , confirm_mail = '' WHERE id_user=" . $user['id_user'];

        if($connect->query($sql)){ 
            header('Location: http://real-madrid_fan-shop.local/index.php');
        }
    }
}

if(isset($_POST) && $_SERVER["REQUEST_METHOD"]=="POST" 
&& $_POST["username"] != "" && $_POST["email"] != "" && $_POST["password"] != "" )
{
    //registration
    $password = md5($_POST['password']);

    $u_code = generateRandomString(20);

    $sql = " INSERT INTO users (login, email, confirm_mail, password) 
    VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', 
            '$u_code', '" . $password . "')"; 
    $result = $connect->query($sql);
    if($result){
        echo "User registred";
        $link = "<a href='http://real-madrid_fan-shop.local/register.php?u_code=$u_code'>Confirm</a>";
        mail($_POST['email'], 'Register', $link);
        header('Location: http://real-madrid_fan-shop.local/index.php');
    }
} else { echo "Your data incorrect"; }

function generateRandomString($Lenght = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwzyxABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characterLenght = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $Lenght; $i++) {
        $randomString .= $characters[rand(0, $characterLenght - 1)];
    }
    return $randomString;
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" href="assets/style.css"/>
    <title>Registrarion</title>
</head>
<body>
<div id="content">
    <h2>Registrarion</h2>
    <form class="form-inline my-2 my-lg-0 col-3" method="POST">
        <p>Login<br/>
            <input class="form-control mr-sm-2" type="text" name="username">
        </p>
        <p>E-mail<br/>
            <input class="form-control mr-sm-2" type="text" name="email">
        </p>
        <p>Password<br/>
            <input class="form-control mr-sm-2" type="password" name="password">
        </p>
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Register</button> 
    </form>
</div>

</body>
</html>
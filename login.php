<?php 
    session_start();
    require_once 'pdo.php';

    $salt ='XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f';
    if (isset($_SESSION['cancel'])){
        header("Location:index.php");
        return;
    }
    if(isset($_POST['submit'])){
        if(strlen($_POST['pwd'])<1 || strlen($_POST['email'])<1){
            $_SESSION['err'] = "Email and password cannot be empty";
            header("Location: login.php");
            return;
        }
        else{
            $check = hash('md5', $salt.$_POST['pwd']);
            $stmt = $pdo->prepare("SELECT user_id, name FROM users WHERE email= :em AND password= :pwd");
            $stmt->execute(array(':em'=> $_POST['email'], ':pwd'=>$check));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $_SESSION['err'] = "Incorrect password";
                header('Location:login.php');
                return;
            }
            else{
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['user_id'];
                header("Location:index.php");
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Senthooran B</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/form.css">
</head>

<body class="container bg-light"> 
    <h1>Database Manager Login</h1>

    <form class="container form-login" method="post">
    <?php 
        if(isset($_SESSION['err'])){
            echo('<p class="bg-danger" style="text-align:center; color:white">'.$_SESSION['err'].'</p>');
            unset($_SESSION['err']);
        }    
    ?>
    <label for id="username">Email</label>
    <input type="text" id="username" name="email" size="40" placeholder="123@example.com" class="form-control"><br>
    <label for="pwd">Password</label>
    <input type="password" id="pwd" name="pwd" size="40" placeholder="Password" class="form-control"><br>
    <input type="submit" name="submit" value="Login" class="btn btn-primary">
    <input type="submit" name="cancel" value="Cancel" class="btn btn-danger">
    </form>
</body>
</html>
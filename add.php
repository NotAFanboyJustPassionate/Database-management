<?php 
    session_start();
    require_once 'pdo.php';
    if(isset($_POST['cancel'])){
        header("Location: index.php");
        return;
    }
    if(isset($_POST['add'])){
        if(strlen($_POST['fname'])<1 || strlen($_POST['lname'])<1 || strlen($_POST['email'])<1 || strlen($_POST['headline'])<1 || strlen($_POST['summary'])<1){
            $_SESSION['err'] = "All fields are required";
            header("Location: add.php");
            return;
        }
        else{
            $stmt = $pdo->prepare("INSERT INTO `profile`(user_id, first_name, last_name, email, headline, summary) VALUES (:user, :fname, :lname, :em, :hl, :sm)");
            $stmt->execute(array(':user'=>$_SESSION['user_id'], ':fname'=>$_POST['fname'], ':lname'=> $_POST['lname'],':em'=>$_POST['email'], ':hl'=>$_POST['headline'], ':sm'=> $_POST['summary']));
            $_SESSION['success'] = "Record Inserted";
            header("Location:index.php");
            return;
        }
    }
   
?>

<!DOCTYPE html><html lang="en">
 <head>	
  <meta charset="UTF-8">	
  <title>Test</title>	
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/form.css">
  </head>
  <body class="container bg-light"> 
    <h1>Profile Database Manager- Add New Profile</h1>
    <?php 
        if(isset($_SESSION['err'])){
            echo('<p class="bg-danger" style="text-align:center; color:white">'.$_SESSION['err'].'</p>');
            unset($_SESSION['err']);
        }    
    ?>
    <form class="container form-login" method="post">
    <label for id="fname">First Name:</label>
    <input type="text" id="fname" name="fname" size="40" placeholder="First Name" class="form-control"><br>
    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" size="40" placeholder="Last Name" class="form-control"><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" size="40" placeholder="email" class= form-control><br>
    <label for="headline">Headline:</label>
    <input type="text" id="headline" name="headline" size="40" placeholder="Headline" class="form-control"><br>
    <label for="summary">Summary:</label>
    <textarea name="summary" id="summary" placeholder="Summary goes here." class="form-control"></textarea><br>
    <input type="submit" name="add" value="Add" class="btn btn-primary">
    <input type="submit" name="cancel" value="Cancel" class="btn btn-danger">
    </form>
</body>
</html>
<?php 
    session_start();
    require_once 'pdo.php';
    $stmt = $pdo->query("SELECT first_name, last_name, email, headline, summary FROM `profile` WHERE profile_id =".$_GET['profile_id']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['cancel'])){
        header("Location:index.php");
        return;
    }
    
    if(isset($_POST['save'])){
        if(strlen($_POST['fname']<1 || $_POST['lname']<1 || $_POST['email']<1 || $_POST['headline']<1 || $_POST['summary']<1)){
            $_SESSION['err'] = "All fields are required";
            header("Location: edit.php");
            return;
        }
        $_SESSION['success'] = "Record Edited";
        $stmt1 = $pdo->prepare("UPDATE Profile SET first_name= :fname, last_name= :lname, email = :em, headline= :hl, summary= :sm WHERE profile_id=".$_GET['profile_id']);
        $stmt1->execute(array(':fname'=>$_POST['fname'], ':lname'=>$_POST['lname'], ':em'=>$_POST['email'], 
                        ':hl'=>$_POST['headline'], ':sm'=>$_POST['summary']));
        header("Location: index.php");
        return;
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
    <h1>Profile Database Manager- Edit Profile</h1>
    <?php 
        if(isset($_SESSION['err'])){
            echo('<p class="bg-danger" style="text-align:center; color:white">'.$_SESSION['err'].'</p>');
            unset($_SESSION['err']);
        }    
    ?>
    <form class="container form-login" method="post">
    <label for id="fname">First Name:</label>
    <input type="text" id="fname" name="fname" size="40" placeholder="First Name" class="form-control" value="<?=$row['first_name'] ?>"><br>
    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" size="40" placeholder="Last Name" class="form-control" value="<?=$row['last_name']?>"><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" size="40" placeholder="email" class= form-control value="<?=$row['email'] ?>"><br>
    <label for="headline">Headline:</label>
    <input type="text" id="headline" name="headline" size="40" placeholder="Headline" class="form-control" value="<?=$row['headline']?>"><br>
    <label for="summary">Summary:</label>
    <textarea name="summary" id="summary" placeholder="Summary goes here." class="form-control"><?=$row["summary"]?></textarea><br>
    <input type="submit" name="save" value="Save" class="btn btn-success">
    <input type="submit" name="cancel" value="Cancel" class="btn btn-danger">
    </form>
    
</body>
</html>
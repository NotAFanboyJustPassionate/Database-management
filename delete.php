<?php 
    session_start();
    require_once 'pdo.php';
    $stmt = $pdo->query("SELECT first_name, last_name, email, headline, summary FROM `profile` WHERE profile_id =".$_GET['profile_id']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['delete'])){
        $stmt1 = $pdo->query("DELETE FROM `profile` WHERE profile_id=".$_GET['profile_id']);
        $_SESSION['success'] = "Record Deleted";
        header("Location: index.php");
        return;
    }
    if(isset($_POST['cancel'])){
        header("Location:index.php");
        return;
    }
?>
<head>
    <title>Senthooran B</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="container">
    <p><b>Are You sure you want to delete?</b></p>
        <?php 
            echo("<p>First Name:".$row['first_name']."</p>");
            echo("<p>Last Name:".$row['last_name']."</p>");
            echo("<p>email:".$row['email']."</p>");
        ?>
    <form method="post">
        <input type="submit" value="Delete" class="btn btn-danger" name="delete">
        <input type="submit" value="Cancel" class="btn btn-success" name="cancel">
    </form>
</body>
<?php 
    require_once 'pdo.php';
    session_start();
?>

<!DOCTYPE html>
<html lang= "en">
<head>
    <title>Senthooran B</title>
    <meta name="viewport" content="width=device-width initial-scale=1">
    <meta name="description" content="Senthooran B, database application">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body class="container bg-light">
    <h1>Profile Management System</h1>
    <?php 
        if(isset($_SESSION['success'])){
            echo('<p class="bg-success" style="text-align:center; color:white">'.$_SESSION['success'].'</p>');
            unset($_SESSION['success']);
        }    
    ?>
    <?php 
        if(isset($_SESSION['name'])){
            $stmt = $pdo->query("SELECT first_name, headline FROM Profile WHERE user_id =".$_SESSION['user_id']);
            $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
            if( ! $row1===false){
                echo('<table class="table table-responsive table-hover table-bordered">
                <thead class="thead-dark">
                    <tr><th>Name</th><th>Headline</th><th>Action</th></tr>
                </thead>
                
                <tbody>');
                $stmt = $pdo->query("SELECT first_name, headline FROM profile WHERE user_id =".$_SESSION['user_id']);
                while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    $stmt1 = $pdo->prepare("SELECT profile_id FROM profile WHERE first_name= :fname");
                    $stmt1->execute(array(':fname'=> $row['first_name'] ));
                    $prof_id = $stmt1->fetch(PDO::FETCH_ASSOC);
                    echo ('<tr><td><a href="view.php?profile_id='.$prof_id['profile_id'].'">');
                    echo(htmlentities($row['first_name']));
                    echo("</a></td><td>");
                    echo(htmlentities($row['headline']));
                    echo("</td><td>");
                    echo('<a href="edit.php?profile_id='.$prof_id['profile_id'].'">Edit</a>/');
                    echo('<a href="delete.php?profile_id='.$prof_id['profile_id'].'">Delete</a>');
                    echo("</td></tr>\n");
                }
                echo("</tbody></table>");
            }
            else{
                echo("<p>No entries Yet</p>");
            }
            echo("<p><a href='logout.php'>Logout</a></p>");
            echo('<p><a href="add.php">Add new Entry</a></p>');
        }
        else{
            echo("<p><a href='login.php'>Please log in</a></p>");
        }
    ?>
    
</body>
</html>
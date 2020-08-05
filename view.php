<?php 
    require_once 'pdo.php';
?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <title>Senthooran B</title>
    <meta name="viewport" content="width=device-width initial-scale=1">
    <meta name="description" content="Senthooran B, database application">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/view.css">
</head>

<body class="container bg-light">
    <h1>Profile Manager- Profile Information</h1>
    <div class="container">
    <?php 
        $stmt = $pdo->query("SELECT first_name, last_name, email, headline, summary FROM `profile` WHERE profile_id =".$_GET['profile_id']);
        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){
            echo("<h3>First Name:</h3>");
            echo("<p>".htmlentities($row['first_name'])."</p>");
            echo("<hr>");
            echo("<h3>Last Name:</h3>");
            echo("<p>".htmlentities($row['last_name'])."</p>");
            echo("<hr>");
            echo("<h3>Email:</h3>");
            echo("<p>".htmlentities($row['email'])."</p>");
            echo("<hr>");
            echo("<h3>Headline:</h3>");
            echo("<p>".htmlentities($row['headline'])."</p>");
            echo("<hr>");
            echo("<h3>Summary:</h3>");
            echo("<p>".htmlentities($row['summary'])."</p>");
            echo("<hr><br>");
        }
    ?>
    <p><a href="index.php" class="btn btn-primary">Done</a></p>
    </div>
</body>

</html>
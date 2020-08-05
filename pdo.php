<? 
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=misc", 'sen', 'senIsCool');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container dashboard">
        <h1>Welcome, <?php echo htmlspecialchars($user['fullname'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <h2>Simple Login System</h2>
        <p>System Integration and Architecture 1</p>
        <a class="button" href="logout.php">Logout</a>
    </div>
</body>
</html>

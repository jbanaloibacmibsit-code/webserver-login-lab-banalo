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
    <title>Successful Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <main class="container dashboard">
        <h1>Successful Login</h1>
        <p>Welcome, <?php echo htmlspecialchars($user['fullname'], ENT_QUOTES, 'UTF-8'); ?>.</p>

        <div class="buttons">
            <a class="button" href="dashboard.php">Dashboard</a>
            <a class="button" href="logout.php">Logout</a>
        </div>
    </main>
</body>
</html>

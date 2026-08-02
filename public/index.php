<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . '/../config/database.php';

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $errors[] = 'Please enter both username and password.';
    } elseif (strlen($username) > 50 || !preg_match('/^[A-Za-z0-9_.-]+$/', $username)) {
        $errors[] = 'Username may contain only letters, numbers, dots, underscores, and hyphens, and must be 50 characters or fewer.';
    } else {
        try {
            $pdo = getDatabaseConnection();
            ensureDatabaseSchema($pdo);

            $stmt = $pdo->prepare('SELECT id, username, password, fullname FROM users WHERE username = :username LIMIT 1');
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => (int) $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                ];

                session_regenerate_id(true);
                header('Location: success.php');
                exit;
            }

            $errors[] = 'Invalid username or password.';
        } catch (PDOException $exception) {
            $errors[] = 'Database error. Please check your PostgreSQL settings.';
            error_log('Login error: ' . $exception->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Login System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <p class="subtitle">Simple Login System</p>

        <?php if (!empty($errors)) : ?>
            <div class="alert">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <div class="buttons">
                <button type="submit">Login</button>
                <button type="reset" class="secondary">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>

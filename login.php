<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/conexion.php';

/**
 * Attempts to locate the requested user and validate the given password.
 * Returns the user data on success or null when the credentials are invalid.
 */
function verify_login(string $user, string $password, \mysqli $connection): ?array
{
    $query = 'SELECT ID_USUARIO AS id_usuario, user, nombre, rol, imagen, password FROM USUARIO WHERE user = ? LIMIT 1';
    $statement = $connection->prepare($query);

    if ($statement === false) {
        throw new \RuntimeException('No se pudo preparar la consulta de autenticación.');
    }

    $statement->bind_param('s', $user);
    $statement->execute();

    $row = null;
    $result = $statement->get_result();

    if ($result instanceof \mysqli_result) {
        $row = $result->fetch_assoc();
    } else {
        // Fallback for environments compiled without mysqlnd.
        $statement->bind_result($id, $dbUser, $nombre, $rol, $imagen, $storedPassword);

        if ($statement->fetch()) {
            $row = [
                'id_usuario' => $id,
                'user'       => $dbUser,
                'nombre'     => $nombre,
                'rol'        => $rol,
                'imagen'     => $imagen,
                'password'   => $storedPassword,
            ];
        }
    }

    if ($row === null) {
        return null;
    }

    $storedPassword = (string)($row['password'] ?? '');
    $passwordInfo   = password_get_info($storedPassword);

    $isValid = false;

    if ($storedPassword === '') {
        // Legacy accounts without password can authenticate with just the username.
        $isValid = true;
    } elseif ($passwordInfo['algo'] !== 0) {
        $isValid = password_verify($password, $storedPassword);
    } elseif (preg_match('/^[a-f0-9]{32}$/i', $storedPassword) === 1) {
        $normalizedStoredPassword = strtolower($storedPassword);
        $isValid = hash_equals($normalizedStoredPassword, md5($password));
    } else {
        $isValid = hash_equals($storedPassword, $password);
    }

    if (!$isValid) {
        return null;
    }

    unset($row['password']);

    return $row;
}

if (!isset($_SESSION['login_done'])) {
    $_SESSION['login_done'] = false;
}

if (!empty($_SESSION['login_done'])) {
    header('Location: ./web/index.php');
    exit;
}

$errorMessage = '';
$connection   = null;

try {
    $connection = get_db_connection();
} catch (\RuntimeException $exception) {
    $errorMessage = 'No se pudo conectar con la base de datos. Inténtelo de nuevo más tarde.';
    error_log($exception->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $user = trim((string)($_POST['user'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if ($user === '') {
        $errorMessage = 'Debe introducir un usuario.';
    } elseif ($connection === null) {
        $errorMessage = 'No se pudo conectar con la base de datos. Inténtelo de nuevo más tarde.';
    } else {
        try {
            $userData = verify_login($user, $password, $connection);

            if ($userData !== null) {
                $_SESSION['id_usuario'] = (int)$userData['id_usuario'];
                $_SESSION['userid'] = (int)$userData['id_usuario'];
                $_SESSION['user'] = $userData['user'];
                $_SESSION['username'] = $userData['nombre'] ?? '';
                $_SESSION['user_rol'] = $userData['rol'] ?? '';
                $_SESSION['imagen'] = $userData['imagen'] ?? '';
                $_SESSION['login_done'] = true;

                header('Location: ./web/index.php');
                exit;
            }

            $errorMessage = 'Usuario o contraseña incorrectos.';
        } catch (\Throwable $exception) {
            $errorMessage = 'Se produjo un error al procesar la solicitud. Inténtelo de nuevo más tarde.';
            error_log($exception->getMessage());
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Intranet - Inicio de sesión</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/css/login.css">
    <script src="./assets/js/login.js"></script>
</head>
<body>
<div class="login-page">
    <div class="form">
        <?php if ($errorMessage !== ''): ?>
            <div class="error"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form class="login-form" action="" method="post" novalidate>
            <input type="text" name="user" placeholder="Usuario" value="<?php echo isset($user) ? htmlspecialchars($user, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"/>
            <input type="password" name="password" placeholder="Contraseña"/>
            <button name="login" type="submit" value="login">Acceder</button>
        </form>
    </div>
</div>
</body>
</html>

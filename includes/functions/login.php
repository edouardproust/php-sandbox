<?php
function credentials() 
{
    return [
        'username' => 'admin',
        'password_hashed' => '$2y$13$ew/.dV4.LdNxbCBkdxaELe4ozhg395dZ5jZCM/1sEuXUFUkrIlubi'
    ];
}
function is_connected(): bool
{
    if( session_status() === PHP_SESSION_NONE ) {
        session_start();
    }
    return !empty($_SESSION['connected']); // Returns TRUE if $_SESSION['connected'] is not empty
}
function redirect_if_not_connected(string $redirect_location): void
{
    if (!is_connected()) {
        header("Location: $redirect_location");
    }
}
function login_verify(): ?bool
{
    if ($_POST['username'] === credentials()['username'] && password_verify($_POST['password'], credentials()['password_hashed']) === true ) {
    session_start();
        $_SESSION['connected'] = 1;
        header('Location: ../admin/index.php');
    } else {
        return false;
    }
}
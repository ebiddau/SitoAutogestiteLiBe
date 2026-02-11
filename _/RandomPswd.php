<?php
require("template/header.php");


$stmt = $conn->query("SELECT username FROM utenti");
$utenti = $stmt->fetch_all(MYSQLI_ASSOC);

function generate_password() 
{
    $passwordPlain = bin2hex(random_bytes(4));
    $ServerPasswordHash = password_hash($passwordPlain, PASSWORD_DEFAULT);
    return ['plain' => $passwordPlain, 'hash' => $ServerPasswordHash];
}

function export_passwords_to_csv($passwords, $filename = 'passwords.csv') {
    $file = fopen($filename, 'w');
    fputcsv($file, ['Username', 'Password']);
    
    foreach ($passwords as $item) {
        fputcsv($file, [$item['username'], $item['password']]);
    }
    
    fclose($file);
}

$plaintext_passwords = [];
$update_stmt = $conn->prepare("UPDATE utenti SET password = ? WHERE username = ?");

foreach ($utenti as $item) {
    $pwd = generate_password();
    $username = $item['username'];
    $passwordHash = $pwd['hash'];
    
    $update_stmt->bind_param('ss', $passwordHash, $username);
    $update_stmt->execute();
    
    $plaintext_passwords[] = ['username' => $username, 'password' => $pwd['plain']];
}

export_passwords_to_csv($plaintext_passwords, 'exported_passwords.csv');
echo count($utenti) . " password(s) updated.\n";
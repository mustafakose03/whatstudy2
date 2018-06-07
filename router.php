<?php

// Set de standaard-actie op het tonen van het login-formulier.
// Als er in de GET-parameter een andere actie wordt opgegeven, gebruik deze dan
$action = 'loginform';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

// Bepaal welke actie er moet worden uitgevoerd
switch ($action) {
    case 'loginform':
        require_once 'views/loginform.php';
        break;
    case 'login':
        $whatstudy->login($_POST['username'], $_POST['password']);
        header('Location: index.php?action=chat');
        break;
    case 'logout':
        $whatstudy->logout();
        header('Location: index.php?action=loginform');
    case 'chat':
        require_once 'views/chat.php';
        break;
    default:
        throw new NotFoundException('Pagina kan niet worden gevonden');
}
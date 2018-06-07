<?php
// sessie starten
session_start();

// toon alle errors
error_reporting(E_ALL);

// afhandeling van excepties
try {
    function whatstudyAutoloader($className) {
        require_once 'classes/' . $className . '.php';
    }
    spl_autoload_register('whatstudyAutoloader');

    $whatstudy = new Whatstudy();

    require_once 'router.php';

} catch (NotFoundException $e) {
    http_response_code(404);
    echo '<h1>404</h1>' . $e->getMessage();
} catch (Pest_Exception $e) {
    echo '<h1>Oeps!</h1>Er is iets fout gegaan met de verbidinding met de API-server: ' . $e->getMessage();
} catch (Exception $e) {
    echo '<h1>Oeps!</h1>Er is iets mis gegaan: ' . $e->getMessage();
}

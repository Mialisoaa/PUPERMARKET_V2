app/bootstrap.php
<?php
require_once __DIR__ . '/config.php';

// Connexion à la base avec PDO
Flight::register('db', 'PDO', array(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
    DB_USER,
    DB_PASS,
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    )
));

// Définir le chemin des vues
Flight::set('flight.views.path', __DIR__ . '/views');

// Route par défaut "/" → redirige vers /register
Flight::route('GET /', function() {
    Flight::redirect('/register');
});

// Charger toutes les autres routes depuis routes.php
require_once __DIR__ . '/routes.php';

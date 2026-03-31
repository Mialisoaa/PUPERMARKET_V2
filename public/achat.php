<?php
require_once __DIR__ . '/../app/config.php';

$error = null;
$caisseLabel = '-';
$caisseId = filter_input(INPUT_GET, 'caisse_id', FILTER_VALIDATE_INT);

if ($caisseId) {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );

        $stmt = $pdo->prepare('SELECT nom FROM caisse WHERE id = :id');
        $stmt->execute(['id' => $caisseId]);
        $row = $stmt->fetch();
        if ($row) {
            $caisseLabel = $row['nom'];
        } else {
            $caisseLabel = 'Caisse inconnue';
        }
    } catch (Throwable $e) {
        $error = 'Impossible de charger la caisse.';
    }
} else {
    $error = 'Aucune caisse selectionnee.';
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Saisie achats</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        color: #333;
        margin: 0;
        padding: 0;
      }

      .page {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        border: 1px solid #ddd;
      }

      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid #ddd;
      }

      nav {
        padding: 12px 20px;
        border-bottom: 1px solid #eee;
        background: #fafafa;
      }

      .content {
        padding: 24px 20px 40px;
      }

      .label {
        font-weight: bold;
      }

      .alert {
        padding: 12px 20px;
        color: #b00020;
      }
    </style>
  </head>
  <body>
    <div class="page">
      <?php if ($error): ?>
        <div class="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
      <?php endif; ?>
      <header>
        <div class="label">Caisse selectionnee : <?= htmlspecialchars($caisseLabel, ENT_QUOTES, 'UTF-8') ?></div>
        <div>Page de saisie des achats</div>
      </header>
      <nav>
        Menu
      </nav>
      <main class="content">
        <p>Zone de saisie des achats a venir.</p>
      </main>
    </div>
  </body>
</html>

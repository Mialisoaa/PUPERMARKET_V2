<?php
require_once __DIR__ . '/../app/config.php';

$error = null;
$caisses = [];

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    $stmt = $pdo->query('SELECT id, nom FROM caisse ORDER BY id');
    $caisses = $stmt->fetchAll();
} catch (Throwable $e) {
    $error = 'Impossible de charger les caisses.';
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Choisir caisse</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        color: #333;
        margin: 0;
        padding: 0;
      }

      .page {
        max-width: 520px;
        margin: 60px auto;
        background: #fff;
        border: 1px solid #ddd;
        padding: 28px;
        text-align: center;
      }

      h1 {
        font-size: 20px;
        margin: 0 0 24px;
      }

      .field {
        display: flex;
        justify-content: center;
        margin-bottom: 22px;
      }

      select {
        width: 280px;
        padding: 8px 10px;
        border: 1px solid #666;
        background: #fff;
        font-size: 14px;
      }

      button {
        padding: 8px 22px;
        border: 1px solid #666;
        background: #e6e6e6;
        cursor: pointer;
      }

      button:hover {
        background: #dcdcdc;
      }

      .alert {
        margin-bottom: 16px;
        color: #b00020;
      }
    </style>
  </head>
  <body>
    <main class="page">
      <h1>Choisir caisse</h1>
      <?php if ($error): ?>
        <div class="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
      <?php endif; ?>
      <form action="achat.php" method="get">
        <div class="field">
          <select name="caisse_id" required>
            <option value="" disabled selected>Selectionner une caisse</option>
            <?php foreach ($caisses as $caisse): ?>
              <option value="<?= (int) $caisse['id'] ?>">
                <?= htmlspecialchars($caisse['nom'], ENT_QUOTES, 'UTF-8') ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit">Valider</button>
      </form>
    </main>
  </body>
</html>

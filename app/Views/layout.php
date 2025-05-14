<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartBooker - <?= $title ?? 'Prenotazioni' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
    
</head>
<body>
    <header class="header">
        <div class="container">
            <h1><a href="<?= base_url('/') ?>">SmartBooker</a></h1>
            <p class="tagline">Sistema di prenotazione risorse semplice ed efficiente</p>

            <div class="login-box">
                <?php if (session()->get('isLoggedIn')): ?>
                    <span>Ciao, <?= esc(session()->get('nome')) ?> (<?= esc(session()->get('ruolo')) ?>)</span>
                    <a href="<?= base_url(session()->get('ruolo') . '/dashboard') ?>">Dashboard</a>
                    <a href="<?= base_url('index.php/logout') ?>">Logout</a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>">Login</a>
                    <a href="<?= base_url('register') ?>">Registrati</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    
    <main class="main">
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 SmartBooker - Tutti i diritti riservati</p>
        </div>
    </footer>
</body>
</html>

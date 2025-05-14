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
            <h1>SmartBooker</h1>
            <p class="tagline">Sistema di prenotazione risorse semplice ed efficiente</p>
            
            <div style="margin-top: 10px;">
                <?php if (session()->get('isLoggedIn')): ?>
                    <p>Ciao, <?= esc(session()->get('nome')) ?> (<?= esc(session()->get('ruolo')) ?>) | 
                    <a href="<?= base_url(session()->get('ruolo') . '/dashboard') ?>">Dashboard</a> | 
                    <a href="<?= base_url('index.php/logout') ?>">Logout</a></p>
                <?php else: ?>
                    <p><a href="<?= base_url('login') ?>">Login</a> | 
                    <a href="<?= base_url('register') ?>">Registrati</a></p>
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
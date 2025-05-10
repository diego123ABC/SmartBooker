<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartBooker - Prenotazioni</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
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
                    <a href="<?= base_url('logout') ?>">Logout</a></p>
                <?php else: ?>
                    <p><a href="<?= base_url('login') ?>">Login</a> | 
                    <a href="<?= base_url('register') ?>">Registrati</a></p>
                <?php endif; ?>
            </div>
        </div>
    </header>


    <main class="main">
        <div class="container">
            <div class="welcome-section">
                <h2>Benvenuto in SmartBooker</h2>
                <p>Scegli una sezione per vedere le risorse disponibili:</p>
            </div>

            <div class="resources-section">
                <div class="resource-card">
                    <div class="card-img-container">
                        <img src="images/laboratorio.jpg" alt="Laboratorio" class="card-img">
                    </div>
                    <div class="card-content">
                        <h3>Laboratori</h3>
                        <p>Prenota i laboratori per i tuoi esperimenti</p>
                        <a href="<?= base_url('risorse/tipo/laboratorio') ?>" class="btn">Visualizza</a>
                    </div>
                </div>
                
                <div class="resource-card">
                    <div class="card-img-container">
                        <img src="images/aula.jpg" alt="Aula Studio" class="card-img">
                    </div>
                    <div class="card-content">
                        <h3>Aule Studio</h3>
                        <p>Trova lo spazio ideale per studiare</p>
                        <a href="<?= base_url('risorse/tipo/aula') ?>" class="btn">Visualizza</a>
                    </div>
                </div>
                
                <div class="resource-card">
                    <div class="card-img-container">
                        <img src="images/dispositivi.jpg" alt="Dispositivi" class="card-img">
                    </div>
                    <div class="card-content">
                        <h3>Dispositivi</h3>
                        <p>Prenota dispositivi elettronici e attrezzature</p>
                        <a href="<?= base_url('risorse/tipo/dispositivi') ?>" class="btn">Visualizza</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 SmartBooker - Tutti i diritti riservati</p>
        </div>
    </footer>
</body>
</html>
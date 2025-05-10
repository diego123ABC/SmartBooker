<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Studente</title>
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Dashboard Studente</h1>
            <p class="tagline">Benvenuto, <?= esc(session()->get('nome')) ?></p>
            <p><a href="<?= base_url('/') ?>">🏠 Home</a> | <a href="<?= base_url('logout') ?>">Logout</a></p>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="welcome-section">
                <h2>Accesso rapido alle funzioni</h2>
                <p>Prenota risorse o consulta le tue attività.</p>
            </div>

            <div class="resources-section">
                <div class="resource-card">
                    <div class="card-content">
                        <h3>Prenota una risorsa</h3>
                        <p>Visualizza le risorse e prenota subito</p>
                        <a href="<?= base_url('/') ?>" class="btn">Vai</a>
                    </div>
                </div>

                <div class="resource-card">
                    <div class="card-content">
                        <h3>Storico prenotazioni</h3>
                        <p>Consulta le prenotazioni effettuate</p>
                        <a href="#" class="btn">Visualizza</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

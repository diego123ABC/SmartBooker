<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Dashboard Admin</h1>
            <p class="tagline">Benvenuto, <?= esc(session()->get('nome')) ?></p>
            <p><a href="<?= base_url('/') ?>">🏠 Home</a> | <a href="<?= base_url('logout') ?>">Logout</a></p>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="welcome-section">
                <h2>Gestione piattaforma</h2>
                <p>Da qui puoi gestire utenti, risorse e prenotazioni.</p>
            </div>

            <div class="resources-section">
                <div class="resource-card">
                    <div class="card-content">
                        <h3>Utenti</h3>
                        <p>Visualizza e gestisci gli utenti registrati</p>
                        <a href="#" class="btn">Gestisci Utenti</a>
                    </div>
                </div>

                <div class="resource-card">
                    <div class="card-content">
                        <h3>Risorse</h3>
                        <p>Aggiungi o modifica le risorse disponibili</p>
                        <a href="#" class="btn">Gestisci Risorse</a>
                    </div>
                </div>

                <div class="resource-card">
                    <div class="card-content">
                        <h3>Prenotazioni</h3>
                        <p>Controlla lo stato delle prenotazioni</p>
                        <a href="#" class="btn">Visualizza Prenotazioni</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

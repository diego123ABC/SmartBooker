<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Docente</title>
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Dashboard Docente</h1>
            <p class="tagline">Benvenuto, <?= esc(session()->get('nome')) ?></p>
            <p><a href="<?= base_url('/') ?>">🏠 Home</a> | <a href="<?= base_url('logout') ?>">Logout</a></p>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="welcome-section">
                <h2>Strumenti per docenti</h2>
                <p>Consulta e gestisci le tue prenotazioni didattiche.</p>
            </div>

            <div class="resources-section">
                <div class="resource-card">
                    <div class="card-content">
                        <h3>Prenota risorsa</h3>
                        <p>Accedi alla sezione risorse e prenota</p>
                        <a href="<?= base_url('/') ?>" class="btn">Prenota</a>
                    </div>
                </div>

                <div class="resource-card">
                    <div class="card-content">
                        <h3>Mie prenotazioni</h3>
                        <p>Visualizza tutte le tue prenotazioni</p>
                        <a href="#" class="btn">Visualizza</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
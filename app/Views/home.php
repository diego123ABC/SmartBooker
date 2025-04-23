<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>SmartBooker - Prenotazioni</title>
</head>
<body>
    <h1>Benvenuto in SmartBooker</h1>
    <p>Scegli una sezione per vedere le risorse disponibili:</p>
    <ul>
        <li><a href="<?= base_url('risorse/tipo/laboratorio') ?>">🔬 Laboratori</a></li>
        <li><a href="<?= base_url('risorse/tipo/aula') ?>">📚 Aule Studio</a></li>
        <li><a href="<?= base_url('risorse/tipo/dispositivi') ?>">💻 Dispositivi</a></li>
    </ul>
</body>
</html>
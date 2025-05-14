<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2>Prenota una risorsa</h2>

    <form action="<?= base_url('prenotazioni/inserisci') ?>" method="post">
        <input type="hidden" name="risorsa_id" value="<?= $risorsa_id ?>">
        <input type="hidden" name="utente_id" value="<?= session()->get('id') ?>">

        <label>Data Inizio:</label>
        <input type="datetime-local" name="data_inizio" required><br>

        <label>Data Fine:</label>
        <input type="datetime-local" name="data_fine" required><br>

        <button type="submit">Prenota</button>
    </form>

    <p><a href="<?= base_url('/') ?>">⬅️ Torna alla Home</a></p>
<?= $this->endSection() ?>
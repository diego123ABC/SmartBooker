<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2>Registrati</h2>

    <form method="post" action="<?= base_url('register') ?>">
        <?= csrf_field() ?>
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= old('nome') ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= old('email') ?>"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <?php if (session()->get('ruolo') === 'admin'): ?>
            <label>Ruolo:</label><br>
            <select name="ruolo">
                <option value="studente">Studente</option>
                <option value="docente">Docente</option>
                <option value="admin">Admin</option>
            </select><br><br>
        <?php else: ?>
            <input type="hidden" name="ruolo" value="studente">
        <?php endif; ?>

        <button type="submit">Registrati</button>
    </form>
<?= $this->endSection() ?>
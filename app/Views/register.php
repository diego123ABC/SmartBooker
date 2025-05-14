<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2>Registrati</h2>

    <form action="<?= base_url('register') ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="ruolo">Ruolo:</label>
        <select name="ruolo" id="ruolo" required>
            <option value="studente">Studente</option>
            <option value="docente">Docente</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit">Registrati</button>
    </form>


    <?php if (isset($validation)): ?>
        <div style="color:red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div style="color:red;">
            <?= $error ?>
        </div>
    <?php endif; ?>

<?= $this->endSection() ?>
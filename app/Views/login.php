<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2>Accedi</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color:green"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login') ?>">
        <?= csrf_field() ?>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
<?= $this->endSection() ?>
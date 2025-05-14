<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <div class="tipo-header">
        <h2><?= ucfirst($tipo) ?></h2>
        <p><a href="<?= base_url('/') ?>" class="back-link">⬅️ Torna alla Home</a></p>
    </div>

    <?php if (empty($risorse)): ?>
        <div class="empty-state">
            <p>Nessuna risorsa disponibile in questa categoria.</p>
        </div>
    <?php else: ?>
        <div class="resources-section">
            <?php foreach ($risorse as $risorsa): ?>
                <div class="resource-card">
                    <div class="card-img-container">
                        <?php 
                        // Imposta un'immagine predefinita in base al tipo di risorsa
                        $imgSrc = base_url('images/' . ($risorsa['immagine'] ?? $tipo . '.jpg'));
                        ?>
                        <img src="<?= $imgSrc ?>" alt="<?= esc($risorsa['nome']) ?>" class="card-img">
                    </div>
                    <div class="card-content">
                        <h3><?= esc($risorsa['nome']) ?></h3>
                        <p><?= esc($risorsa['descrizione']) ?></p>
                        <?php if (isset($risorsa['disponibilita']) && $risorsa['disponibilita']): ?>
                            <p class="disponibilita disponibile">Disponibile</p>
                        <?php else: ?>
                            <p class="disponibilita non-disponibile">Non disponibile</p>
                        <?php endif; ?>
                        <a href="<?= base_url('prenota/' . $risorsa['id']) ?>" class="btn">Prenota</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <p><a href="<?= base_url('/') ?>">⬅️ Torna alla Home</a></p>
<?= $this->endSection() ?>
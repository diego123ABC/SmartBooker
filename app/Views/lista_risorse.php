<!DOCTYPE html>
<html>
<head>
    <title>Risorse - <?= ucfirst($tipo) ?></title>
</head>
<body>
    <h2><?= ucfirst($tipo) ?></h2>

    <?php if (empty($risorse)): ?>
        <p>Nessuna risorsa disponibile.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($risorse as $risorsa): ?>
                <li>
                    <?= $risorsa['nome'] ?> - <?= $risorsa['descrizione'] ?> 
                    [<a href="<?= base_url('prenota/' . $risorsa['id']) ?>">Prenota</a>]
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="<?= base_url('/') ?>">⬅️ Torna alla Home</a></p>
</body>
</html>
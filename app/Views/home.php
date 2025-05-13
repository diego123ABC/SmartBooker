<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="welcome-section">
    <h2>Benvenuto in SmartBooker</h2>
    <p>Scegli una sezione per vedere le risorse disponibili:</p>
</div>

<div class="resources-section">
    <div class="resource-card">
        <div class="card-img-container">
            <img src="<?= base_url('images/laboratorio.jpg') ?>" alt="Laboratorio" class="card-img">
        </div>
        <div class="card-content">
            <h3>Laboratori</h3>
            <p>Prenota i laboratori per i tuoi esperimenti</p>
            <a href="<?= base_url('risorse/tipo/laboratorio') ?>" class="btn">Visualizza</a>
        </div>
    </div>
    
    <div class="resource-card">
        <div class="card-img-container">
            <img src="<?= base_url('images/aula.jpg') ?>" alt="Aula Studio" class="card-img">
        </div>
        <div class="card-content">
            <h3>Aule Studio</h3>
            <p>Trova lo spazio ideale per studiare</p>
            <a href="<?= base_url('risorse/tipo/aula') ?>" class="btn">Visualizza</a>
        </div>
    </div>
    
    <div class="resource-card">
        <div class="card-img-container">
            <img src="<?= base_url('images/dispositivi.jpg') ?>" alt="Dispositivi" class="card-img">
        </div>
        <div class="card-content">
            <h3>Dispositivi</h3>
            <p>Prenota dispositivi elettronici e attrezzature</p>
            <a href="<?= base_url('risorse/tipo/dispositivi') ?>" class="btn">Visualizza</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
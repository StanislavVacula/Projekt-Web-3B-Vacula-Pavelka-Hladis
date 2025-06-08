<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>Detail auta<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <a href="<?= base_url('auta'); ?>" class="btn btn-secondary mb-3">Zpět na seznam</a>
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mx-auto" style="max-width: 700px;">
        <div class="card-img-top text-center bg-light d-flex align-items-center justify-content-center" style="min-height: 260px; height:260px;">
            <img src="<?= isset($auto['obrazek']) ? esc($auto['obrazek']) : base_url('assets/no-car-image.svg') ?>" alt="Obrázek auta" style="max-width: 90%; max-height: 240px; border-radius: 10px; object-fit: contain; opacity: 0.9;">
        </div>
        <div class="card-body p-4">
            <h3 class="card-title mb-3" style="font-weight: bold; color: #007bff; letter-spacing: 0.5px;">
                <?= esc($auto['znacka'] ?? '') . ' ' . esc($auto['model'] ?? ''); ?>
            </h3>
            <ul class="list-unstyled mb-3">
                <li><strong>Typ:</strong> <?= esc($auto['typ'] ?? '-'); ?></li>
                <li><strong>Palivo:</strong> <?= esc($auto['palivo'] ?? '-'); ?></li>
                <li><strong>Cena:</strong> <?= isset($auto['cena']) ? number_format($auto['cena'], 0, ',', ' ') . ' Kč' : '-'; ?></li>
                <li><strong>Rok výroby:</strong> <?= esc($auto['rok_vyroby'] ?? '-'); ?></li>
                <li><strong>Výkon:</strong> <?= esc($auto['vykon'] ?? '-'); ?> <?= $auto['vykon'] ? 'kW' : '' ?></li>
                <li><strong>Datum přidání:</strong> <?= esc($auto['created_at'] ?? '-'); ?></li>
                <li><strong>Datum úpravy:</strong> <?= esc($auto['updated_at'] ?? '-'); ?></li>
                <?php if (!empty($auto['deleted_at'])): ?>
                <li><strong>Smazáno:</strong> <?= esc($auto['deleted_at']); ?></li>
                <?php endif; ?>
            </ul>
            <div class="mb-2">
                <strong>Popis:</strong><br>
                <?= esc($auto['popis'] ?? ''); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

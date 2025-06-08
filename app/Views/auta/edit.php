<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>Editace auta<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <h1 class="mb-4">Editace auta</h1>
    <form action="<?= base_url('auta/update/' . $auto['id']); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="znacka_auta_id" class="form-label">Značka</label>
            <select name="znacka_auta_id" id="znacka_auta_id" class="form-select" required>
                <option value="" disabled>Vyberte značku</option>
                <?php foreach ($znacky as $znacka): ?>
                    <option value="<?= $znacka['id']; ?>" <?= (isset($auto['znacka_auta_id']) ? $auto['znacka_auta_id'] : ($auto['znacka'] ?? '')) == $znacka['id'] ? 'selected' : '' ?>><?= $znacka['znacka']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="<?= esc($auto['model']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="typ" class="form-label">Typ</label>
            <select name="typ" id="typ" class="form-select" required>
                <option value="" disabled>Vyberte typ</option>
                <?php foreach ($typy as $typ): ?>
                    <option value="<?= $typ['typ']; ?>" <?= $auto['typ'] == $typ['typ'] ? 'selected' : '' ?>><?= $typ['typ']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="palivo" class="form-label">Palivo</label>
            <select name="palivo" id="palivo" class="form-select" required>
                <option value="" disabled>Vyberte palivo</option>
                <option value="benzín" <?= $auto['palivo'] == 'benzín' ? 'selected' : '' ?>>Benzín</option>
                <option value="nafta" <?= $auto['palivo'] == 'nafta' ? 'selected' : '' ?>>Nafta</option>
                <option value="elektro" <?= $auto['palivo'] == 'elektro' ? 'selected' : '' ?>>Elektro</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cena" class="form-label">Cena (Kč)</label>
            <input type="number" name="cena" id="cena" class="form-control" value="<?= esc($auto['cena']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="obrazek" class="form-label">Obrázek auta</label>
            <input type="file" name="obrazek" id="obrazek" class="form-control" accept="image/*">
            <?php if (!empty($auto['obrazek'])): ?>
                <img src="<?= $auto['obrazek']; ?>" alt="obrázek" style="max-width: 120px; margin-top: 10px;">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="popis" class="form-label">Popis (dlouhý text)</label>
            <textarea name="popis" id="popis" class="form-control" rows="6" required><?= esc($auto['popis']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Uložit změny</button>
        <a href="<?= base_url('auta'); ?>" class="btn btn-secondary">Zpět</a>
    </form>
</div>
<?php // WYSIWYG editor TinyMCE ?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#popis',
        menubar: false,
        plugins: 'lists link image code',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
        min_height: 200
    });
</script>
<?= $this->endSection(); ?>

<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>Přidat auto<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <h1 class="mb-4">Přidat nové auto</h1>
    <form action="<?= base_url('auta/store'); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="znacka_auta_id" class="form-label">Značka</label>
            <select name="znacka_auta_id" id="znacka_auta_id" class="form-select" required>
                <option value="" disabled selected>Vyberte značku</option>
                <?php foreach ($znacky as $znacka): ?>
                    <option value="<?= $znacka['id']; ?>"><?= $znacka['znacka']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" name="model" id="model" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="typ" class="form-label">Typ</label>
            <select name="typ" id="typ" class="form-select" required>
                <option value="" disabled selected>Vyberte typ</option>
                <?php foreach ($typy as $typ): ?>
                    <option value="<?= $typ['typ']; ?>"><?= $typ['typ']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="palivo" class="form-label">Palivo</label>
            <select name="palivo" id="palivo" class="form-select" required>
                <option value="" disabled selected>Vyberte palivo</option>
                <option value="benzín">Benzín</option>
                <option value="nafta">Nafta</option>
                <option value="elektro">Elektro</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cena" class="form-label">Cena (Kč)</label>
            <input type="number" name="cena" id="cena" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="obrazek" class="form-label">Obrázek auta</label>
            <input type="file" name="obrazek" id="obrazek" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="popis" class="form-label">Popis (dlouhý text)</label>
            <textarea name="popis" id="popis" class="form-control" rows="6" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Přidat auto</button>
        <a href="<?= base_url('auta'); ?>" class="btn btn-secondary">Zpět</a>
    </form>
</div>
<!-- TinyMCE pro popis -->
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

<!-- filepath: c:\xampp\htdocs\web-autosalon\app\Views\domovska_stranka.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
Domovská stránka
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <h1 class="text-center">Všechna auta</h1>

    <!-- Filtr -->
    <form method="get" action="<?= base_url('/'); ?>" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="znacka" class="form-label">Značka</label>
                <select name="znacka_auta_id" id="znacka" class="form-select">
                    <option value="">Vyberte značku</option>
                    <?php foreach ($znacky as $znacka): ?>
                        <option value="<?= $znacka['id']; ?>" <?= isset($selectedFilters['znacka_auta_id']) && $selectedFilters['znacka_auta_id'] == $znacka['id'] ? 'selected' : ''; ?>>
                            <?= $znacka['znacka']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="model" class="form-label">Model</label>
                <select name="model_auta_id" id="model" class="form-select">
                    <option value="">Vyberte model</option>
                    <?php foreach ($modely as $model): ?>
                        <option value="<?= $model['id']; ?>" <?= isset($selectedFilters['model_auta_id']) && $selectedFilters['model_auta_id'] == $model['id'] ? 'selected' : ''; ?>>
                            <?= $model['model']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="typ" class="form-label">Typ</label>
                <select name="typ_auta_id" id="typ" class="form-select">
                    <option value="">Vyberte typ</option>
                    <?php foreach ($typy as $typ): ?>
                        <option value="<?= $typ['id']; ?>" <?= isset($selectedFilters['typ_auta_id']) && $selectedFilters['typ_auta_id'] == $typ['id'] ? 'selected' : ''; ?>>
                            <?= $typ['typ']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="palivo" class="form-label">Palivo</label>
                <select name="palivo" id="palivo" class="form-select">
                    <option value="">Vyberte palivo</option>
                    <option value="benzín" <?= isset($selectedFilters['palivo']) && $selectedFilters['palivo'] == 'benzín' ? 'selected' : ''; ?>>Benzín</option>
                    <option value="nafta" <?= isset($selectedFilters['palivo']) && $selectedFilters['palivo'] == 'nafta' ? 'selected' : ''; ?>>Nafta</option>
                    <option value="elektro" <?= isset($selectedFilters['palivo']) && $selectedFilters['palivo'] == 'elektro' ? 'selected' : ''; ?>>Elektro</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Filtrovat</button>
            </div>
        </div>
    </form>

    <!-- Seznam aut -->
    <div class="row">
        <?php if (!empty($auta) && is_array($auta)): ?>
            <?php foreach ($auta as $auto): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= $auto['obrazek']; ?>" class="card-img-top" alt="Obrázek auta">
                        <div class="card-body">
                            <h5 class="card-title"><?= $auto['znacka']; ?> <?= $auto['model']; ?></h5>
                            <p class="card-text">
                                <strong>Typ:</strong> <?= $auto['typ']; ?><br>
                                <strong>Palivo:</strong> <?= $auto['palivo']; ?><br>
                                <strong>Cena:</strong> <?= number_format($auto['cena'], 0, ',', ' '); ?> Kč
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center mt-4">Žádné auto neodpovídá zadaným kritériím.</p>
        <?php endif; ?>
    </div>

    <!-- Stránkování -->
    <div class="d-flex justify-content-center mt-4">
        <?= $pager->links(); ?>
    </div>
</div>

<script>
    document.getElementById('znacka').addEventListener('change', function () {
        const znackaId = this.value;
        const modelSelect = document.getElementById('model');
        const typSelect = document.getElementById('typ');

        // Vymazání předchozích možností
        modelSelect.innerHTML = '<option value="">Vyberte model</option>';
        typSelect.innerHTML = '<option value="">Vyberte typ</option>';

        if (znackaId) {
            fetch('<?= base_url('/home/getModelsByBrand'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ znacka_id: znackaId })
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.model;
                    modelSelect.appendChild(option);
                });
            });
        }
    });

    document.getElementById('model').addEventListener('change', function () {
        const modelId = this.value;
        const typSelect = document.getElementById('typ');

        // Vymazání předchozích možností
        typSelect.innerHTML = '<option value="">Vyberte typ</option>';

        if (modelId) {
            fetch('<?= base_url('/home/getTypesByModel'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ model_id: modelId })
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(typ => {
                    const option = document.createElement('option');
                    option.value = typ.id;
                    option.textContent = typ.typ;
                    typSelect.appendChild(option);
                });
            });
        }
    });
</script>
<?= $this->endSection(); ?>
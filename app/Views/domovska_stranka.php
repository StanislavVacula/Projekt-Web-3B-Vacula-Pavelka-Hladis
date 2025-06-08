<!-- filepath: c:\xampp\htdocs\web-autosalon\app\Views\domovska_stranka.php -->
<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>Všechna auta<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<style>
/* Moderní postranní filtr */
.sidebar-filter {
    position: sticky;
    top: 40px;
    min-width: 260px;
    max-width: 320px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08), 0 1.5px 6px rgba(0,0,0,0.04);
    padding: 2rem 1.5rem 1.5rem 1.5rem;
    margin-bottom: 2rem;
    transition: box-shadow 0.3s;
    z-index: 2;
    animation: slideInLeft 0.7s cubic-bezier(.68,-0.55,.27,1.55);
}
@keyframes slideInLeft {
    from { transform: translateX(-60px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
.sidebar-filter label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.3rem;
    transition: color 0.2s;
}
.sidebar-filter select, .sidebar-filter button {
    margin-bottom: 1.2rem;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    box-shadow: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.sidebar-filter select:focus, .sidebar-filter select:hover {
    border-color: #007bff;
    box-shadow: 0 0 0 2px #007bff22;
}
.sidebar-filter button {
    background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
    color: #fff;
    font-weight: 600;
    border: none;
    box-shadow: 0 2px 8px #007bff22;
    transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
}
.sidebar-filter button:hover {
    background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
    box-shadow: 0 4px 16px #007bff33;
    transform: translateY(-2px) scale(1.03);
}
@media (max-width: 991px) {
    .sidebar-filter { position: static; max-width: 100%; margin-bottom: 2rem; }
}

/* Hlavní obsah vedle filtru */
.main-content-flex {
    display: flex;
    gap: 2.5rem;
    align-items: flex-start;
}
@media (max-width: 991px) {
    .main-content-flex { flex-direction: column; gap: 0.5rem; }
}
</style>
<div class="container mt-4">
    <h1 class="text-center mb-5" style="font-weight: bold; color: #222; letter-spacing: 1px;">Naše nabídka</h1>
    <div class="row g-4">
        <div class="col-12 col-lg-3 mb-4">
            <aside class="sidebar-filter shadow p-4 bg-white rounded-4">
                <form method="get" action="<?= base_url('/'); ?>">
                    <div class="mb-3">
                        <label for="znacka" class="form-label">Značka</label>
                        <select name="znacka_auta_id" id="znacka" class="form-select" required>
                            <option value="" disabled selected>Vyberte značku</option>
                            <?php foreach ($znacky as $znacka): ?>
                                <option value="<?= $znacka['id']; ?>" <?= isset($selectedFilters['znacka_auta_id']) && $selectedFilters['znacka_auta_id'] == $znacka['id'] ? 'selected' : ''; ?>>
                                    <?= $znacka['znacka']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <select name="model_auta_id" id="model" class="form-select">
                            <option value="" <?= empty($selectedFilters['model_auta_id']) ? 'selected' : '' ?>>Všechny modely</option>
                            <?php foreach ($modely as $model): ?>
                                <option value="<?= $model['id']; ?>" <?= isset($selectedFilters['model_auta_id']) && $selectedFilters['model_auta_id'] == $model['id'] ? 'selected' : ''; ?>>
                                    <?= $model['model']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="typ" class="form-label">Typ</label>
                        <select name="typ_auta_id" id="typ" class="form-select">
                            <option value="" <?= empty($selectedFilters['typ_auta_id']) ? 'selected' : '' ?>>Všechny typy</option>
                            <?php foreach ($typy as $typ): ?>
                                <option value="<?= $typ['id']; ?>" <?= isset($selectedFilters['typ_auta_id']) && $selectedFilters['typ_auta_id'] == $typ['id'] ? 'selected' : ''; ?>>
                                    <?= $typ['typ']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="palivo" class="form-label">Palivo</label>
                        <select name="palivo" id="palivo" class="form-select" required>
                            <option value="" disabled selected>Vyberte palivo</option>
                            <option value="benzín" <?= isset($selectedFilters['palivo']) && $selectedFilters['palivo'] == 'benzín' ? 'selected' : ''; ?>>Benzín</option>
                            <option value="nafta" <?= isset($selectedFilters['palivo']) && $selectedFilters['palivo'] == 'nafta' ? 'selected' : ''; ?>>Nafta</option>
                            <option value="elektro" <?= isset($selectedFilters['palivo']) && $selectedFilters['palivo'] == 'elektro' ? 'selected' : ''; ?>>Elektro</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Filtrovat</button>
                    </div>
                </form>
            </aside>
        </div>
        <div class="col-12 col-lg-9">
            <?php if (isset($auta) && count($auta) > 0): ?>
                <div class="row row-cols-1 row-cols-md-2 g-4"> <!-- pouze 2 karty v řádku na desktopu -->
                    <?php foreach ($auta as $auto): ?>
                        <div class="col">
                            <div class="card h-100 shadow border-0 rounded-4 overflow-hidden" style="min-width:320px; max-width:600px; margin:auto;">
                                <div class="card-img-top text-center bg-light d-flex align-items-center justify-content-center" style="min-height: 260px; height:260px;">
                                    <img src="<?= base_url('assets/no-car-image.svg') ?>" alt="Obrázek auta" style="max-width: 90%; max-height: 240px; border-radius: 10px; object-fit: contain; opacity: 0.5; filter: grayscale(1);">
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-2" style="font-weight: bold; color: #007bff; letter-spacing: 0.5px;">
                                        <?= esc($auto['znacka'] ?? '') . ' ' . esc($auto['model'] ?? ''); ?>
                                    </h5>
                                    <ul class="list-unstyled mb-2">
                                        <li><strong>Typ:</strong> <?= esc($auto['typ'] ?? '-'); ?></li>
                                        <li><strong>Palivo:</strong> <?= esc($auto['palivo'] ?? '-'); ?></li>
                                        <li><strong>Cena:</strong> <?= isset($auto['cena']) ? number_format($auto['cena'], 0, ',', ' ') . ' Kč' : '-'; ?></li>
                                    </ul>
                                    <p class="mb-0"><strong>Popis:</strong><br><?= esc($auto['popis'] ?? '-'); ?></p>
                                </div>
                                <div class="card-footer bg-white border-0 text-end p-3">
                                    <a href="<?= base_url('auta/show/' . $auto['id']); ?>" class="btn btn-info btn-sm me-1"><i class="bi bi-eye"></i> Detail</a>
                                    <?php if (service('ionAuth')->loggedIn()): ?>
                                        <a href="<?= base_url('auta/edit/' . $auto['id']); ?>" class="btn btn-outline-primary btn-sm me-1"><i class="bi bi-pencil"></i> Editovat</a>
                                        <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete(<?= $auto['id']; ?>)"><i class="bi bi-trash"></i> Smazat</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links('auta', 'default_full') ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">Žádná auta neodpovídají zadaným filtrům.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    const znackaSelect = document.getElementById('znacka');
    const modelSelect = document.getElementById('model');
    const typSelect = document.getElementById('typ');

    function resetSelect(select, placeholder, allowAll = false) {
        select.innerHTML = allowAll
            ? `<option value="" selected>Všechny ${placeholder}</option>`
            : `<option value="" disabled selected>Vyberte ${placeholder}</option>`;
        select.disabled = false;
    }

    znackaSelect.addEventListener('change', function () {
        const znackaId = this.value;
        resetSelect(modelSelect, 'modely', true);
        resetSelect(typSelect, 'typy', true);
        if (znackaId) {
            fetch('<?= base_url('/home/getModelsByBrand'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ znacka_id: znackaId })
            })
            .then(response => response.json())
            .then(data => {
                resetSelect(modelSelect, 'modely', true);
                // Přidej možnost 'Všechny modely' vždy
                const allOption = document.createElement('option');
                allOption.value = '';
                allOption.textContent = 'Všechny modely';
                modelSelect.appendChild(allOption);
                if (data.length > 0) {
                    data.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.id;
                        option.textContent = model.model;
                        modelSelect.appendChild(option);
                    });
                }
                modelSelect.disabled = false;
            });
        }
    });

    modelSelect.addEventListener('change', function () {
        const modelId = this.value;
        resetSelect(typSelect, 'typy', true);
        if (modelId) {
            fetch('<?= base_url('/home/getTypesByModel'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ model_id: modelId })
            })
            .then(response => response.json())
            .then(data => {
                resetSelect(typSelect, 'typy', true);
                if (data.length > 0) {
                    data.forEach(typ => {
                        const option = document.createElement('option');
                        option.value = typ.id;
                        option.textContent = typ.typ;
                        typSelect.appendChild(option);
                    });
                }
                typSelect.disabled = false;
            });
        } else {
            // Pokud není vybrán žádný model, povol všechny typy
            typSelect.disabled = false;
        }
    });

    window.addEventListener('DOMContentLoaded', function () {
        if (znackaSelect.value) modelSelect.disabled = false;
        if (modelSelect.value) typSelect.disabled = false;
    });

    function confirmDelete(id) {
        if (confirm('Opravdu chcete smazat toto auto?')) {
            window.location.href = '<?= base_url('auta/delete/'); ?>' + id;
        }
    }
</script>
<?= $this->endSection(); ?>
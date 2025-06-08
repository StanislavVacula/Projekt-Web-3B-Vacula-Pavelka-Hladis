<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
O nás
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4" style="font-weight: bold; color: #dc3545;">O nás</h1>
                    <p class="lead text-center mb-4">Jsme tým mladých nadšenců do aut a moderních technologií.</p>
                    <div class="text-center mb-4">
                        <img src="https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=800&q=80" alt="Tým Autosalonu" class="img-fluid rounded shadow" style="max-height: 250px;">
                    </div>
                    <p class="mb-4" style="font-size: 1.1rem;">
                        Tento projekt vznikl v rámci studia na <strong>Obchodní akademii Uherské Hradiště</strong> jako ukázka našich schopností v oblasti webových technologií a týmové spolupráce. Naším cílem bylo vytvořit moderní a přehledný autosalon, kde si každý najde to své vysněné auto.
                    </p>
                    <div class="mb-4">
                        <h3 class="mb-3" style="color: #007bff;">Náš tým</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Vojtěch Pavelka</strong> – vývojář, návrh databáze, frontend</li>
                            <li class="list-group-item"><strong>Stanislav Vacula</strong> – backend, logika aplikace, testování</li>
                            <li class="list-group-item"><strong>Michal Hladiš</strong> – design, dokumentace, UX/UI</li>
                        </ul>
                    </div>
                    <blockquote class="blockquote text-center mt-4">
                        <p class="mb-0">„Naše práce je naším koníčkem. Věříme, že spojení technologií a vášně pro auta může přinést skvělé výsledky.“</p>
                        <footer class="blockquote-footer">Tým Autosalonu</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

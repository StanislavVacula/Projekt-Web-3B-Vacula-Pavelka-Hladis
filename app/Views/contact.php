<?= $this->extend('layout/template'); ?>

<?= $this->section('title'); ?>
Kontakt
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4" style="font-weight: bold; color: #007bff;">Kontaktujte nás</h1>
                    <p class="lead text-center mb-4">Máte dotaz nebo zájem o spolupráci? Napište nám!</p>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Jméno</label>
                            <input type="text" class="form-control" id="name" placeholder="Vaše jméno" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" placeholder="vas@email.cz" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Zpráva</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Vaše zpráva" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Odeslat</button>
                    </form>
                    <div class="text-center mt-4">
                        <small class="text-muted">Obchodní akademie Uherské Hradiště &bull; Studentský projekt</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

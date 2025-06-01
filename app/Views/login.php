
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4 text-center">Přihlášení</h2>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>
    <form action="<?= base_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="identity" class="form-label">Email nebo uživatelské jméno</label>
            <input type="text" class="form-control" id="identity" name="identity" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
            <label class="form-check-label" for="remember">Zapamatovat si mě</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Přihlásit se</button>
    </form>
</div>
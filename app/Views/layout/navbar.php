<?php
$ionAuth = service('ionAuth');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">Autosalon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Domů</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/about'); ?>">O nás</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/contact'); ?>">Kontakt</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if ($ionAuth->loggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/logout'); ?>">Odhlásit se</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/login'); ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
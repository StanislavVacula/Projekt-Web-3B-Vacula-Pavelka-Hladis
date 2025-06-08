<?php
$ionAuth = service('ionAuth');
?>
<style>
.navbar-modern {
    background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
    box-shadow: 0 4px 24px rgba(0,0,0,0.08), 0 1.5px 6px rgba(0,0,0,0.04);
    transition: background 0.4s cubic-bezier(.68,-0.55,.27,1.55), box-shadow 0.3s;
}
.navbar-modern .navbar-brand {
    font-weight: bold;
    font-size: 1.7rem;
    letter-spacing: 1px;
    color: #fff !important;
    transition: color 0.2s;
    text-shadow: 0 2px 8px #007bff44;
    padding-right: 2rem;
}
.navbar-modern .navbar-nav .nav-link {
    color: #e3e3e3 !important;
    font-weight: 500;
    font-size: 1.1rem;
    margin-right: 0.7rem;
    border-radius: 8px;
    transition: background 0.2s, color 0.2s, transform 0.15s;
    padding: 0.5rem 1.1rem;
}
.navbar-modern .navbar-nav .nav-link:hover, .navbar-modern .navbar-nav .nav-link.active {
    background: rgba(255,255,255,0.13);
    color: #fff !important;
    transform: scale(1.08);
    box-shadow: 0 2px 8px #007bff22;
}
.navbar-modern .navbar-toggler {
    border: none;
    background: #fff2;
    transition: background 0.2s;
}
.navbar-modern .navbar-toggler:focus {
    background: #fff4;
}
@media (max-width: 991px) {
    .navbar-modern .navbar-nav .nav-link {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
}
</style>
<nav class="navbar navbar-expand-lg navbar-modern sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">Autosalon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Domů odstraněno, Autosalon je hlavní odkaz -->
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
<script>
// Animace při scrollu (stín)
window.addEventListener('scroll', function() {
    const nav = document.querySelector('.navbar-modern');
    if (window.scrollY > 10) {
        nav.style.boxShadow = '0 8px 32px #007bff33';
    } else {
        nav.style.boxShadow = '0 4px 24px rgba(0,0,0,0.08), 0 1.5px 6px rgba(0,0,0,0.04)';
    }
});
</script>
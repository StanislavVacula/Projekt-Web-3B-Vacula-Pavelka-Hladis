<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>Správa aut<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <h1 class="mb-4">Správa aut</h1>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zavřít"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zavřít"></button>
        </div>
    <?php endif; ?>
    <a href="<?= base_url('auta/create'); ?>" class="btn btn-success mb-3">Přidat nové auto</a>
    <div class="mb-2">
        <strong>Celkový počet aut v databázi:</strong> <?= isset($celkemAut) ? $celkemAut : count($auta); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Značka</th>
                    <th>Model</th>
                    <th>Typ</th>
                    <th>Palivo</th>
                    <th>Cena</th>
                    <th>Obrázek</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auta as $auto): ?>
                    <tr<?= !empty($auto['deleted_at']) ? ' class="table-danger"' : '' ?> >
                        <td><?= $auto['id'] ?? '-'; ?></td>
                        <td><?= $auto['znacka'] ?? $auto['znacka_auta_id'] ?? '-'; ?></td>
                        <td><?= $auto['model'] ?? '-'; ?></td>
                        <td><?= $auto['typ'] ?? '-'; ?></td>
                        <td><?= $auto['palivo'] ?? '-'; ?></td>
                        <td><?= isset($auto['cena']) ? number_format($auto['cena'], 0, ',', ' ') . ' Kč' : '-'; ?></td>
                        <td><?php if (!empty($auto['obrazek'])): ?><img src="<?= $auto['obrazek']; ?>" alt="obrázek" style="max-width: 80px;"><?php endif; ?></td>
                        <td>
                            <a href="<?= base_url('auta/edit/' . $auto['id']); ?>" class="btn btn-primary btn-sm">Editovat</a>
                            <?php if (empty($auto['deleted_at'])): ?>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $auto['id']; ?>"><i class="bi bi-trash"></i> Smazat</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal<?= $auto['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $auto['id']; ?>" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $auto['id']; ?>">Opravdu smazat auto?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
                                      </div>
                                      <div class="modal-body">
                                        Opravdu chcete smazat toto auto? Tato akce je nevratná.
                                      </div>
                                      <div class="modal-footer">
                                        <form method="post" action="<?= base_url('auta/delete/' . $auto['id']); ?>">
                                          <?= csrf_field() ?>
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                                          <button type="submit" class="btn btn-danger">Smazat</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php else: ?>
                                <span class="text-muted">Smazáno</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>

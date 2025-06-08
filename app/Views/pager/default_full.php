<?php
// Vlastní Bootstrap stránkování pro CodeIgniter 4 – zkrácené (elipsy)
// Uloženo jako app/Views/pager/default_full.php
?>
<?php $pagerGroup = isset($pagerGroup) ? $pagerGroup : 'default'; ?>
<?php $links = $pager->links($pagerGroup); ?>
<?php if ($links): ?>
    <ul class="pagination justify-content-center pagination-lg" style="gap:0.5rem;">
        <?php if ($pager->hasPrevious($pagerGroup)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst($pagerGroup) ?>" aria-label="První">&laquo;&laquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious($pagerGroup) ?>" aria-label="Předchozí">&laquo;</a>
            </li>
        <?php endif ?>
        <?php
        // Najdi aktuální stránku a počet stránek z pole $links
        $current = 1;
        $pageCount = 1;
        if (is_array($links) && count($links) > 0) {
            foreach ($links as $link) {
                if (!empty($link['active'])) $current = (int)$link['title'];
            }
            $pageCount = (int)end($links)['title'];
        }
        $range = 2; // kolik čísel okolo aktuální stránky
        for ($i = 1; $i <= $pageCount; $i++) {
            if (
                $i == 1 || $i == $pageCount ||
                ($i >= $current - $range && $i <= $current + $range)
            ) {
                $active = $i == $current ? ' active' : '';
                // Najdi správný odkaz z $links
                $uri = '#';
                foreach ($links as $link) {
                    if ((int)$link['title'] === $i && !empty($link['uri'])) {
                        $uri = $link['uri'];
                        break;
                    }
                }
                echo '<li class="page-item' . $active . '"><a class="page-link" href="' . $uri . '">' . $i . '</a></li>';
            } elseif (
                ($i == 2 && $current - $range > 2) ||
                ($i == $pageCount - 1 && $current + $range < $pageCount - 1)
            ) {
                echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
            }
        }
        ?>
        <?php if ($pager->hasNext($pagerGroup)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext($pagerGroup) ?>" aria-label="Další">&raquo;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast($pagerGroup) ?>" aria-label="Poslední">&raquo;&raquo;</a>
            </li>
        <?php endif ?>
    </ul>
<?php endif ?>
<style>
.pagination .page-link {
    border-radius: 12px;
    border: none;
    color: #007bff;
    font-weight: 600;
    font-size: 1.1rem;
    box-shadow: 0 2px 8px #007bff22;
    margin: 0 2px;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.15s;
}
.pagination .page-link:hover, .pagination .page-item.active .page-link {
    background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
    color: #fff;
    box-shadow: 0 4px 16px #007bff33;
    transform: scale(1.08);
}
.pagination .page-item.disabled .page-link {
    color: #aaa;
    background: #f8f9fa;
    box-shadow: none;
}
</style>

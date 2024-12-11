<div id="<?= $id ?>" class="collapse <?= checkIsShow(array_column($items, 'href'), $currentPath) ?>" data-bs-parent="#sideNavbar">
   <ul class="nav flex-column">
      <?php foreach ($items as $item): ?>
         <?= loadComponents('/layout/nav-item', 'admin', [
            'href' => $item['href'],
            'iconClass' => $item['iconClass'],
            'text' => $item['text'],
            'active' => $currentPath == $item['href']
         ]) ?>
      <?php endforeach; ?>
   </ul>
</div>
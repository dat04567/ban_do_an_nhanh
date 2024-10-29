<?php
function renderPageHeader($title, $breadcrumbs = [], $actionButton = null) {
    ?>
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2><?php echo htmlspecialchars($title); ?></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <?php foreach ($breadcrumbs as $item): ?>
                                <li class="breadcrumb-item <?php echo isset($item['active']) && $item['active'] ? 'active' : ''; ?>"
                                    <?php echo isset($item['active']) && $item['active'] ? 'aria-current="page"' : ''; ?>>
                                    <?php if (isset($item['active']) && $item['active']): ?>
                                        <?php echo htmlspecialchars($item['label']); ?>
                                    <?php else: ?>
                                        <a href="<?php echo htmlspecialchars($item['href']); ?>" class="text-inherit">
                                            <?php echo htmlspecialchars($item['label']); ?>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                </div>
                <?php if ($actionButton): ?>
                    <div>
                        <?php echo $actionButton; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}
?>

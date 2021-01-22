<div class="breadcrumb">
    <?php
    if (isset($url)) {
        foreach ($url as &$path) {
    ?>
            <p class="breadcrumb-item"> <?= ucfirst($path) ?></p>
    <?php
        }
        unset($path);
    }

    ?>
</div>
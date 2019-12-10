<?php

/*
 * Template Name: Nasa Token Page
 */
use Zeidan\Controller\IndexController;

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : "";
?>

    <?php if ($picture = get_transient(IndexController::NASA_TRANSIENT_NAME)) { ?>
    <div class="image"><h3><?= _('Today\'s Picture', 'nasa_plugin'); ?></h3>
        <p><a href="<?= $picture->hdurl; ?>" target="_blank"><img src="<?= $picture->url; ?>" width="100%"></a></p>
        <hr>
        <h2><?= $picture->title ?></h2>
        <p>&copy; <?php isset($picture->copyright) ? $picture->copyright : "" ?></p>
        <p><?= $picture->explanation ?></p>
    </div>
    <?php } ?>
<?php

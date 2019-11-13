<?php
/*
 * Template Name: Nasa Token Page
 */
use Zeidan\Controller\IndexController;

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : "";
?>

	<div id="ezdev-token" class="inside">
		<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="initial-form hide-if-no-js">
			<div class="input-text-wrap" id="title-wrap">
				<label for="token">NASA Api Token</label>
				<input type="token" name="token" id="token" value="<?= get_option(IndexController::OPTION_NASA_FIELD); ?>">
			</div>
			<p class="submit">
				<input type="hidden" name="action" value="token_form">
				<input type="submit" id="token-add" class="button button-primary" value="Añadir Token">
				<br class="clear">
			</p>
		</form>
	</div>
	<div id="ezdv-message"><?= $message; ?></div>
    <?php if($picture = get_transient(IndexController::NASA_TRANSIENT_NAME)) { ?>
    <hr>
    <div class="image"><h3><?= _('Today\'s Picture', 'nasa_plugin'); ?></h3>
        <p><a href="<?= $picture->hdurl; ?>" target="_blank"><img src="<?= $picture->url; ?>" width="100%"></a></p>
        <p><?= $picture->title ?></p>
        <p>&copy; <?= $picture->copyright ?></p>
        <p><?= $picture->explanation ?></p>
    </div>
    <?php } ?>
<?php

<?php

function wp_postit_update() {
	global $wpdb;
	$table_name = $wpdb->prefix . "postit";
	$id = $_GET["id"];
	$nota = $_POST["nota"];
	$activa = $_POST["activa"];
	$created = $_POST["created"];
//update
	if (isset($_POST['update'])) {
		$wpdb->update(
				$table_name, //table
				array('nota' => $nota, 'activa' => $activa), //data
				array('ID' => $id), //where
				array('%s'), //data format
				array('%s') //where format
		);
	}
//delete
	else if (isset($_POST['delete'])) {
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
	} else {//selecting value to update
		$postit = $wpdb->get_results($wpdb->prepare("SELECT id,nota,activa,created from $table_name where id=%s", $id));
		foreach ($postit as $s) {
			$nota = $s->nota;
			$activa = $s->activa;
		}
	}
	?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/wp-postit/style-admin.css" rel="stylesheet" />
	<div class="wrap">
		<h2>Post-it</h2>

		<?php if ($_POST['delete']) { ?>
			<div class="updated"><p>Postit Borrado</p></div>
			<a href="<?php echo admin_url('admin.php?page=wp_postit_list') ?>">&laquo; De vuelta a la lista de postit </a>

		<?php } else if ($_POST['update']) { ?>
			<div class="updated"><p>Postit Actualizado</p></div>
			<a href="<?php echo admin_url('admin.php?page=wp_postit_list') ?>">&laquo; De vuelta a la lista de postit </a>

		<?php } else { ?>
							<div class="row">
		<table class='wp-list-table widefat fixed striped posts'>
			<tr>
			<th class="manage-column ss-list-width">Activa debe estar en 1 para que se visualice en el shorttag &#x3C;?= do_shortcode(&#x27;[postit]&#x27;); ?&#x3E;</h1></th>
			</tr>
		</div>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<table class='wp-list-table widefat fixed'>
					<tr><th>Nota</th><td><input type="text" name="nota" value="<?php echo $nota; ?>"/></td></tr>
					<tr><th>Activa</th><td><input type="text" name="activa" value="<?php echo $activa; ?>"/></td></tr>
				</table>
				<input type='submit' name="update" value='Grabar' class='button'> &nbsp;&nbsp;
				<input type='submit' name="delete" value='Borrar' class='button' onclick="return confirm('&iquest;Est&aacute;s seguro de borrar este elemento?')">
			</form>
		<?php } ?>

	</div>
	<?php
}

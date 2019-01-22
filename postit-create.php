<?php

function wp_postit_create() {
	$id = $_GET["id"];
	$nota = $_POST["nota"];
	$activa = $_POST["activa"];
	$created = $_POST["created"];
	//insert
	if (isset($_POST['insert'])) {
		global $wpdb;
		$table_name = $wpdb->prefix . "postit";

		$wpdb->insert(
				$table_name, //table
				array('nota' => $nota, 'activa' => $activa), //data
				array('%s', '%s') //data format
		);
		$message.="Post-it Agregado";
	}
	?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/wp-postit/style-admin.css" rel="stylesheet" />
	<div class="wrap">
		<h2>Agregar Nuevo Post-it</h2>
		<?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<div class="row">
		<table class='wp-list-table widefat fixed striped posts'>
			<tr>
			<th class="manage-column ss-list-width">Activa debe estar en 1 para que se visualice en el shorttag &#x3C;?= do_shortcode(&#x27;[postit]&#x27;); ?&#x3E;</h1></th>
			</tr>
		</div>
			<table class='wp-list-table widefat fixed'>

				<tr>
					<th class="ss-th-width">postit</th>
					<td><input type="text" name="name" value="<?php echo $nota; ?>" class="ss-field-width" /></td>
				</tr>
				<tr>
					<th class="ss-th-width">Activa</th>
					<td><input type="text" name="activa" value="<?php echo $activa; ?>" class="ss-field-width" /></td>
				</tr>
			</table>
			<input type='submit' name="insert" value='Grabar' class='button'>
		</form>
	</div>
	<?php
}

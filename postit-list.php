<?php

function wp_postit_list() {
	?>
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/wp-postit/style-admin.css" rel="stylesheet" />
	<div class="wrap">
		<h2>Post-it</h2>
		<div class="tablenav top">
			<div class="alignleft actions">
				<a href="<?php echo admin_url('admin.php?page=wp_postit_create'); ?>">Nuevo Post-It</a>
			</div>
			<br class="clear">

		</div>
		<div class="row">
		<table class='wp-list-table widefat fixed striped posts'>
			<tr>
			<th class="manage-column ss-list-width">
			<h1>Usar el shorttag de la siguiente manera &#x3C;?= do_shortcode(&#x27;[postit]&#x27;); ?&#x3E;
			</h1></th>
			</tr>
		</div>
		<?php
		global $wpdb;
		$table_name = $wpdb->prefix . "postit";

		$rows = $wpdb->get_results("SELECT id,nota,activa,created from $table_name");
		?>
		<table class='wp-list-table widefat fixed striped posts'>
			<tr>
				<th class="manage-column ss-list-width">ID</th>
				<th class="manage-column ss-list-width">Nota</th>
				<th class="manage-column ss-list-width">Activa</th>
				<th class="manage-column ss-list-width">Creada</th>
				<th>&nbsp;</th>
			</tr>
			<?php foreach ($rows as $row) { ?>
				<tr>
					<td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->nota; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->activa; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->created; ?></td>
					<td><a href="<?php echo admin_url('admin.php?page=wp_postit_update&id=' . $row->id); ?>">Actualizar</a></td>
				</tr>
			<?php } ?>
		</table>
	</div>
	<?php
}

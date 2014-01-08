<?php
	
?>
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form id="roster" action="../wp-content/plugins/SUVBC_roster/roster_admin.php" method="post">
		<?php settings_fields( 'suvbc_rotster_group' ); ?>
		<h2><?php _e( 'Add, modifiy, or remover players from the roster section', 'SUVBC_domain' ); ?></h2>
		<h3><?php _e( 'Add new player', 'SUVBC_domain' ); ?></h3>
		
		<input type="text" class="admin_input" id="suvbc_number" name="suvbc_number" placeholder="Number" value=""/>

		<input type="text" class="admin_input" id="suvbc_name" name="suvbc_name" placeholder="Name" value=""/>
				
		<input type="text" class="admin_input" id="suvbc_pos" name="suvbc_pos" placeholder="Position" value=""/>
				
		<input type="text" class="admin_input" id="suvbc_year" name="suvbc_year" placeholder="Year" value=""/>
		
		<input type="text" class="admin_input" id="suvbc_ht" name="suvbc_ht" placeholder="Hometown" value=""/>

		<input type="file" class="admin_input" id="suvbc_img" name="suvbc_img" placeholder="Player Image" value=""/>

		<textarea rows="10" cols="50" name="suvbc_bio" placeholder="Player Bio"></textarea>

		<input type="submit" value="<?php _e( 'Save', 'SUVBC_domain' ); ?>" />

	</form>
	<span class="target">ajax response !!!</span>

	<div class="display_admin_table">
		<table cellpadding="5" cellspacing="5" width="100%">	
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Pos.</th>
					<th>Cl.</th>
					<th>Hometown</th>
				</tr>
			</thead>
			<tbody>
			<?php
				global $wpdb;

				$table_name = $wpdb->prefix . 'suvbc_Roster';
				$admin_query = $wpdb->get_results("SELECT * FROM wp_suvbc_Roster"); 
				foreach ($admin_query as $print){
					echo '<tr>';
					echo '<td>'.$print->player_number.'</td>';
					echo '<td>'.$print->player_name.'</td>';
					echo '<td>'.$print->player_position.'</td>';
					echo '<td>'.$print->player_year.'</td>';
					echo '<td>'.$print->player_hometown.'</td>';
					}
			?>

			</tbody>
		</table>	
</div>
<?php
?>
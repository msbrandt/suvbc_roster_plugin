<?php
	$SU_number = $_POST['suvbc_number'];
	$SU_name = $_POST['suvbc_name'];
	$SU_position = $_POST['suvbc_pos'];
	$SU_year = $_POST['suvbc_year'];
	$SU_hometown = $_POST['suvbc_ht'];
	$SU_image = $_POST['suvbc_img'];
	$SU_bio = $_POST['suvbc_bio'];

	
?>
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form id="roster" method="post" action="roster_admin.php">
		<?php settings_fields( 'suvbc_rotster_group' ); ?>
		<h2><?php _e( 'Add, modifiy, or remover players from the roster section', 'SUVBC_domain' ); ?></h2>
		<h3><?php _e( 'Add new player', 'SUVBC_domain' ); ?></h3>
		
		<input type="text" class="admin_input" id="suvbc_number" name="suvbc_number" placeholder="Number" />

		<input type="text" class="admin_input" id="suvbc_name" name="suvbc_name" placeholder="Name" />
				
		<input type="text" class="admin_input" id="suvbc_pos" name="suvbc_pos" placeholder="Position" />
				
		<input type="text" class="admin_input" id="suvbc_year" name="suvbc_year" placeholder="Year" />
		
		<input type="text" class="admin_input" id="suvbc_ht" name="suvbc_ht" placeholder="Hometown" />

		<input type="file" class="admin_input" id="suvbc_img" name="suvbc_img" placeholder="Player Image" />

		<textarea rows="10" cols="50" name="suvbc_bio" placeholder="Player Bio"></textarea>

		<input type="submit" value="<?php _e( 'Save', 'SUVBC_domain' ); ?>" />

	</form>

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

				$table_name = $wpdb->prefix . 'Roster';
				$admin_query = $wpdb->get_results("SELECT * FROM wp_Roster"); 
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
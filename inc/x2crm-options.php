
<?php
function wp2x2crm_display_contents()
{
   $options = get_option( 'wp2x2crm_op_array' );
?>
   <div class="wrap">
      <h2>x2CRM Details</h2>
	  <?php
  if ( isset( $_GET['m'] ) && $_GET['m'] == '1' )
  {
?>
   <div id='message' class='updated fade'><p><strong>You have successfully updated your x2CRM Details.</strong></p></div>
<?php
  }
?>
      <form method="post" action="admin-post.php">
         <input type="hidden" name="action" value="wp2x2crm_save_x2crm_option" />
 
         <?php wp_nonce_field( 'wp2x2crm_op_verify' ); ?>
				<div style="margin-bottom:10px;">
				<label style="margin-bottom:3px; clear:both;">Username:</label><br/>
				 <input type="text" name="x2crm_username" value="<?php echo esc_html( $options['wp2x2crm_op_x2crm_username'] ); ?>"/>
				 <div style="margin-top:3px;">Select user account's username</div>
				 </div>
				 <div style="margin-bottom:10px;">
				 <label style="margin-bottom:3px;">API Key:</label><br/>
				  <input type="text" name="x2crm_apikey" value="<?php echo esc_html( $options['wp2x2crm_op_x2crm_apikey'] ); ?>"/>
				  <div style="margin-top:3px;">User's API Key can be found by selecting Users in x2CRM then selecting user from the list and Update User in the left nav</div>
				  </div>
		 <div style="margin-bottom:10px;">
		 <label style="margin-bottom:3px;">x2CRM Location:</label><br/>
		  <input type="text" name="x2crm_url" value="<?php echo esc_html( $options['wp2x2crm_op_x2crm_url'] ); ?>"/>
		  <div style="margin-top:3px;">Location of your x2CRM install. ('www.host.domain/path/to/x2)</div>
		  </div>
		  <div style="margin-bottom:10px;">
		 <label style="margin-bottom:3px;">x2CRM Tracking Code:</label><br/>
		   <input type="checkbox" name="x2crm_webtracker" value="Yes"<?php checked( isset( $options['wp2x2crm_op_x2crm_webtracker'] ) ); ?> />&nbsp;Yes, I want to add web tracking
		   <div style="margin-top:3px;">Allows you to track contacts visiting your website. If tracking from a different domain make certain to update the setting in x2CRM. Admin menu -> Web Tracker -> Public Info</div>
		 </div>
         <input type="submit" value="Submit" class="button-primary"/>
      </form>
	  <br>
	 
   </div>
<?php
}
add_action( 'admin_post_wp2x2crm_save_x2crm_option', 'process_wp2x2crm_x2crm_options' );


	

?>
<?php
if ( get_option( 'wp2x2crm_op_array' ) === false ) {
	
} else {
function contactform7_before_send_mail( $form_to_DB ) {
 global $wpdb;
 
 $options =get_option( 'wp2x2crm_op_array' );
 $username =$options['wp2x2crm_op_x2crm_username'];
 $apikey =$options['wp2x2crm_op_x2crm_apikey'];
 $url =$options['wp2x2crm_op_x2crm_url'];

$form_to_DB = WPCF7_Submission::get_instance();

if ( $form_to_DB ) {
$formData = $form_to_DB->get_posted_data();
}

require 'APIModel.php';
$attributes = $_POST;
$contact = new APIModel($username,$apikey,$url);
$fieldMap = array( // This map should be of the format 'your_fieldname'=>'x2_fieldname',
    $formData['firstName']=>'firstName',
    $formData['lastName']=>'lastName',
    $formData['phone']=>'phone',
	$formData['phone2']=>'phone2',
	$formData['email']=>'email',
    $formData['visibility']=>'visibility',
	$formData['leadtype']=>'leadtype',
	$formData['leadSource']=>'leadSource',
	$formData['interest']=>'interest',
	$formData['website']=>'website',
	$formData['address']=>'address',
	$formData['address2']=>'address2',
	$formData['city']=>'city',
	$formData['state']=>'state',
	$formData['zipcode']=>'zipcode',
	$formData['country']=>'country',
	$formData['leadscore']=>'leadscore',
	
);
$contact->email=$attributes['email'];
$contact->contactLookup();
if($contact->responseCode!='404'){
   foreach($attributes as $key => $value){ // Try to set any empty attributes
        if(isset($fieldMap[$key]) && empty($contact->{$fieldMap[$key]})){ // Check if value is empty + found in field map
            $contact->{$fieldMap[$key]} = $value; // Found in field map, used mapped attribute
        }elseif(empty($contact->$key)){ // Just check if value is empty
            $contact->$key = $value; // No match in field map, assume it's a Contact attribute
        }
    }
    $contact->contactUpdate();
} 

foreach($attributes as $key=>$value){
   if(isset($fieldMap[$key])){
        $contact->{$fieldMap[$key]}=$value; // Found in field map, used mapped attribute
    }else{
        $contact->$key=$value; // No match anywhere, assume it's a Contact attribute
    }
}
if(isset($_POST['x2_key'])){
    $contact->trackingKey=$_POST['x2_key'];
}
$contact->contactCreate(); // Call API to create contact

  
}  
remove_all_filters ('wpcf7_before_send_mail');
add_action( 'wpcf7_before_send_mail', 'contactform7_before_send_mail' );
}

function x2crm_add_tracker() { 
 $options =get_option( 'wp2x2crm_op_array' );
 $url =$options['wp2x2crm_op_x2crm_url'];
 $webtracker = $options['wp2x2crm_op_x2crm_webtracker'];
 
 if ($webtracker == 'Yes' ) {
?>
<script src="//<?php echo $url; ?>webTracker.php"></script>
<?php }

}
add_action('wp_head', 'x2crm_add_tracker');
?>
<?php
// contact form 7 email validation
add_filter( 'wpcf7_validate_email*', 'custom_email_validation_filter', 50, 2 );
function custom_email_validation_filter( $result, $tag ) {
  $email_tag_array=array("your-email","email");
  foreach ($email_tag_array as $key => $email_tag_name) {
    if ( $email_tag_name == $tag->name ) {
        $your_email = isset( $_POST[$email_tag_name] ) ? trim( $_POST[$email_tag_name] ) : '';
        if(!empty($your_email)){
        $domain_name = substr(strrchr($your_email, "@"), 1);
        $email_checker_test=true;
        if(!empty($domain_name)){
        if(checkdnsrr($domain_name,"MX")) {
            $email_checker_test=true;
        }else{
            $email_checker_test=false;
        }
    }else{
        $email_checker_test=false;
        }
    
        if ( $email_checker_test == false) {
        $result->invalidate( $tag, "The e-mail address entered is invalid." );
        }
    }
    }
}
    return $result;
}
?>

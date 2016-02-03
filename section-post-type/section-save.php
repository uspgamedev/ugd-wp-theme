<?php 

//save

add_action('save_post', 'save_section_post_meta', 1);
function save_section_post_meta( $post_id ) {
    // Do stuff.

    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        /*
        
        wp_die('<h2>FUCK! YOU DONE FUCKED UP. Autosave Error.</h2>');

        */
        return;
    }

    // verify if this is the right post type
    if ( get_post($post_id)->post_type != 'ugd_section' ) {
        /*
        
        $message = "<br><strong>Post Types are different.</strong>
            <br>Expected: ugd_section<br>Got: " . get_post($post_id)->post_type;

        wp_die('<h2>FUCK! YOU DONE FUCKED UP. Wrong Post Type Error.</h2>' . $message);

        */
        return;

    }

    // check author permissions
    if (!current_user_can('edit_post', $post_id)) { 
        /*

        wp_die('<h2>FUCK! YOU DONE FUCKED UP. Author Permission Error.</h2>');

        */
        return;
    }

    // verify nonce
    if ( !wp_verify_nonce( $_POST['UGD_section_fields'], 'UGD_metabox_nonce' ) ) {
        /*
        $m
        essage = "<br><strong>Nonces are different.</strong>
            <br>Expected: " . plugin_basename( __FILE__ ) . "<br>Got: " . $nonce;
        
        wp_die('<h2>FUCK! YOU DONE FUCKED UP. Nonce Error.</h2>' . $message);

        */
        return;
    }

    // OK, we're authenticated: we need to find and save the data
    update_post_meta($post_id, 'section_type', $_POST['section_type']);
    update_post_meta($post_id, 'section_content', $_POST['section_content']);
}

?>
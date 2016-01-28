<?php 

//save

add_action('save_post', 'save_section_post_meta', 1);
function save_section_post_meta( $post_id ) {

    // verify nonce  
    if (isset($_POST['horisec_section_nonce']) && (!wp_verify_nonce($_POST['horisec_section_nonce'], basename(__FILE__)))) return;
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    // check permissions and verify if this is our post type saving.
	if ( get_post($post_id)->post_type != 'horisec_section' ) {
        return;
    } elseif (!current_user_can('edit_post', $post_id)) { 
        return;
    }

    // OK, we're authenticated: we need to find and save the data
    $sectiontype = $_POST['section_type'];
    $sectioncontent = $_POST['section_content'];
    
    update_post_meta($post_id, 'section_type', $sectiontype);
    update_post_meta($post_id, 'section_content', $sectioncontent);
}

?>
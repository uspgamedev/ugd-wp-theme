<?php

//metaboxes

add_action('add_meta_boxes', 'add_section_meta_box');
function add_section_meta_box() {
	add_meta_box('horisec_section', __('Type of Section'), 'section_get_post_meta', 'horisec_section', 'normal', 'high');
}

/* Prints the box content */
function section_get_post_meta() {
	global $post;

	$post_id = $post->ID;

    wp_create_nonce( basename( __FILE__ ), 'horisec_section_nonce' );

    $stype = get_post_meta($post_id, 'section_type', true);
    $scontent = get_post_meta($post_id, 'section_content', true);

    $type_options = array(
        'cover' => 'Cover',  //no second meta
        'query' => 'Query',  //second meta is cat id
        'page' => 'Page'     //second meta is page id
    );

    $unset = true;

    //section content

    //query
    $categories = get_categories();
    //page
    $pages = get_posts( array( 'post_type' => 'page', 'posts_per_page' => -1 ) );

    ?>
    <div id="metabox">
        

        <select id="section_type_selector" name="section_type">
            <?php foreach ($type_options as $option => $label) { ?>
                <?php if ($stype == $option) { ?>
                    <?php $unset = false; ?>
                    <option value="<?php echo $option; ?>" selected><?php echo $label; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $option; ?>"><?php echo $label; ?></option>
                <?php } ?>
            <?php } ?>
            <option value <?php if ($unset) echo 'selected'; ?>><?php _e('-- undefined --') ?></option>
        </select>
        <div><small>
            <?php _e('Choose what kind of section you want.'); ?>
        </small></div>
        <hr>
        <div id="metabox_section_content">
            <?php if (!empty($stype)) {
                $unset2 = true;
                if ($stype == 'cover') {
                    print("OK, you're good to go. This section will display your header image. I recommend something with a transparent background.");
                } elseif ($stype == 'query') {
                    print('<select name="section_content">');
                    foreach ($categories as $category) { 
                        if ($scontent == $category->cat_ID) {
                            printf('<option value=%1$s selected>%2$s</option>', $category->cat_ID, $category->name);
                            $unset2 = false;
                        } else {
                            printf('<option value=%1$s >%2$s</option>', $category->cat_ID, $category->name);
                        }
                    }
                    if ($unset2) {
                        print('<option value selected>-- undefined --</option>');
                    } else {
                        print('<option value >-- undefined --</option>');
                    }
                    print('</select>');
                } elseif ($stype == 'page') {
                    print('<select name="section_content">');
                    foreach ($pages as $page) { 
                        if ($scontent == $page->ID) {
                            printf('<option value=%1$s selected>%2$s</option>', $page->ID, $page->post_title);
                            $unset2 = false;
                        } else {
                            printf('<option value=%1$s >%2$s</option>', $page->ID, $page->post_title);
                        }
                    }
                    if ($unset2) {
                        print('<option value selected>-- undefined --</option>');
                    } else {
                        print('<option value >-- undefined --</option>');
                    }
                    print('</select>');
                }
            } ?>
        </div>

    </div>

    <script type="text/javascript">

        function add_cover_content() {
            jQuery('#metabox_section_content').empty();
            jQuery('#metabox_section_content').append("OK, you're good to go. This section will display your header image. I recommend something with a transparent background.");
        }
        function add_query_content() {
            jQuery('#metabox_section_content').empty();

            var options = "<select name='section_content'>";
            <?php foreach ($categories as $category) { ?>
                options = options + "<?php printf('<option value=%1$s >%2$s</option>', $category->cat_ID, $category->name); ?>";
            <?php } ?>;
            options += "<option value selected>-- undefined --</option>";
            options += "</select>";
            console.log(options);

            jQuery('#metabox_section_content').append(options);
            jQuery('#metabox_section_content').append("<div><small>Choose a category for the section. All posts withing that category will be shown in this section.</small></div>");
        }
        function add_page_content() {
            jQuery('#metabox_section_content').empty();

            var options = "<select name='section_content'>";
            <?php foreach ($pages as $page) { ?>
                options += "<?php printf('<option value=%1$s >%2$s</option>', $page->ID, $page->post_title); ?>";
            <?php } ?>;
            options += "<option value selected>-- undefined --</option>";
            options += "</select>";
            console.log(options);

            jQuery('#metabox_section_content').append(options);
            jQuery('#metabox_section_content').append("<div><small>Choose a page for the section. That page will be shown in this section.</small></div>");
        }

        jQuery('#section_type_selector').change(function() {
            var the_type = jQuery(this).val();
            if (the_type) {
                console.log("It works: " + the_type);
                if (the_type == 'cover') {
                    add_cover_content();
                } else if (the_type == 'query') {
                    add_query_content();
                } else if (the_type == 'page') {
                    add_page_content();
                }
            };
        });
    </script>
    <?php
}

?>
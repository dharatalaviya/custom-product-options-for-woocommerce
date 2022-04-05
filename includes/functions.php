<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Get Jema Fields Group All Post
function get_field_groups( array $args = []){
    
    if(empty($args)){
   		$args = array(
            'post_type' => 'jempa_field_group',
            'posts_per_page' => -1
        ); 	
    }    
   
        $the_query = new \WP_Query($args);                        //get created field groups

        // The Loop
        $data = array();
        if ($the_query->have_posts()) {
            ///	echo '<ul>';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $data[] = get_the_ID();                                    //store an array of field groups ids
            }
            ///	echo '</ul>';
        }
        wp_reset_postdata();
        return $data;
}

/**
 * used to sanitize a multidimensional array
 * @param $array
 * @return mixed
 */
function sanitize_array(&$array)
{

    //In the event we don't get an array
    if (!is_array($array)) {
        $array = sanitize_textarea_field($array);
        return $array;
    }

    foreach ($array as &$value) {

        if (!is_array($value))

            // sanitize if value is not an array
            $value = sanitize_textarea_field($value);

        else

            // go inside this function again
            $this->sanitize_array($value);

    }

    return $array;

}
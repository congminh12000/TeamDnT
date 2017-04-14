<?php

class Cornerstone_Header_Builder extends Cornerstone_Plugin_Component {

  public function setup() {
    add_filter('cornerstone_data_fragment_header_config', array( $this, 'config') );
  }

  public function config() {
    return array(
      'i18n' => $this->plugin->i18n( 'headers' ),
      'assign_contexts' => $this->get_assign_contexts()
    );

  }

  public function get_assign_contexts() {

    $contexts = array();


    $contexts[] = array(
      'value' => 'home',
      'label' => 'Front Page',
      'group' => 'Index',
      'no-heading' => true
    );

    $contexts[] = array(
      'value' => 'blog',
      'label' => 'Posts Page',
      'group' => 'Index'
    );

    // $contexts[] = array(
    //   'value' => 'shop',
    //   'label' => 'Shop',
    //   'group' => 'Index'
    // );

    $post_types = get_post_types( array(
      'public'   => true,
      'show_ui' => true,
      'exclude_from_search' => false
    ) , 'objects' );

    unset( $post_types['attachment'] );

    $posts = get_posts( array(
      'post_type' => array_keys( $post_types ) ,
      'orderby' => 'type',
      'posts_per_page' => 2500
    ) );

    $previous_type = null;
    foreach ($posts as $post) {

      $post_type_obj = get_post_type_object( $post->post_type );

      if ( $previous_type != $post->post_type ) {
        $contexts[] = array(
          'value' => 'all-' . $post->post_type,
          'group' => $post_type_obj->labels->singular_name, // Same as group
          'label' => sprintf( __( 'All %s', 'cornerstone' ), $post_type_obj->labels->name )
        );
      }

      $previous_type = $post->post_type;

      $contexts[] = array(
        'value' => $post->ID,
        'label' => $post->post_title,
        // 'post-type' => $post->post_type,
        'group' => $post_type_obj->labels->singular_name,
      );

    }

    // $taxonomies = get_taxonomies( array( 'public' => true), 'objects' );
    // foreach ( $taxonomies  as $taxonomy ) {
    //   $contexts[] = array(
    //     'value' => $taxonomy->name,
    //     'label' => $taxonomy->labels->singular_name,
    //     'group' => 'Taxonomy'
    //   );
    // }

    return $contexts;
  }

}

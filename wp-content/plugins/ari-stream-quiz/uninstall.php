<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

$queries = array(
    'DROP TABLE IF EXISTS `%1$sasq_answers`,`%1$sasq_questions`,`%1$sasq_quizzes`,`%1$sasq_result_templates`'
);

function asq_execute_queries( $queries ) {
    global $wpdb;

    foreach ( $queries as $query ) {
        $wpdb->query(
            sprintf(
                $query,
                $wpdb->prefix
            )
        );
    }
}

function asq_clear_site_data( $queries ) {
    $settings = get_option( 'ari_stream_quiz_settings' );

    if ( isset( $settings['clean_uninstall'] ) && (bool) $settings['clean_uninstall'] ) {
        asq_execute_queries( $queries );
        delete_option( 'ari_stream_quiz_version' );
        delete_option( 'ari_stream_quiz_settings' );
    }
}

if ( ! is_multisite() ) {
    asq_clear_site_data( $queries );
} else {
    global $wpdb;

    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
    $original_blog_id = get_current_blog_id();

    foreach ( $blog_ids as $blog_id )   {
        switch_to_blog( $blog_id );

        asq_clear_site_data( $queries );
    }

    switch_to_blog( $original_blog_id );
}

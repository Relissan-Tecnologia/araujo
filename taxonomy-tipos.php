<?php get_header();?>

<?php
    $paged = (get_query_var('paged')) ? get_query_var( 'paged' ) : 1;

?>
<?php get_header();?>

<?php
    $language = apply_filters( 'wpml_current_language', NULL );

    $current_term = get_queried_object();
    if ( isset($current_term->slug) ) {
        $title = $current_term->title;
        echo $language == 'en' ? "<script>window.location.href = '/en/eventos?tipo=".$current_term->slug."'</script>" : "<script>window.location.href = '/eventos?tipo=".$current_term->slug."'</script>";
    }else{
        echo $language == 'en' ? "<script>window.location.href = '/en/eventos?tipo=".$current_term->slug."'</script>" : "<script>window.location.href = '/eventos?tipo=".$current_term->slug."'</script>";
    }
?>

<?php get_footer();?>
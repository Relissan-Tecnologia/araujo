<?php get_header(); ?>
<?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

<div id="single">
    <?php if (has_post_thumbnail()) : ?>
        <div class="container" id="thumbnail">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-7">
                    <div class="post-header">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid">
                    </div>
                    <?php 
                        include_once('inc/blocks/sharer/sharer.php')
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="post-content">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();?>
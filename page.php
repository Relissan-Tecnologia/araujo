<?php get_header(); ?>
<?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

<div id="single">
    <div class="container" id="thumbnail">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="post-header">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid">
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/default.webp'); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid">
                    <?php endif; ?>
                </div>
                <?php 
                    include_once('inc/blocks/sharer/sharer.php')
                ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="post-content">
                    <h1 style="position:absolute;margin-top:-2000px"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();?>
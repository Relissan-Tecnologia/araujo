<?php 
    /*
     * Template Name: Quem Somos
     */
?>

<?php get_header(); ?>
<?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

<div id="about-page">
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

<?php 

    wp_reset_postdata();

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 15,
        'order'          => 'ASC',
        'category_name'  => 'reconhecimentos'
    );

    $query = new WP_Query( $args );                            
?>
    
<div class="container divider-block">
</div>

<div id="posts">

    <div class="container" style="overflow: hidden;">
        
        <div class="row">
            <div class="col-12">
                <?php if ( $query->have_posts() ): ?>

                    <div id="block-title-slider">

                        <h2 class="sub-title mb-4"><?php if($language == 'en') : ?>Recognitions<?php else: ?>Reconhecimentos<?php endif; ?></h2>

                        <div id="post-carousel" class="posts f-carousel">
                            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                <div class="f-carousel__slide">
                                    <a href="<?= get_permalink(); ?>" class="post">
                                        <?php if( has_post_thumbnail() ): ?>
                                            <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?= get_the_title(); ?>" class="post__image">
                                        <?php else: ?>
                                            <img src="<?= get_template_directory_uri() . '/assets/images/default.webp'; ?>" alt="<?= get_the_title(); ?>" class="post__image">
                                        <?php endif; ?>

                                        <div class="post__content">
                                            <div class="execpt">
                                                <?= get_the_excerpt(); ?>
                                            </div>
                                            <div class="date"><?= get_the_date( 'd/m/Y' ); ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <?php 
                        $category = get_category_by_slug('reconhecimentos');
                        $category_link = get_category_link($category->term_id); 
                    ?>

                    <a href="<?= esc_url($category_link); ?>" class="btn btn-load-more-posts">
                        <span><?php if($language == 'en') : ?>See more recognitions<?php else: ?>Ver mais reconhecimentos<?php endif; ?></span>
                        <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9827 10.263C11.3283 9.88189 11.3283 9.30072 10.9827 8.91959L3.26512 0.408297C2.86823 -0.029407 2.1804 -0.0294064 1.78351 0.408298L1.01765 1.25292C0.672057 1.63406 0.672057 2.21523 1.01765 2.59636L6.75122 8.91959C7.09682 9.30072 7.09682 9.88189 6.75122 10.263L1.01765 16.5863C0.672058 16.9674 0.672057 17.5486 1.01765 17.9297L1.78351 18.7743C2.1804 19.212 2.86823 19.212 3.26512 18.7743L10.9827 10.263Z" fill="#F45B06"/>
                        </svg>
                    </a>
                <?php else : ?>                      
                    <p><?php if($language == 'en') : ?>No recognition found.<?php else: ?>Ver mais reconhecimentos<?php endif; ?></p>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>

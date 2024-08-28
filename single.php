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
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php 
    // Recuperar IDs dos posts relacionados pelo ACF
    $related_posts_ids = get_field('related_posts');
    
    // Se houver posts relacionados pelo ACF
    if ($related_posts_ids) :
        $related_posts = new WP_Query(array(
            'post__in' => $related_posts_ids
        ));
    else :
        // Posts relacionados por categoria
        $categories = get_the_category();
        if ($categories) :
            $category_ids = wp_list_pluck($categories, 'term_id');

            $related_posts = new WP_Query(array(
                'category__in' => $category_ids,
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => 10,
            ));
        endif;
    endif;

    // Se houver posts relacionados, exibir
    if ($related_posts->have_posts()) : 
    ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">
                    <div class="divider"></div>
                    <div class="sub-title"><?php if($language === 'en'): ?>Related Posts<?php else: ?>Publicações Relacionadas<?php endif; ?></div>

                    <div class="posts-lines mb-5">
                        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="post">
                                <div class="post__title"><?php the_title(); ?></div>
                                <div class="post__date"><?php echo get_the_date('d/m/Y'); ?></div>
                            </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>

<?php get_header();?>

    <?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

    <section id="expertise" class="content container mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-12">
                            <h1><?php if($language == 'en') : ?>Expertise<?php else: ?>Áreas de atuação<?php endif; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-4 mb-4">
                    <div class="row expertise-list">
                        <?php if (have_posts()): ?>
                            <?php while (have_posts()): the_post();?>
                                <div data-expertise="<?php echo get_the_ID(); ?>" class="col-4 col-md-2 mt-2 mb-2">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                    <div class="p-3 rounded-2 d-flex align-items-center justify-content-start flex-column expertise-list-item">
                                        <img class="expertise-list-item-icon" src="<?php echo get_field('icon_main', get_the_ID()); ?>" />
                                        <img class="expertise-list-item-icon-hover" src="<?php echo get_field('icon_hover', get_the_ID()); ?>" />
                                        <span><?php echo get_the_title(); ?></span>
                                    </div>
                                    </a>
                                </div>
                            <?php endwhile;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php wp_reset_postdata(); ?>

    <div class="separator"></div>

    <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4
        );
        $recent_posts = new WP_Query($args);
    ?>
    <?php if ($recent_posts->have_posts()): ?>
        <section id="recent-posts" class="container mt-4 mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12">
                                <h3><?php if($language == 'en') : ?>Last posts<?php else: ?>Últimas publicações<?php endif; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mt-4 mb-4">
                        <div class="row recent-posts">
                            <?php while ($recent_posts->have_posts()): $recent_posts->the_post();?>
                                <div data-expertise="<?php echo get_the_ID(); ?>" class="col-12 border-start border-4 mt-2 mb-2 recent-posts-item">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <h4><?php echo get_the_title(); ?></h4>
                                        <span><?php echo get_the_date('d/m/Y'); ?></span>
                                    </a>
                                </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <?php wp_reset_postdata(); ?>

<?php get_footer();?>
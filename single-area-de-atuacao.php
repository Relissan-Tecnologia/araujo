<?php get_header();?>

    <?php global $post; ?>
    <?php $active = $post->ID; ?>
    <?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

    <?php
        $args = array(
            'post_type' => 'area-de-atuacao',
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $expertise = new WP_Query($args);
    ?>

    <?php if ($expertise->have_posts()): ?>
        <section id="expertise" class="content container mt-4 mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12">
                                <h2><?php if($language == 'en') : ?>Expertise<?php else: ?>Área de Atuação<?php endif; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mt-4 mb-4">
                        <div class="row expertise-list">
                            <?php while ($expertise->have_posts()): $expertise->the_post();?>
                                <div data-expertise="<?php echo get_the_ID(); ?>" class="col-4 col-md-2 mt-2 mb-2">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                    <div class="p-3 rounded-2 d-flex align-items-center justify-content-start flex-column expertise-list-item <?php echo $active == get_the_ID() ? 'active' : '' ; ?>">
                                        <img class="expertise-list-item-icon" src="<?php echo get_field('icon_main', get_the_ID()); ?>" />
                                        <img class="expertise-list-item-icon-hover" src="<?php echo get_field('icon_hover', get_the_ID()); ?>" />
                                        <span><?php echo get_the_title(); ?></span>
                                    </div>
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

    <div class="separator"></div>

    <section id="content" class="container mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post();?>
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    <?php endwhile;?>
                <?php endif;?>
            </div>
        </div>
    </section>

    <?php

        function lawyer_acronym($name) {
            $parts = explode(' ', $name);
            $firstNameLetter = substr($parts[0], 0, 1);
            $lastNameLetter = substr($parts[count($parts) - 1], 0, 1);
            $acronym = strtoupper($firstNameLetter . $lastNameLetter);
            return $acronym;
        }

        $args = array(
            'post_type' => 'equipe',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'related_expertise',
                    'value' => '"' . $active . '"',
                    'compare' => 'LIKE'
                )
            )
        );
        $lawyers = new WP_Query($args);
    ?>
    <?php if ($lawyers->have_posts()): ?>
        <section id="related-lawyers" class="container border-top border-1 pt-4 pt-4">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12">
                                <h3><?php if($language == 'en') : ?>Lawyers working in this area<?php else: ?>Advogados que atuam nessa área:<?php endif; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mt-4 mb-4">
                        <div class="row related-lawyers">
                            <?php while ($lawyers->have_posts()): $lawyers->the_post();?>
                                <div data-expertise="<?php echo get_the_ID(); ?>" class="col-12 col-md-6 mt-2 mb-2">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <div class="d-flex flex-row justify-content-start align-items-center related-lawyers-item">
                                            <?php $photo = get_the_post_thumbnail_url(); ?>
                                            <?php if($photo != ""): ?>
                                                <div class="related-lawyers-item-photo" style="background-image: url(<?php echo $photo ?>);"></div>
                                            <?php else: ?>
                                                <?php $acronym = lawyer_acronym(get_the_title()); ?>
                                                <div class="related-lawyers-item-acronym"><?php echo $acronym; ?></div>
                                            <?php endif; ?>
                                            <h5><?php echo get_the_title(); ?></h5>
                                        </div>
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

    <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4
        );
        $recent_posts = new WP_Query($args);
    ?>
    <?php if ($recent_posts->have_posts()): ?>
        <section id="recent-posts" class="container border-top border-1 pt-4 pt-4">
            <div class="row">
                <div class="col-12">
                    <h3><?php if($language == 'en') : ?>Last posts<?php else: ?>Últimas publicações<?php endif; ?></h3>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const contentSection = document.getElementById("content");
            if (contentSection) {
                const offset = 120; 
                const contentPosition = contentSection.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({
                    top: contentPosition,
                    behavior: 'smooth'
                });
            }
        });
    </script>

<?php get_footer();?>
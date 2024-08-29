<?php get_header();?>
<?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

<h1 style="position: absolute; left: -1000px; opacity: 0;">Araújo e Policastro Advogados</h1>

<?php
    $args = array(
        'post_type' => 'banners',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $banners = new WP_Query($args);
?>

<?php if ($banners->have_posts()): ?>
<section id="banner">
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?php while ($banners->have_posts()): $banners->the_post();?>
                    <li class="glide__slide banner">
                        <?php $desktop = get_field('banner_desktop', get_the_ID()); ?>
                        <?php $mobile = get_field('banner_mobile', get_the_ID()); ?>
                        <img class="banner-image banner-desktop" alt="<?php echo $desktop['alt']; ?>" src="<?php echo $desktop['url']; ?>" />
                        <img class="banner-image banner-mobile" alt="<?php echo $mobile['alt']; ?>" src="<?php echo $mobile['url']; ?>" />
                        <div class="banner-content">
                            <?php echo get_field('banner_content', get_the_ID()); ?>
                        </div>
                    </li>
                <?php endwhile;?>
            </ul>
        </div>

        <div class="glide__bullets separator" data-glide-el="controls[nav]">
            <?php $bullets = 0; ?>
            <?php while ($banners->have_posts()): $banners->the_post(); ?>
                <button class="glide__bullet" data-glide-dir="=<?php echo $bullets; ?>"></button>
                <?php $bullets = $bullets + 1; ?>
            <?php endwhile;?>
        </div>
    </div>
</section>
<?php endif;?>
<?php wp_reset_postdata(); ?>

<?php
    $args = array(
        'post_type' => 'links',
        'post_status' => 'publish',
        'posts_per_page' => 7
    );
    $links = new WP_Query($args);
?>

<?php if ($links->have_posts()): ?>
<section id="external-links" class="container-fluid mb-4">
    <div class="row">
        <div class="col-12 pt-4 pb-4 d-flex justify-content-flex-start justify-content-lg-center align-items-center">
            <?php while ($links->have_posts()): $links->the_post(); ?>
                <a target="_blank" href="<?php echo get_field('external_link', get_the_ID()); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
                </a>
            <?php endwhile;?>
        </div>
    </div>
</section>
<?php endif;?>
<?php wp_reset_postdata(); ?>

<?php

    $args_query = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'paged' => $paged
    );

    $publications_query = new WP_Query($args_query);
    $title = $language == 'en' ? 'Latest Posts' : 'Últimas Publicações';
    $see_more = $language == 'en' ? 'See all Publications' : 'Veja todas as Publicações';
    $text_link_more = $language == 'en' ? 'Clicking here' : 'Clicando aqui';
    $publications_link = $language == 'en' ? '/publications' : '/publicacoes';

?>

<?php if ( $publications_query->have_posts() ): ?>
    <div id="posts" class="mb-4">
        <div class="container" style="overflow: hidden;">
            <div class="row">
                <div class="col-12">
                    <div id="block-title-slider">

                        <h2 class="sub-title mb-4"><?= $title; ?></h2>

                        <div id="post-carousel" class="posts f-carousel">
                            <?php while ( $publications_query->have_posts() ) : $publications_query->the_post(); ?>
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
                            
                            <div class="f-carousel__slide post-publications-more">
                                <a href="<?= $publications_link; ?>" class="post">
                                    
                                    <div class="see-more">
                                        <span><?= $see_more ?></span>
                                    </div>

                                    <div class="link-more">
                                        <span><?= $text_link_more ?></span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<?php wp_reset_postdata(); ?>


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
                            <h2><?php if($language == 'en') : ?>Expertise<?php else: ?>Áreas de atuação<?php endif; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-4 mb-4">
                    <div class="row expertise-list">
                        <?php while ($expertise->have_posts()): $expertise->the_post();?>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
<?php wp_reset_postdata(); ?>



<section id="about-us" class="container-fluid pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="sub-title"><?php if($language == 'en') : ?>More about us<?php else: ?>Mais sobre nós<?php endif; ?></h2>
            </div>
        </div>

        <div class="row about d-flex justify-content-flex-start justify-content-lg-center align-items-center">
            <a class="about-item" href="<?php if($language == 'en') : ?>/quem-somos/en<?php else: ?>/quem-somos<?php endif; ?>">
                <div style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/quem-somos.png'; ?>)">
                    <h3><?php if($language == 'en') : ?>ABOUT US<?php else: ?>QUEM SOMOS<?php endif; ?></h3>
                </div>
            </a>

            <a class="about-item" href="<?php if($language == 'en') : ?>/equipe/en<?php else: ?>/equipe<?php endif; ?>">
                <div style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/equipe.png'; ?>)">
                    <h3><?php if($language == 'en') : ?>TEAM<?php else: ?>EQUIPE<?php endif; ?></h3>
                </div>
            </a>
            
            <a class="about-item" href="#">
                <div style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/eventos.png'; ?>)">
                    <h3><?php if($language == 'en') : ?>EVENTS<?php else: ?>EVENTOS<?php endif; ?></h3>
                </div>
            </a>
        </div>
    </div>
</section>

<div id="find-us" class="mt-3 mt-lg-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="sub-title"><?php if($language == 'en') : ?>How to find us<?php else: ?>Onde nos encontrar<?php endif; ?></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                <?php echo  get_field('options_maps', 'option'); ?>
            </div>

            <div class="d-none col-12 col-lg-3 mb-3 mb-lg-0">
                <div class="newsletter">
                    <h3 class="newsletter__title">
                        <img class="icon" src="<?=  get_template_directory_uri() . '/assets/images/OBJECTS.png'?>" />
                        <span class="text"><?php if($language == 'en') : ?>Subscribe to our newsletter<?php else: ?>Assine nossa newsletter<?php endif; ?></span>
                    </h3>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="contact-us">
                    <h3 class="contact-us__title">
                        <img class="icon" src="<?=  get_template_directory_uri() . '/assets/images/OBJECTS-PHONE.png'?>" />
                        <span class="text"><?php if($language == 'en') : ?>Contact Us<?php else: ?>Fale Conosco<?php endif; ?></span>
                    </h3>

                    <div class="contact-us__content">
                        <p><?php if($language == 'en') : ?>Phone<?php else: ?>Tel.<?php endif; ?>: <span><?php echo get_field('options_phone', 'option'); ?></span></p>
                        <p><?php if($language == 'en') : ?>Opening Hours<?php else: ?>Horário de funcionamento<?php endif; ?></p>
                        <p><?php echo get_field('options_hour', 'option'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();?>
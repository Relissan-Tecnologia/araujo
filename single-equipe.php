<?php get_header();?>

    <?php global $post; ?>
    <?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

    <?php 

        function lawyer_acronym_profile($name) {
            $parts = explode(' ', $name);
            $firstNameLetter = substr($parts[0], 0, 1);
            $lastNameLetter = substr($parts[count($parts) - 1], 0, 1);
            $acronym = strtoupper($firstNameLetter . $lastNameLetter);
            return $acronym;
        }

        if (have_posts()):
            while (have_posts()): the_post();
                $name = get_the_title();
                $role = '';
                $photo = get_the_post_thumbnail_url();
                $acronym = lawyer_acronym_profile($name);
                $localization = get_field('team_local', get_the_ID());
                $email = get_field('team_mail', get_the_ID());
                $phone = get_field('team_phone', get_the_ID());
                $vcard = get_field('team_vcard', get_the_ID());
                $curriculum = get_field('team_curriculum', get_the_ID());

                $terms = get_the_terms(get_the_ID(), 'cargos');

                if ($terms && !is_wp_error($terms)):
                    foreach($terms as $term):
                        $role = $term->name;
                        break;
                    endforeach;
                endif;

            endwhile;
        endif;    
    ?>

    <div id="lawyer" class="container">

        <div class="row lawyer pt-5 pb-4">
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row lawyer-item">
                        <div class="col-2 col-lg-1 lawyer-item-image">
                            <?php if($photo != ""): ?>
                                <div class="lawyer-item-image-photo" style="background-image: url(<?php echo $photo ?>);"></div>
                            <?php else: ?>
                                <div class="lawyer-item-image-acronym"><?php echo $acronym; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-10 col-lg-11 lawyer-item-content d-flex flex-column justify-content-center">
                            <h1><?php echo $name; ?></h1>
                            <span><?php echo $role; ?></span>
                        </div>
                    </div>

                    <div class="row lawyer-item pt-4 pb-2">
                        <div class="col-12 col-md-10 offset-md-2 offset-lg-1">
                            <div class="lawyer-item-data">
                                <div class="lawyer-item-data-icons">
                                    <?php if( $localization != "") : ?>
                                        <div class="lawyer-item-icons-location">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-local.png'; ?>">
                                            <span><?php echo $localization; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( $email != "") : ?>
                                        <div class="lawyer-item-icons-email">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/images/icone-a.png'; ?>">
                                            <a href="mailto:<?php echo $email ?>"><span><?php echo $email; ?></span></a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( $phone != "") : ?>
                                        <div class="lawyer-item-icons-phone">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-phone.png'; ?>">
                                            <a href="tel:<?php echo $phone ?>"><span><?php echo $phone; ?></span></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="lawyer-item-data-icons">
                                    <?php if( $vcard != "") : ?>
                                        <div class="lawyer-item-icons-vcard">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-v-card.png'; ?>">
                                            <a class="open-vcard" download="download" href="<?php echo $vcard ?>"><span>VCard</span></a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( $curriculum != "") : ?>
                                        <div class="lawyer-item-icons-curriculum">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-doc.png'; ?>">
                                            <a download="download" href="<?php echo $curriculum ?>"><span><?php if($language == 'en') : ?>Curriculum<?php else: ?>Currículo<?php endif; ?></span></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="separator"></div>

    <?php $expertise = get_field('related_expertise', $post->ID); ?>

    <?php if( $expertise ): ?>
        <section id="related-expertise" class="content container mt-5 mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12">
                                <h3><?php if($language == 'en') : ?>Expertise<?php else: ?>Área de Atuação<?php endif; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mt-2 mb-2">
                        <div class="row related-expertise-list">
                            <?php foreach( $expertise as $post ):  setup_postdata($post); ?>
                                <div data-expertise="<?php echo get_the_ID(); ?>" class="col-12 col-md-5 mt-2 mb-2">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                    <div class="related-expertise-list-item">
                                        <span><?php echo get_the_title(); ?></span>
                                    </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>                            
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>

    <section id="content" class="container mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php if (have_posts()): ?>
                                <?php while (have_posts()): the_post();?>
                                    <?php the_content(); ?>
                                <?php endwhile;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12">
                                <h3><?php if($language == 'en') : ?>Last posts<?php else: ?>Últimas publicações<?php endif; ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12">
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
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <?php wp_reset_postdata(); ?>

<?php get_footer();?>
<?php get_header(); ?>

<?php $language = apply_filters( 'wpml_current_language', NULL ); ?>

<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $search_query = get_search_query();
    $title_lang = $language == 'en' ? 'Search results for: ' : 'Resultados da pesquisa para: ';
    
    $title = $title_lang . $search_query;
?>

<?php if (have_posts()): ?>

    <div class="container">
        
        <div class="row">
        
            <div class="col-12 mt-5 mb-3">

                <h2 class="sub-title mb-4"><?= $title; ?></h2>
                
                <div class="archive-posts">

                    <?php while (have_posts()): the_post(); ?>
                        <div class="card-post">
                            <a href="<?= get_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?= get_the_title(); ?>" class="post__image">
                                <?php else: ?>
                                    <img src="<?= get_template_directory_uri() . '/assets/images/default.webp'; ?>" alt="<?= get_the_title(); ?>" class="post__image">
                                <?php endif; ?>

                                <div class="post__content">
                                    <div class="execpt">
                                        <?= get_the_excerpt(); ?>
                                    </div>
                                    <div class="date"><?= get_the_date('d/m/Y'); ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>

                </div>

            </div>

            <div class="col-12">
                <div class="archive-navigation">
                    <?php 
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total' => $wp_query->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'format' => '?paged=%#%',
                            'show_all' => false,
                            'type' => 'plain',
                            'end_size' => 2,
                            'mid_size' => 1,
                            'prev_next' => true,
                            'prev_text' => '<svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.01728 8.91983C0.671689 9.30097 0.67169 9.88214 1.01729 10.2633L8.73488 18.7746C9.13177 19.2123 9.8196 19.2123 10.2165 18.7746L10.9823 17.9299C11.3279 17.5488 11.3279 16.9676 10.9823 16.5865L5.24878 10.2633C4.90318 9.88214 4.90318 9.30097 5.24878 8.91983L10.9823 2.59661C11.3279 2.21547 11.3279 1.6343 10.9823 1.25316L10.2165 0.408541C9.8196 -0.0291634 9.13177 -0.0291634 8.73488 0.408541L1.01728 8.91983Z" fill="#F45B06"/></svg>',
                            'next_text' => '<svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.9827 10.263C11.3283 9.88189 11.3283 9.30072 10.9827 8.91959L3.26512 0.408297C2.86823 -0.029407 2.1804 -0.0294064 1.78351 0.408298L1.01765 1.25292C0.672057 1.63406 0.672057 2.21523 1.01765 2.59636L6.75122 8.91959C7.09682 9.30072 7.09682 9.88189 6.75122 10.263L1.01765 16.5863C0.672058 16.9674 0.672057 17.5486 1.01765 17.9297L1.78351 18.7743C2.1804 19.212 2.86823 19.212 3.26512 18.7743L10.9827 10.263Z" fill="#F45B06"/></svg>',
                            'add_args' => false,
                            'add_fragment' => '',
                        ));
                    ?>
                </div>
            </div>

        </div>

    </div>

<?php else: ?>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 mb-3">
                <h2 class="sub-title mb-4">Nenhum resultado encontrado para: <?= $search_query; ?></h2>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php get_footer(); ?>

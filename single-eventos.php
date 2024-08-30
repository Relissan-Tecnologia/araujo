<?php get_header();?>

<?php
    $language = apply_filters( 'wpml_current_language', NULL );

    $post_terms = wp_get_post_terms( get_the_ID(), 'tipos' );
    $first_term = !empty($post_terms) ? $post_terms[0] : null;

    $args = array(
        'taxonomy'   => 'tipos',
        'hide_empty' => false,
    );
    $terms = get_terms( $args );

    if($language == 'en'):
        $active_term = $first_term ? $first_term->slug : 'breakfast';
    else:
        $active_term = $first_term ? $first_term->slug : 'cafes-da-manha';
    endif;
?>

<section id="lawyers-types" class="content container mt-4 mb-4">
    <div class="row">
        <div class="col-12">
            <div class="container-fluid mt-4 mb-4">
                <div class="row d-flex justify-content-center align-items-stretch flex-row lawyers-type-list">
                    <?php if (!empty($terms)): ?>
                        <?php foreach ($terms as $term): ?>
                            <div class="col-4 col-md-2 col-lg-2 mt-2 mb-2">
                                <?php $active_class = ($active_term === $term->slug) ? 'active' : ''; ?>
                                <?php $icon = get_field('term_icon', 'term_'.$term->term_id); ?>
                                <?php $icon_white = get_field('term_icon_hover', 'term_'.$term->term_id); ?>
                                <a href="<?php if($language == 'en') : ?>/en<?php endif; ?>/eventos?tipo=<?php echo $term->slug ?>">
                                    <div class="p-3 rounded-2 d-flex align-items-center justify-content-center flex-strech flex-column lawyers-type-list-item <?php echo $active_class; ?>">
                                        <img class="lawyers-type-list-item-icon" src="<?php echo $icon ?>" />
                                        <img class="lawyers-type-list-item-icon-hover" src="<?php echo $icon_white ?>" />
                                        <span><?php echo $term->name ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>

<div class="separator"></div>

<div id="event">

    <?php $post_id = get_post()->ID ?>

    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-12">

                <?php if(( function_exists('has_post_thumbnail') ) && ( has_post_thumbnail())): ?>
                    <?php 
                        $post_thumbnail_id = get_post_thumbnail_id();
                        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                    ?>
                    <?php if(!empty($post_thumbnail_url)): ?>
                        <img class="img-fluid thumbnail-event" src="<?= $post_thumbnail_url; ?>" alt="<?= the_title(); ?>" />
                    <?php  endif; ?>
                <?php endif; ?>
                
                <div class="content-max-size">
                    <ul class="nav nav-pills mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link area-block active" id="single-tab" data-bs-toggle="pill" data-bs-target="#single" type="button" role="tab" aria-controls="single" aria-selected="true">
                                <img src="<?= get_template_directory_uri() . '/assets/images/sobre-o-evento.png' ?>" alt="sobre-o-evento" class="area__icon">
                                <div class="area__title"><?php if($language == 'en') : ?>About event<?php else: ?>Sobre o evento<?php endif; ?></div>
                            </button>
                        </li>

                        <?php $galery = get_field('fotos', $post_id); ?>
                        <?php if(!empty($galery)): ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link area-block" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    <img src="<?= get_template_directory_uri() . '/assets/images/fotos.png' ?>" alt="fotos" class="area__icon">
                                    <div class="area__title"><?php if($language == 'en') : ?>Photos<?php else: ?>Fotos<?php endif; ?></div>
                                </button>
                            </li>
                        <?php endif; ?>

                        <?php $materias = get_field('materias', $post_id); ?>
                        <?php if(!empty($materias)): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link area-block" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                <img src="<?= get_template_directory_uri() . '/assets/images/material-de-apoio.png' ?>" alt="material-de-apoio" class="area__icon">
                                <div class="area__title"><?php if($language == 'en') : ?>Support material<?php else: ?>Material de apoio<?php endif; ?></div>
                            </button>
                        </li>
                        <?php endif; ?>

                        <?php $local = get_field('local', $post_id); ?>
                        <?php if(!empty($local)): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link area-block" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-map" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                <img src="<?= get_template_directory_uri() . '/assets/images/local.png' ?>" alt="local" class="area__icon">
                                <div class="area__title"><?php if($language == 'en') : ?>Location<?php else: ?>Local<?php endif; ?></div>
                            </button>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <div class="tab-content mt-4" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="single" role="tabpanel" aria-labelledby="single-tab" tabindex="0">
                            <div class="post-content remove-mg-top">
                                <?php the_content();?>
                            </div>
                        </div>
                        
                        <?php if(!empty($galery)): ?>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <div class="galery">
                                <?php foreach($galery as $img): ?>
                                    <?= wp_get_attachment_image( $img['ID'], 'full', '', array( 'class' => 'img-fluid' ) ); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($materias)): ?>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                            <div class="files">
                                <?php foreach($materias as $material): ?>
                                <a href="<?= $material['url'] ?>" target="_blank" class="file">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0641 1.8941V9.31691C10.0641 9.49229 9.92556 9.63255 9.75234 9.63255H7.00679L12.5022 17.8972L17.9976 9.63255H15.2607C15.0875 9.63255 14.9489 9.49229 14.9489 9.31691V1.8941C14.9489 1.54773 14.806 1.23204 14.5808 1.00405C14.3556 0.771677 14.0438 0.631279 13.7017 0.631279H11.3156C10.9735 0.631279 10.6617 0.771677 10.4322 1.00405C10.2026 1.23204 10.0641 1.54773 10.0641 1.8941ZM1.87517 24.3643H23.1162C23.4584 24.3643 23.7702 24.2239 23.9997 23.9959C24.2249 23.768 24.3634 23.4522 24.3634 23.1015V19.4318C24.3634 19.0855 24.2249 18.7697 23.9997 18.5374C23.7702 18.3094 23.4584 18.169 23.1162 18.169H22.3497C22.0033 18.169 21.6915 18.3094 21.4663 18.5374C21.2368 18.7697 21.0982 19.0855 21.0982 19.4318V20.7427C21.0982 20.9181 20.9597 21.0585 20.7865 21.0585H4.20495C4.03173 21.0585 3.89319 20.9181 3.89319 20.7427V19.4318C3.89319 19.0855 3.75452 18.7697 3.525 18.5374C3.29982 18.3094 2.98814 18.169 2.64603 18.169H1.87517C1.53306 18.169 1.22125 18.3094 0.996062 18.5374H0.991701C0.766515 18.7697 0.628007 19.0855 0.628007 19.4318V23.1015C0.628007 23.4522 0.766545 23.7636 0.996062 23.9959C1.22125 24.2239 1.53306 24.3643 1.87517 24.3643ZM23.1162 25H1.87517C1.35984 25 0.887813 24.7851 0.550034 24.4431C0.212256 24.1011 0 23.6232 0 23.1015V19.4318C0 18.9145 0.212225 18.4365 0.545673 18.0945H0.550034V18.0902C0.892144 17.7482 1.35984 17.5333 1.87517 17.5333H2.64603C3.16136 17.5333 3.63338 17.7482 3.97116 18.0902C4.30894 18.4322 4.5167 18.9101 4.5167 19.4318V20.4315H20.4833V19.4318C20.4833 18.9145 20.6912 18.4365 21.029 18.0945L21.0333 18.0902C21.3711 17.7482 21.8431 17.5333 22.3585 17.5333H23.1248C23.6402 17.5333 24.1122 17.7482 24.45 18.0902C24.7877 18.4322 25 18.9101 25 19.4318V23.1015C25 23.6232 24.7877 24.0967 24.45 24.4431C24.1035 24.7851 23.6359 25 23.1162 25ZM9.43622 9.00556V1.89839C9.43622 1.38102 9.64845 0.907567 9.98189 0.565582L9.98612 0.561166C10.3282 0.214796 10.7959 0 11.3113 0H13.6975C14.2085 0 14.6848 0.214796 15.0226 0.561166C15.3604 0.903152 15.5725 1.37664 15.5725 1.89839V9.00556H18.5779C18.6428 9.00556 18.6992 9.0231 18.7511 9.06256C18.894 9.15463 18.933 9.35195 18.8377 9.50103L12.7621 18.6425C12.7404 18.6776 12.7101 18.7084 12.6711 18.7303C12.5326 18.8268 12.3377 18.7916 12.2381 18.6425L6.1754 9.52297C6.13642 9.46597 6.10602 9.40015 6.10602 9.32561C6.10602 9.15023 6.24468 9.00997 6.4179 9.00997H9.43622V9.00556Z" fill="#30383B"/>
                                    </svg>
                                    <span><?= $material['titulo'] ?></span>
                                </a>
                                <?php  endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($local)): ?>
                        <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                            <div class="map">
                                <?= $local ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();?>
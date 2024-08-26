<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	

  <!-- title -->
	<?php if( is_home() ) : ?> 
		<title>Home</title>
	<?php elseif( is_category() ) : ?>
		<title><?php single_cat_title(); ?></title>
	<?php elseif( is_search() ) : ?>
		<title><?php if($language == 'en'): ?>Results for:<?php else: ?>Resultados para:<?php endif; ?> <?= get_search_query() ?></title>
	<?php elseif( is_404() ) : ?>
		<title><?php if($language == 'en'): ?>Page not found<?php else: ?>Página não encontrada<?php endif; ?></title>
	<?php else : ?>
		<title><?php bloginfo( 'name' ); ?> - <?php echo get_the_title(); ?></title>
	<?php endif; ?>

  <!-- favicon -->
  <link rel="icon" type="image/png" href="./assets/images/">

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php $language = apply_filters( 'wpml_current_language', NULL ); ?>
	<div id="header" class="d-none d-lg-flex">
		<div class="container ">
			<div class="row align-items-center">
				<div class="col">
					<a href="<?= get_option('home') ?>">
						<?php 
							$image = get_theme_mod( 'custom_logo' );
							$size = array('250', '30');
						?>

						<?php if( $image ): ?>
							<?= wp_get_attachment_image( $image, $size ); ?>
						<?php else: ?>
							<img class="img-fluid" width="250" height="30" src="<?= get_template_directory_uri() . '/assets/images/araujo-policastro.png'; ?>" alt="araujo policastro" />
						<?php endif; ?>
					</a>
				</div>
				
				<div class="col-auto">
					<?php 
						$linkedin = get_field('options_linkedin', 'option');
						$facebook = get_field('options_facebook', 'option');
						$instagram = get_field('options_instagram', 'option');
					?>
					<?php if ( $linkedin != "" && $facebook != "" && $instagram != "") : ?>                            
						<ul class="social">
							<?php if ( $linkedin != "") : ?>
								<li class="social-item">
									<a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener">
										<img src="<?php echo get_template_directory_uri() . '/assets/images/icon-linkedin.svg'; ?>" alt="Linkedin" />
									</a>
								</li>
							<?php endif; ?>

							<?php if ( $facebook != "") : ?>
								<li class="social-item">
									<a href="<?php echo $facebook; ?>" target="_blank" rel="noopener">
										<img src="<?php echo get_template_directory_uri() . '/assets/images/icon-facebook.svg'; ?>" alt="facebook" />
									</a>
								</li>
							<?php endif; ?>

							<?php if ( $instagram != "") : ?>
								<li class="social-item">
									<a href="<?php echo $instagram; ?>" target="_blank" rel="noopener">
										<img src="<?php echo get_template_directory_uri() . '/assets/images/icon-instagram.svg'; ?>" alt="instagram" />
									</a>
								</li>
							<?php endif; ?>							
						</ul>
					<?php endif; ?>
				</div>

				<form id="search" action="<?= home_url( '/' ); ?>" method="get" id="search" class="col-auto" role="search">
                    <input class="form-control" name="s" type="search" placeholder="<?php if($language == 'en'): ?>What are you looking for?<?php else: ?>O que você procura?<?php endif; ?>" aria-label="Search">
                    <button class="btn btn-search" type="submit">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
							<path d="M12.1094 7.39344C11.8938 7.39344 11.7188 7.56777 11.7188 7.78257C11.7188 7.99737 11.8938 8.1717 12.1094 8.1717C12.325 8.1717 12.5 7.99737 12.5 7.78257C12.5 7.56777 12.325 7.39344 12.1094 7.39344Z" fill="#F45B06"/>
							<path d="M19.5422 17.2664L14.3282 12.0723C15.1776 10.7977 15.625 9.32176 15.625 7.78257C15.625 3.49126 12.1203 0 7.8125 0C3.50469 0 0 3.49126 0 7.78257C0 12.0739 3.50469 15.5651 7.8125 15.5651C9.35766 15.5651 10.8393 15.1194 12.1187 14.2733L13.5599 15.709C13.5597 15.7088 13.5601 15.7092 13.5599 15.709L17.3327 19.4674C17.628 19.7614 18.0203 19.9234 18.4375 19.9234C18.8547 19.9234 19.247 19.7614 19.5421 19.4675C19.8374 19.1736 20 18.7827 20 18.3669C20 17.951 19.8374 17.5602 19.5422 17.2664ZM11.935 13.4532C11.935 13.4533 11.935 13.4532 11.935 13.4532C10.7293 14.3256 9.30371 14.7869 7.8125 14.7869C3.93547 14.7869 0.78125 11.6447 0.78125 7.78257C0.78125 3.92039 3.93547 0.778257 7.8125 0.778257C11.6895 0.778257 14.8438 3.92039 14.8438 7.78257C14.8438 9.26807 14.3808 10.6881 13.505 11.8892C13.0668 12.4906 12.5386 13.0168 11.935 13.4532ZM12.7545 13.806C13.1588 13.4765 13.5284 13.1084 13.8591 12.7057L14.9673 13.8097C14.6303 14.2059 14.2605 14.5743 13.8628 14.91L12.7545 13.806ZM18.9898 18.917C18.8421 19.0641 18.646 19.1451 18.4375 19.1451C18.229 19.1451 18.0329 19.0641 17.8852 18.917L14.4166 15.4618C14.8122 15.1236 15.1818 14.7555 15.5212 14.3614L18.9899 17.8168C19.1375 17.9637 19.2188 18.159 19.2188 18.3669C19.2188 18.5747 19.1375 18.77 18.9898 18.917Z" fill="#F45B06"/>
							<path d="M7.8125 1.55651C4.36621 1.55651 1.5625 4.34948 1.5625 7.78257C1.5625 11.2157 4.36621 14.0086 7.8125 14.0086C11.2588 14.0086 14.0625 11.2157 14.0625 7.78257C14.0625 4.34948 11.2588 1.55651 7.8125 1.55651ZM7.8125 13.2304C4.79703 13.2304 2.34375 10.7865 2.34375 7.78257C2.34375 4.77865 4.79703 2.33477 7.8125 2.33477C10.828 2.33477 13.2812 4.77865 13.2812 7.78257C13.2812 10.7865 10.828 13.2304 7.8125 13.2304Z" fill="#F45B06"/>
							<path d="M12.1901 6.11216C11.8537 5.24004 11.268 4.49439 10.4963 3.95588C9.70622 3.40448 8.77817 3.11303 7.8125 3.11303C7.5968 3.11303 7.42188 3.28728 7.42188 3.50216C7.42188 3.71703 7.5968 3.89128 7.8125 3.89128C9.41793 3.89128 10.884 4.89594 11.4608 6.39132C11.5205 6.54603 11.6685 6.64098 11.8255 6.64098C11.8721 6.64098 11.9195 6.63262 11.9655 6.61499C12.1669 6.5379 12.2674 6.31279 12.1901 6.11216Z" fill="#F45B06"/>
						</svg>
                    </button>
				</form>

				<div class="col-auto">
					<div class="d-flex align-items-center justify-content-start language">
						<?php if($language != 'en'): ?>
							<a class="d-flex align-items-center justify-content-start" href="<?php echo $_SERVER['REMOTE_HOST'] . $_SERVER['PATH_INFO'] . '/en' ?>">
								<img class="me-1" src="<?php echo get_template_directory_uri() . '/assets/images/icon-usa.png'; ?>" />
								<span>English</span>
							</a>
						<?php else: ?>
							<?php $current_url = $_SERVER['REMOTE_HOST'] . $_SERVER['PATH_INFO']; ?>
							<?php $new_url = rtrim(str_replace('/en', '', $current_url), '/'); ?>
							<a class="d-flex align-items-center justify-content-start" href="<?php echo $new_url == "" ? "/" : $new_url; ?>">
								<img class="me-1" src="<?php echo get_template_directory_uri() . '/assets/images/icon-brazil.png'; ?>" />
								<span>Português</span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="nav" class="d-none d-lg-block">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="nav">
						<?php 
							$locations = get_nav_menu_locations();
							$header = wp_get_nav_menu_items($locations['menu-header']);
							$outhtml = "";

							if(!empty($header)) {
								foreach ( $header as $item ) {
									$title = !empty($item->post_title) ? $item->post_title : $item->title;
									$outhtml = $outhtml . "<a href='{$item->url}'>{$title}</a>";
								}     
							}

							echo $outhtml;
						?>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div id="header-mobile" class="d-lg-none">
		<div class="container">
			<div class="row align-items-center">
				<div class="col">
					<a class="logo" href="<?= get_option('home') ?>">
						<?php 
							$image = get_theme_mod( 'custom_logo' );
							$size = array('179', '22');
						?>

						<?php if( $image ): ?>
							<?= wp_get_attachment_image( $image, $size ); ?>
						<?php else: ?>
							<img class="img-fluid" width="179" height="22" src="<?= get_template_directory_uri() . '/assets/images/araujo-policastro.png'; ?>" alt="araujo policastro" />
						<?php endif; ?>
					</a>
				</div>

				<div class="col-auto">
					<?php 
						$linkedin = get_field('options_linkedin', 'option');
						$facebook = get_field('options_facebook', 'option');
						$instagram = get_field('options_instagram', 'option');
					?>
					<?php if ( $linkedin != "" && $facebook != "" && $instagram != "") : ?>                            
						<ul class="social">
							<?php if ( $linkedin != "") : ?>
								<li class="social-item">
									<a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener">
										<img src="<?php echo get_template_directory_uri() . '/assets/images/icon-linkedin.svg'; ?>" alt="Linkedin" />
									</a>
								</li>
							<?php endif; ?>

							<?php if ( $facebook != "") : ?>
								<li class="social-item">
									<a href="<?php echo $facebook; ?>" target="_blank" rel="noopener">
										<img src="<?php echo get_template_directory_uri() . '/assets/images/icon-facebook.svg'; ?>" alt="facebook" />
									</a>
								</li>
							<?php endif; ?>

							<?php if ( $instagram != "") : ?>
								<li class="social-item">
									<a href="<?php echo $instagram; ?>" target="_blank" rel="noopener">
										<img src="<?php echo get_template_directory_uri() . '/assets/images/icon-instagram.svg'; ?>" alt="instagram" />
									</a>
								</li>
							<?php endif; ?>							
						</ul>
					<?php endif; ?>
				</div>

				<div class="col-auto">
					<div class="d-flex align-items-center justify-content-start language">
						<?php if($language != 'en'): ?>
							<a class="d-flex align-items-center justify-content-start" href="<?php echo $_SERVER['REMOTE_HOST'] . $_SERVER['PATH_INFO'] . '/en' ?>">
								<img class="me-1" src="<?php echo get_template_directory_uri() . '/assets/images/icon-usa.png'; ?>" />
							</a>
						<?php else: ?>
							<?php $current_url = $_SERVER['REMOTE_HOST'] . $_SERVER['PATH_INFO']; ?>
							<?php $new_url = rtrim(str_replace('/en', '', $current_url), '/'); ?>
							<a class="d-flex align-items-center justify-content-start" href="<?php echo $new_url == "" ? "/" : $new_url; ?>">
								<img class="me-1" src="<?php echo get_template_directory_uri() . '/assets/images/icon-brazil.png'; ?>" />
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="nav-mobile" class="d-lg-none">
		<div class="container">
			<div class="row align-items-center">
				<div class="col">
					<form id="search" action="<?= home_url( '/' ); ?>" method="get" id="search" class="col-auto" role="search">
						<input class="form-control" name="s" type="search" placeholder="<?php if($language == 'en'): ?>What are you looking for?<?php else: ?>O que você procura?<?php endif; ?>" aria-label="Search">
						<button class="btn btn-search" type="submit">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
								<path d="M12.1094 7.39344C11.8938 7.39344 11.7188 7.56777 11.7188 7.78257C11.7188 7.99737 11.8938 8.1717 12.1094 8.1717C12.325 8.1717 12.5 7.99737 12.5 7.78257C12.5 7.56777 12.325 7.39344 12.1094 7.39344Z" fill="#F45B06"/>
								<path d="M19.5422 17.2664L14.3282 12.0723C15.1776 10.7977 15.625 9.32176 15.625 7.78257C15.625 3.49126 12.1203 0 7.8125 0C3.50469 0 0 3.49126 0 7.78257C0 12.0739 3.50469 15.5651 7.8125 15.5651C9.35766 15.5651 10.8393 15.1194 12.1187 14.2733L13.5599 15.709C13.5597 15.7088 13.5601 15.7092 13.5599 15.709L17.3327 19.4674C17.628 19.7614 18.0203 19.9234 18.4375 19.9234C18.8547 19.9234 19.247 19.7614 19.5421 19.4675C19.8374 19.1736 20 18.7827 20 18.3669C20 17.951 19.8374 17.5602 19.5422 17.2664ZM11.935 13.4532C11.935 13.4533 11.935 13.4532 11.935 13.4532C10.7293 14.3256 9.30371 14.7869 7.8125 14.7869C3.93547 14.7869 0.78125 11.6447 0.78125 7.78257C0.78125 3.92039 3.93547 0.778257 7.8125 0.778257C11.6895 0.778257 14.8438 3.92039 14.8438 7.78257C14.8438 9.26807 14.3808 10.6881 13.505 11.8892C13.0668 12.4906 12.5386 13.0168 11.935 13.4532ZM12.7545 13.806C13.1588 13.4765 13.5284 13.1084 13.8591 12.7057L14.9673 13.8097C14.6303 14.2059 14.2605 14.5743 13.8628 14.91L12.7545 13.806ZM18.9898 18.917C18.8421 19.0641 18.646 19.1451 18.4375 19.1451C18.229 19.1451 18.0329 19.0641 17.8852 18.917L14.4166 15.4618C14.8122 15.1236 15.1818 14.7555 15.5212 14.3614L18.9899 17.8168C19.1375 17.9637 19.2188 18.159 19.2188 18.3669C19.2188 18.5747 19.1375 18.77 18.9898 18.917Z" fill="#F45B06"/>
								<path d="M7.8125 1.55651C4.36621 1.55651 1.5625 4.34948 1.5625 7.78257C1.5625 11.2157 4.36621 14.0086 7.8125 14.0086C11.2588 14.0086 14.0625 11.2157 14.0625 7.78257C14.0625 4.34948 11.2588 1.55651 7.8125 1.55651ZM7.8125 13.2304C4.79703 13.2304 2.34375 10.7865 2.34375 7.78257C2.34375 4.77865 4.79703 2.33477 7.8125 2.33477C10.828 2.33477 13.2812 4.77865 13.2812 7.78257C13.2812 10.7865 10.828 13.2304 7.8125 13.2304Z" fill="#F45B06"/>
								<path d="M12.1901 6.11216C11.8537 5.24004 11.268 4.49439 10.4963 3.95588C9.70622 3.40448 8.77817 3.11303 7.8125 3.11303C7.5968 3.11303 7.42188 3.28728 7.42188 3.50216C7.42188 3.71703 7.5968 3.89128 7.8125 3.89128C9.41793 3.89128 10.884 4.89594 11.4608 6.39132C11.5205 6.54603 11.6685 6.64098 11.8255 6.64098C11.8721 6.64098 11.9195 6.63262 11.9655 6.61499C12.1669 6.5379 12.2674 6.31279 12.1901 6.11216Z" fill="#F45B06"/>
							</svg>
						</button>
					</form>	
				</div>

				<div class="col-auto">
					<nav class="navbar">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
							<div class="offcanvas-header">
								<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body">
								<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
									<?php 
										$locations = get_nav_menu_locations();
										$header = wp_get_nav_menu_items($locations['menu-header']);
										$outhtml = "";

										if(!empty($header)) {
											foreach ( $header as $item ) {
												$title = !empty($item->post_title) ? $item->post_title : $item->title;
												$outhtml = $outhtml . "<li class='nav-item'><a class='nav-link' href='{$item->url}'>{$title}</a></li>";
											}     
										}

										echo $outhtml;
									?>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>

       
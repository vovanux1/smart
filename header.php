<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package smartsystem.fr
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	
	<meta name="google-site-verification" content="_s7wAZaiMvEReUTRzgEJGBWuyaG2kLXq_xQFlU9k15Y" />	
	

	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KN6VPCB');</script>
<!-- End Google Tag Manager -->
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/solid.css" integrity="sha384-29Ax2Ao1SMo9Pz5CxU1KMYy+aRLHmOu6hJKgWiViCYpz3f9egAJNwjnKGgr+BXDN" crossorigin="anonymous">
	
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

<link href="/wp-content/themes/smartsystem-fr/serg.css" rel="stylesheet">

	
	<style>
		.page-block>.container {
    		padding: 110px 0 50px;
		}
		.asides #sidebar {
			padding-top: 55px;
		}
		@media (max-width: 768px) {
			.block-uno {
				width: 46%!important;
			}
		}	
		
		p.form-submit {
			margin-top: 20px;
			padding-bottom: 20px!important;
		}
	</style>
	
	
<link rel="stylesheet" id="smartsystem-fr-style-css" href="https://www.smartsystem.fr/wp-content/themes/smartsystem-fr/style.css?ver=1.0.0" media="all">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KN6VPCB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'smartsystem-fr' ); ?></a>

<? if(!is_front_page() && !is_single(17706)){ ?>	<header id="header" class="site-header">
		<div class="container">
			<span class="site-logo">
                <a href="/"><img src="/wp-content/uploads/2020/07/logo.png" alt="smartsystem.fr"></a>
            </span>
				<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'smartsystem-fr' ); ?>				</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		</div><!-- .site-branding -->
<? if(is_single(13905)){?> 
		<style>
			.information-block{display:none !important;}
			#c-mail-full{
				display:none !important;
			}
	
			
.subtab tr td:first-child span {
    display: flex;
    flex-direction: column;
    justify-content: unset;
    align-items: unset !important; 
			}
			@media(max-width:768px){
			.subtab.suptab	{ 
				zoom:0.7;
			}
				.zoom5
			{
				zoom:0.5 !important;
			}
			.zoom4
			{
				zoom:0.4 !important;
			}
				.subtab.suptab.zoom2
			{
				zoom:0.2 !important;
				font-size:1rem !important
			}
				.subtab.suptab.zoom2 span
				{
					font-size:1rem !important
				}
			}
			@media (max-width: 500px){
.tablepress-id-8 {
    min-width: 320px!important;
}
			.cl2dn tr td:nth-child(2)
				{
					display:none !important
				}
			}
			@media(max-width:1400px)
			{
				.tablepress-id-8 .column-1{
    display: none !important;
}
			}
			@media(max-width:468px)
{
	.page-head .page-block-image
	{
		margin-bottom:50px !important;
	}
	.page-block-title.small
	{
		margin-top:
	}
}
		</style>
		<?} ?>
	<? if(is_single(18121)) { ?> 
		<style>
		.wrapper-rating
			{
				opacity:0 !important;
			}
			.page-block.page-head , .breadcrumbs.container
			{
				display:none !important;
			}
			#main .block-avtora:nth-child(3)
			{
				display:none !important;
			}
		</style>
		<? } ?>
	</header><!-- #masthead -->
<? } ?>
<?php
     if ((is_singular() && !is_front_page()) && !is_single(17706) ) {
        dvt_the_breadcrumbs();
    }
    if(is_front_page()){ ?> 
	
	<div class="fulbg">
			<header id="header" class="site-header">
		<div class="container">

				<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'smartsystem-fr' ); ?>				</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		</div><!-- .site-branding -->
<? if(is_single(13905)){?> 
		<style>
			.information-block{display:none !important;}
			#c-mail-full{
				display:none !important;
			}
	
			
.subtab tr td:first-child span {
    display: flex;
    flex-direction: column;
    justify-content: unset;
    align-items: unset !important; 
			}
			@media(max-width:768px){
			.subtab.suptab	{ 
				zoom:0.7;
			}
				.zoom5
			{
				zoom:0.5 !important;
			}
			.zoom4
			{
				zoom:0.4 !important;
			}
				.subtab.suptab.zoom2
			{
				zoom:0.2 !important;
				font-size:1rem !important
			}
				.subtab.suptab.zoom2 span
				{
					font-size:1rem !important
				}
			}
			@media (max-width: 500px){
.tablepress-id-8 {
    min-width: 320px!important;
}
			.cl2dn tr td:nth-child(2)
				{
					display:none !important
				}
			}
			@media(max-width:1400px)
			{
				.tablepress-id-8 .column-1{
    display: none !important;
}
			}
			@media(max-width:468px)
{
	.page-head .page-block-image
	{
		margin-bottom:50px !important;
	}
	.page-block-title.small
	{
		margin-top:
	}
}
		</style>
		<?} ?>
	<? if(is_single(18121)) { ?> 
		<style>
		.wrapper-rating
			{
				opacity:0 !important;
			}
			.page-block.page-head , .breadcrumbs.container
			{
				display:none !important;
			}
			#main .block-avtora:nth-child(3)
			{
				display:none !important;
			}
		</style>
		<? } ?>
				<style>
					#header .menu-item-has-children li a{
						color:#000!important;
					}
					.wrapper-rating{
						display:none;
					}
					.block-white{
						display:none;
					}
					#ez-toc-container{
						margin-top:10px;
					}
					@media(max-width:768px){
						button.menu-toggle{
					left: 10px !important;
    margin-top: 40px!important;
					}
						.fulbg #primary-menu a{
							color:#000!important;
						}
					}
					
				</style>
	</header>
			<div class="container mrwe">
				<div class="row flex-header">
				<div class="col-12">
					<h1 class="main-title home-h1-hp">				
			<?php the_title(); ?>
			</h1>
<div class="blockheader">
	<div class="first-h">
		<span>Apprendre à trader</span>
		<span>Comparer les brokers</span>
	</div>
	<div class="second-h">
		<span>Infos & conseils gratuits</span>
	</div>
					</div>
					<div class="knopka-a">
						<a href="https://www.smartsystem.fr/site-de-trading/" >Comparez les brokers en ligne <div class="hr-n"></div></a>
						<a href="https://www.smartsystem.fr/alvexocta" id="btn-alvexo">Commencez à trader dès maintenant <div class="hr-n"></div></a>
					</div>
					</div>
			
				</div>
		</div>
		</div>
	<? } elseif(is_single(17706)){ ?>
	<div class="fulbg">
			<header id="header" class="site-header">
		<div class="container">

				<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'smartsystem-fr' ); ?>				</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		</div><!-- .site-branding -->
<? if(is_single(13905)){?> 
		<style>
			.information-block{display:none !important;}
			#c-mail-full{
				display:none !important;
			}
	
			
.subtab tr td:first-child span {
    display: flex;
    flex-direction: column;
    justify-content: unset;
    align-items: unset !important; 
			}
			@media(max-width:768px){
			.subtab.suptab	{ 
				zoom:0.7;
			}
				.zoom5
			{
				zoom:0.5 !important;
			}
			.zoom4
			{
				zoom:0.4 !important;
			}
				.subtab.suptab.zoom2
			{
				zoom:0.2 !important;
				font-size:1rem !important
			}
				.subtab.suptab.zoom2 span
				{
					font-size:1rem !important
				}
			}
			@media (max-width: 500px){
.tablepress-id-8 {
    min-width: 320px!important;
}
			.cl2dn tr td:nth-child(2)
				{
					display:none !important
				}
			}
			@media(max-width:1400px)
			{
				.tablepress-id-8 .column-1{
    display: none !important;
}
			}
			@media(max-width:468px)
{
	.page-head .page-block-image
	{
		margin-bottom:50px !important;
	}
	.page-block-title.small
	{
		margin-top:
	}
}
		</style>
		<?} ?>
	<? if(is_single(18121)) { ?> 
		<style>
		.wrapper-rating
			{
				opacity:0 !important;
			}
			.page-block.page-head , .breadcrumbs.container
			{
				display:none !important;
			}
			#main .block-avtora:nth-child(3)
			{
				display:none !important;
			}
		</style>
		<? } ?>
				<style>
					#header .menu-item-has-children li a{
						color:#000!important;
					}
					.wrapper-rating{
						display:none;
					}
					.block-white{
						display:none;
					}
					#ez-toc-container{
						margin-top:10px;
					}
					@media(max-width:768px){
						button.menu-toggle{
					left: 10px !important;
    margin-top: 40px!important;
					}
						.fulbg #primary-menu a{
							color:#000!important;
						}
					}
					
				</style>
		
	</header>
			<div class="container mrwe">
				<div class="row flex-header">
				<div class="col-12">
					<h1 class="main-title home-h1-hp">				
			<?php the_title(); ?>
			</h1>
<div class="blockheader">
	<div class="first-h">
		<span>Le meilleur du site de trading</span>
		<span>Comparer les brokers</span>
	</div>
	<div class="second-h">
		<span>Avis de nos experts</span>
	</div>
					</div>
					<div class="knopka-a">
						<a href="https://www.smartsystem.fr/avis-sur-alvexo-lun-des-meilleurs-courtiers/">Le leader du trading en ligne <div class="hr-n"></div></a>
						<a href="https://www.smartsystem.fr/alvexocta" id="btn-alvexo" >Ouvrir un compte de trading <div class="hr-n"></div></a>
					</div>
					</div>
			
				</div>
		</div>
		</div>
	<? } else {
    dvt_the_page_block('head'); }
?>
	
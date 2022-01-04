<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smartsystem.fr
 */


  
    get_header();  
?>
    
<main id="main" class="container">
    <?php if (have_posts()) : ?>
        <div class="list-posts" data-col="3">
            <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/post/loop');
                endwhile;
            ?>
         </div>
        <!-- <?php// the_corenavi(); ?>-->
     <?php else : get_template_part('empty'); ?>   
     <?php endif; ?>
     
    <!-- <?php //dvt_the_term_rating(); ?>-->
     
     <article class="term-description the_content">                    
        <?php the_archive_description(); ?>                                        
     </article>     
     
       <div class="wrapper-information-block" data-position="footer">
        <div class="information-block" data-id="72271" style="display: block;">
            <div class="information-block-inner"><div class="geodiv geo-DEF" style="display: block;"><a rel="nofollow" href="/6lpatraderautrement" id="banner-alvexo"> <img src="https://www.smartsystem.fr/wp-content/uploads/2019/09/AL_services_FR_1000x200.gif" alt=""></a></div>
<div class="geodiv geo-CANADA"><a rel="nofollow" href="https://www.smartsystem.fr/avatrade" id="banner-alvexo"> <img src="https://www.smartsystem.fr/wp-content/uploads/2019/08/canadabottom.gif" alt=""></a></div>
<div class="geodiv geo-AFRICA"><a target="_blank" href="https://iqoption.com/lp/ultimate-trading/fr/binary/?aff=11509" id="banner-option"><img src="//files.iqoption.com/storage/public/5c/0e/425f4f622.jpg" width="970" height="250"></a></div></div>
        </div>        
        </div>
    
</main>   
    
<?php    
    get_footer();
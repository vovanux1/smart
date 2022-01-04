<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package smartsystem.fr
 */


 
    get_header(); 
    
    the_post();   
?>
    <main id="main" class="container"> 

    <?php if(is_single('eToro : Avis complet')){} else{ ?>
	<? } ?>
    <div class="asides">   
        <?php
            get_template_part('template-parts/content');            
          if(!is_single(17706)){  get_sidebar(); }
        ?>
    </div>
   
	 
        
</main>       
    
<?php    
    get_footer();
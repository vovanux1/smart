<?php
/**
 * Шаблон вывода содержания записи
 *
 * @package Developt
 * @author  Ruslan Heorhiiev (SKYPE: rgeorgievs)
 * @version 1.0.0
 */   
?>

<article id="content" class="the_content">
    <?php 
        $content = get_the_content();                                    
        
        $page_settings = dvt_get_post_settings();
        
        // вырезание текста при возможности
        if (isset($page_settings['cont_head_text'])) {                                                                                        
            $content = str_replace($page_settings['head_text'], '', $content);                                  
        }
        
        // вывод рейтинга
        if (!isset($page_settings['chart']) || !isset($page_settings['signle_ticket'])) {
            dvt_the_post_rating();    
        }        
        echo do_shortcode('[c-post-before]');                               
        echo apply_filters('the_content', $content);

    ?>
	
				 <section class="c-comments">
						<?php
						
							   comments_template();
						
						
						?>
					<section>


			<?php echo do_shortcode('[c-mail-full]') ?>
 
</article>
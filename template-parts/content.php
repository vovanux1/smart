<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smartsystem.fr
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
?> <? if(is_single()) { ?>
        <div class="block-avtora" style=" <?php if(get_field('cjdc')[0] == "1") { ?>display:none;<?php } ?> <?php if(get_field('cjdc')[0] == "2") { ?>display:none;<?php } ?>">
          <div class="avtor-left">
            <div class="virovphoto" style="background-image: url('/wp-content/uploads/2021/05/justine.jpg')"></div>
            <span class="name-avtor"><a href="/justine-fox/"><p>Justine Fox</p></a></span>
          </div>
          <div class="avtor-right"><p>Bonjour à tous, moi c'est Justine. Je travaille comme rédactrice web en tant que freelance depuis plusieurs années et environ une année pour le compte de SmartSystem. Mon job ? Recueillir les dernières informations sur le monde du trading en ligne pour informer mes lecteurs. C'est aussi dévoiler un regard d'expert sur les différents brokers du net pour découvrir quel est le meilleur d'entre eux. J'essaye aussi d'apporter des informations utiles pour permettre aux débutants de devenir traders. Mon travail me passionne réellement.</p>
            <div class="avtorfull bot_soc"> 
              
            <a class="bot_soc_f" href="https://www.linkedin.com/in/justine-fox-777b3a212/"></a>
      
          </div>
          </div>
        </div>
      
       <?php if(get_field('cjdc')[0] == "2") { ?><div class="block-avtora" style=" <?php if(get_field('cjdc')[0] == "1") { ?>display:none;<?php } ?>">
          <div class="avtor-left">
            <div class="virovphoto" style="background-image: url(<?php echo the_field('avimg'); ?>)"></div>
            <span class="name-avtor"><?php echo the_field('name_avtor'); ?></span>
          </div>
          <div class="avtor-right"><?php echo the_field('text_avtor'); ?>
            <div class="avtorfull bot_soc"> 
              <?php if(get_field('faceb') != ""){?>
            <a class="bot_soc_f" href="<?php echo the_field('faceb') ?>"></a><?php }?>
            <?php if(get_field('twit') != ""){?>
            <a class="bot_soc_t" href="<?php echo the_field('twit') ?>"></a><?php }?>
            <?php if(get_field('idcar') != ""){?>
            <a class="bot_soc_i" href="<?php echo the_field('idcar') ?>"></a><?php }?>
          </div>
          </div>
        </div><?php } }
    ?>
	<?  if(get_field('faqpost')){?> <div class="block-white"> <? echo do_shortcode('[faqpost]');  ?> </div> <? } ?>
				 <section class="c-comments">
						<?php
						
							   comments_template();
						
						
						?>
					<section>

			<?php if(is_single('eToro : Avis complet')){} else{ ?>
			<?php echo do_shortcode('[c-mail-full]');} ?>
 
</article>
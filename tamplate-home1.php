<?php
/**
 * Файл шаблона главной страницы
 * 
 * Template Name: Homeee
 * @package Developt
 * @author  Ruslan Heorhiiev (SKYPE: rgeorgievs)
 * @version 1.0.0
 */
 
 get_header(); 
    
    the_post();   
?>
    <main id="main" class="container"> 
  <section class="advantages section">
    <h3 class="section-title">Advantages</h3>
    
        <div class="item">
            <figure class="item-thumbnail"><img data-src="/wp-content/uploads/2019/01/advantage_1.png" alt=""></figure>
            <h4 class="item-title">Invest online</h4>
            <p class="item-description">Discover how to invest on the <br>
stock market from home thanks <br>
to trading platforms.</p>
        </div>
        <div class="item">
            <figure class="item-thumbnail"><img data-src="/wp-content/uploads/2019/01/advantage_2.png" alt=""></figure>
            <h4 class="item-title">Major stocks</h4>
            <p class="item-description">To effectively trade the best stock <br>
market and stock market indices, <br>
find useful information and tips!</p>
        </div>
        <div class="item">
            <figure class="item-thumbnail"><img data-src="/wp-content/uploads/2019/01/advantage_3.png" alt=""></figure>
            <h4 class="item-title">Trading tools</h4>
            <p class="item-description">The specific tools and innovative features <br>
of online brokers help you improve your <br>
trading experience. Discover them!</p>
        </div> </section>
	
	
	<section class="articles section" <? if(is_front_page()){ ?> style="display:none;" <? } ?> >
    <h3 class="section-title">Articles</h3>
    <div class="list-posts" data-col="4">
        
<div class="item item-post sm goto" data-goto="/meilleure-plateforme-de-trading/" title="La meilleure plateforme de trading : l’indispensable à connaître avant d’investir votre argent !">

    <figure class="item-thumbnail goto">
        <img width="319" height="154" src="/wp-content/uploads/2020/12/imgonline-com-ua-Resize-lJeYaM8da55.png" class="attachment-thumbnail size-thumbnail wp-post-image" alt="La meilleure plateforme de trading : l’indispensable à connaître avant d’investir votre argent !">    
    </figure>
    
    <h2 class="item-title">
        <a href="/meilleure-plateforme-de-trading/" title="La meilleure plateforme de trading : l’indispensable à connaître avant d’investir votre argent !">
            La meilleure plateforme…        </a>
    </h2>
    
    <div class="item-description">
        La plateforme de trading rencontre un vif…    </div>        
    
</div>
<div class="item item-post sm goto" data-goto="/ou-investir-pour-lannee-2019/" title="Où investir son argent pour l’année 2020 ?">

    <figure class="item-thumbnail goto">
        <img width="319" height="154" src="/wp-content/uploads/2018/11/Trader_Rear_View-780x438-319x154.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="Où investir son argent pour l’année 2020 ?">    
    </figure>
    
    <h2 class="item-title">
        <a href="/ou-investir-pour-lannee-2019/" title="Où investir son argent pour l’année 2020 ?">
            Où investir son…        </a>
    </h2>
    
    <div class="item-description">
        La question fatidique et la plus récurrente…    </div>        
    
</div>
<div class="item item-post sm goto" data-goto="/mieux-comprendre-le-trading-en-ligne/" title="Mieux comprendre le trading en ligne">

    <figure class="item-thumbnail goto">
        <img width="319" height="154" src="/wp-content/uploads/2018/11/daa824f35832c0c9aaae4947349a2b57-319x154.jpeg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="Mieux comprendre le trading en ligne">    
    </figure>
    
    <h2 class="item-title">
        <a href="/mieux-comprendre-le-trading-en-ligne/" title="Mieux comprendre le trading en ligne">
            Mieux comprendre le…        </a>
    </h2>
    
    <div class="item-description">
        Avec la démocratisation d’internet, il est devenu…    </div>        
    
</div>    </div>    
 </section>
    
	
	

	
    <div class="asides">   
<? echo do_shortcode('[newblockpc]'); ?>
<article id="content" class="the_content">
    <?php 
        $content = get_the_content();                                    
        

                                    
        echo apply_filters('the_content', $content);

    ?>

					<section>

			<?php echo do_shortcode('[c-mail-full]'); ?>
 
</article> <?          
         if(!is_front_page()) {    get_sidebar(); }
        ?>
    </div>

	 
        
</main>       
    
<?php    
    get_footer();
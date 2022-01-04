<?php
/**
 * Шаблон вывода записи в цикле
 *
 * @package Developt
 * @author  Ruslan Heorhiiev (SKYPE: rgeorgievs)
 * @version 1.0.0
 */

    // id записи 
    $post_id = get_the_ID(); 
    
    // заголовок записи
    $post_title = get_the_title( $post_id );
    $post_title_e = esc_attr( $post_title );
    
    // ссылка записи
    $link = get_permalink( $post_id );
?>

<div class="item item-post sm goto" data-goto="<?= $link ?>" title="<?= $post_title_e ?>">

    <figure class="item-thumbnail goto">
        <?php
            // миниатюра записи
            the_post_thumbnail( 'thumbnail', array(
                'alt' => $post_title_e
            ) );
        ?>    
    </figure>
    
    <h2 class="item-title">
        <a href="<?= $link ?>"  title="<?= $post_title_e ?>">
            <?= wp_trim_words($post_title, 3) ?>
        </a>
    </h2>
    
    <div class="item-description">
        <?= wp_trim_words(get_the_excerpt($post_id), 7); ?>
    </div>        
    
</div>
<?php
/**
 * Шаблон вывода записей
 *
 * @package Developt
 * @author  Ruslan Heorhiiev (SKYPE: rgeorgievs)
 * @version 1.0.0
 */

if (!$posts = get_field('articles')) {
    $posts = get_posts([
        'numberposts' => 4,
    ]);    
}

if (!$posts) {
    return;
}
?>
 
 <section class="articles section">
    <h3 class="section-title">Articles</h3>
    <div class="list-posts" data-col="4">
        <?php
            foreach ($posts as $post) {
                setup_postdata($post);
                get_template_part('template-parts/post/loop', 'sm');
            }
            
            wp_reset_postdata();
        ?>
    </div>    
 </section>
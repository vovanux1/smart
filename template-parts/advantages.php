<?php
/**
 * Шаблон вывода преимуществ
 *
 * @package Developt
 * @author  Ruslan Heorhiiev (SKYPE: rgeorgievs)
 * @version 1.0.0
 */
 
    $advantages = '';
            
    for ($i = 1; $i <= 3; $i++) {
        $advantage = get_field('advantage_' . $i);
        
        if (!$advantage) {
            continue;
        }                     
        
        $advantages .= '
        <div class="item">
            <figure class="item-thumbnail"><img data-src="'.$advantage['image'].'" alt="" /></figure>
            <h4 class="item-title">'.$advantage['title'].'</h4>
            <p class="item-description">'.$advantage['description'].'</p>
        </div>';
    } 
    
    if (!$advantages) {
        return;
    } 
    
 ?>
 
 <section class="advantages section">
    <h3 class="section-title">Advantages</h3>
    <?= $advantages ?>
 </section>
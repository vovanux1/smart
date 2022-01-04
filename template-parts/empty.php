<?php
/**
 * Шаблон вывода ошибок
 *
 * @package Developt
 * @author  Ruslan Heorhiiev (SKYPE: rgeorgievs)
 * @version 1.0.0
 */
 ?>
<div id="empty">
    <?php if ( is_404() ) : ?>
        <p><?php _e('Вы попали на ошибку 404. Ничего не найдено.', 'dvelopt'); ?></p>
    <?php elseif ( is_search() ) : ?>
        <p><?php _e('По вашему запросу ничего не найдено.', 'dvelopt'); ?></p>
    <?php else : ?>
        <p><?php _e('На этой странице ничего не найдено.', 'dvelopt'); ?></p>
    <?php endif; ?>
</div>
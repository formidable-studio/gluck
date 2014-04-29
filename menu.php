
<!-- MENU.PHP -->

<?php
if ( !is_super_admin() || !is_admin_bar_showing() ) {
    $decalSkrollr = '0';
}else{
    $decalSkrollr = '32px';
}

if(is_home()){
    $baseURL = '';
}else{
    $baseURL = get_bloginfo('url').'/';
}

?>


<div id="menu_wrapper" data-smooth-scrolling="off" style="top:<?php echo $decalSkrollr;?>;">
    <div class="container">
        <ul id="nav">
            <li>
                <a href="<?php echo $baseURL; ?>#accueil" id="btn_accueil">
                    <img src="<?php bloginfo( 'template_url' ); ?>/img/exclamation.png" alt="Accueil" width="18" height="20"/></a>
                </li>
                <?php

                if(get_field('home_pages', 'option')):
                    while(has_sub_field('home_pages', 'option')):

                        ?>
                    <li>
                        <a href="<?php echo $baseURL; ?>#<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>" id="btn_<?php echo preg_replace('/[^[:alpha:]]/', '', get_sub_field('menu_title')); ?>"><?php the_sub_field('menu_title'); ?></a>
                    </li>
                    <?php if(get_sub_field('menu_title')=='Boutique'){ ?>
                    <li>
                        <a href="<?php bloginfo('url'); ?>/shop/cart/" id="btn_panier">Panier <img src="<?php bloginfo( 'template_url' ); ?>/img/panier.png" class="logo-panier" alt="Panier" width="21" height="17"/>
                        </a>
                    </li>
                    <?php } ?>
                    <?php
                    endwhile;
                    endif;
                    ?>
                    <li>
                        <a href="<?php bloginfo('url'); ?>/category/blog/" id="btn_blog">Blog</a>
                    </li>
                    <li>
                        <span id="social">
                            <a href="https://www.facebook.com/pages/Glück/102108928011?fref=ts" id="facebook" target="_blank">Facebook</a><!--
                         --><a href="http://pinterest.com/gluckfactory/" id="pinterest" target="_blank">Pinterest</a><!--
                         --><a href="http://instagram.com/gluckfactory" id="instagram" target="_blank">Instagram</a><!--
                         --><a href="https://twitter.com/Gluck_factory" id="twitter" target="_blank">Twitter</a><!--
                         --><a href="http://www.etsy.com/fr/shop/Gluckfactory" id="etsy" target="_blank">Etsy</a>
                        </span>
                    </li>
                </ul>

                
</div>
</div>

<!-- fin MENU.PHP -->
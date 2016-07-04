<h3>Categorias</h3>
<div id="menu">
 <ul>
 <?php wp_list_categories('hide_empty=0&exclude=1&title_li=&depth=2'); ?>
 </ul>
 </div>
<hr>





<?php
$categ = $_SERVER['REQUEST_URI'];
function geraUrlLimpa2($categ){
    $categ = eregi_replace('\/','',$categ);
       return ($categ); } ?>
<?php query_posts('category_name='.$categ.'&showposts=-1'); ?>
<?php if (have_posts()) : echo "<h3>Posts</h3>"; while (have_posts()) : the_post(); ?>
<!-- <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li> -->
<li><?php the_title(); ?></li>
<?php endwhile; ?>
<hr>
<?php endif; ?>







<?php if(have_posts() ) : while(have_posts() ) : the_post();?>
<h2><?php the_title();?></h2>
<?php the_content();?>
<hr>
<?php endwhile;endif;?>
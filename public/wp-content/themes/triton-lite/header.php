<h3>Categorias</h3>
<div id="menu">
 <ul>
 
 <!-- link para a home page do blog
 <li><a href="<?php echo get_option('home');?>">Home</a></li>
  -->
 
 <!-- retorna todas as categorias e subcategorias cadastradas no blog (o depth=2 quer dizer que vai pegar 2 niveis ou seja categoria + subcategoria -->
 <?php wp_list_categories('hide_empty=0&exclude=1&title_li=&depth=2'); ?>
 
 <!-- retorna as páginas cadastradas no blog
 <?php wp_list_pages('title_li=') ?>
  -->
 </ul>
 </div>

 
 
 
 
 
 
 <hr>
 <?php
$categ = $_SERVER['REQUEST_URI'];

function geraUrlLimpa2($categ){

    $categ = eregi_replace('\/','',$categ);
       return ($categ);

}

?>
<?php query_posts('category_name='.$categ.'&showposts=-1'); ?>
<?php if (have_posts()) : echo "<h3>Posts</h3>"; while (have_posts()) : the_post(); ?>

<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>

<hr>
<?php endif; ?>






<?php if (is_single()) { ?>
<h2><?php the_title(); ?></h2>
<?php the_content() ?>
<hr>
<?php } ?>
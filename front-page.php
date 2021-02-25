<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

     <div class="entry-content">
        <?php the_content(); ?>
    </div>

<?php endwhile; else: ?>
    <p><?php _e('Desculpe, não há posts a exibir.'); ?></p>
<?php endif; ?>
<hr>
<h2>Pesquisa por post</h2>
<div class="input-group">
    <input type="text" class="form-control" id="searchInput" placeholder="Procure por um post">
    <span class="input-group-btn">
    <button class="btn btn-primary" type="button" id="search" >Procurar</button>
    </span>
</div><!-- /input-group -->

<div id="datafetch"> </div>

<?php get_footer(); ?>
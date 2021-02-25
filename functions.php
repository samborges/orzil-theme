<?php
function scripts_do_template() {
    // Bootstrap core JavaScript
    // Se preferir utilizar a própria cópia do Bootstrap, descomente a linha a seguir e comente a próxima
    //wp_register_script('bootstrap', get_template_directory_uri().'/lib/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'));
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'));

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
}
// include custom jQuery
function shapeSpace_include_custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

add_action('wp_enqueue_scripts', 'scripts_do_template');

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'before_title' => '<h3>',
        'after_title' => '</h3>',
        'before_widget' => '<div class="row"><div class="col-md-12">',
        'after_widget' => '</div></div>',
    ));
}
?>
<?php
// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $the_query = new WP_Query( array( 'posts_per_page' => 5, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'post' ) );
    echo "<h4>Resultados</h4>";
    if( $the_query->have_posts() ) :
        echo ('<div class="list-group">');
        while( $the_query->have_posts() ): $the_query->the_post(); ?>
       
        <a href="<?php echo esc_url( post_permalink() ); ?>" class="list-group-item">
          <h4 class="list-group-item-heading"><?php the_title();?></h4>
          <p class="list-group-item-text"><?php echo ucfirst(get_the_time('l, j \d\e F \d\e Y')); ?></em></p>
        </a> 

        <?php endwhile;
        echo ('</div>');
        wp_reset_postdata();  
    else: 
        echo '<h3>Não encontramos resultados</h3>';
    endif;
    die();
}

// add the ajax fetch js
add_action('wp_footer', 'ajax_fetch');
function ajax_fetch() {
?>
<script type="text/javascript">

$( "#search" ).click(function() {
    var keyword = jQuery('#searchInput').val();

    $.ajax({url: '<?php echo admin_url('admin-ajax.php'); ?>', 
            type: 'post',
            data: { action: 'data_fetch', keyword: keyword  },
       success: function(result){
            $("#datafetch").html(result);
        }
    });
 
});

</script>
<?php
}
?>
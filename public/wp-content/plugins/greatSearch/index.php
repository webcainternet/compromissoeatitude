<?php
/*
Plugin Name: The Great Search
Plugin URI:  
Description: The best and simplest way for search an especific post in your blog
Author: Flávio Sena
Version: 0.1
Author URI: http://www.naiche.net
*/
$date = '07-29-2013';
$version = md5('0.1' . $date);


register_activation_hook(__FILE__, 'installgreatSearch');
register_deactivation_hook( __FILE__, 'uninstallgreatSearch');
add_action('init', 'addgreatSearchComponents' );
add_filter('pre_get_posts', 'greatSearchFilters');
add_shortcode('getGreatSearchForm', 'getGreatSearchForm');

function installgreatSearch() {
	add_option('greatSearchVersion', '0.1');
}
function uninstallgreatSearch() {
	delete_option('greatSearchVersion');
}
function addgreatSearchComponents() { 
    global $version;
    if (!is_admin()) {
        wp_enqueue_style('greatSearchCSS', WP_PLUGIN_URL . '/greatSearch/style.css', array(), $version);
        wp_enqueue_script('greatSearchJS', WP_PLUGIN_URL . '/greatSearch/script.js', array('jquery'), $version);
    }
}
function greatSearchFilters() {
    global $wp_query;
    if (isset($_REQUEST['s']) === TRUE) {
        $wp_query->query_vars['sentence'] = isset($_REQUEST['sentence']) && (int)$_REQUEST['sentence'] == 1 ? 1 : 0;
        
        
        if(isset($_REQUEST['cat']) === TRUE
                && $_REQUEST['cat'] != 0){
            $cat  = get_categories("hide_empty=false&exclude=" . $_REQUEST['cat']);
            $wp_query->query_vars['cat'] = "-" . $cat;
        }

        if(isset($_REQUEST['orderByDate']) === TRUE
            && strlen($_REQUEST['orderByDate']) > 0) {
            $wp_query->set('orderby', 'date');
            $wp_query->set('order', $_REQUEST['orderByDate'] == 'ASC' ? 'ASC' : 'DESC');
        }

        if(isset($_REQUEST['column']) === TRUE
            && strlen($_REQUEST['column']) > 0) {
            add_filter( 'posts_search', 'greatSearchBy__', 500, 2 );
        }
    }
}
add_filter( 'posts_search', 'debugxss', 5000, 2 );
function debugxss($search, &$wp_query) {
    $name = 'debug.txt';
    $text = var_export($search, true) . PHP_EOL . PHP_EOL . PHP_EOL;
    $file = fopen($name, 'a');
    fwrite($file, $text);
    fclose($file);
    return $search;
}
function getGreatSearchForm(){ ?>
    <form method="get" action="<?php echo get_bloginfo("url"); ?>">
                    <p>Critério de busca:
                        <input type="text" value="<?php echo esc_attr(apply_filters('the_search_query', get_search_query())) ?>" name="s" id="s" /></p>
                    <p>Em
                        <input type="radio" name="sentence" id="sentence0" checked value="0">
                        <label for="sentence0">qualquer palavra</label>

                        <input type="radio" name="sentence" id="sentence1" value="1">
                        <label for="sentence1">frase exata</label></p>
                    <p>Por
                        <input type="radio" name="column" id="columnall" checked value="">
                        <label for="columnall">Título e Conteudo</label>
                        <input type="radio" name="column" id="post_title" value="post_title">
                        <label for="post_title">Título</label>
                        <input type="radio" name="column" id="post_content" value="post_content">
                        <label for="post_content">Conteudo</label></p>
                    <p>
                        Order por: 
                        <select name="orderByDate">
                            <option value="DESC">Mais recentes</option>
                            <option value="ASC">Mais antigos</option>
                        </select>
                    </p>
                    <p>Categoria:
                    <?php echo wp_dropdown_categories(array(
                        'show_option_all' => 'Todas as categorias',
                        'show_option_none' => '',
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'show_last_update' => 0,
                        'show_count' => 0,
                        'hide_empty' => 1,
                        'child_of' => 0,
                        'echo' => 0,
                        'selected' => (int)$_GET['cat'],
                        'hierarchical' => 1, 
                        'name' => 'cat',
                        'class' => 'cat-list')) ?>
                    </p>
            <input type="submit" value="Buscar" />
    </form>
<?php
}
function greatSearchBy__($search, &$wp_query) {
    $column = $_REQUEST['column'];
    //echo $search;
    if(strlen($column) > 0) {
        global $wpdb;
        if ( empty( $search ) )
            return $search; // skip processing - no search term in query

        $n = ! empty( $wp_query->query_vars['exact'] ) ? '' : '%';
        $search =
        $searchand = NULL;
        foreach ( (array) $wp_query->query_vars['search_terms'] as $term ) {
            $term = esc_sql( like_escape( $term ) );
            $search .= $searchand . "(" . $wpdb->posts . "." . $column . " LIKE '" . $n . $term . $n . "')";
            $searchand = ' AND ';
        }
        if ( ! empty( $search ) ) {
            $search = " AND ({$search}) ";
            if ( ! is_user_logged_in() )
                $search .= " AND ($wpdb->posts.post_password = '') ";
        }
    }
    /*echo '<br>';
    echo $search;exit;*/
    return $search;
}
<?php
/**
 * Template for site header
 * @package themify
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php echo themify_get_html_schema(); ?> <?php language_attributes(); ?>>
<head>
<?php
/** Themify Default Variables
 *  @var object */
	global $themify; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<title itemprop="name"><?php wp_title(); ?></title>

<?php
/**
 *  Stylesheets and Javascript files are enqueued in theme-functions.php
 */
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-34379997-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- wp_header -->
<?php wp_head(); ?>





</head>

<body <?php body_class(); ?>>
<?php themify_body_start(); // hook ?>
<div id="pagewrap" class="hfeed site">

	<div id="headerwrap">
    
		<?php themify_header_before(); // hook ?>

		<header id="header" class="pagewidth clearfix">
		
		<!-- Header Ticker -->

          <div class="headerTicker">
            <div class="headerTickerWrap">
              <div style="float:right;">
              <p> | 
                  <a href="http://www.compromissoeatitude.org.br/busca/" style="color: #000000;">Busca Avançada </a> |
                  <a href="http://www.compromissoeatitude.org.br/contato/" style="color: #000000;">Contato </a> | <a href="http://www.compromissoeatitude.org.br/cadastre-se/" style="color: #000000;">Cadastre-se</a>
                </p>
              </div>
              <div id="searchform-wrap" style="float:right;">
              <?php if(!themify_check('setting-exclude_search_form')): ?>
                <?php get_search_form(); ?>
              <?php endif ?>
            </div>
            <!-- /searchform-wrap -->
            </div>
          </div>

          <!-- End of Header Ticker -->

        	<?php themify_header_start(); // hook ?>

			<div class="logo-wrap">
				<?php echo themify_logo_image(); ?>
				<?php if ( $site_desc = get_bloginfo( 'description' ) ) : ?>
					<?php global $themify_customizer; ?>
					<div id="site-description" class="site-description"><?php echo class_exists( 'Themify_Customizer' ) ? $themify_customizer->site_description( $site_desc ) : $site_desc; ?></div>
				<?php endif; ?>
					
			</div>

			<a id="menu-icon" href="#sidr" data-uk-offcanvas="{target:'#sidr'}"></a>
			<nav id="sidr" class="uk-offcanvas">
				<div class="uk-offcanvas-bar uk-offcanvas-bar-flip">

					<div class="social-widget">
						<?php dynamic_sidebar('social-widget'); ?>

						<?php if ( ! themify_check( 'setting-exclude_rss' ) ) : ?>
							<div class="rss"><a href="<?php echo themify_get( 'setting-custom_feed_url' ) != '' ? themify_get( 'setting-custom_feed_url' ) : get_bloginfo( 'rss2_url' ); ?>"></a></div>
						<?php endif ?>
					</div>
					

					<?php //themify_theme_menu_nav(); ?>
<ul id="main-nav" class="main-nav clearfix">
	<li id="menu-item-9557" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-has-children menu-item-9557"><a href="http://www.compromissoeatitude.org.br/sobre-a-campanha/">A Campanha</a>
<ul class="sub-menu">
	<li id="menu-item-9519" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9519"><a href="http://www.compromissoeatitude.org.br/sobre-a-campanha/">O que é</a></li>
	<li id="menu-item-11534" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-11534"><a href="http://www.compromissoeatitude.org.br/sobre-a-campanha/parceiros-da-campanha/">Parceiros da Campanha</a></li>
	<li id="menu-item-21756" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-21756"><a href="http://www.compromissoeatitude.org.br/empresas-que-apoiam-a-campanha-compromisso-e-atitude/">Empresas que apoiam a Campanha</a></li>
	<li id="menu-item-15049" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15049"><a href="http://www.compromissoeatitude.org.br/category/sobre-a-campanha/cobertura-sobre-a-campanha/">Ações da Campanha</a></li>
	<li id="menu-item-9538" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-9538"><a href="http://www.compromissoeatitude.org.br/agenda/">Agenda</a></li>
</ul>
</li>
	<li id="menu-item-5542" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-has-children menu-item-5542"><a href="http://www.compromissoeatitude.org.br/dados-e-estatisticas-sobre-violencia-contra-as-mulheres/">Dados e fatos</a>
<ul class="sub-menu">
	<li id="menu-item-15060" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15060"><a href="http://www.compromissoeatitude.org.br/dados-e-estatisticas-sobre-violencia-contra-as-mulheres/">Dados sobre violência contra as mulheres</a></li>
	<li id="menu-item-5544" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5544"><a href="http://www.compromissoeatitude.org.br/dados-nacionais-sobre-violencia-contra-a-mulher/">Dados nacionais</a></li>
	<li id="menu-item-5543" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5543"><a href="http://www.compromissoeatitude.org.br/dados-mundiais-sobre-a-violencia-contra-as-mulheres/">Dados mundiais</a></li>
	<li id="menu-item-27403" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27403"><a href="http://www.compromissoeatitude.org.br/violencia-moral-e-psicologica/">Seção violência moral e psicologica</a></li>
	<li id="menu-item-22264" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22264"><a href="http://www.compromissoeatitude.org.br/secao-violencia-sexual/">Seção violência sexual</a></li>
	<li id="menu-item-22265" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22265"><a href="http://www.compromissoeatitude.org.br/secao-sobre-feminicidios/">Seção feminicídio</a></li>
	<li id="menu-item-9533" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-has-children menu-item-9533"><a title="Biblioteca virtual" href="http://www.compromissoeatitude.org.br/biblioteca/">Biblioteca</a>
<ul class="sub-menu">
	<!--<li id="menu-item-9532" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-9532"><a href="http://www.compromissoeatitude.org.br/sobre/biblioteca-virtual/">Veja as seções</a></li>-->
	<li id="menu-item-20545" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20545"><a href="http://www.compromissoeatitude.org.br/category/biblioteca-virtual/artigos/">Artigos comentados da Lei Maria da Penha</a></li>
</ul>
</li>
</ul>
</li>
	<li id="menu-item-15053" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-15053"><a href="http://www.compromissoeatitude.org.br/lei-maria-da-penha/">Lei Maria da Penha</a>
<ul class="sub-menu">
	<li id="menu-item-15072" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15072"><a href="http://www.compromissoeatitude.org.br/lei-no-11-340-de-07082006-lei-maria-da-penha/">A Lei nº 11.340/2006</a></li>
	<li id="menu-item-15057" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15057"><a href="http://www.compromissoeatitude.org.br/artigos-opinativos/">Artigos comentados</a></li>
	<li id="menu-item-15056" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-15056"><a href="http://www.compromissoeatitude.org.br/jurisprudencia/">Jurisprudência</a>
<ul class="sub-menu">
	<li id="menu-item-20328" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20328"><a href="http://www.compromissoeatitude.org.br/decisoes-do-stf/">Decisões do STF</a></li>
	<li id="menu-item-20329" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20329"><a href="http://www.compromissoeatitude.org.br/decisoes-do-stj/">Decisões do STJ</a></li>
	<li id="menu-item-20330" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20330"><a href="http://www.compromissoeatitude.org.br//decisoes-de-outros-tribunais/">Decisões de outros tribunais</a></li>
</ul>
</li>
</ul>
</li>
	<li id="menu-item-5551" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-has-children menu-item-5551"><a href="http://www.compromissoeatitude.org.br/legislacao-jurisprudencia-convencoes-e-normas/">Legislação/Jurisprudência</a>
<ul class="sub-menu">
	<li id="menu-item-5548" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-has-children menu-item-5548"><a href="http://www.compromissoeatitude.org.br/legislacao-sobre-violencia-contra-as-mulheres/">Legislação sobre violência contra as mulheres</a>
<ul class="sub-menu">
	<li id="menu-item-5550" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5550"><a href="http://www.compromissoeatitude.org.br/legislacao-sobre-violencia-contra-as-mulheres-no-mundo/">No mundo</a></li>
	<li id="menu-item-5549" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5549"><a href="http://www.compromissoeatitude.org.br/legislacao-sobre-violencia-contra-as-mulheres-no-brasil/">No Brasil</a></li>
</ul>
</li>
	<li id="menu-item-5541" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5541"><a href="http://www.compromissoeatitude.org.br/convencoes-e-tratados-internacionais/">Convenções e tratados internacionais</a></li>
	<li id="menu-item-5554" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5554"><a href="http://www.compromissoeatitude.org.br/normas-recomendacoes-e-manuais/">Normas, recomendações e manuais</a></li>
	<li id="menu-item-5547" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-has-children menu-item-5547"><a href="http://www.compromissoeatitude.org.br/jurisprudencia/">Jurisprudência</a>
<ul class="sub-menu">
	<li id="menu-item-5545" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5545"><a href="http://www.compromissoeatitude.org.br/decisoes-do-stf/">Decisões do STF</a></li>
	<li id="menu-item-5546" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5546"><a href="http://www.compromissoeatitude.org.br/decisoes-do-stj/">Decisões do STJ</a></li>
	<li id="menu-item-7563" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-7563"><a href="http://www.compromissoeatitude.org.br/decisoes-de-outros-tribunais/">Decisões de outros tribunais</a></li>
</ul>
</li>
</ul>
</li>
	<li id="menu-item-2499" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2499"><a title="Serviços e ações do Estado" href="#">Serviços e ações</a>
<ul class="sub-menu">
	<li id="menu-item-5555" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5555"><a href="http://www.compromissoeatitude.org.br/politicas-publicas-sobre-violencia-contra-as-mulheres/">Políticas públicas sobre violência contra as mulheres</a></li>
	<li id="menu-item-15050" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15050"><a href="http://www.compromissoeatitude.org.br/rede-de-atendimento-as-mulheres-em-situacao-de-violencia/">Rede de serviços</a></li>
	<li id="menu-item-5556" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-has-children menu-item-5556"><a href="http://www.compromissoeatitude.org.br/sistema-de-justica-em-acao/">Ações do Sistema de Justiça</a>
<ul class="sub-menu">
	<li id="menu-item-13031" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-13031"><a href="http://www.compromissoeatitude.org.br/sistema-de-justica-em-acao/">Sistema de Justiça em ação</a></li>
	<li id="menu-item-13032" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-13032"><a href="http://www.compromissoeatitude.org.br/experiencias-de-atuacao-funcional">Experiências de atuação funcional</a></li>
	<li id="menu-item-16350" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16350"><a href="http://www.compromissoeatitude.org.br/julgamentos-de-crimes-de-violencia-contra-as-mulheres/">Julgamentos de crimes de violência contra as mulheres</a></li>
	<li id="menu-item-15058" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15058"><a href="http://www.compromissoeatitude.org.br/casos-emblematicos-de-assassinato-e-outros-crimes-contra-mulheres">Casos emblemáticos</a></li>
</ul>
</li>


	<li id="menu-item-24193" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-24193"><a href="http://www.compromissoeatitude.org.br/atlas-de-acesso-a-justica/">Atlas de Acesso à Justiça</a></li>
	<li id="menu-item-15050" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15050"><a href="http://www.compromissoeatitude.org.br/mapa-da-cpmi/">Mapa da CPMI</a></li>
	<li id="menu-item-5540" class="menu-item menu-item-type-post_type menu-item-object-sobre menu-item-5540"><a href="http://www.compromissoeatitude.org.br/campanhas-sobre-violencia-contra-a-mulher/">Campanhas</a></li>
</ul>
</li>
	<li id="menu-item-2501" class="menu-item menu-item-type-post_type menu-item-object-noticias menu-item-has-children menu-item-2501"><a href="http://www.compromissoeatitude.org.br/noticias/">Notícias</a>
<ul class="sub-menu">
	<li id="menu-item-9409" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9409"><a href="http://www.compromissoeatitude.org.br/noticias/">Notícias em destaque</a>
<ul class="sub-menu">
	<li id="menu-item-9399" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9399"><a href="http://www.compromissoeatitude.org.br/category/noticias/noticias-dos-tres-poderes/">Notícias dos Três Poderes</a></li>
	<li id="menu-item-21755" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21755"><a href="http://www.compromissoeatitude.org.br/category/noticias/noticias-das-empresas/">Notícias das Empresas</a></li>
	<li id="menu-item-9398" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9398"><a href="http://www.compromissoeatitude.org.br/category/noticias/noticias-na-imprensa/">Notícias na imprensa</a></li>
</ul>
</li>
	<li id="menu-item-13028" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-13028"><a href="http://www.compromissoeatitude.org.br/category/noticias/materias-exclusivas/">Especiais e matérias exclusivas</a>
<ul class="sub-menu">
	<li id="menu-item-19129" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19129"><a href="http://www.compromissoeatitude.org.br/category/noticias/materias-exclusivas/">Matérias especiais</a></li>
	<li id="menu-item-17668" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17668"><a href="http://www.compromissoeatitude.org.br/sobre/artigos-opinativos/">Opinião: artigos</a></li>
	<li id="menu-item-12812" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12812"><a href="http://www.compromissoeatitude.org.br/category/noticias/entrevistas/">Opinião: entrevistas</a></li>
</ul>
</li>
	<li id="menu-item-25452" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25452"><a href="http://www.compromissoeatitude.org.br/informativo-compromisso-e-atitude/">Informativo</a></li>
</ul>
</li>
</ul>
			<!-- /#main-nav -->



					<a id="menu-icon-close" href="#"></a>

				</div>
			</nav>

			<?php themify_header_end(); // hook ?>

		</header>
		<!-- /#header -->

        <?php themify_header_after(); // hook ?>
				
	</div>
	<!-- /#headerwrap -->
	
	<div id="body" class="clearfix">

		<?php themify_layout_before(); //hook ?>
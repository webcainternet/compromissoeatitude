<?php
/**
 * Template for search form.
 * @package themify
 * @since 1.0.0
 */
?>

<style type="text/css">
	.botao-pesquisa{
		background: none;
		float: right;
		border: none;
		padding: 0;
		margin: -21px 5px 0 0;
  		width: 5px;
  		height: 30px;
	}
		.botao-pesquisa:hover{
			background: none;
		}
	#s{
		padding: 5px 20px !important;
	}
	@media screen and (max-width: 1000px) {
	   #searchform{display: none !important;}
	}
</style>

<form method="get" id="searchform" action="<?php echo home_url(); ?>/">

	<input type="text" name="s" id="s" />
	<button class="botao-pesquisa"><i class="icon-search"></i></button>

</form>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>
<script type="text/javascript" src="scripts/jquery.js" /></script>
<script type="text/javascript" src="scripts/cycle.js" /></script>

<script type="text/javascript">
$(function(){
   $('#destaques ul').cycle({
     fx: 'fade',
     speed: 1500,
     timeout: 5000,
     next: '#proximo',
     prev: '#anterior',
     pager: '#pager'
   })
 })
</script>

<style type="text/css">
*{margin:0; padding:0;}
#destaques{width:500px; height:300px;}
#destaques ul{list-style:none;}
.paginacao a{padding:3px; border:1px solid #333; text-decoration:none;
 font:14px "Trebuchet MS", Arial, Helvetica, sans-serif;
 color:#333; margin:5px 2px;}
.paginacao a:hover{background:#C4FFFF;}
</style>
<body>


<div id="destaques">
 <ul>
 <li>
 <img src="images/01.jpg" alt="" />
 <h1>Not�cia destaque 01</h1>
 <p>
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et condimentum nibh
 . Nunc iaculis iaculis cursus. Integer nisl tellus, dictum sit amet consequat eget
 cursus nec
 </p>

 </li>

 <li>
 <img src="images/02.jpg" alt="" />
 <h1>Not�cia destaque 02</h1>
 <p>
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et condimentum nibh
 . Nunc iaculis iaculis cursus. Integer nisl tellus, dictum sit amet consequat eget
 cursus nec
 </p>
 </li>

 <li>
 <img src="images/03.jpg" alt="" />
 <h1>Not�cia destaque 03</h1>
 <p>
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et condimentum nibh
 . Nunc iaculis iaculis cursus. Integer nisl tellus, dictum sit amet consequat eget
 cursus nec
 </p>
 </li>

 <li>
 <img src="images/04.jpg" alt="" />
 <h1>Not�cia destaque 04</h1>
 <p>
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et condimentum nibh
 . Nunc iaculis iaculis cursus. Integer nisl tellus, dictum sit amet consequat eget
 cursus nec
 </p>
 </li>

 <li>
 <img src="images/05.jpg" alt="" />
 <h1>Not�cia destaque 05</h1>
 <p>
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et condimentum nibh
 . Nunc iaculis iaculis cursus. Integer nisl tellus, dictum sit amet consequat eget
 cursus nec
 </p>
 </li>
 </ul>

 <div class="paginacao">
 <a href="#" id="anterior">Anterior</a>
 <span id="pager"></span>
 <a href="#" id="proximo">Pr�ximo</a>
 </div><!--paginacao-->

</div><!--destaques-->

</body>
</html>

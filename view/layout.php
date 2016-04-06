<!DOCTYPE html>
<html>
	<head>
		<title>Saludo</title>
<div style="background-image:url('http://blog.decoradornet.com.br/wp-content/uploads/2012/10/tiffany-328x205.jpg'); background-repeat:repeat;height:1000px;"
	
	<head>
		<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAA/4QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABEREQAAAAAAAREQAAAAEREREREREQARERERERERABEAAAAAABEAEQAAAAAAEQARAAAAAAARABEAEQAAABEAEQAQAAAAEQAQABABAAARABABEREAABEAABEQAAAAEQABEQAAAAARABEQAAEREREAEQABEREREQAAAAAAAAAAD4HwAA/D8AAIABAACAAQAAn/kAAJ/5AACf+QAAmfkAAJv5AAC7eQAAsHkAAOP5AADH+QAAjwEAAJwBAAD//wAA" rel="icon" type="image/x-icon" />
		<title>Panel de control</title>
		<meta charset="utf-8" />
		{% block cabecera %}
			<script src="/js/jquery.min.js"></script>
			<link href="/css/bootstrap-combined.min.css" rel="stylesheet">
			<link href="/css/bootstrap-theme.min.css" rel="stylesheet">
			<link href="/css/jumbotron-narrow.css" rel="stylesheet">
			<link href="calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
   <style type="text/css">
   body{
      font-family: tahoma, verdana, sans-serif;
   }
   </style>
   <script type="text/javascript" src="calendario_dw/jquery-1.4.4.min.js"></script>
   <script type="text/javascript" src="calendario_dw/calendario_dw.js"></script>
   
   <script type="text/javascript">
   $(document).ready(function(){
      $(".campofecha").calendarioDW();
   })
   </script>
   
		{% endblock %}
		
	</head>
	<body>
		<div class="container">
			<div class="header">
				<ul class="nav nav-pills pull-right">
				    <li id="inicio" class="active"><a href="/">Inicio</a></li>
				    <li id="crear"><a href="/maria">Partes</a></li>
					<li id="oir"><a href="/dictado/escuchar"></a></li>
					{% if login.isLogged() %}
						<li id="salir"><a href="/usuario/logout">Cerrar sesión</a></li>
					{% endif %}
				</ul>
				
				<img src="img/icono.jpg">
			</div>
			
			{% block cuerpo %} {% endblock %}
			
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('ul.nav').find('li').removeAttr('class'); $('li#{% block tabActivo %} {% endblock %}').addClass('active')
			});
		</script>
		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			  ga('create', 'UA-38574806-2', 'auto');
			  ga('send', 'pageview');
		</script>
	</body>
</html>

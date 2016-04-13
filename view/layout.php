<!DOCTYPE html>
<html>

	
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
				    <li id="contacto"><a href="/contactar">Formulario para alumnos</a></li>
				    <li id="comentarios"><a href="/comentarios">Alumnos</a></li>
				    <li id="partes"><a href="/partes">Partes</a></li>
				    <li id="about"><a href="/about">Acerca de</a></li>
				</ul>
				<h3 class="text-muted">Panel de control</h3>
				<img src="img/logotipodefinitivatititititon.png" height="160" width="160">
			</div>
			
			{% block cuerpo %} {% endblock %}
			
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('ul.nav').find('li').removeAttr('class'); $('li#{% block tabActivo %} {% endblock %}').addClass('active')
			});
		</script>
	</body>
</html>

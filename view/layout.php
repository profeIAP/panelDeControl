<!DOCTYPE html>
<html>
<div style="background-image:url('http://blog.decoradornet.com.br/wp-content/uploads/2012/10/tiffany-328x205.jpg'); background-repeat:repeat;height:1000px;"
	
	<head>
		<title>Panel de control</title>
		<meta charset="utf-8" />
		{% block cabecera %}
			<script src="/js/jquery.min.js"></script>
			<link href="/css/bootstrap-combined.min.css" rel="stylesheet">
			<link href="/css/bootstrap-theme.min.css" rel="stylesheet">
			<link href="/css/jumbotron-narrow.css" rel="stylesheet">
		{% endblock %}
		
	</head>
	<body>
		<div class="container">
			<div class="header">
				<ul class="nav nav-pills pull-right">
				    <li id="inicio" class="active"><a href="/">Inicio</a></li>
				    <li id="contacto"><a href="/contactar">Formulario para alumnos</a></li>
				    <li id="comentarios"><a href="/comentarios">Alumnos</a></li>
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

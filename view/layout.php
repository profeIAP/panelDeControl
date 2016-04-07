<!DOCTYPE html>
<html>
<div style="background-image:url('http://www.mundodopapeldeparede.com.br/wp-content/uploads/2013/05/05629-80-89892_280x231.jpg'); background-repeat:repeat;height:1000px;"
	
	<head>
		<title>Panel de control</title>
		<meta charset="utf-8" />
		{% block cabecera %}
			<script src="/js/jquery.min.js"></script>
			<link href="/css/bootstrap-combined.min.css" rel="stylesheet">
			<link href="/css/bootstrap-theme.min.css" rel="stylesheet">
			<link href="/css/jumbotron-narrow.css" rel="stylesheet">
			<link href="css/calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
   <style type="text/css">
   body{
      font-family: tahoma, verdana, sans-serif;
   }
   </style>
   <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
   <script type="text/javascript" src="js/calendario_dw.js"></script>
   
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

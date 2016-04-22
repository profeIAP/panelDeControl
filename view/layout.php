<!DOCTYPE html>
<html>
<div style="background-image:url('http://www.mundodopapeldeparede.com.br/wp-content/uploads/2013/05/05629-80-89892_280x231.jpg'); background-repeat:repeat;height:1000px;"
	
	<head>
		<title>Panel de control</title>
		<meta charset="utf-8" />
		{% block cabecera %}
			<script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>
			<script type="text/javascript" src="/js/calendario_dw.js"></script>
			<script type="text/javascript">
			$(document).ready(function(){
			$(".campofecha").calendarioDW();
			})
			</script>
			<script src="/js/jquery.min.js"></script>
			<link href="/css/bootstrap-combined.min.css" rel="stylesheet">
			<link href="/css/bootstrap-theme.min.css" rel="stylesheet">
			<link href="/css/jumbotron-narrow.css" rel="stylesheet">		
			<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
			<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
			<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		{% endblock %}
			
	</head>
	<body>
		<div class="container">
			<div class="header">
				<ul class="nav nav-pills pull-right">
				    <li id="inicio" class="active"><a href="/">Inicio</a></li>
				    <li id="contacto"><a href="/alumnos/crear">Formulario para alumnos</a></li>
				    <li id="notificaciones"><a href="/notificaciones">Notificaciones</a></li>
				    <li id="alumnos"><a href="/comentarios">Alumnos</a></li>
				    <li id="partes"><a href="/partes">Partes</a></li>
				    <li id="parte"><a href="/partes/crear">Crear Parte</a></li>
				    <li id="about"><a href="/about">Acerca de</a></li>
				    <li id="importar"><a href="/importar">Importar</a></li>
				</ul>
				<h3 class="text-muted">Panel de control</h3>
				<img src="/img/logo.png" height="160" width="160">
			</div>
			
			
			
			{% block cuerpo %} {% endblock %}
			</div>
			<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
			
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('ul.nav').find('li').removeAttr('class'); $('li#{% block tabActivo %} {% endblock %}').addClass('active')
			});
		</script>
	</body>
</html>

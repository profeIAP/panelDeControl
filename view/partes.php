{% extends "layout.php" %}

{% block tabActivo %}comentarios{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}
<table class="table table-bordered table-hover" id="temas">				
	<thead>	GIT
		<tr>			
			<th>ID</th>	
			<th>NOMBRE</th>
			<th>EMAIL</th>
			<th>CLAVE</th>
			<th>GRUPO</th>
			<th>ASIGNATURA</th>
			<th>PROFESOR</th>
			<th>ACCIONES</th>
		</tr>	
	</thead>
	<tbody style=" .table-hover">
		{% for comentario in usuarios %}
			<tr>
			{% for campo, valor in comentario %}
				<td>{{valor}}</td>
			{% endfor %}
				<td>
					{% set url=utils.protegerURL('/usuarios/borrar?id=?id=' ~ comentario.ID )%}
					<a href="{{url}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
					{% set url=utils.protegerURL('/usuarios/editar?id=' ~ comentario.ID )%}
					<a href="{{url}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a>			
				</td>
			</tr>
		{% endfor %}
	</tbody>
</table>
<div class="jumbotron">
	<h1>Partes registrados</h1>
	<p class="lead">Listado de partes</p>
</div>

{% for comentario in comentarios %}
	
		{% for campo, valor in comentario %}
			{{campo}} : {{valor}} <br>
		{% endfor %}
		
	    {% set url=utils.protegerURL('/borrar?id=' ~ comentario.ID) %}
		<a href="{{url}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		{% set url=utils.protegerURL('/editar?id=' ~ comentario.ID) %}
		<a href="{{url}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		----------------<br>
{% endfor %}
	
{% endblock cuerpo %}


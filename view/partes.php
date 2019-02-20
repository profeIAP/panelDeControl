{% extends "layout.php" %}

{% block tabActivo %}comentarios{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

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


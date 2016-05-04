{% extends "layout.php" %}

{% block tabActivo %}razon{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

<div class="jumbotron">
	<h1>Partes de alumnos</h1>
	<p class="lead">Lista de alumnos con partes leves</p>
	{% for razón in partesleves %}
	
		{% for campo, valor in Partes %}
			{{campo}} : {{valor}} <br>
		{% endfor %}
		
		<a href="/borrar2?id={{partesleves.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/editar2?id={{partesleves.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		----------------<br>
	{% endfor %}
</div>

{% endblock cuerpo %}


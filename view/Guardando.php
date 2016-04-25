{% extends "layout.php" %}

{% block tabActivo %}inicio{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

<div class="jumbotron">
	<h1>Ya estas regristado el parte "{{nombre}}"</h1>
	<p class="lead">Sus datos serán utilizados en el control de partes del instituto</p>
</div>
{% endblock cuerpo %}

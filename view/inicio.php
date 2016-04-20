{% extends "layout.php" %}

{% block tabActivo %}inicio{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

<div
  class="jumbotron">
	<h1>Bienvenid@</h1>
	<p class="lead">Panel de control y lista de alumnos del instituto I.E.S. Al-Andalus</p>
</div>

{% endblock cuerpo %}


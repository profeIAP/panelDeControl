{% extends "layout.php" %}

{% block tabActivo %}contacto{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

<div class="jumbotron">
	<h1>Crear usuario</h1>
	<p class="lead">Indica los datos del nuevo usuario del sistema</p>
</div>

<img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.comune.sandonatomilanese.mi.it%2Fwp-content%2Fuploads%2F2016%2F09%2Fpp-work-in-progress.jpg&f=1">

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
{% endblock cuerpo %}


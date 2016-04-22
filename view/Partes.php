{% extends "layout.php" %}

{% block tabActivo %}Partes{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

<div class="jumbotron">
	<p class="lead">Partes registrados</p>
</div>

<form method="post" action="/Guardando" role="form">
		
		<input type="hidden" name="id" value="{{partesleves.ID}}"/>
		
		<div class="form-group">
			<label for="nombre">Nombre del alumno</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="{{partesleves.NOMBRE}}">
		</div>
		<div class="form-group">
			<label for="tipo">Tipo de parte</label>
			<input type="text" class="form-control" id="tipo" name="tipo"  value="{{partesleves.TIPO}}">
		</div>
		<div class="form-group">
			<label for="razon">Razon:</label>
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="razon" name="razon" >{{partesleves.RAZÓN}} </textarea>
		</div>
		
		<button type="submit" class="btn btn-default">Enviar</button>
</form>

{% endblock cuerpo %}




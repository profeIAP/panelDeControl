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
	<h1>Registrese como alumno del I.E.S. Al-Ándalus</h1>
	<p class="lead">Todos los campos son obligatorios</p>
</div>

<form method="post" action="/guardarSugerencia" role="form">
		
		<input type="hidden" name="id" value="{{comentario.ID}}"/>
		
		<div class="form-group">
			<label for="nombre">Nombre:</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="{{comentario.NOMBRE}}">
		</div>
		<div class="form-group">
			<label for="email">Correo electrónico:</label>
			<input type="text" class="form-control" id="email" name="email"  value="{{comentario.EMAIL}}">
		</div>
		<div class="form-group">
			<label for="direccion">Dirección:</label>
			<input type="text" class="form-control" id="direccion" name="direccion"  value="{{comentario.DIRECCION}}">
		</div>
		<div class="form-group">
			<label for="telefono">Teléfono:</label>
			<input type="text" class="campofecha" id="telefono" name="telefono" size="12" value="{{comentario.TELEFONO}}">
		</div>
		<div class="form-group">
			<label for="comentario">Comentario:</label>
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="comentario" name="comentario" >{{comentario.COMENTARIO}}</textarea>
		</div>
		<div class="form-group">
			<label for="localidad">Localidad:</label>
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="localidad" name="localidad" >{{comentario.COMENTARIO}}</textarea>
		</div>
		<div class="form-group">
			<label for="provincia">Provincia:</label>
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="provincia" name="provincia" >{{comentario.COMENTARIO}}</textarea>
		</div>
		<div class="form-group">
			<label for="dni_tutor">dni_tutor:</label>
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="dni_tutor" name="dni_tutor" >{{comentario.COMENTARIO}}</textarea>
		</div>
		<div class="form-group">
			<label for="curso">Curso:</label>
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="curso" name="curso" >{{comentario.COMENTARIO}}</textarea>
		</div>
		
		<button type="submit" class="btn btn-default">Enviar</button>
</form>

{% endblock cuerpo %}


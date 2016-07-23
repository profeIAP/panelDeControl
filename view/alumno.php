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

<form method="post" action="/alumnos/guardar" role="form">
		
		<input type="hidden" name="id" value="{{comentario.ID}}"/>
		
		<div class="form-group col-md-12">
			<label for="nombre">Nombre:</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="{{comentario.NOMBRE}}">
		</div>
		<div class="form-group col-md-12">
			<label for="apellido">Apellidos:</label>
			<input type="text" class="form-control" id="apellido" name="apellido"  value="{{comentario.APELLIDO}}">
		</div>
		
			<div class="form-group col-md-12">
			<label for="correoelectronico">Correo Electrónico:</label>
			<input type="text" class="form-control" id="email" name="email" value="{{comentario.EMAIL}}">
		</div>
		<div class="form-group col-md-12">
		<label for="calle">Calle:</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="{{comentario.DIRECCION}}">
		</div>
		
		  <div class="form-group col-md-6">
		  <label for="codigopostal">Código Postal:</label>
		    <input type="text" class="form-control" id="codigopostal" name="codigopostal" size="12" value="">
 </div>
 
		   <div class="form-group col-md-6">
		  <label for="localidad">Localidad:</label>
			<input type="text" class="form-control" id="localidad" name="localidad" size="12" value="">
 </div>
		<div class="form-group col-md-12">
		<label for="provincia">Provincia:</label>
			<input type="text" class="form-control" id="provincia" name="provincia" value="{{comentario.PROVINCIA}}">
		</div>
		<div class="form-group col-md-12">
		<label for="tutor1">D.N.I:</label>
			<input type="text" class="form-control" id="dni" name="dni" value="{{comentario.DNI}}">
		</div>
		<div class="form-group col-md-12">
			<label for="dni">Tutor 1:</label>
			<input type="text" class="form-control" id="tutor1" name="tutor1" value="{{comentario.TUTOR1}}">
		</div>
		<div class="form-group col-md-12">
		<label for="tutor2">D.N.I:</label>
			<input type="text" class="form-control" id="dni" name="dni" value="{{comentario.DNI}}">
		</div>
		<div class="form-group col-md-12">
			<label for="dni">Tutor 2:</label>
			<input type="text" class="form-control" id="tutor2" name="dni" value="{{comentario.TUTOR2}}">
		
		

			
		</div>
		
		<div class="form-group col-md-3">
			
		<button type="submit" class="btn btn-success">Aceptar</button><a href="/alumnos/aceptar"></a>
		</div>
        <div class="form-group col-md-3">
		<button type="submit" class="btn btn-danger">Cancelar</button><a href="/alumnos/cancelar"></a>
		
		</div>
		




</form>

{% endblock cuerpo %}


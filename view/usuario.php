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

<form method="post" action="/alumnos/anotaciones/guardar" role="form">
		
		<input type="hidden" name="ID" value="{{usuario.ID}}"/>

		<div class="form-group col-md-9">
			<label for="alumnoaImplicado">Nombre</label>
			<input type="text" class="form-control" id="alumnoaImplicado" name="nombre" value="{{usuario.NOMBRE}}">
		</div>
		
		<div class="form-group col-md-3">
			<label for="alumnoaImplicado">Perfil</label>
			<select class="form-control" id="hora" value="rol">
				{% for p in perfiles %}
				  <option>p</option>
				 {% endfor %}
				 </select>

		</div>	
		<div class="form-group col-md-12">
			                                <label for="alumnoaImplicado">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="{{usuario.EMAIL}}">
		</div>	
		<div class="form-group col-md-6">
			                                <label for="alumnoaImplicado">Contraseña</label>
			<input type="password" class="form-control" id="clave" name="clave" value="{{usuario.CLAVE}}">
		</div>
		<div class="form-group col-md-6">
			                                <label for="alumnoaImplicado">Repetir Contraseña</label>
			<input type="password" class="form-control" id="clave2" name="clave2" value="{{usuario.CLAVE}}">
		</div>	
	
		                                
		                                <div class="form-group col-md-12">
			                                <label for="comentario">Observaciones:</label>
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="comentario" name="descripcion" >{{usuario.OBSERVACIONES}}</textarea>
		</div>
										
		<div class="form-group col-md-9"></div>			

 	    <div class="form-group col-md-3">	
			<button type="submit" class="btn btn-success">Aceptar</button>	
			<a href="/alumnos/anotaciones/cancelar" class="btn btn-danger">Cancelar</a>				
		</div>
									
 				
</form>	


<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

{% endblock cuerpo %}

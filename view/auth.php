{% extends "layout.php" %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

<div class="jumbotron">
	<h1>Acceso servicios Google</h1>
	<p class="lead">Se necesita su autorización para acceder a su cuenta de Google</p>
</div>

<form method="post" action="/auth/aceptar" role="form">
		
		<div class="form-group col-md-12">
		  Para poder enviar notificaciones/avisos por correo electrónico y generar informes en Google Drive se requiere su consentimiento previo. <br><br>Visite la siguiente url para obtener la <a href="{{url}}" target="_blank">autorización de acceso</a>
		</div>
		
		<!--
		<div class="form-group col-md-12">
			<label for="nombre">Código de comprobación:</label>
			<input type="text" class="form-control" id="codigo" name="codigo" value="">
		</div>
		
		<div class="form-group col-md-10"></div>
		<div class="form-group col-md-1">
			<button type="submit" class="btn btn-success">Aceptar</button><a href="/auth/aceptar"></a>
		</div>
        <div class="form-group col-md-1">
			<a type="button" class="btn btn-danger" href="/auth/cancelar">Cancelar</a>
		</div>
		-->

</form>

{% endblock cuerpo %}


{% extends "layoutlogin.php" %}

{% block tabActivo %}contacto{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}

 <div id="header" class="row-fluid">

            
            <div class="col-sm-3">
			</div>
			
            <div class="col-sm-2">
				<img src="/img/logo.png">
			</div>
			
			<div class="col-sm-4">
				
			

				
												<form method="post" action="/login" role="form">
										
										<input type="hidden" name="id" value="{{comentario.ID}}"/>
										
										<div class="form-group">
											<label for="nombre">Usuario:</label>
											<input type="text" class="form-control" id="nombre" name="nombre" value="{{comentario.NOMBRE}}">
										</div>
										
											<div class="form-group">
											<label for="email">Contraseña:</label>
											<input type="text" class="form-control" id="email" name="email" value="{{comentario.EMAIL}}">
										</div>
										
										
										
										<button type="submit" class="btn btn-default">Enviar</button>
								</form>
				
			</div>
</div>				
	
{% endblock cuerpo %}


{% extends "layoutlogin.php" %}

{% block cuerpo %}

 <div id="header" class="row-fluid">
            <div class="col-md-12 col-md-offset-5">
  		        <a href="/"><img src="/img/logo.png"></a>
			</div>
			
			<form method="post" action="/usuario/recuperar" role="form"  class="col-md-12">
				
				<div class="col-md-12 text-center">
					La url proporcionada (<em>{{uri}}</em>) <b>no</b> está <b>firmada</b> con un código "hash"
				</div>
									
				<div class="col-md-12">
					<p></p>
				</div>				

				<div class="col-md-12">
					<a href="/" class="btn btn-info btn-lg btn-block">Seguir trabajando</a>
				</div>				

			</form>
					
</div>

{% endblock cuerpo %}

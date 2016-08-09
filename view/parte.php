{% extends "layout.php" %}

{% block tabActivo %}crear{% endblock tabActivo %}

{% block cuerpo %}

<div class="jumbotron">
	<h1>Parte de incidencias</h1>
	<p class="lead">Registre el problema</p>
</div>

<form method="post" action="/partes/guardar" role="form">
		
		<input type="hidden" name="id" value="">
		<input type="hidden" id="id_alumno" name="id_alumno" value="">
		
		<div class="form-group col-md-8">
			<label for="alumnoaImplicado">Alumno/a implicado</label>
			<input type="text" class="form-control" id="alumnoaImplicado" name="alumnoaImplicado" value="">
		</div>
		
		<div class="form-group col-md-2 ">
			<label for="fecha">Fecha:</label>
			<div class="input-group date">
					<input type="text" id="fecha" name="fecha" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		
		<div class="form-group col-md-2">
			<label for="hora">Hora:</label>
			 <select class="form-control" id="sel1">
              <option>Primera</option>
               <option>Segunda</option>
               <option>Tercera</option>
               <option>Recreo</option>
               <option>Cuarta</option>
               <option>Quinta</option>
               <option>Sexta</option>
             </select>
		</div>

		<div class="form-group col-md-8">
			<label for="cursoygrupo">Tutor/a:</label>
			<input type="text" class="form-control" id="tutor" name="tutor" value="">
		</div>

		<div class="form-group col-md-4">
			<label for="cursoygrupo">Curso y Grupo</label>
			<input type="text" class="form-control" id="cursoygrupo" name="cursoygrupo" value="" readonly="readonly">
		</div>
		
		<div class="form-group col-md-6">
			<label for="alumnoaImplicado">Profesor/a:</label>
			<input type="text" class="form-control" id="profesor" name="profesor" value="{{login.getUsuario().getNombre()}}" readonly="readonly">
		</div>
		
		<div class="form-group col-md-6">
			<label for="asignatura">Asignatura:</label>
			<input type="text" class="form-control" id="asignatura" name="asignatura" value="">
		</div>
		
		<div class="form-group col-md-12">
			<label for="observaciones">Observaciones:</label>
			<head>
  
			<textarea style="width:100%" rows="8" cols="50" class="form-control" id="observacion" name="observacion"></textarea>
		</div>
			
		<div>
			<h1>Conductas contrarias a las normas de convivencia (Leves) </h1>
		</div>

        <div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Perturbar el desarrollo de las clases</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Dificultar el estudio de los compañeros</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Faltar a clase injustificadamente</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Deteriorar instalaciones, documentos o pertenencias</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Utilizar el teléfono móvil en clase</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Usar gorras, gafas de sol o reprod. de música en clase</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Usar el ordenador indebidamente</label>
		</div>
		  
		
	<div>
		<h1>Conductas gravemente perjudiciales para la convivencia (Graves) </h1>
	</div>

        <div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Agresión física</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Incumplimiento de correcciones impuestas</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Amenazas o coacciones</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Suplantación personalidad, falsificación o sustracción</label>
		</div>
		<div class="form-group col-md-12">
			<label><input type="checkbox" value=""> Fumar en clase</label>
		</div>
		
		<div class="row">
             
             <div class="col-md-8">
 			</div>
 			
 			
 			<div class="col-md-4">
 		<button type="submit" class="btn btn-danger">Cancelar</button>
 		<button type="submit" class="btn btn-primary">Guardar</button>
 		<button type="submit" class="btn btn-success">Aceptar</button>
            
            </div>
          </div>
         </form>
		
		<script type="text/javascript">
			
 		$(document).ready(function(){
			$('.input-group.date').datepicker({
				format: "dd/mm/yyyy",
				weekStart: 1,
				todayBtn: "linked",
				language: "es",
				daysOfWeekDisabled: "0,6",
				autoclose: true
			});
 			$( "#alumnoaImplicado" ).autocomplete({
			  source: "/alumnos/buscar/nombre",
			  minLength: 3,
			  select: function (event,ui){
				$.ajax({
					url:'/alumnos/buscar/id',
					  type:'POST',
					  dataType:'json',
					  data:{ valor:ui.item.id}
				  }).done(function(respuesta){
					  
					  //$("#alumnoaImplicado").val(respuesta.nombre);
					  $("#id_alumno").val(respuesta.id);
					  $("#cursoygrupo").val(respuesta.grupo);
					  $("#tutor").val(respuesta.tutor);
				  });  
			  }
			});
 			
 		});
 		
 		
 	</script>
		
</form>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea',menubar: false });</script>
{% endblock cuerpo %}

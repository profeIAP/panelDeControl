{% extends "layout.php" %}

{% block tabActivo %}crear{% endblock tabActivo %}

{% block cuerpo %}

<div class="jumbotron">
	<h1>Parte de incidencias</h1>
	<p class="lead hidden-print">Registre el problema</p>
</div>

<form method="post" action="/partes/guardar" role="form">
		
		<input type="hidden" name="ID" value="">
		<input type="hidden" id="id_alumno" name="id_alumno" value="">

		<div class="row">
			<div class="form-group col-md-8">
				<label for="alumnoaImplicado">Alumno/a implicado <span style="color:red">*</span></label>
				<input type="text" class="form-control" id="alumnoaImplicado" required>
			</div>
			
			<div class="form-group col-md-2 ">
				<label for="fecha">Fecha:</label>
				<div class="input-group date">
						<input type="text" id="fecha" name="fecha" class="form-control" value="{{fecha}}"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
			</div>
			
			<div class="form-group col-md-2">
				<label for="hora">Hora:</label>
				 <select class="form-control" id="hora" name="hora">
				  <option>Primera</option>
				   <option>Segunda</option>
				   <option>Tercera</option>
				   <option>Recreo</option>
				   <option>Cuarta</option>
				   <option>Quinta</option>
				   <option>Sexta</option>
				 </select>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-8">
				<label for="tutor">Tutor/a:</label>
				<input type="text" class="form-control" id="tutor" name="tutor" value readonly="readonly" >

			</div>

			<div class="form-group col-md-4">
				<label for="cursoygrupo">Curso y Grupo</label>
				<input type="text" class="form-control" id="cursoygrupo" name="grupo" value="" readonly="readonly">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="alumnoaImplicado">Profesor/a:</label>
				<input type="text" class="form-control" id="profesor" name="profesor" value="{{login.getUsuario().getNombre()}}" readonly="readonly">
			</div>

			<div class="form-group col-md-6">
				<label for="asignatura">Asignatura:</label>
				<input type="text" class="form-control" id="asignatura" name="asignatura" value readonly="readonly">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label for="observaciones">Observaciones:</label>
				<head>
	  
				<textarea style="width:100%" rows="8" cols="50" class="form-control" id="observacion" name="observacion"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="form-group col-md-12">
					<h1>Conductas contrarias a las normas de convivencia (Leves) </h1>
				</div>
				<div class="form-group col-md-6">
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_PERTURBAR" value=""> Perturbar el desarrollo de las clases</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_DIFICULTAR"> Dificultar el estudio de los compañeros</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_FALTARINJUSTIFICADAMENTE" value=""> Faltar a clase injustificadamente</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_DETERIORAR" value=""> Deteriorar instalaciones, documentos o pertenencias</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_FALTAMATERIAL" value=""> No traer o no utilizar el material necesario</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_ORDENADOR" value=""> Utilizar ordenadores sin permiso</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_ALTERAR" value=""> Alterar el orden y limp. en zonas comunes</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_USOINDEBIDO" value=""> Utilizar indebidamente material en aulas especificas</label>
					
					</div>
				</div>
				<div class="form-group col-md-6">
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_MOVIL" value="1"> Utilizar el teléfono móvil en clase</label>
					</div>
					<div class="form-group col-md-12">
<<<<<<< HEAD
						<label><input type="checkbox" name="L_GORRA" value="1"> Usar gorras, gafas de sol o reprod. de música en clase</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_ORDENADOR" value="1"> Usar el ordenador indebidamente</label>
						</div>
=======
						<label><input type="checkbox" name="L_DESCONSIDERABLES" value="1"> Ser desconsiderados con profesores, compañeros...</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_BEBEROCOMER" value="1"> Comer o beber en clase</label>
					</div>
>>>>>>> d594ec677925a203245bdb4e5432c8dfe234e2db
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_PASILLOS" value=""> Permanecer en los pasillos en los recreos</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_FALTARINJUSTIFICADAMENTE" value=""> Faltar injustificadamente a clase antes de un examen</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_NOCOLABORAR" value="1"> No colaborar de forma sistematica</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_IMPUNTUAL" value="1"> Ser inpuntual sin justificacion</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_DESCONSIDERADO" value="1"> Ser desconsiderado con el profesor,compañeros...</label>
							</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" name="L_BEBEROCOMER" value=""> Comer o beber en clase</label>
					</div>
				</div> 
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="form-group col-md-12">
					<h1>Conductas gravemente perjudiciales para la convivencia (Graves)</h1>
				</div>
				<div class="form-group col-md-6">
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="1" name="G_AGRESION"> Agresión física</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="1" name="G_INCUMPLIMIENTO"> Incumplimiento de correcciones impuestas</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="1" name="G_AMENAZAS"> Amenazas o coacciones</label>
				    </div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="1" name="G_SUPLANTACION"> Suplantación personalidad, falsificación o sustracción</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="1" name="G_FUMAR"> Fumar en el recinto o en cualquier actividad docente</label>
					</div>
				</div>
				<div class="form-group col-md-6">
					
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="1" name="G_SUPLANTACION"> Suplantación personalidad, falsificación o sustracción</label>
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="G_FUMAR"> Fumar en clase</label>
						</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="G_INCUMPLIMIENTO"> Salir del centro sin autorizacion</label>
							</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="G_DETERIORO"> Deterioro grave inst., docu o pertenencias</label>
								</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="G_IMPEDIMENTO"> Impedimento del desarrollo de actividades</label
					</div>
					<div class="form-group col-md-12">
						<label><input type="checkbox" value="G_IMPEDIMENTO"> Injurias,ofensas,vejaciones y humillaciones</label
					</div>
					
					
				</div>
			</div>
		</div>
			
		
	

        
		
		
		<div class="row hidden-print">
             
             <div class="col-md-8">
 			</div>
 			
 			
 			<div class="col-md-4">
		
				<button type="submit" class="btn btn-primary" name="borrador" value="1">Guardar</button>
				<button type="submit" class="btn btn-success" name="borrador" value="0">Aceptar</button>
				<a class="btn btn-danger" href="/partes/cancelar">Cancelar</a>
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
				orientation: "auto",
				autoclose: true,
				container: '.input-group' 
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
					  $("#id_alumno").val(respuesta.ID);
					  $("#cursoygrupo").val(respuesta.CURSO);
					  $("#tutor").val(respuesta.TUTOR);
                       if (respuesta.TUTOR == null || respuesta.TUTOR === 0)
						$("a").removeAttr("readonly");
				  });}});

function buscarAsignatura(){				    
				    $.post("/partes/buscar/asignatura",
  {

    FECHA: "06/05/2019",
    HORA: "Segunda",
    GRUPO: "2º ESO B"
  },
  function(data, status){
    alert("Data: " + data + "\nStatus: " + status);
  } );
			  }
 		
 		
 	</script>
		
</form>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea',menubar: false });</script>
{% endblock cuerpo %}

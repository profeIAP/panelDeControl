{% extends "layout.php" %}

{% block tabActivo %}crear{% endblock tabActivo %}

{% block cuerpo %}

<h1></h1>
	<form novalidate="true" class="jotform-form" action="/guardarParte" method="post" name="form_60212753776356" id="60212753776356" accept-charset="utf-8">
  <input name="formID" value="60212753776356" type="hidden">
  <div class="form-all">
    <ul class="form-section page-section">
      <li id="cid_1" class="form-input-wide" data-type="control_head">
        <div class="form-header-group">
          <div class="header-text">
            <h1 id="header_1" class="form-header">
              PARTE DE INCIDENCIAS
            </h1>
          </div>
        </div>
      </li>
      <li id="cid_3" class="form-input-wide" data-type="control_head">
        <div class="form-header-group">
          <div class="header-text">
            <h2 id="header_3" class="form-header">
              +Datos del alumno:
            </h2>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_textbox" id="id_4">
        <label class="form-label form-label-left form-label-auto" id="label_4" for="input_4"> Alumno/a implicado: </label>
        <div id="cid_4" class="form-input jf-required">
          <input class=" form-textbox" data-type="input-textbox" id="input_4" name="alumnoaImplicado" size="20" value="" type="text">
        </div>
      </li>
      <li class="form-line" data-type="control_textbox" id="id_5">
        <label class="form-label form-label-left form-label-auto" id="label_5" for="input_5"> Curso y Grupo: </label>
        <div id="cid_5" class="form-input jf-required">
          <input class=" form-textbox" data-type="input-textbox" id="input_5" name="cursoygrupo" size="20" value="" type="text">
        </div>
      </li>
      <li class="form-line" data-type="control_textbox" id="id_6">
        <label class="form-label form-label-left form-label-auto" id="label_6" for="input_6"> Fecha: </label>
        <div id="cid_6" class="form-input jf-required">
          <input class=" form-textbox" data-type="input-textbox" id="input_6" name="fecha6" size="20" value="" type="text">
        </div>
      </li>
      <li class="form-line" data-type="control_textbox" id="id_7">
        <label class="form-label form-label-left form-label-auto" id="label_7" for="input_7"> Hora: </label>
        <div id="cid_7" class="form-input jf-required">
          <input class=" form-textbox" data-type="input-textbox" id="input_7" name="hora" size="20" value="" type="text">
        </div>
      </li>
      <li class="form-line" data-type="control_textbox" id="id_8">
        <label class="form-label form-label-left form-label-auto" id="label_8" for="input_8"> Asignatura: </label>
        <div id="cid_8" class="form-input jf-required">
          <input class=" form-textbox" data-type="input-textbox" id="input_8" name="asignatura" size="20" value="" type="text">
        </div>
      </li>
      
      <!--
      
      <li class="form-line" data-type="control_textbox" id="id_9">
        <label class="form-label form-label-left form-label-auto" id="label_9" for="input_9"> Profesor/a: </label>
        <div id="cid_9" class="form-input jf-required">
          <input class=" form-textbox" data-type="input-textbox" id="input_9" name="q9_profesora" size="20" value="" type="text">
        </div>
      </li>
      <li class="form-line" data-type="control_textbox" id="id_10">
        <label class="form-label form-label-left form-label-auto" id="label_10" for="input_10"> Tutor/a: </label>
        <div id="cid_10" class="form-input jf-required">
          <input class=" form-textbox" data-type="input-textbox" id="input_10" name="q10_tutora" size="20" value="" type="text">
        </div>
      </li>
      <li class="form-line" data-type="control_checkbox" id="id_12">
        <label class="form-label form-label-left form-label-auto" id="label_12" for="input_12"> +INCIDENCIAS LEVES: </label>
        <div id="cid_12" class="form-input jf-required">
          <div class="form-single-column">
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_0" name="q12_incidenciasLeves[]" value="Perturbar el desarrollo de la clase" type="checkbox">
              <label id="label_input_12_0" for="input_12_0"> Perturbar el desarrollo de la clase </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_1" name="q12_incidenciasLeves[]" value="Dificultar el estudio de los compañeros" type="checkbox">
              <label id="label_input_12_1" for="input_12_1"> Dificultar el estudio de los compañeros </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_2" name="q12_incidenciasLeves[]" value="Faltar a clase injustificadamente" type="checkbox">
              <label id="label_input_12_2" for="input_12_2"> Faltar a clase injustificadamente </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_3" name="q12_incidenciasLeves[]" value="Deteriorar instalaciones,documentos o pertenencias" type="checkbox">
              <label id="label_input_12_3" for="input_12_3"> Deteriorar instalaciones,documentos o pertenencias </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_4" name="q12_incidenciasLeves[]" value="Utilizar teléfono móvil en clase" type="checkbox">
              <label id="label_input_12_4" for="input_12_4"> Utilizar teléfono móvil en clase </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_5" name="q12_incidenciasLeves[]" value="Utilizar gorras,gafas de sol o reproductores de musica en clase" type="checkbox">
              <label id="label_input_12_5" for="input_12_5"> Utilizar gorras,gafas de sol o reproductores de musica en clase </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_6" name="q12_incidenciasLeves[]" value="Usar el ordenador indevidamente" type="checkbox">
              <label id="label_input_12_6" for="input_12_6"> Usar el ordenador indevidamente </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_7" name="q12_incidenciasLeves[]" value="Faltar injustificadamente a clase antes de un examen" type="checkbox">
              <label id="label_input_12_7" for="input_12_7"> Faltar injustificadamente a clase antes de un examen </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_8" name="q12_incidenciasLeves[]" value="No colaborar de forma sistemática" type="checkbox">
              <label id="label_input_12_8" for="input_12_8"> No colaborar de forma sistemática </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_9" name="q12_incidenciasLeves[]" value="Ser impuntual sin justificación" type="checkbox">
              <label id="label_input_12_9" for="input_12_9"> Ser impuntual sin justificación </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_10" name="q12_incidenciasLeves[]" value="Tener una falta de respeto hacia compañeros o/y profesores/as" type="checkbox">
              <label id="label_input_12_10" for="input_12_10"> Tener una falta de respeto hacia compañeros o/y profesores/as </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_11" name="q12_incidenciasLeves[]" value="Comer o beber en clase" type="checkbox">
              <label id="label_input_12_11" for="input_12_11"> Comer o beber en clase </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_12" name="q12_incidenciasLeves[]" value="No traer o no utilizar el material necesario" type="checkbox">
              <label id="label_input_12_12" for="input_12_12"> No traer o no utilizar el material necesario </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_13" name="q12_incidenciasLeves[]" value="Usar el ordenador sin permiso" type="checkbox">
              <label id="label_input_12_13" for="input_12_13"> Usar el ordenador sin permiso </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_14" name="q12_incidenciasLeves[]" value="Alterar el orden y/o limpieza en zonas comunes" type="checkbox">
              <label id="label_input_12_14" for="input_12_14"> Alterar el orden y/o limpieza en zonas comunes </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_15" name="q12_incidenciasLeves[]" value="Fumar en el recinto escolar" type="checkbox">
              <label id="label_input_12_15" for="input_12_15"> Fumar en el recinto escolar </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_12_16" name="q12_incidenciasLeves[]" value="Usar indevidamente el material de aulas específicas" type="checkbox">
              <label id="label_input_12_16" for="input_12_16"> Usar indevidamente el material de aulas específicas </label>
            </span>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_checkbox" id="id_13">
        <label class="form-label form-label-left form-label-auto" id="label_13" for="input_13"> +INCIDENCIAS GRAVES: </label>
        <div id="cid_13" class="form-input jf-required">
          <div class="form-single-column">
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_0" name="q13_incidenciasGraves13[]" value="Agresión física" type="checkbox">
              <label id="label_input_13_0" for="input_13_0"> Agresión física </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_1" name="q13_incidenciasGraves13[]" value="Incumplimiento de correcciones impuestas" type="checkbox">
              <label id="label_input_13_1" for="input_13_1"> Incumplimiento de correcciones impuestas </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_2" name="q13_incidenciasGraves13[]" value="Amenazas o coacciones" type="checkbox">
              <label id="label_input_13_2" for="input_13_2"> Amenazas o coacciones </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_3" name="q13_incidenciasGraves13[]" value="Suplantación de personalidad o falsificaciones" type="checkbox">
              <label id="label_input_13_3" for="input_13_3"> Suplantación de personalidad o falsificaciones </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_4" name="q13_incidenciasGraves13[]" value="Fumar en clase" type="checkbox">
              <label id="label_input_13_4" for="input_13_4"> Fumar en clase </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_5" name="q13_incidenciasGraves13[]" value="Injurias y ofensas" type="checkbox">
              <label id="label_input_13_5" for="input_13_5"> Injurias y ofensas </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_6" name="q13_incidenciasGraves13[]" value="Vejaciones y humillaciones" type="checkbox">
              <label id="label_input_13_6" for="input_13_6"> Vejaciones y humillaciones </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_7" name="q13_incidenciasGraves13[]" value="Deterioro grave de instrumentos,documentos o pertenencias" type="checkbox">
              <label id="label_input_13_7" for="input_13_7"> Deterioro grave de instrumentos,documentos o pertenencias </label>
            </span>
            <span class="form-checkbox-item" style="clear:left;">
              <span class="dragger-item">
              </span>
              <input class="form-checkbox" id="input_13_8" name="q13_incidenciasGraves13[]" value="Impedimento del desarrollo de actividades" type="checkbox">
              <label id="label_input_13_8" for="input_13_8"> Impedimento del desarrollo de actividades </label>
            </span>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_textarea" id="id_14">
        <label class="form-label form-label-left form-label-auto" id="label_14" for="input_14"> +OBSERVACIONES: </label>
        <div id="cid_14" class="form-input jf-required">
          <textarea id="input_14" class="form-textarea" name="q14_observaciones14" cols="40" rows="6"></textarea>
        </div>
      </li>
      <li style="display:none">
        Should be Empty:
        <input name="website" value="" type="text">
      </li>
    </ul>
  </div>
  -->
  <input id="simple_spc" name="simple_spc" value="60212753776356-60212753776356" type="hidden">
  <script type="text/javascript">
  document.getElementById("si" + "mple" + "_spc").value = "60212753776356-60212753776356";
  </script>
<input value="true" name="preview" type="hidden"><input value="1453467120107_60212753776356_4HerYND" name="event_id" type="hidden">
<button type="submit" class="btn btn-default">Enviar</button>

</form>
{% endblock cuerpo %}

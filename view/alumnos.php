{% extends "layout.php" %}

{% block tabActivo %}comentarios{% endblock tabActivo %}

{% block cuerpo %}

{% if message %}
	<div class="alert alert-success" role="alert"> {{ message|raw}}</div>
{% endif %}

{% if error %}
	<div class="alert alert-error" role="alert"> {{ error|raw}}</div>
{% endif %}


<div class="jumbotron">
	<h1>Lista de alumno</h1>
	<p class="lead">Alumnos matriculados en el centro</p>
</div>

<table id="myTable">  
        <thead>  
          <tr>  
            <th>Nº Alumno</th>  
            <th>Nombre</th>  
            <th>Email</th>  
            <th>Dirección </th> 
          </tr>  
        </thead>  
        <tbody>  
          <tr>  
            <td>01</td>  
            <td>Juan</td>  
            <td>juan@hotmail.com</td>  
            <td>Juan 23 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>
            
          </tr>  
          <tr>  
            <td>02</td>  
            <td>Antonio</td>  
            <td>Antonio@hotmail.com</td>  
            <td>Antonio 23 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>
            
          </tr>  
          <tr>  
            <td>03</td>  
            <td>Rafael</td>  
            <td>rafael@hotmail.com</td>  
            <td>rafael 23 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>
         
          </tr>  
           <tr>  
           <td>04</td>  
            <td>Rigoberta</td>  
            <td>rigorbeta@hotmail.com</td>  
            <td>Rigoberta 23 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>
          
          </tr>  
          <tr>  
            <td>05</td>  
            <td>Julio</td>  
            <td>julio@hotmail.com</td>  
            <td>Julio 23 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          <tr>  
            <td>06</td>  
            <td>Franciso</td>  
            <td>Francisco@hotmail.com</td>  
            <td>Atocha 12 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          
           <tr>  
            <td>07</td>  
            <td>Carlos</td>  
            <td>carlos@hotmail.com</td>  
            <td>Carlos 12 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          <tr>  
            <td>08</td>  
            <td>Miguel Angel</td>  
            <td>miguelangel@hotmail.com</td>  
            <td>Miguel Angel 12 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          <tr>  
            <td>09</td>  
            <td>Barbu</td>  
            <td>barbu@hotmail.com</td>  
            <td>Barbu 12 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          
            <tr>  
            <td>10</td>  
            <td>Stephen</td>  
            <td>Sthepen@hotmail.com</td>  
            <td>Sthepen 15 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          <tr>  
            <td>11</td>  
            <td>Sara</td>  
            <td>Sara@hotmail.com</td>  
            <td>Sara 12 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          <tr>  
            <td>12</td>  
            <td>Patri</td>  
            <td>patri@hotmail.com</td>  
            <td>Patri 12<a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
           <tr>  
            <td>13</td>  
            <td>El Cid Empalador</td>  
            <td>empalador@hotmail.com</td>  
            <td>Don Quijote De la Mancha <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          <tr>  
            <td>14</td>  
            <td>Angel</td>  
            <td>angel@hotmail.com</td>  
            <td>Feo 1 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
            <tr>  
            <td>15</td>  
            <td>Teresa</td>  
            <td>teresa@hotmail.com</td>  
            <td>Tere 25 <a href="/notificaciones/borrar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/trash_can1.png"></a>
		<a href="/notificaciones/editar?id={{notificacion.ID}}"><img width="32px" src="http://findicons.com/files/icons/2226/matte_basic/32/document_edit.png"></a><br>
		</td>  
          </tr>  
          </tr>  
        </tbody>  
      </table>  
     

{% endblock cuerpo %}


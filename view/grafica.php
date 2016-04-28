{% extends "layout.php" %}

{% block tabActivo %}about{% endblock tabActivo %}

{% block cuerpo %}

<html>
<head>
  <title>Tabla de partes dividida por género</title>
</head>

<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script>
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(dibujarGrafico);
   function dibujarGrafico() {
     // Tabla de datos: valores y etiquetas de la gráfica
     var data = google.visualization.arrayToDataTable([
       ['Texto', 'Valor numérico'],
       ['Chicos', 49.21],
       ['Chicas', 48.28],
      
     ]);
     var options = {
       title: 'Tabla de partes dividida por género'
     }
     // Dibujar el gráfico
     new google.visualization.ColumnChart( 
     //ColumnChart sería el tipo de gráfico a dibujar
       document.getElementById('GraficoGoogleChart-ejemplo-1')
     ).draw(data, options);
   }
 </script> 
<body>
Partes
<div id="GraficoGoogleChart-ejemplo-1" style="width: 800px; height: 600px">
</div>
</body>
</html>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Partes por género'],
          ['Chicos',     46],
          ['Chicas',      47],
          
        ]);

        var options = {
          title: 'Partes por género'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>

{% endblock cuerpo %}


<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">	
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
	
    {% block cabecera %}
			
			
			<!--
			
			
			
			<link href="/css/bootstrap-combined.min.css" rel="stylesheet">
			<link href="/css/bootstrap-theme.min.css" rel="stylesheet">
			<link href="/css/jumbotron-narrow.css" rel="stylesheet">		-->
			
	{% endblock %}
		
    <title>Control de Partes</title>

    <!-- ===========================
    FONTS & ICONS
    =========================== -->
    <link href='//fonts.googleapis.com/css?family=Kristi|Alegreya+Sans:300' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/css/menulateral.css" rel="stylesheet" type="text/css">

    <!--[if IE]>
        <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container" style="width:97%">
        <!-- ===========================
        HEADER
        ============================ -->
        <div id="header" class="row">
            <div class="col-sm-2">
                <a href="/"><img class="propic" src="/img/logo.png" alt=""></a>
            </div>
            <!-- photo end-->

            <div class="col-sm-10">
                <div class="cv-title">
                    <div class="row">
                        <div class="col-sm-7">
                            <h1>Control de Partes</h1>
                        </div>
                        <div class="col-sm-5 text-right dl-share">
                            
                        </div>
                    </div>
                    <h2 style="margin-top: 0px; padding-left: 5px;">IES Al-Ándalus</h2>
                </div><!-- Title end-->

                <!-- ===========================
                SOCIAL & CONTACT
                ============================ -->
                
                <!--
				    <li id="notificaciones"><a href="/notificaciones">Notificaciones</a></li>
				    
                -->
                <div class="row">
                    <div class="col-sm-8">
                        <ul class="list-unstyled">
                        </ul>
                    </div><!-- social 1st col end-->
					<div class="col-sm-2">
						
                        <ul class="list-unstyled">
                            <li><a href="/about"><span class="social fa"></span>Acerca de</a></li>
                        </ul>
                    </div><!-- social 2nd col end-->
                    <div class="col-sm-2">
                        <ul class="list-unstyled">
                            <li><a href="/"><span class="social fa fa-home"></span>Inicio</a></li>
                        </ul>
                    </div><!-- social 2nd col end-->
                    
                    
                    
                    <!-- social 3rd col end-->
                </div><!-- header social end-->
            </div><!-- header right end-->
        </div><!-- header end-->

        <hr class="firsthr">

        <!-- ===========================
        BODY LEFT PART
        ============================ -->
        <div class="col-md-9 mainleft">
            <div id="statement" class="row mobmid" style="margin left:40px">
                
                <div class="col-sm-12">
                    <!--<h3>Inicio </h3>
                    <p>Bienvenidos a la página principal de Control de Partes</p>-->
                    {% block cuerpo %} {% endblock %}
                    <script>
						$(document).ready(function(){
							$('#myTable').dataTable();
						});
					</script>
                </div><!--info end-->
            </div><!--personal statement end-->

        </div><!--left end-->
        
        <!-- ===========================
        SIDEBAR
        =========================== -->
        <div class="col-md-3 mainright">
            <div class="row">
                <div class="col-sm-1 col-md-2 mobmid">
                    <span class="secicon fa fa-briefcase"></span>
                </div><!--icon end-->

                <div class="col-sm-11 col-md-10 ">
                    <h3 class="mobmid">MENÚ</h3>

                   <li id="grafica"><a href="/grafica">Grafica Alumnos</a></li>
                   
<ul id="accordion" class="accordion">
  <li>
    <div class="link"></i>Alumnos<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
						<li><a href="/alumnos/crear">Crear</a></li>
						<li><a href="/alumnos">Listar</a></li>
						<li><a href="/alumnos/importar">Importar</a></li>
					</ul>
  </li>
 
  <li>
    <div class="link"></i>Anotaciones<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><a href="/alumnos/anotaciones/crear">Crear</a></li>
		</ul>
		</li>
  
  <li>
    <div class="link"></i>Notificaciones<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><a href="/notificaciones">Listar</a></li>
    </ul>
  </li>
  <li>
    <div class="link"></i>Partes<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><a href="/partes/crear">Crear</a></li>
						<li><a href="/partes">Listar</a></li>
    </ul>
  </li>
  <li>
    <div class="link"></i>Usuarios<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      						<li><a href="/usuarios/crear">Crear</a></li>
						<li><a href="/usuarios">Listar</a></li>
    </ul>
  </li>
  
   <li>
    <div class="link"></i>Salir<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
    </ul>
  </li>
</ul>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script>
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});
</script>
                    
                </div><!--info end-->
            </div><!--tech skills end-->
		</div><!--right end-->
    </div><!--container end-->

                </div><!--info end-->
            </div><!--tech skills end-->
		</div><!--right end-->

    
    <footer class="text-center">  ... </footer>

    <!--necessary scripts and plugins-->
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="/js/jquery.nicescroll.min.js"></script>
    <script src="/js/evenfly.js"></script>
    
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/js/calendario_dw.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
		$(".campofecha").calendarioDW();
		})
	</script>
	<script>
		$(document).ready(function(){
			$('#myTable').dataTable();
		});
	</script>
</body>

</html>

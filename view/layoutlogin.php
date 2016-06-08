<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/home/usuario/Vídeos/panelDeControl/img/favicon.ico" rel="icon" type="image/x-icon" />
    
    <link href="/img/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="/css/font-awesome.css" rel="stylesheet" type="text/css">	
    <link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link rel="stylesheet" href="/css/datatable.css">
	<link rel="stylesheet" href="/css/datatable2.css"></style>
	<link href="/css/jqueryui.css" type="text/css" rel="stylesheet"/>
    <link href="/css/calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET"> 
	<script src="/js/jquery.min.js"></script>
	
    {% block cabecera %}
			
			
		    <!--
			<link href="/css/bootstrap-combined.min.css" rel="stylesheet">
			<link href="/css/bootstrap-theme.min.css" rel="stylesheet">
			<link href="/css/jumbotron-narrow.css" rel="stylesheet">
			
   
   		-->
			
	{% endblock %}
		
    <title>Control de Partes</title>

    <!-- ===========================
    FONTS & ICONS
    =========================== -->
    <link href="/css/datatable3.css" rel='stylesheet' type='text/css'>
    <link href="/css/datatable4.css" rel="stylesheet">
    <script type="text/javascript" src="/js/jsapi.js"></script>
    <link href="/css/datatable5.css" rel="stylesheet" type="text/css">
	<link href="/css/menulateral.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/loader.js"></script>
    <!--[if IE]>
        <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

              <div class="container-fluid">


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
       
            </div><!--info end-->
                
            </div><!--tech skills end-->
		</div><!--right end-->

    


    <!--necessary scripts and plugins-->
    
    <script src="/js/bootstrap.min.js"></script>
    
    <script src="/js/jquery.nicescroll.min.js"></script>
    <script src="/js/evenfly.js"></script>
    
	<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/js/calendario_dw.js"></script>
	<script type="text/javascript" src="/js/1.10.2jquery-ui.min.js"></script>

	<script>
		$(document).ready(function(){
			$('#myTable').dataTable();
		});
	</script>
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
</body>

</html>

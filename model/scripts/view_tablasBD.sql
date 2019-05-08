
CREATE VIEW alumno as
select id, alumnoa NOMBRE, correoelectrnico EMAIL, direccin DIRECCION, telfono TELEFONO, '' COMENTARIO, localidadderesidencia LOCALIDAD,provinciaderesidencia PROVINCIA, dnipasaporteprimertutor DNI_TUTOR, unidad CURSO 
from alumnos_seneca
WHERE AODELAMATRCULA=(SELECT MAX(AODELAMATRCULA) FROM alumnos_seneca);

insert into alumnos_seneca (alumnoa, correoelectrnico, direccin , telfono , localidadderesidencia ,provinciaderesidencia , dnipasaporteprimertutor , unidad, AODELAMATRCULA)
values (
'domínguez balbuena, juana', 
'jdombal@hotmail.es', 
'c/ cualquiera, 4', 
'955444955', 
'córdoba','córdoba',
'33333333D',
'1º ESO B',
'2018');

SELECT nombre || ' (' || curso || ')' value, id FROM alumno where nombre like '%jose%'
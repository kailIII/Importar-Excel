select count(*)  from reporte_trabajo_copia;


select  sum(horas_hombre) from  reporte_trabajo_copia where ot_codigoot='REC-0196';




select  sum(horas_hombre)  from  reporte_trabajo_copia  where ot_codigoot='REC-0196';


select  *  from  reporte_trabajo_copia  where ot_codigoot='REC-0196' order  by fecha_inicio desc







insert into reporte_trabajo(fecha_inicio,hora_inicio,hora_fin,horas_trabajo,descripcion_trabajo,
horas_hombre,fecha_creacion,usuario_idusuario,nombre_usuario,area_codigoarea,nom_area,
ot_codigoot,cencos,estado)
select fecha_inicio,hora_inicio,hora_fin,horas_trabajo,descripcion_trabajo,
horas_hombre,now(),usuario_idusuario,nombre_usuario,area_codigoarea,nom_area,
ot_codigoot,cencos,estado from reporte_trabajo_copia;



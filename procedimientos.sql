Delimiter //
create or replace procedure procedure_cargues (variable_where varchar(100), offset_where int, per_page_where int)
begin
DECLARE id_factura_cargue varchar(100);
DECLARE cedula_conductor varchar(100);
DECLARE nombre_conductor varchar(100);
DECLARE apellido_conductor varchar(100);
DECLARE placa_vehiculo varchar(100);
DECLARE estado_cargue varchar(100);
DECLARE fecha_hora_cargue varchar(100);


DECLARE cursor_query cursor for 
SELECT car.id_factura_cargue, con.cedula_conductor, con.nombre_conductor, con.apellido_conductor, vehi.placa_vehiculo, est_car.estado_cargue, est_car.fecha_hora_cargue  
FROM cargues car 
join conductores_vehiculos con_vehi 
join vehiculos vehi 
join conductores con 
join estados_cargues est_car 
ON car.id_factura_cargue = est_car.id_factura_cargue 
AND con_vehi.id_conductor_vehiculo = car.id_conductor_vehiculo
AND vehi.placa_vehiculo = con_vehi.placa_vehiculo
AND con.cedula_conductor = con_vehi.cedula_conductor
WHERE car.id_factura_cargue LIKE '%variable_where%'
OR con.cedula_conductor LIKE '%variable_where%' 
OR concat(con.nombre_conductor, ' ', con.apellido_conductor) LIKE '%variable_where%'
OR vehi.placa_vehiculo LIKE '%variable_where%'
LIMIT offset_where, per_page_where;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET @fin = TRUE;
open cursor_query;
loop1:loop
fetch cursor_query into id_factura_cargue, cedula_conductor, nombre_conductor, apellido_conductor, placa_vehiculo, estado_cargue, fecha_hora_cargue;
IF @fin THEN
LEAVE loop1;
END IF;
select id_factura_cargue, cedula_conductor, nombre_conductor, apellido_conductor, placa_vehiculo, estado_cargues, fecha_hora_cargue;
end loop loop1;
close cursor_query;
end



/* cargues con rollback*/
DELIMITER //

CREATE PROCEDURE registrar_cargue_estado (id_factura_variable varchar(100), id_conductor_vehiculo_variable varchar(100), id_usuario_variable varchar(100))

BEGIN

DECLARE exit handler for sqlexception
  BEGIN
    -- ERROR
  ROLLBACK;
END;

DECLARE exit handler for sqlwarning
 BEGIN
    -- WARNING
 ROLLBACK;
END;

START TRANSACTION;
  -- ADD option 5
INSERT INTO 
cargues(id_factura_cargue, id_conductor_vehiculo, id_usuario_usuarios, fecha_hora_cargue) 
VALUES 
(id_factura_variable,id_conductor_vehiculo_variable,id_usuario_variable,now());

INSERT INTO 
estados_cargues(id_factura_cargue, estado_cargue, fecha_hora_cargue)
VALUES
(id_factura_variable, 'Registrado',id_usuario_variable, now());

COMMIT;
END
//






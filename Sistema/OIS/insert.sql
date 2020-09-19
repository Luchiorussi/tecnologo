use ois;
INSERT INTO prestamomobiliario(id,idUsuario,idAula,DescripcionPrestamo,InicioFechaPrestamo,finFechaPrestamo) VALUES
(1,1,1,'PRESTAMO CORRECTAMENTE REALIZADO','2019-09-26 07:11:11','2020-09-26 07:11:11'),
(2,1,2,'PRESTAMO CORRECTAMENTE REALIZADO','2019-09-26 07:11:11','2020-09-26 07:11:11'),
(3,1,3,'PRESTAMO CORRECTAMENTE REALIZADO','2019-09-26 07:11:11','2020-09-26 07:11:11');

INSERT INTO detalle_prestamo (id,PrestamoMobiliario_id,MobiliarioAula_id,estadoPrestamo_id,Fec_Retorno) VALUES
(1,1,6,1,'0000-00-00 00:00:00'),
(2,2,4,1,'0000-00-00 00:00:00'),
(3,3,5,1,'0000-00-00 00:00:00');

INSERT INTO detalle_prestamo (id,PrestamoMobiliario_id,MobiliarioAula_id,estadoPrestamo_id,Fec_Retorno) VALUES
(4,1,6,2,'0000-00-00 00:00:00'),
(5,2,4,2,'0000-00-00 00:00:00'),
(6,3,5,2,'0000-00-00 00:00:00');


INSERT INTO prestamomobiliario(id,idUsuario,idAula,DescripcionPrestamo,InicioFechaPrestamo,finFechaPrestamo) VALUES
(4,2,1,'PRESTAMO CORRECTAMENTE REALIZADO','2019-09-26 07:11:11','2020-09-26 07:11:11');


INSERT INTO detalle_prestamo (id,PrestamoMobiliario_id,MobiliarioAula_id,estadoPrestamo_id,Fec_Retorno) VALUES
(7,4,15,1,'0000-00-00 00:00:00');
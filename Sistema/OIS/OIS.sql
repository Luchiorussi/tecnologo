create database ois;
use ois;

CREATE TABLE aula(
id INT(11)  NOT NULL auto_increment,
NombreAula VARCHAR(60) NOT NULL,
EstadoAula INT(1) NULL,
PRIMARY KEY(id))ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE cargousuario(
id INT(11) NOT NULL AUTO_INCREMENT,
NombreCargo VARCHAR(60) NOT NULL,
NivelVisibilidad INT(1) NOT NULL,
Estado INT(1) NOT NULL,
primary key(id))ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO cargousuario (NombreCargo,NivelVisibilidad,Estado) VALUES ('Rector',1,1);
INSERT INTO cargousuario (NombreCargo,NivelVisibilidad,Estado) VALUES ('Jefe de Inventario',2,1);
INSERT INTO cargousuario (NombreCargo,NivelVisibilidad,Estado) VALUES ('Docente',3,1);
INSERT INTO cargousuario (NombreCargo,NivelVisibilidad,Estado) VALUES ('Coordinador',4,1);

CREATE TABLE estadomobiliario(
id INT(11)  NOT NULL AUTO_INCREMENT,
NombreEstadoMobiliario VARCHAR(60) NOT NULL,
PRIMARY KEY (id));

INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Dañado');
INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Dado de Baja');
INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Dado de Alta');
INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Reparación');
INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Robado');
INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Bueno');
INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Malo');
INSERT INTO estadomobiliario(NombreEstadoMobiliario) VALUES ('Regular');

CREATE TABLE media(
id INT(11)  NOT NULL auto_increment,
NombreMedia VARCHAR(255) NOT NULL,
TipoMedia VARCHAR(45) NOT NULL,
PRIMARY KEY (id))ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO media(NombreMedia,TipoMedia) VALUES ('mesa.jpg','image/jpg');

CREATE TABLE mobiliarioaula(
id INT(11) NOT NULL auto_increment,
NombreMobiliario VARCHAR(500) NOT NULL,
CodigoMobiliario CHAR(5) NULL,
idAula INT(11) NOT NULL,
VidaUtilMobiliario DATE NOT NULL,
VidaUtilMobiliarioFinal DATE NOT NULL,
idNombreEstadoMobiliario INT(11)  NOT NULL,
imagenMobiliario INT(11) DEFAULT 0 NULL,
primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE tipodocumento(
id INT(11)  NOT NULL AUTO_INCREMENT,
NombreTipoDocumento VARCHAR(60) NOT NULL,
PRIMARY KEY (id));
INSERT INTO tipodocumento (NombreTipoDocumento) VALUES ('Cedula de Ciudadania');
INSERT INTO tipodocumento (NombreTipoDocumento) VALUES ('Cedula de Extranjeria');
INSERT INTO tipodocumento (NombreTipoDocumento) VALUES ('Pasaporte');

CREATE TABLE usuario(
id INT(11)  NOT NULL auto_increment,
Nombre VARCHAR (100) NOT NULL,
Apellido VARCHAR (100) NOT NULL,
idCargoUsuario INT(11) NULL,
idTipoDocumento INT(11) NOT NULL,
NoDocumento VARCHAR(18) NOT NULL,
CorreoElectronico VARCHAR(100) NOT NULL,
ClaveUsuario VARCHAR(200) NULL,
Estado INT(1) NULL DEFAULT '0',
UltimoLogin DATETIME DEFAULT NULL,
ImagenUsuario VARCHAR(255) DEFAULT 'no_image.jpg',
primary key(id))ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO usuario (Nombre,Apellido,idCargoUsuario,idTipoDocumento,NoDocumento,CorreoElectronico,ClaveUsuario,Estado,UltimoLogin,ImagenUsuario) VALUES
('admin','admin',1,1,'0000','admin_admin@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef',1,'2019-09-26 07:11:11','pzg9wa7o1.jpg');



CREATE TABLE novedad(
id INT(11)  NOT NULL AUTO_INCREMENT,
idUsuario INT(11) NOT NULL,
idAula INT(11)  NOT NULL,
idMobiliarioaula INT(11) NOT NULL,
idEstadoMobiliario INT(11) NOT NULL,
DescripcionNovedad VARCHAR(800) NULL,
FechaIngreso date null,
PRIMARY KEY (id))ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE estadoPrestamo (
idEstadoMobiliario int(11) NOT NULL,
Descripcion varchar(50) DEFAULT NULL,
PRIMARY KEY (idEstadoMobiliario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO estadoPrestamo (idEstadoMobiliario, Descripcion) VALUES
(1, 'Pendiente'),
(2, 'Devuelto'),
(3, 'Registrado');


CREATE TABLE prestamomobiliario(
id INT(11) NOT NULL AUTO_INCREMENT,
idUsuario INT(11) NOT NULL,
idAula INT(11) NOT NULL,
DescripcionPrestamo VARCHAR(500) NULL,
InicioFechaPrestamo DATETIME NOT NULL,
finFechaPrestamo DATETIME NOT NULL,
PRIMARY KEY (id))ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

ALTER TABLE usuario ADD UNIQUE KEY NoDocumento(NoDocumento);
ALTER TABLE usuario ADD UNIQUE KEY CorreoElectronico(CorreoElectronico);

ALTER TABLE mobiliarioaula ADD KEY idAula(idAula),
ADD KEY imagenMobiliario(imagenMobiliario);

ALTER TABLE cargousuario ADD UNIQUE KEY NivelVisibilidad(NivelVisibilidad);

ALTER TABLE estadoPrestamo MODIFY idEstadoMobiliario int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
ALTER TABLE usuario ADD FOREIGN KEY (idCargoUsuario) REFERENCES cargousuario(NivelVisibilidad);
ALTER TABLE usuario ADD FOREIGN KEY (idTipoDocumento) REFERENCES tipodocumento(id);

ALTER TABLE mobiliarioaula ADD FOREIGN KEY (idAula) REFERENCES aula(id);
ALTER TABLE mobiliarioaula ADD FOREIGN KEY (idNombreEstadoMobiliario) REFERENCES estadomobiliario(id);



ALTER TABLE prestamomobiliario ADD FOREIGN KEY (idusuario) REFERENCES usuario(id);
ALTER TABLE prestamomobiliario ADD FOREIGN KEY (idAula) REFERENCES aula(id);


 
ALTER TABLE novedad ADD FOREIGN KEY(idUsuario) REFERENCES usuario(id);
ALTER TABLE novedad ADD FOREIGN KEY(idAula) REFERENCES aula(id);
ALTER TABLE novedad ADD FOREIGN KEY(idMobiliarioaula) REFERENCES mobiliarioaula(id);
ALTER TABLE novedad ADD FOREIGN KEY(idEstadoMobiliario) REFERENCES estadomobiliario(id);

create table detalle_prestamo(
id INT(11) NOT NULL,
PrestamoMobiliario_id INT(11) NOT NULL,
MobiliarioAula_id INT(11) NOT NULL,
estadoPrestamo_id INT(11) NOT NULL,
Fec_Retorno DATETIME DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE detalle_prestamo
  ADD PRIMARY KEY (id),
  ADD KEY PrestamoMobiliario_id  (PrestamoMobiliario_id),
  ADD KEY MobiliarioAula_id (MobiliarioAula_id),
  ADD KEY estadoPrestamo_id (estadoPrestamo_id);
  
  ALTER TABLE detalle_prestamo
  ADD CONSTRAINT fk_detalle_prestamo_PRESTAMO FOREIGN KEY (PrestamoMobiliario_id) REFERENCES prestamomobiliario(id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT fk_detalle_prestamo_MOBILIARIO FOREIGN KEY (MobiliarioAula_id) REFERENCES mobiliarioaula(id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT fk_detalle_prestamo_ESTADO FOREIGN KEY (estadoPrestamo_id) REFERENCES estadoPrestamo(idEstadoMobiliario) ON DELETE CASCADE ON UPDATE CASCADE;



create database ois;
use ois;
CREATE TABLE IF NOT EXISTS `ois`.`aula` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreAula` VARCHAR(60) NOT NULL,
  `EstadoAula` INT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ois`.`cargousuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreCargo` VARCHAR(60) NOT NULL,
  `Estado` INT(1) NOT NULL,
  `NivelVisibilidad` INT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ois`.`estadomobiliario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreEstadoMobiliario` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ois`.`media` (
  `idMedia` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreMedia` VARCHAR(255) NOT NULL,
  `TipoMedia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idMedia`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ois`.`mobiliarioaula` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreMobiliario` VARCHAR(60) NOT NULL,
  `CodigoMobiliario` CHAR(6) NOT NULL,
  `idAula` INT(11) NOT NULL,
  `VidaUtilMobiliario` DATE null,
  `VidaUtilMobiliarioFinal` DATE null,
  `idNombreEstadoMobiliario` INT(11) NOT NULL,
  `imagenMobiliario` varchar(255) NULL DEFAULT 'no_image.jpg',
  PRIMARY KEY (`id`),
  INDEX `fk_MobiliarioAula_EstadoMobiliario_idx` (`idNombreEstadoMobiliario` ASC),
  INDEX `fk_MobiliarioAula_Aula_idx` (`idAula` ASC),
  CONSTRAINT `fk_MobiliarioAula_Aula`
    FOREIGN KEY (`idAula`)
    REFERENCES `ois`.`aula` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MobiliarioAula_EstadoMobiliario`
    FOREIGN KEY (`idNombreEstadoMobiliario`)
    REFERENCES `ois`.`estadomobiliario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ois`.`tipodocumento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreTipoDocumento` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ois`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(100) NOT NULL,
  `Apellido` VARCHAR(100) NOT NULL,
  `idCargoUsuario` INT(11) NOT NULL,
  `idTipoDocumento` int(15) NOT NULL,
  `NoDocumento` varchar(15) NOT NULL,
  `CorreoElectronico` VARCHAR(100) NOT NULL,
  `ClaveUsuario` VARCHAR(200) NULL,
  `Estado` INT(1) NULL,
  `UltimoLogin` DATETIME NULL,
  `ImagenUsuario` VARCHAR(255) NULL DEFAULT 'no_image.jpg',
  PRIMARY KEY (`id`),
  INDEX `fk_Usuarios_CargoUsuario_idx` (`idCargoUsuario` ASC),
  INDEX `fk_Usuarios_TipoDocumento_idx` (`idTipoDocumento` ASC),
  CONSTRAINT `fk_Usuarios_CargoUsuario`
    FOREIGN KEY (`idCargoUsuario`)
    REFERENCES `ois`.`cargousuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_TipoDocumento`
    FOREIGN KEY (`idTipoDocumento`)
    REFERENCES `ois`.`tipodocumento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

 CREATE TABLE IF NOT EXISTS `ois`.`novedad` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_idUsuarios` INT(11) NOT NULL,
  `idMobiliarioAula` INT(11) NOT NULL,
  `DescripcionNovedad` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Novedades_MobiliarioAula_idx` (`idMobiliarioAula` ASC),
  INDEX `fk_Novedades_Usuarios1_idx` (`Usuarios_idUsuarios` ASC),
  CONSTRAINT `fk_Novedades_MobiliarioAula`
    FOREIGN KEY (`idMobiliarioAula`)
    REFERENCES `ois`.`mobiliarioaula` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Novedades_Usuarios1`
    FOREIGN KEY (`Usuarios_idUsuarios`)
    REFERENCES `ois`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ois`.`prestamomobiliario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `idUsuarios` INT(11) NOT NULL,
  `descripcionPrestamo` VARCHAR(200) NOT NULL,
  `InicioFechaPrestamo` DATETIME  NULL,
  `finFechaPrestamo` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_PrestamoMobiliario_Usuarios_idx` (`idUsuarios` ASC),
  CONSTRAINT `fk_PrestamoMobiliario_Usuarios`
    FOREIGN KEY (`idUsuarios`)
    REFERENCES `ois`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
CREATE TABLE IF NOT EXISTS `ois`.`reporte` (
  `PrestamoMobiliario_idPrestamoMobiliario` INT(11) NOT NULL,
  `MobiliarioAula_idMobiliarioAula` INT(11) NOT NULL,
  PRIMARY KEY (`PrestamoMobiliario_idPrestamoMobiliario`, `MobiliarioAula_idMobiliarioAula`),
  INDEX `fk_PrestamoMobiliario_has_MobiliarioAula_MobiliarioAula1_idx` (`MobiliarioAula_idMobiliarioAula` ASC),
  INDEX `fk_PrestamoMobiliario_has_MobiliarioAula_PrestamoMobiliario_idx` (`PrestamoMobiliario_idPrestamoMobiliario` ASC),
  CONSTRAINT `fk_PrestamoMobiliario_has_MobiliarioAula_MobiliarioAula1`
    FOREIGN KEY (`MobiliarioAula_idMobiliarioAula`)
    REFERENCES `ois`.`mobiliarioaula` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PrestamoMobiliario_has_MobiliarioAula_PrestamoMobiliario1`
    FOREIGN KEY (`PrestamoMobiliario_idPrestamoMobiliario`)
    REFERENCES `ois`.`prestamomobiliario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

 
  

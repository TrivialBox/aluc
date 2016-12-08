CREATE DATABASE  IF NOT EXISTS `ALUC` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ALUC`;
-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: ALUC
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_administrador_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jornada1` int(11) NOT NULL,
  `id_jornada2` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_horario_1_idx` (`id_jornada1`),
  KEY `fk_horario_2_idx` (`id_jornada2`),
  CONSTRAINT `fk_horario_1` FOREIGN KEY (`id_jornada1`) REFERENCES `jornada` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_2` FOREIGN KEY (`id_jornada2`) REFERENCES `jornada` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jornada`
--

DROP TABLE IF EXISTS `jornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jornada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hora_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `descripcion` varchar(70) DEFAULT NULL,
  `id_horario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_laboratorio_1_idx` (`id_horario`),
  CONSTRAINT `fk_laboratorio_1` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lector`
--

DROP TABLE IF EXISTS `lector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lector` (
  `mac` varchar(70) NOT NULL,
  `id_laboratorio` int(11) NOT NULL,
  `ip` varchar(55) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`mac`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  KEY `fk_lector_1_idx` (`id_laboratorio`),
  CONSTRAINT `fk_lector_1` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `moderador`
--

DROP TABLE IF EXISTS `moderador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moderador` (
  `id` varchar(10) NOT NULL,
  `id_laboratorio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_moderador_2_idx` (`id_laboratorio`),
  CONSTRAINT `fk_moderador_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_moderador_2` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `n_usuarios` int(11) NOT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `tipo_uso` enum('clases','práctica') NOT NULL,
  `codigo_secreto` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_secreto_UNIQUE` (`codigo_secreto`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reservacion`
--

DROP TABLE IF EXISTS `reservacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservacion` (
  `id_reserva` int(100) NOT NULL AUTO_INCREMENT,
  `id_laboratorio` int(11) NOT NULL,
  `id_usuario` varchar(10) NOT NULL,
  `estado` enum('reservado','procesado','cancelado','cancelado ausencia') NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `hora_activacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_reserva`,`id_laboratorio`,`id_usuario`),
  KEY `fk_new_table_1_idx` (`id_usuario`),
  KEY `fk_reservacion_1_idx` (`id_laboratorio`),
  CONSTRAINT `fk_new_table_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservacion_1` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservacion_2` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ALUC`.`reservacion_BEFORE_UPDATE` BEFORE UPDATE ON `reservacion` FOR EACH ROW
BEGIN
	
    declare Shora_inicio time;
    declare Shora_fin time;

    if OLD.estado = 'cancelado' then
		set NEW.estado = 'cancelado';
        signal sqlstate "45000" set message_text = "110000";
    end if;
    
    if OLD.estado = 'cancelado ausencia' then
		set NEW.estado = 'cancelado ausencia';
        signal sqlstate "45000" set message_text = "110000";
    end if;

    select hora_inicio into Shora_inicio 
		from view_reserva where id = new.id_reserva;
    
    select hora_inicio into  Shora_fin
		from view_reserva where id = new.id_reserva;
        
        
    if new.estado = 'procesado' then
		
        if (now() between Shora_inicio and Shora_fin) then
			update reservacion set fecha_activacion = now() where id = NEW.id_reserva;
		else
			signal sqlstate "45000" set message_text = '160000'; 
            
		end if;
    end if;
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` varchar(10) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `view_administrador`
--

DROP TABLE IF EXISTS `view_administrador`;
/*!50001 DROP VIEW IF EXISTS `view_administrador`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_administrador` AS SELECT 
 1 AS `id`,
 1 AS `nombre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_laboratorio`
--

DROP TABLE IF EXISTS `view_laboratorio`;
/*!50001 DROP VIEW IF EXISTS `view_laboratorio`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_laboratorio` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `capacidad`,
 1 AS `descripcion`,
 1 AS `j1_hora_apertura`,
 1 AS `j1_hora_cierre`,
 1 AS `j2_hora_apertura`,
 1 AS `j2_hora_cierre`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_moderador`
--

DROP TABLE IF EXISTS `view_moderador`;
/*!50001 DROP VIEW IF EXISTS `view_moderador`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_moderador` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `id_laboratorio`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_reserva`
--

DROP TABLE IF EXISTS `view_reserva`;
/*!50001 DROP VIEW IF EXISTS `view_reserva`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_reserva` AS SELECT 
 1 AS `id`,
 1 AS `id_usuario`,
 1 AS `id_laboratorio`,
 1 AS `descripcion`,
 1 AS `n_usuarios`,
 1 AS `tipo_uso`,
 1 AS `estado`,
 1 AS `fecha`,
 1 AS `hora_inicio`,
 1 AS `hora_fin`,
 1 AS `codigo_secreto`,
 1 AS `fecha_creacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'ALUC'
--

--
-- Dumping routines for database 'ALUC'
--
/*!50003 DROP PROCEDURE IF EXISTS `editar_reserva` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_reserva`(
						IN Sid int,
						IN Sid_laboratorio INT(11),
						IN Sdescripcion varchar(60),		
						IN Sn_usuarios int(11),
						IN Stipo_uso varchar(45),
						IN Sfecha DATE,
						IN Shora_inicio TIME,
						IN Shora_fin TIME)
BEGIN

	
	declare cupos int;
    declare ocupados int;
    declare valor int;
    declare tipo varchar(45);
    declare horas int;
    declare horas_peticion int;
    declare bandera int;
    declare Rn_usuarios int;
    declare Rhoras int;
    declare Rrango int;
    declare dias int;
    declare Rid_usuario varchar(10);
    declare Rhora_inicio time;
    
    
    start transaction;
    
    
	if (now() >= timestamp(Sfecha,Shora_inicio)) then
		signal sqlstate "45000" set message_text = "100000";
    end if;
    
    
    select datediff(Sfecha,curdate()) into dias;
    if (dias > 5)then
		signal sqlstate "45000" set message_text = "90000";
    end if;
    
    if (Stipo_uso != 'clases' ) then
		
		
		SELECT tipo_uso into tipo
			FROM reserva join reservacion on reserva.id = reservacion.id_reserva
			where id_laboratorio = Sid_laboratorio and estado = "reservado" 
			and TIMESTAMP(fecha,hora_fin) 
			between TIMESTAMP(Sfecha,Shora_inicio) + interval 1 minute 
			and TIMESTAMP(Sfecha,Shora_fin);
			
		if (tipo = "clases") then
			signal sqlstate "45000" set message_text = "50000";
		end if;
	end if;
    
    
    
    select id into bandera
    from laboratorio
		where id = Sid_laboratorio;
	if (bandera) then
		set bandera=bandera;
    else
		signal sqlstate "45000" set message_text = "1452";
    end if;
    
    
    
    select id into bandera
    from view_laboratorio 
		where id = Sid_laboratorio
        and (((Shora_inicio + interval 1 minute between j1_hora_apertura and j1_hora_cierre) 
		and (Shora_fin - interval 1 minute between j1_hora_apertura and j1_hora_cierre))
		or ((Shora_inicio + interval 1 minute between j2_hora_apertura and j2_hora_cierre) 
		and (Shora_fin - interval 1 minute between j2_hora_apertura and j2_hora_cierre)));
    
    if (bandera and dayname(Sfecha)= 'Sunday') then
		set bandera=bandera;
    else
		signal sqlstate "45000" set message_text = "60000";
    end if;
    
    
    select timediff(hora_fin,hora_inicio) into Rhoras
		from view_reserva 
        where id = Sid;
    
    
    select id_usuario into Rid_usuario 
		from reservacion 
        where id_reserva = Sid;
        
    select sum(timediff(hora_fin,hora_inicio))  into horas
		from reserva join reservacion on reserva.id = reservacion.id_reserva
		where id_usuario = Rid_usuario and fecha = Sfecha;
    
    set horas_peticion = timediff(Shora_fin,Shora_inicio);
    if ((horas + horas_peticion - Rhoras) > "20000") then
		signal sqlstate "45000" set message_text = "70000";
    end if;
    
    
    set valor = 0;
    set Rn_usuarios = 0;
    select id_laboratorio into bandera
		from view_reserva 
        where id = Sid;
	
    select hora_inicio into Rhora_inicio
		from reservacion 
		where id_reserva = Sid;
	if(bandera = Sid_laboratorio and Rhora_inicio = Shora_inicio)then
		select n_usuarios into Rn_usuarios
		from view_reserva 
		where id = Sid;
    end if;
    
    
    SELECT capacidad into cupos
		from laboratorio 
		where id = Sid_laboratorio;
                    
    SELECT ifnull(sum(n_usuarios),0) into ocupados
		FROM reserva join reservacion on reserva.id = reservacion.id_reserva
		where id_laboratorio = Sid_laboratorio  and estado = "reservado" and 
		TIMESTAMP(fecha,hora_inicio + interval 1 minute) 
		between TIMESTAMP(Sfecha,Shora_inicio)  
		and TIMESTAMP(Sfecha,Shora_fin);
    
    set valor = cupos - ocupados + Rn_usuarios;
    insert into prueba values(cupos,ocupados,valor,Rn_usuarios);
    if (valor > 0 and Sn_usuarios <= valor ) then
		Update ALUC.reserva  
			set n_usuarios = Sn_usuarios, descripcion = Sdescripcion,
				tipo_uso = Stipo_uso, fecha_creacion = now() where id  = Sid;
        Update ALUC.reservacion 
			set id_laboratorio = Sid_laboratorio, fecha = Sfecha, hora_inicio = Shora_inicio,
            hora_fin = Shora_fin where id_reserva = Sid;
		commit;
	else
		signal sqlstate "45000" set message_text = "80000";
	end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertar_reserva` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_reserva`(
						
						IN Sid_usuario varchar(10),
						IN Sid_laboratorio INT(11),
						IN Sdescripcion varchar(60),		
						IN Sn_usuarios int(11),
						IN Stipo_uso varchar(45),
						IN Sestado varchar(45),
						IN Sfecha DATE,
						IN Shora_inicio TIME,
						IN Shora_fin TIME,
						IN Scodigo_secreto varchar(100))
BEGIN
    
	declare cupos int;
    declare ocupados int;
    declare valor int;
    declare tipo varchar(45);
    declare horas int;
    declare horas_peticion int;
    declare bandera int;
    declare dias int;
    
    
    start transaction;
    
    if(Shora_fin <= Shora_inicio) then
		signal sqlstate "45000" set message_text = "130000";
	end if;
    
    if (timediff(Shora_fin,Shora_inicio) < 3000 and now() >= timestamp(Sfecha,Shora_inicio))then
		signal sqlstate "45000" set message_text = "100000";
    end if;
    
    select id into bandera
		from ALUC.view_reserva 
		where id_usuario = Sid_usuario and fecha =  Sfecha 
		and hora_inicio = Shora_inicio;
    
    if (bandera != '')then
		signal sqlstate "45000" set message_text = "120000";
    end if;
    
    select datediff(Sfecha,curdate()) into dias;
    if (dias > 5)then
		signal sqlstate "45000" set message_text = "90000";
    end if;
    
    
    SELECT tipo_uso into tipo
		FROM reserva join reservacion on reserva.id = reservacion.id_reserva
		where id_laboratorio = Sid_laboratorio and estado = "reservado" 
        and TIMESTAMP(fecha,hora_fin) 
		between TIMESTAMP(Sfecha,Shora_inicio) + interval 1 minute 
		and TIMESTAMP(Sfecha,Shora_fin);
        
	if (tipo = "clases") then
		signal sqlstate "45000" set message_text = "50000";
    end if;
    
    
    select id into bandera
    from view_laboratorio 
		where id = Sid_laboratorio
        and (((Shora_inicio + interval 1 minute between j1_hora_apertura and j1_hora_cierre) 
		and (Shora_fin - interval 1 minute between j1_hora_apertura and j1_hora_cierre))
		or ((Shora_inicio + interval 1 minute between j2_hora_apertura and j2_hora_cierre) 
		and (Shora_fin - interval 1 minute between j2_hora_apertura and j2_hora_cierre)));
    
    if (not bandera and dayname(Sfecha)= 'Sunday') then
		signal sqlstate "45000" set message_text = "60000";
    end if;
    
    
    select sum(timediff(hora_fin,hora_inicio))  into horas
		from reserva join reservacion on reserva.id = reservacion.id_reserva
		where id_usuario = Sid_usuario and fecha = Sfecha;
    
    set horas_peticion = timediff(Shora_fin,Shora_inicio);
    if ((horas + horas_peticion) > "20000") then
		signal sqlstate "45000" set message_text = "70000";
    end if;
    
    
    set valor = 0;
    
    SELECT capacidad into cupos
		from laboratorio 
		where id = Sid_laboratorio;
                    
    SELECT ifnull(sum(n_usuarios),0) into ocupados
		FROM reserva join reservacion on reserva.id = reservacion.id_reserva
		where id_laboratorio = Sid_laboratorio and estado = "reservado" and 
		TIMESTAMP(fecha,hora_inicio + interval 1 minute) 
		between TIMESTAMP(Sfecha,Shora_inicio) 
		and TIMESTAMP(Sfecha,Shora_fin);
    
    set valor = cupos - ocupados;
    if (valor > 0 and Sn_usuarios <= valor ) then
		INSERT INTO ALUC.reserva  
			values(NULL,Sn_usuarios,Sdescripcion,Stipo_uso,Scodigo_secreto,now());
        INSERT INTO ALUC.reservacion 
			values(NULL, Sid_laboratorio,Sid_usuario, Sestado, Sfecha, Shora_inicio, Shora_fin);
		commit;
	else
		signal sqlstate "45000" set message_text = "80000";
	end if;
    
    

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `view_administrador`
--

/*!50001 DROP VIEW IF EXISTS `view_administrador`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_administrador` AS select `usuario`.`id` AS `id`,`usuario`.`nombre` AS `nombre` from (`usuario` join `administrador` on((`usuario`.`id` = `administrador`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_laboratorio`
--

/*!50001 DROP VIEW IF EXISTS `view_laboratorio`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_laboratorio` AS select `l`.`id` AS `id`,`l`.`nombre` AS `nombre`,`l`.`capacidad` AS `capacidad`,`l`.`descripcion` AS `descripcion`,`j`.`hora_apertura` AS `j1_hora_apertura`,`j`.`hora_cierre` AS `j1_hora_cierre`,`j2`.`hora_apertura` AS `j2_hora_apertura`,`j2`.`hora_cierre` AS `j2_hora_cierre` from (((`laboratorio` `l` join `horario` `h` on((`l`.`id_horario` = `h`.`id`))) join `jornada` `j` on((`h`.`id_jornada1` = `j`.`id`))) join `jornada` `j2` on((`h`.`id_jornada2` = `j2`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_moderador`
--

/*!50001 DROP VIEW IF EXISTS `view_moderador`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_moderador` AS select `usuario`.`id` AS `id`,`usuario`.`nombre` AS `nombre`,`moderador`.`id_laboratorio` AS `id_laboratorio` from (`usuario` join `moderador` on((`usuario`.`id` = `moderador`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_reserva`
--

/*!50001 DROP VIEW IF EXISTS `view_reserva`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_reserva` AS select `reserva`.`id` AS `id`,`reservacion`.`id_usuario` AS `id_usuario`,`reservacion`.`id_laboratorio` AS `id_laboratorio`,`reserva`.`descripcion` AS `descripcion`,`reserva`.`n_usuarios` AS `n_usuarios`,`reserva`.`tipo_uso` AS `tipo_uso`,`reservacion`.`estado` AS `estado`,`reservacion`.`fecha` AS `fecha`,`reservacion`.`hora_inicio` AS `hora_inicio`,`reservacion`.`hora_fin` AS `hora_fin`,`reserva`.`codigo_secreto` AS `codigo_secreto`,`reserva`.`fecha_creacion` AS `fecha_creacion` from (`reserva` join `reservacion` on((`reserva`.`id` = `reservacion`.`id_reserva`))) order by timestamp(`reservacion`.`fecha`,`reservacion`.`hora_inicio`) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-07 17:59:43

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
  `id_jornada1` int(11) DEFAULT NULL,
  `id_jornada2` int(11) DEFAULT NULL,
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
  `hora_apertura` time DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
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
  `nombre` varchar(45) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `descripcion` varchar(70) DEFAULT NULL,
  `id_horario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_laboratorio_1_idx` (`id_horario`),
  CONSTRAINT `fk_laboratorio_1` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lector`
--

DROP TABLE IF EXISTS `lector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lector` (
  `mac` varchar(70) NOT NULL,
  `id_laboratorio` int(11) DEFAULT NULL,
  `ip` varchar(55) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mac`),
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
  `id_laboratorio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
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
  `n_usuarios` int(11) DEFAULT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `tipo_uso` varchar(45) DEFAULT NULL,
  `codigo_secreto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `estado` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  PRIMARY KEY (`id_reserva`,`id_laboratorio`,`id_usuario`),
  KEY `fk_new_table_1_idx` (`id_usuario`),
  KEY `fk_reservacion_1_idx` (`id_laboratorio`),
  CONSTRAINT `fk_new_table_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservacion_1` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservacion_2` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
 1 AS `codigo_secreto`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'ALUC'
--

--
-- Dumping routines for database 'ALUC'
--
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
    /*Variables para el desarrollo*/
	declare cupos int;
    declare ocupados int;
    declare valor int;
    
    /*declaracion de las excepsiones*/
    
    
    start transaction;
    
    SELECT capacidad into cupos
		from laboratorio 
		where id = Sid_laboratorio;
                    
    SELECT sum(n_usuarios) into ocupados
		FROM reserva join reservacion on reserva.id = reservacion.id_reserva
		where id_laboratorio = Sid_laboratorio  and estado = "Reservado" and 
		TIMESTAMP(fecha,hora_inicio) 
		between TIMESTAMP(fecha,hora_inicio) 
		and TIMESTAMP(fecha,hora_fin);
    
    set valor = cupos - ocupados;
    if (valor > 0 and Sn_usuarios <= valor) then
		INSERT INTO ALUC.reserva  
			values(NULL,Sn_usuarios,Sdescripcion,Stipo_uso,Scodigo_secreto);
        INSERT INTO ALUC.reservacion 
			values(NULL, Sid_laboratorio,Sid_usuario, Sestado, Sfecha, Shora_inicio, Shora_fin);
		commit;
	else
		signal sqlstate "45000" set message_text = "No hay cupos ";
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
/*!50001 VIEW `view_reserva` AS select `reserva`.`id` AS `id`,`reservacion`.`id_usuario` AS `id_usuario`,`reservacion`.`id_laboratorio` AS `id_laboratorio`,`reserva`.`descripcion` AS `descripcion`,`reserva`.`n_usuarios` AS `n_usuarios`,`reserva`.`tipo_uso` AS `tipo_uso`,`reservacion`.`estado` AS `estado`,`reservacion`.`fecha` AS `fecha`,`reservacion`.`hora_inicio` AS `hora_inicio`,`reservacion`.`hora_fin` AS `codigo_secreto` from (`reserva` join `reservacion`) */;
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

-- Dump completed on 2016-11-19 11:01:13

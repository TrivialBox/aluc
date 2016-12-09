use ALUC;
-- Administradores
INSERT INTO administrador (id) VALUES ('0105070353');
INSERT INTO administrador (id) VALUES ('1400967715');

-- Moderadores
 INSERT INTO moderador (id, id_laboratorio) VALUES ('1400567572', '1');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0105108336', '1');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0104273131', '2');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0105515472', '2');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0104668009', '3');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0103162038', '3');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0604107607', '3');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('1400964001', '4');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0105686737', '4');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0104035514', '5');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0105513402', '5');
 INSERT INTO moderador (id, id_laboratorio) VALUES ('0106816952', '5');

-- Lectores
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:13:49:00:01:02','1','192.168.1.2','aSDFERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:14:49:00:01:02','2','192.168.1.3','aSrFERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:15:49:00:01:02','3','192.168.1.4','aSfFERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:16:49:00:01:02','4','192.168.1.5','aSaFERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:17:49:00:01:02','5','192.168.1.6','aSsfERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:18:49:00:01:02','6','192.168.1.7','aSgbERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:19:49:00:01:02','1','192.168.1.8','aSDhERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:10:49:00:01:02','2','192.168.1.9','aSDkERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:11:49:00:01:02','3','192.168.1.10','aSoFERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:12:49:00:01:02','4','192.168.1.11','aSpFERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:21:49:00:01:02','5','192.168.1.12','aSmFERTYFRsffge');
INSERT INTO lector(mac,id_laboratorio,ip,token) VALUES('00:22:49:00:01:02','6','192.168.1.13','aSgFERTYFRsffge');

-- Reservas
ALTER TABLE ALUC.reserva AUTO_INCREMENT=0;
ALTER TABLE ALUC.reservacion AUTO_INCREMENT=0;
-- clases
CALL ALUC.insertar_reserva('0604107607','1','Clases normales ','10','clases','reservado','2016-12-02','15:00:00','16:00:00','Ds3lO3TT1UtO6RO');
CALL ALUC.insertar_reserva('1400967715','2','Clases normales ','10','clases','reservado','2016-12-02','15:30:00','16:30:00','Ds3lO4TT1UtO6RO');
CALL ALUC.insertar_reserva('0105070353','3','Clases normales ','10','clases','reservado','2016-12-02','15:00:00','16:00:00','Ds3lO5TT1UtO6RO');
CALL ALUC.insertar_reserva('0104967864','4','Clases normales ','10','clases','reservado','2016-12-02','15:30:00','16:30:00','Ds3lO6TT1UtO6RO');
CALL ALUC.insertar_reserva('0105850945','5','Clases normales ','10','clases','reservado','2016-12-02','15:00:00','16:00:00','Ds3lO7TT1UtO6RO');
CALL ALUC.insertar_reserva('0104429527','6','Clases normales ','10','clases','reservado','2016-12-02','15:30:00','16:30:00','Ds3lO8TT1UtO6RO');

CALL ALUC.insertar_reserva('0604107607','1','Clases normales ','10','clases','reservado','2016-12-02','10:00:00','11:00:00','Ds3lO9TT1UtO6RO');
CALL ALUC.insertar_reserva('1400967715','2','Clases normales ','10','clases','reservado','2016-12-02','10:30:00','11:30:00','Ds3lO0TT1UtO6RO');
CALL ALUC.insertar_reserva('0105070353','3','Clases normales ','10','clases','reservado','2016-12-02','10:00:00','11:00:00','Ds3lO1TT1UtO6RO');
CALL ALUC.insertar_reserva('0104967864','4','Clases normales ','10','clases','reservado','2016-12-02','10:30:00','11:30:00','Ds3lO22TT1UtO6RO');
CALL ALUC.insertar_reserva('0105850945','5','Clases normales ','10','clases','reservado','2016-12-02','10:00:00','11:00:00','Ds3lO3TT2UtO6RO');
CALL ALUC.insertar_reserva('0104429527','6','Clases normales ','10','clases','reservado','2016-12-02','10:30:00','11:30:00','Ds3lO3TT6UtO6RO');



-- reservas para prácticas

CALL ALUC.insertar_reserva('0105513402','1','Prácticas realizadas para deberes','1','práctica','reservado','2016-12-02','07:00:00','08:00:00','Ds3lO3Ty1UtO6RO');
CALL ALUC.insertar_reserva('0105513402','2','Prácticas realizadas para deberes','5','práctica','reservado','2016-12-03','09:00:00','10:00:00','Ds3lO3Tu1UtO6RO');
CALL ALUC.insertar_reserva('1400567572','1','Prácticas realizadas para deberes','7','práctica','reservado','2016-12-02','07:00:00','08:00:00','Ds3lO3To1UtO6RO');
CALL ALUC.insertar_reserva('1400567572','2','Prácticas realizadas para deberes','2','práctica','reservado','2016-12-03','09:00:00','10:00:00','Ds3lO3Tp1UtO6RO');

CALL ALUC.insertar_reserva('0105108336','3','Prácticas realizadas para deberes','1','práctica','reservado','2016-12-02','09:00:00','10:00:00','Ds3lO3Ta1UtO6RO');
CALL ALUC.insertar_reserva('0105108336','4','Prácticas realizadas para deberes','5','práctica','reservado','2016-12-03','11:00:00','12:00:00','Ds3lO3Ts1UtO6RO');
CALL ALUC.insertar_reserva('0105515472','3','Prácticas realizadas para deberes','7','práctica','reservado','2016-12-02','09:00:00','10:00:00','Ds3lO3Td1UtO6RO');
CALL ALUC.insertar_reserva('0105515472','4','Prácticas realizadas para deberes','2','práctica','reservado','2016-12-03','11:00:00','12:00:00','Ds3lO3Tf1UtO6RO');

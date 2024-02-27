DROP DATABASE IF EXISTS examenrecu;
CREATE DATABASE IF NOT EXISTS examenrecu;
USE examenrecu;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    apellidos       varchar(255),
    email           varchar(255) not null,
    password        varchar(255) not null,
    rol             varchar(20),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

drop table if exists mensajes;

CREATE TABLE mensajes (
                          id int(4) PRIMARY KEY auto_increment,
                          id_usuario int,
                          de varchar(100),
                          asunto varchar(100),
                          cuerpo text,
                          fecha date)engine=InnoDB;

INSERT INTO usuarios value (null, "admin", "admin", "admin@gmail.com", "$2y$04$0xMw6XxzEdqG2B1pfmDa2OMbPHOk2KbXHT1AKiFIbGS7zT/t8ziEW", "admin");

INSERT INTO mensajes VALUES (null,1,"Jose Luis Caparros","Recursos EducaMadrid","Este es un canal de información de la Revista Digital y del Portal EducaMadrid a los profesores de la enseñanza sostenida con fondos públicos.
Los mensajes son enviados a su cuenta profesional en 'educa.madrid.org'. Si recibe este mensaje en una cuenta personal probablemente es porque tenga redirigida su cuenta de EdudcaMadrid.
Si no desea recibir más mensajes de este canal informativo, pulse en el siguiente enlace para cancelar la recepción de futuros mensajes:
http://listas.educa.madrid.org/gestion_listas/index.php","2021-01-25");


INSERT INTO mensajes VALUES (null,1,"Javier Gomez","Visita seguros","
Hola a todos y a todas:
Al igual que hemos hecho en ocasiones anteriores, mañana nos concentraremos en la entrada del instituto para protestar por la situación de la Enseñanza Pública y los recortes que está sufriendo, y por las últimas detenciones ocurridas en Villalba. Nos concentraremos en el segundo recreo.
Un saludo
","2021-01-19");

INSERT INTO mensajes VALUES (null,1,"Mariano Sanchez","Funeral de mi suego","
Espero que vuestras vacaciones sigan tranquilas, pero os tenemos que convocar a una reunión de departameno urgente para mañana jueves a las 13:30 horas.
Lo más probable es que tengamos que desplazar a algún miembro del departamento por quedarse sin horas lectivas. Todo ello como ya suponeis se debe a la implantación de los nuevos ciclos, la reducción de horas de FCT y alguna cosa más.
 Un saludo.","2021-12-19");
INSERT INTO mensajes VALUES (null,1,"Virginia Santamaria","Proximo examen","
Para los que os interese.
La Marea Verde ha citado a todos los que quieran participar en la manifestación de los mineros mañana a las 10:45 en el Museo de Cera de la Pza Col�n.
Un saludo","2021-01-18");
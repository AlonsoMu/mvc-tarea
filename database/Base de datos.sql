-- CRENADO BASE DE DATOS
CREATE DATABASE informatica;
USE informatica;


-- CREANDO TABLA BASE DE DATOS
CREATE TABLE productos
(
idproducto		INT AUTO_INCREMENT   PRIMARY KEY,
nombreproducto		VARCHAR(50)		NOT NULL,
modelo			VARCHAR(30)		NOT NULL,
marca			VARCHAR(40)		NOT NULL,
color			VARCHAR(30)		NOT NULL,
conectividad		VARCHAR(30)		NOT NULL,
peso			VARCHAR(20)		NOT NULL,	
precio			DECIMAL(7,2)		NOT NULL,
fecharegistro		DATETIME 		NOT NULL DEFAULT NOW(),
fechaupdate		DATETIME		NULL,
estado			CHAR(1)			NOT NULL DEFAULT '1',
CONSTRAINT unk_modelo UNIQUE(modelo)
)ENGINE = INNODB;

DROP TABLE productos;

INSERT INTO productos(nombreproducto, modelo, marca, color, conectividad, peso, precio, fecharegistro) VALUES
('Superligth','Mouse','Logitech','blanco','inalambrico','ligero',500,'2023-06-10'),
('DRAGONBORN K630W-RGB','Teclado','RedDragon','blanco','inalambrico','ligero',3200,'2023-07-12'),
('Wireless Mice','Mouse RGB','Corsair','negro','inalambrico','ligero',220,'2023-09-10');

SELECT * FROM productos;	



-- PROCEDIMIENTOS ALMACENADOS

-- LISTAR

DELIMITER $$
CREATE PROCEDURE spu_productos_listar()
BEGIN
	SELECT idproducto,
		nombreproducto,
		modelo,
		marca,
		color,
		conectividad,
		peso,
		fecharegistro,
		precio
	FROM productos
	WHERE estado = '1'
	ORDER BY idproducto DESC;
END$$

CALL spu_productos_listar()


-- REGISTRAR
DELIMITER $$
CREATE PROCEDURE spu_productos_registrar
(
IN nombreproducto_		VARCHAR(50),
IN modelo_			VARCHAR(30),
IN marca_			VARCHAR(40),
IN color_			VARCHAR(30),
IN conectividad_		VARCHAR(30),
IN peso_			VARCHAR(20),
IN fecharegistro_		DATE,
IN precio_			DECIMAL(7,2)			
)
BEGIN
	INSERT INTO productos(nombreproducto, modelo, marca, color, conectividad, peso, fecharegistro, precio)
	VALUES (nombreproducto_, modelo_, marca_, color_, conectividad_, peso_, fecharegistro_, precio_);
END $$

CALL spu_productos_registrar('Helios con Ventana RGB', 'gabinete', 'ASUS ROG Strix', 'negro','Armado','pesado', '2023-05-25',3200);
CALL spu_productos_listar();

-- ELIMINAR
DELIMITER $$
CREATE PROCEDURE spu_productos_eliminar
(
IN _idproducto INT
)
BEGIN
UPDATE productos SET estado = '0'
	WHERE idproducto = _idproducto;
END$$

CALL spu_productos_eliminar()

DROP PROCEDURE

-- ACTUALIZAR 

DELIMITER $$
CREATE PROCEDURE spu_productos_actualizar
(
IN idproducto_			INT,
IN nombreproducto_		VARCHAR(50),
IN modelo_			VARCHAR(30),
IN marca_			VARCHAR(40),
IN color_			VARCHAR(30),
IN conectividad_		VARCHAR(30),
IN peso_			VARCHAR(20),
IN fecharegistro_		DATE,
IN precio_			DECIMAL(7,2)
)
BEGIN
	UPDATE productos SET
	nombreproducto = nombreproducto_,
	modelo = modelo_,
	marca = marca_,
	color = color_,
	conectividad = conectividad_,
	peso = peso_,
	fecharegistro = fecharegistro_,
	precio = precio_
	WHERE idproducto = idproducto_;
END $$

CALL spu_productos_actualizar('7','HELIOS','GABINETE','SAMSUNG','BLANCO','ARMADO','PESADO','2023-07-04','4000')





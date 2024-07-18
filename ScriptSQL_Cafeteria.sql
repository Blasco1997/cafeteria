SET foreign_key_checks = 0;

DROP DATABASE IF EXISTS cafeteria;

CREATE DATABASE IF NOT EXISTS cafeteria
DEFAULT CHARACTER SET UTF8
DEFAULT COLLATE UTF8_SPANISH_CI;

USE cafeteria;

CREATE TABLE clientes (
Id_cliente INT(11) NOT NULL AUTO_INCREMENT,
Perfil VARCHAR(257) NULL,
Usuario VARCHAR(50) NOT NULL,
Contrasinal VARCHAR(50) NOT NULL,
Nome_completo VARCHAR(50) NOT NULL,
Teléfono VARCHAR(50) NOT NULL,
Correo VARCHAR(50) NOT NULL,
Estado ENUM('Activo', 'Inactivo') NOT NULL,
PRIMARY KEY(Id_cliente)
) ENGINE = INNODB;

INSERT INTO clientes(Id_cliente, Perfil, Usuario, Contrasinal, Nome_completo, Teléfono, Correo, Estado)
VALUES (1, '../Imaxes/Xerais/Yo.PNG', 'blasco', 'abc123.,', 'Blasco Rodríguez Porta', 608736780, 'blascorodriguez@gmail.com', 'Inactivo');

CREATE TABLE empregados (
Id_Empregado INT(11) NOT NULL AUTO_INCREMENT,
Perfil VARCHAR(257) NULL,
Usuario VARCHAR(50) NOT NULL,
Contrasinal VARCHAR(50) NOT NULL,
Nome_completo VARCHAR(100) NOT NULL,
Telefono INT(15) NOT NULL,
Correo VARCHAR(50) NOT NULL,
Estado ENUM('Activo', 'Inactivo') NOT NULL,
PRIMARY KEY(Id_Empregado)
) ENGINE = INNODB;

INSERT INTO empregados(Id_Empregado, Perfil, Usuario, Contrasinal, Nome_completo, Telefono, Correo, Estado)
VALUES (1, '../Imaxes/Xerais/User.PNG', 'admin', 'abc123.,', 'Administrador', 608736780, 'blascorodriguez@gmail.com', 'Inactivo'),
(2, '../Imaxes/Xerais/Victoria.PNG', 'victoria', 'abc123.,', 'María Victoria Pazos Rodríguez', 610343432, 'mvictoriasampedro@hotmail.com', 'Inactivo');

CREATE TABLE provedores (
Id_Provedor INT(11) NOT NULL AUTO_INCREMENT,
Logo VARCHAR(257) NOT NULL,
Provedor VARCHAR(50) NOT NULL,
Dirección VARCHAR(500) NOT NULL,
Teléfono INT(15) NOT NULL,
Páxina_web VARCHAR(500) NOT NULL,
PRIMARY KEY(Id_Provedor)
) ENGINE = INNODB;

INSERT INTO provedores(Id_Provedor, Logo, Provedor, Dirección, Teléfono, Páxina_web) VALUES 
(1, '../Imaxes/Provedores/CorporaciónAlimentariaVima.PNG', 'Corporación Alimentaria Vima', 'Rúa Enrique Mariñas Romero, 36 Edificio Torre de Cristal. Planta 10, 15009 A Coruña', 981228732, 'https://www.vimafoods.com/'),
(2, '../Imaxes/Provedores/Zumosol.PNG', 'Zumosol', 'Avda. de la Industria, 4 Edif. 0 Esc. 2 Plta. 1ª Ofic. C28108 Alcobendas Madrid España', 918228500, 'https://www.zumosol.com/'),
(3, '../Imaxes/Provedores/PepsicoBebidasIberia.PNG', 'Pepsico Bebidas Iberia', 'Marie Curie Kalea, 7, 01510 Miñano Mayor, Araba', 945164100, 'https://www.pepsico.es/'),
(4, '../Imaxes/Provedores/EmbutidosYJamonesJero.PNG', 'Embutidos y Jamones Jero', 'C. Príncipe Felipe, nº 28, 37770 Guijuelo, Salamanca', 923580420, 'https://www.proveedores.com/proveedores/embutidos-y-jamones-jero/'),
(5, '../Imaxes/Provedores/DespensaPisón.PNG', 'Despensa Pisón', 'C. Padre Jose Garcia, 1, 26280 Ezcaray, La Rioja', 941354332, 'https://www.despensapison.com/'),
(6, '../Imaxes/Provedores/CarnesYEmbutidosHérculesSL.PNG', 'Carnes y Embutidos Hércules S.L.', 'Avda. de Nostián, 20, Coruña (A) - A Coruña ', 981250255, 'http://www.carnesyembutidoshercules.com/'),
(7, '../Imaxes/Provedores/SacesaSelección.PNG', 'Sacesa Selección', 'Pol. La Maja, Parcela P-6 , Arnedo - La Rioja', 941132305, 'https://www.sacesaseleccion.com/es/'),
(8, '../Imaxes/Provedores/Frooty.PNG', 'FROOTY', 'Carrer d\Ausiàs Marc, 65, Barcelona (Ciudad) - Barcelona', 629863326, 'https://www.frooty.es/'),
(9, '../Imaxes/Provedores/IndustriasMarjo.PNG', 'Industrias Marjo', ' C/Turiaso, 22 , Zaragoza (Ciudad) - Zaragoza ', 976503567, 'http://www.marjo.es/'),
(10, '../Imaxes/Provedores/ProexDrinksGroup.PNG', 'Proex Drinks Group', 'Arrabal Industrial, 161, 11360 San Roque, Cádiz', 856223943, 'http://www.proexdg.com/');

CREATE TABLE menus (
Id_Menú INT(11) NOT NULL AUTO_INCREMENT,
Prezo INT(11) NOT NULL,
Día DATE NOT NULL,
PRIMARY KEY(Id_Menú)
) ENGINE = INNODB;

INSERT INTO menus(Id_Menú, Prezo, Día) VALUES
(1, 6, '2023-09-06'),
(2, 6, '2023-09-11'),
(3, 6, '2023-09-13'),
(4, 6, '2023-09-18'),
(5, 6, '2023-09-20'),
(6, 6, '2023-09-25'),
(7, 6, '2023-09-27');

CREATE TABLE mesas (
Id_Mesa INT(11) NOT NULL AUTO_INCREMENT,
Mesa VARCHAR(50) NOT NULL,
Estado ENUM('LIBRE', 'RESERVADA', 'OCUPADA'),
PRIMARY KEY(Id_Mesa)
) ENGINE = INNODB;

INSERT INTO mesas(Id_Mesa, Mesa, Estado) VALUES
(1, 'Mesa 1', 'LIBRE'),(2, 'Mesa 2', 'LIBRE'),(3, 'Mesa 3', 'LIBRE'),(4, 'Mesa 4', 'LIBRE'),
(5, 'Mesa 5', 'LIBRE'),(6, 'Mesa 6', 'LIBRE'),(7, 'Mesa 7', 'LIBRE'),(8, 'Mesa 8', 'LIBRE'),
(9, 'Mesa 9', 'LIBRE'),(10, 'Mesa 10', 'LIBRE'),(11, 'Mesa 11', 'LIBRE'),(12, 'Mesa 12', 'LIBRE'),
(13, 'Mesa 13', 'LIBRE'),(14, 'Mesa 14', 'LIBRE'),(15, 'Mesa 15', 'LIBRE'),(16, 'Mesa 16', 'LIBRE'),
(17, 'Mesa 17', 'LIBRE'),(18, 'Mesa 18', 'LIBRE'),(19, 'Mesa 19', 'LIBRE'),(20, 'Mesa 20', 'LIBRE');

CREATE TABLE pratos (
Id_Prato INT(11) NOT NULL AUTO_INCREMENT,
Prato VARCHAR(50) NOT NULL,
Disponible ENUM('Sí', 'No') NOT NULL,
PRIMARY KEY(Id_Prato)
) ENGINE = INNODB;

INSERT INTO pratos(Id_Prato, Prato, Disponible) VALUES
(1, 'RAXO + PATATAS + ENSALADA', 'No'),
(2, 'HAMBURGUESA + OVO + SALCHICHAS + PATATAS', 'Sí'),
(3, 'MILANESA + TORTILLA + ENSALADA DE PASTA', 'Sí'),
(4, 'ESPAGUETTI Á BOLOÑESA', 'Sí'),
(5, 'ESPAGUETTI Á CARBONARA', 'No'),
(6, 'MACARRÓNS CON ATÚN', 'No'),
(7, 'CHULETA + TORTILLA + PATATAS', 'Sí'),
(8, 'HAMBURGUESA + BEICON + PATATAS', 'No'),
(9, 'MACARRÓNS CON POLO', 'No');

CREATE TABLE pratosmenus (
Id_Prato_Menu SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
Id_Prato INT(11) NOT NULL,
Id_Menu INT(11) NOT NULL,
PRIMARY KEY(Id_Prato_Menu),
CONSTRAINT fk_idprato1 FOREIGN KEY(Id_Prato) REFERENCES pratos(Id_Prato)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT fk_idmenu1 FOREIGN KEY(Id_Menu) REFERENCES menus(Id_Menú)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE produtos (
Id_Produto INT(11) NOT NULL AUTO_INCREMENT,
Foto VARCHAR(257) NOT NULL,
Produto VARCHAR(50) NOT NULL,
Descrición VARCHAR(257) NOT NULL,
Tipo ENUM('Varios', 'Bebida', 'Outros') NOT NULL,
Stock INT(11) NOT NULL,
Prezo DECIMAL(4,2) NOT NULL,
Id_Provedor INT(11) NULL,
PRIMARY KEY(Id_Produto),
CONSTRAINT fk_idprovedor FOREIGN KEY (Id_Provedor) REFERENCES provedores(Id_Provedor)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = INNODB;

INSERT INTO produtos(Id_Produto, Foto, Produto, Descrición, Tipo, Stock, Prezo, Id_Provedor) VALUES 
(1, '../Imaxes/Produtos/Bebida/Botelladeagua.PNG', 'Botella de Agua', 'Botella de Agua 0.5L', 'Bebida', 200, 0.60, 1),
(2, '../Imaxes/Produtos/Bebida/ZumoBifrutas.PNG', 'Zumo Bifrutas', 'Zumo Bifrutas de Naranja y Frutas Tropicales', 'Bebida', 70, 0.90, 2),
(3, '../Imaxes/Produtos/Bebida/ZumoPago.PNG', 'Zumo Pago', 'Zumo de Naranja de Marca Pago', 'Bebida', 50, 0.80, 2),
(4, '../Imaxes/Produtos/Bebida/CocacolaLight.PNG', 'Coca-Cola Light', 'Coca-Cola Light Lata 33cl', 'Bebida', 150, 1.70, 3),
(5, '../Imaxes/Produtos/Bebida/CocacolaNormal.PNG', 'Coca-Cola Original', 'Coca-Cola Original Lata 33cl', 'Bebida', 150, 1.70, 3),
(6, '../Imaxes/Produtos/Bebida/CocacolaZero.PNG', 'Coca-Cola Zero', 'Coca-Cola Zero Lata 33cl', 'Bebida', 150, 1.70, 3),
(7, '../Imaxes/Produtos/Bebida/KASNaranja.PNG', 'KAS Naranja', 'KAS de Naranja Lata 33cl', 'Bebida', 150, 1.50, 3),
(8, '../Imaxes/Produtos/Bebida/KASLimón.PNG', 'KAS Limón', 'KAS de Limón Lata 33cl', 'Bebida', 150, 1.50, 3),
(9, '../Imaxes/Produtos/Bebida/FantaNaranja.PNG', 'Fanta Naranja', 'Fanta de Naranja Lata 33cl', 'Bebida', 150, 1.50, 3),
(10, '../Imaxes/Produtos/Bebida/FantaLimón.PNG', 'Fanta Limón', 'Fanta de Limón Lata 33cl', 'Bebida', 150, 1.50, 3),
(11, '../Imaxes/Produtos/Bebida/AquariusNaranja.PNG', 'Aquarius Naranja', 'Aquarius de Naranja Lata 33cl', 'Bebida', 150, 1.50, 3),
(12, '../Imaxes/Produtos/Bebida/AquariusLimón.PNG', 'Aquarius Limón', 'Aquarius de Limón Lata 33cl', 'Bebida', 150, 0.60, 3),
(13, '../Imaxes/Produtos/Bebida/CaféconLeche.PNG', 'Café con Leche', 'Café con Leche', 'Bebida', 300, 1.00, 6),
(14, '../Imaxes/Produtos/Bebida/ColaCao.PNG', 'Colacao', 'Colacao', 'Bebida', 300, 1.00, 7),
(15, '../Imaxes/Produtos/Varios/Cheetos.PNG', 'Cheetos', 'Bolsa de Pelotillas Crujientes', 'Varios', 100, 0.95, 3),
(16, '../Imaxes/Produtos/Varios/Doritos.PNG', 'Doritos', 'Bolsa de Patatas triangulares crujientes', 'Varios', 100, 1.00, 3),
(17, '../Imaxes/Produtos/Varios/Filipinos.PNG', 'Filipinos', 'Mini-Donuts rellenos de galleta y cubiertos de chocolate blanco', 'Varios', 100, 0.90, 9),
(18, '../Imaxes/Produtos/Varios/Haribo.PNG', 'Haribo', 'Golosinas sólidas de sabores', 'Varios', 100, 0.70, 5),
(19, '../Imaxes/Produtos/Varios/itsFini.PNG', 'ItsFini', '¡Hey tú! Párate y piensa. ¿Crees que hoy te has divertido? ¿O te cortan las alas tres o cuatro aburridos?', 'Varios', 150, 0.70, 4),
(20, '../Imaxes/Produtos/Varios/KinderBueno.PNG', 'Kinder Bueno', 'Barquillo crujiente relleno de crema y su chocolate', 'Varios', 150, 1.00, 6),
(21, '../Imaxes/Produtos/Varios/Kitkat.PNG', 'Kitkat', 'Tabla de cuatro filas crujientes rellenas de chocolate. Tómate un respiro.', 'Varios', 150, 1.10, 9),
(22, '../Imaxes/Produtos/Varios/Lays.PNG', 'Lays', 'Bolsa de Patatas crujientes', 'Varios', 150, 1.00, 8),
(23, '../Imaxes/Produtos/Varios/PipasFacundo.PNG', 'Pipas Facundo', 'Bolsa de Pipas con cáscara. Y el toro dijo al morir: Siento dejar este mundo sin probar Pipas Facundo', 'Varios', 150, 0.70, 3),
(24, '../Imaxes/Produtos/Varios/Pringles.PNG', 'Pringles', 'Caja cilindrada de patatas crujientes', 'Varios', 150, 1.50, 3),
(25, '../Imaxes/Produtos/Outros/BocadilloChorizoQueso.PNG', 'Bocadillo de Chorizo y Queso', 'Bocadillo de Chorizo y Queso', 'Outros', 120, 1.20, 4),
(26, '../Imaxes/Produtos/Outros/BocadilloJamonSerranoQueso.PNG', 'Bocadillo de Jamón Serrano y Queso', 'Bocadillo de Jamón Serrano y Queso', 'Outros', 120, 1.20, 4),
(27, '../Imaxes/Produtos/Outros/BocadilloLomoQueso.PNG', 'Bocadillo de Lomo y Queso', 'Bocadillo de Lomo y Queso', 'Outros', 120, 1.20, 4),
(28, '../Imaxes/Produtos/Outros/BocadilloTortilla.PNG', 'Bocadillo de Tortilla de Patatas', 'Bocadillo de Tortilla de Patatas', 'Outros', 120, 1.20, 7),
(29, '../Imaxes/Produtos/Outros/Panninis.PNG', 'Panninis', 'Minipizzas con pan de bocata', 'Outros', 40, 1.00, 7),
(30, '../Imaxes/Produtos/Outros/CaracolaConPasas.PNG', 'Caracola con pasas', 'Caracola con pasas', 'Outros', 10, 1.50, 9),
(31, '../Imaxes/Produtos/Outros/Cruasan.PNG', 'Cruasán', 'Cruasán', 'Outros', 10, 1.50, 9),
(32, '../Imaxes/Produtos/Outros/MitadBocadilloChorizoQueso.PNG', '1/2 Bocadillo de Chorizo y Queso', '1/2 Bocadillo de Chorizo y Queso', 'Outros', 120, 0.60, 7),
(33, '../Imaxes/Produtos/Outros/MitadBocadilloJamonSerranoQueso.PNG', '1/2 Bocadillo de Jamón Serrano y Queso', '1/2 Bocadillo de Jamón Serrano y Queso', 'Outros', 120, 0.60, 7),
(34, '../Imaxes/Produtos/Outros/MitadBocadilloLomoQueso.PNG', '1/2 Bocadillo de Lomo y Queso', '1/2 Bocadillo de Lomo y Queso', 'Outros', 120, 0.60, 7),
(35, '../Imaxes/Produtos/Outros/MitadBocadilloTortilla.PNG', '1/2 Bocadillo de Tortilla de Patatas', '1/2 Bocadillo de Tortilla de Patatas', 'Outros', 120, 0.60, 7),
(36, '../Imaxes/Produtos/Outros/NapolitanaChocolate.PNG', 'Napolitana de chocolate', 'Napolitana de chocolate', 'Outros', 10, 1.50, 9);

CREATE TABLE pedidos(
Id_Pedido INT(11) NOT NULL AUTO_INCREMENT,
Data_Pedido DATE NOT NULL,
Id_Produto INT(11) NOT NULL,
Id_Empregado INT(11) NOT NULL,
Id_Provedor INT(11) NOT NULL,
Stock_Engadir INT(11) NOT NULL,
PRIMARY KEY(Id_Pedido),
CONSTRAINT fk_idproduto1 FOREIGN KEY(Id_Produto) REFERENCES produtos(Id_Produto)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT fk_idempregado1 FOREIGN KEY(Id_Empregado) REFERENCES empregados(Id_Empregado)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT fk_idprovedor2 FOREIGN KEY(Id_Provedor) REFERENCES provedores(Id_Provedor)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE reservas (
Id_Reserva INT(11) NOT NULL AUTO_INCREMENT,
Hora TIME NOT NULL,
Id_Menú INT(11) NOT NULL,
Id_Mesa INT(11) NOT NULL,
Id_Cliente INT(11) NOT NULL,
Id_Prato INT(11) NOT NULL,
Id_Produto INT(11) NOT NULL,
Pagado ENUM('Pagado', 'Pendente de pagar', 'Pendente de entrega') NOT NULL,
PRIMARY KEY(Id_Reserva),
CONSTRAINT fk_idmenu2 FOREIGN KEY(Id_Menú) REFERENCES menus(Id_Menú)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT fk_idmesa1 FOREIGN KEY(Id_Mesa) REFERENCES mesas(Id_Mesa)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT fk_idcliente1 FOREIGN KEY(Id_Cliente) REFERENCES clientes(Id_cliente)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT fk_idprato2 FOREIGN KEY(Id_Prato) REFERENCES pratos(Id_Prato)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT fk_idproduto2 FOREIGN KEY(Id_Produto) REFERENCES produtos(Id_Produto)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE publicacions (
Id_Publicacion INT(11) NOT NULL AUTO_INCREMENT,
Enlace VARCHAR(257) NOT NULL,
Titulo VARCHAR(100) NOT NULL,
Imaxe VARCHAR(257) NOT NULL,
Día DATE NOT NULL,
Id_Empregado INT(11) NOT NULL,
PRIMARY KEY(Id_Publicacion),
CONSTRAINT fk_idempregado FOREIGN KEY(Id_Empregado) REFERENCES empregados(Id_Empregado)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = INNODB;

INSERT INTO publicacions(Id_Publicacion, Enlace, Titulo, Imaxe, Día, Id_Empregado) VALUES
(1, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/749', 'SEMANA DA SAÚDE', '../Imaxes/Noticias/semanadasaude.png', '2019-04-08', 1),
(2, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/789', 'PECHAMOS CURSO E AO SON RURAL', '../Imaxes/Noticias/pechamoscursoeaosondorural.png', '2019-06-27', 1),
(3, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1128', 'ALMORZOS SAUDABLES NO IES MAXIMINO ROMERO DE LEMA', '../Imaxes/Noticias/almorzossaudables1.png', '2021-11-03', 1),
(4, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1134', 'ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables2.png', '2021-11-17', 1),
(5, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1178', 'ALMORZOS SAUDABLES NO IES MAXIMINO ROMERO DE LEMA', '../Imaxes/Noticias/almorzossaudables3.png', '2022-01-16', 1),
(6, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1229', 'ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables4.png', '2022-03-22', 1),
(7, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1220', 'ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables5.png', '2022-03-14', 1),
(8, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1243', 'OS ALMORZOS SAUDABLES REMATAN CON GRAN ÉXITO', '../Imaxes/Noticias/almorzossaudables6.png', '2022-03-27', 1),
(9, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1358', 'EXITAZO, UNHA VEZ MÁIS, NOS ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables7.png', '2022-11-04', 1),
(10, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1391', 'ACÁBASE O ANO, ACÁBANSE OS ALMORZOS SAUDABLES!', '../Imaxes/Noticias/almorzossaudables8.png', '2022-12-18', 1),
(11, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1354', 'ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables9.png', '2022-10-28', 1),
(12, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1413', 'NOVO ANO, MÁIS ALMORZOS SAUDABLES!', '../Imaxes/Noticias/almorzossaudables10.png', '2023-01-14', 1),
(13, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1417', '2º BACHARELATO PARTICIPA DOS ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables11.png', '2023-01-18', 1),
(14, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1419', '1º E 2º DE CICLO SUPERIOR POÑEN O BROCHE FINAL AO PROGRAMA DE ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables12.png', '2023-01-20', 1),
(15, 'http://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1165', 'ALMORZOS SAUDABLES', '../Imaxes/Noticias/almorzossaudables13.png', '2021-12-15', 1),
(16, 'https://www.edu.xunta.gal/centros/iesmaximinoromerodelema/node/1362', 'E... 4º DA ESO TAMÉN ALMORZOU NO INSTITUTO!', '../Imaxes/Noticias/almorzossaudables14.png', '2022-11-19', 1);
-- BASE DE DATOS IMAGYM
-- PUNTOS IMPORTANTES:
	-- DISPONDREMOS DE USUARIOS, LOS CUALES PUEDEN SER ADMINISTRADORES O CLIENTES
		-- LOS ADMINISTRADORES PUEDEN AÑADIR Y MODIFICAR LOS PRODUCTOS
		-- LOS CLIENTES SOLO PUEDEN CONSULTARLOS Y AÑADIRLOS AL CARRITO
	-- LOS PRODUCTOS TENDRÁN DOS ATRIBUTOS DE FILTRADO, CATEGORIA Y GENERO
		-- CATEGORIA SERÁ MÁS GENERAL
		-- GENERO SERÁ MÁS ESPECIFICO
	-- CADA CLIENTE TENDRÁ N FACTURAS
	-- CADA FACTURA TENDRÁ N PRODUCTOS
	-- CADA PRODUCTO PODRÁ APARECER EN N FACTURAS
	-- PODREMOS ESPECIFICAR LA CANTIDAD DE PRODUCTO DESEADA
	-- HABRA QUE CONTROLAR QUE LA CANTIDAD NO SOBREPASE EL STOCK DISPONIBLE
	-- HABRÁ QUE CALCULAR EL PRECIO TOTAL DE LA FACTURA: 
		-- SUMATORIO DE CODIGO UNITARIO DE CADA PRODUCTO MULTIPLICADO POR LA CANTIDAD DESEADA
	


DROP TABLE IF EXISTS Usuarios, Categorias, Contacto, Generos, Productos, Facturas, ProductosEnFacturas, Tallas, ProductoTallas CASCADE;

CREATE TABLE Usuarios (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Contraseña VARCHAR(255) NOT NULL,
    Rol ENUM('administrador', 'cliente') NOT NULL
);

INSERT INTO Usuarios (Nombre, Email, Contraseña, Rol) VALUES
	('Jorge', 'jorge@gmail.com', '1234A', 'administrador'),
	('Emilio','emilio@gmail.com', '1234B', 'cliente');

-- Crear la tabla de categorías
CREATE TABLE Categorias (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL
);

-- Insertar categorías iniciales
INSERT INTO Categorias (Nombre) VALUES
    ('Ropa deportiva'),
    ('Material deportivo'),
    ('Máquinas'),
    ('Suplementos');

    CREATE TABLE Contacto (
  `ORDEN` int(11) NOT NULL,
  `NOMBRE` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `CORREO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `MENSAJE` varchar(1000) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO Contacto (`ORDEN`, `NOMBRE`, `CORREO`, `MENSAJE`) VALUES
(0, 'jorge', 'jorgebecu@gmail.com', 'bienvenidos');

	
-- Crear la tabla de géneros
CREATE TABLE Generos (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL
);

-- Insertar géneros iniciales
INSERT INTO Generos (Nombre) VALUES
    ('Camisetas'),
    ('Pantalones'),
    ('Zapatillas'),
    ('Mancuernas'),
	('Gomas'),
	('Barras'),
	('Fitness Cardio'),
	('Rack'),
	('Musculación'),
	('Proteina'),
	('Creatina'),
	('Pre-Entreno');
	

-- Crear la tabla de productos
CREATE TABLE Productos (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    Imagen VARCHAR(100) NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL,
    Stock INT NOT NULL,
    CategoriaID INT NOT NULL,
    GeneroID INT NOT NULL,
    FOREIGN KEY (CategoriaID) REFERENCES Categorias(ID),
    FOREIGN KEY (GeneroID) REFERENCES Generos(ID)
);

INSERT INTO Productos (Nombre,Imagen, Precio, Stock, CategoriaID, GeneroID)
VALUES
    ('Camiseta Nike','./imagenes/nike.jpg', 29.99, 100, 1, 1),
    ('Camiseta Puma','./imagenes/puma.jpg', 39.99, 75, 1, 1),
    ('Pantalón Adidas','./imagenes/adidas.jpg', 24.99, 50, 1, 2),
    ('Pantalón Joma','./imagenes/joma.jpg', 19.99, 15, 1, 2),
    ('Zapatillas Asics','./imagenes/asics.jpg', 69.99, 20, 1, 3),
    ('Zapatillas Nike','./imagenes/nikeShoes.jpg', 79.99, 10, 1, 3),
    ('Mancuerna 10kg','./imagenes/pesa10k.png', 29.99, 20, 2, 4),
    ('Mancuerna 15kg','./imagenes/pesa15k.png', 34.99, 20, 2, 4),
    ('Goma con agarre','./imagenes/goma_agarre.png', 5.99, 15, 2, 5),
    ('Pack Gomas','./imagenes/gomas.png', 14.99, 40, 2, 5),
	('Barra Z','./imagenes/barraZ.png', 19.99, 25, 2, 6),
	('Barra Olímpica','./imagenes/barra.png', 25.99, 10, 2, 6),
	('Cinta de Correr','./imagenes/cintacorrer.png', 249.99, 5, 3, 7),
	('Bicicleta Estática','./imagenes/bici.png', 199.99, 3, 3, 7),
	('Rack Banca','./imagenes/rackbanca.png', 59.99, 10, 3, 8),
	('Rack Sentadilla','./imagenes/racksentadilla.png', 99.99, 5, 3, 8),
	('Máquina Poleas','./imagenes/poleas.png', 249.99, 3, 3, 9),
	('Remo Horizontal','./imagenes/remo.png', 149.99, 4, 3, 9),
	('MyProtein Chocolate','./imagenes/chocolate.png', 14.99, 300, 4, 10),
	('Whey Vainilla','./imagenes/proteinavanila.png', 14.99, 300, 4, 10),
	('Creatina Monohidrato 500mg','./imagenes/creatina500.png', 24.99, 50, 4, 11),
	('Creatina Monohidrato 1kg','./imagenes/creatina1000.png', 14.99, 300, 4, 11),
	('Pre-Entreno MyProtein','./imagenes/preentreno.png', 14.99, 300, 4, 12),
	('Pre-Entreno Million','./imagenes/lambo.png', 14.99, 300, 4, 12);

CREATE TABLE Tallas (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Talla VARCHAR(10) NOT NULL
);

INSERT INTO Tallas (Talla) VALUES ('38');
INSERT INTO Tallas (Talla) VALUES ('39');
INSERT INTO Tallas (Talla) VALUES ('40');
INSERT INTO Tallas (Talla) VALUES ('41');
INSERT INTO Tallas (Talla) VALUES ('42');
INSERT INTO Tallas (Talla) VALUES ('S');
INSERT INTO Tallas (Talla) VALUES ('M');
INSERT INTO Tallas (Talla) VALUES ('L');
INSERT INTO Tallas (Talla) VALUES ('XL');

CREATE TABLE ProductoTallas (
    ProductoID INT,
    TallaID INT,
    FOREIGN KEY (ProductoID) REFERENCES Productos(ID),
    FOREIGN KEY (TallaID) REFERENCES Tallas(ID),
    PRIMARY KEY (ProductoID, TallaID)
);

INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (1, 6); 
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (1, 7);
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (1, 8); 
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (1, 9);

INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (2, 6); 
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (2, 7);
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (2, 8);  

INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (3, 6);
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (3, 9); 

INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (4, 6); 
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (4, 8); 

INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (5, 1); 
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (5, 2);
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (5, 3); 
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (5, 4);
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (5, 5); 

INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (6, 1); 
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (6, 2);  
INSERT INTO ProductoTallas (ProductoID, TallaID) VALUES (6, 3);  
	

-- Crear la tabla de facturas
CREATE TABLE Facturas (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ClienteID INT NOT NULL,
    FechaCompra DATE NOT NULL,
	PrecioTotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ClienteID) REFERENCES Usuarios(ID)
);

-- Crear la tabla de productos en facturas
CREATE TABLE ProductosEnFacturas (
    FacturaID INT NOT NULL,
    ProductoID INT NOT NULL,
    Cantidad INT NOT NULL,
    Talla VARCHAR(10),
    FOREIGN KEY (FacturaID) REFERENCES Facturas(ID),
    FOREIGN KEY (ProductoID) REFERENCES Productos(ID)
);
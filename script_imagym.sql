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
	


DROP TABLE IF EXISTS Usuarios, Categorias, Contacto, Generos, Productos, Facturas, ProductosEnFacturas, Tallas, ProductoTallas, Favoritos CASCADE;

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
    Descripcion TEXT NOT NULL,
    FOREIGN KEY (CategoriaID) REFERENCES Categorias(ID),
    FOREIGN KEY (GeneroID) REFERENCES Generos(ID)
);

INSERT INTO Productos (Nombre,Imagen, Precio, Stock, CategoriaID, GeneroID,Descripcion)
VALUES
    ('Camiseta Nike','./imagenes/nike.jpg', 29.99, 100, 1, 1,'Camiseta deportiva de alta calidad, marca Nike, perfecta para entrenamientos y actividades al aire libre. Material transpirable y diseño cómodo.'),
    ('Camiseta Puma','./imagenes/puma.jpg', 39.99, 75, 1, 1,' Elegante camiseta Puma, ideal para deportistas. Combina estilo y funcionalidad con un tejido suave y duradero.'),
    ('Pantalón Adidas','./imagenes/adidas.jpg', 24.99, 50, 1, 2,'Pantalón deportivo Adidas, ligero y versátil. Ideal para entrenamientos o uso casual. Tejido resistente y cómodo.'),
    ('Pantalón Joma','./imagenes/joma.jpg', 19.99, 15, 1, 2,'Pantalón Joma cómodo, diseñado para el deporte. Excelente relación calidad-precio, adecuado para todo tipo de actividades físicas.'),
    ('Zapatillas Asics','./imagenes/asics.jpg', 69.99, 20, 1, 3,'Zapatillas Asics de alto rendimiento, perfectas para correr. Proporcionan excelente soporte y comodidad. Diseño moderno y duradero.'),
    ('Zapatillas Nike','./imagenes/nikeShoes.jpg', 79.99, 10, 1, 3,'Zapatillas Nike innovadoras, ideales para deportistas exigentes. Combinan tecnología avanzada con un diseño atractivo.'),
    ('Mancuerna 10kg','./imagenes/pesa10k.jpg', 29.99, 20, 2, 4,'Mancuerna robusta de 10kg, perfecta para fortalecer y tonificar. Diseño ergonómico y seguro. Ideal para ejercicios de musculación.'),
    ('Mancuerna 15kg','./imagenes/pesa15k.jpg', 34.99, 20, 2, 4,'Mancuerna de 15kg, ideal para entrenamientos intensivos. Excelente para el desarrollo muscular y resistencia.'),
    ('Pack Discos','./imagenes/goma_agarre.jpg', 24.99, 15, 2, 5,'Diseñado para atletas de todos los niveles. Cada pack incluye una variedad de discos, cuidadosamente seleccionados para proporcionar el progreso gradual que buscan tanto principiantes como veteranos del fitness.'),
    ('Pack Gomas','./imagenes/gomas.jpg', 14.99, 40, 2, 5,'Conjunto de gomas elásticas de diferentes resistencias. Ideal para una variedad de ejercicios. Compacto y versátil.'),
	('Barra Z','./imagenes/barraZ.jpg', 19.99, 25, 2, 6,'Conjunto de gomas elásticas de diferentes resistencias. Ideal para una variedad de ejercicios. Compacto y versátil.'),
	('Barra Olímpica','./imagenes/barra.jpg', 25.99, 10, 2, 6,'Barra Olímpica estándar, ideal para levantamiento de pesas. Diseño robusto y seguro, adecuado para uso profesional.'),
	('Cinta de Correr','./imagenes/cintacorrer.jpg', 249.99, 5, 3, 7,'Cinta de correr moderna y eficiente. Ideal para entrenamientos cardiovasculares en casa. Varias velocidades y programas.'),
	('Bicicleta Estática','./imagenes/bici.jpg', 199.99, 3, 3, 7,'Bicicleta estática cómoda y estable. Excelente para ejercicios cardiovasculares y de bajo impacto. Varias resistencias ajustables.'),
	('Rack Banca','./imagenes/rackbanca.jpg', 59.99, 10, 3, 8,'Rack para banca de pesas, resistente y seguro. Ideal para un entrenamiento completo de fuerza.'),
	('Rack Sentadilla','./imagenes/racksentadilla.jpg', 99.99, 5, 3, 8,'Rack robusto para sentadillas. Perfecto para ejercicios de piernas y glúteos. Alta estabilidad y seguridad.'),
	('Máquina Poleas','./imagenes/poleas.jpg', 249.99, 3, 3, 9,'Máquina de poleas versátil para un entrenamiento integral. Ideal para trabajar diferentes grupos musculares.'),
	('Remo Horizontal','./imagenes/remo.jpg', 149.99, 4, 3, 9,'Máquina de remo horizontal, perfecta para ejercicios de espalda y cardio. Diseño ergonómico y ajustable.'),
	('MyProtein Chocolate','./imagenes/chocolate.jpg', 14.99, 300, 4, 10,'Proteína en polvo de sabor chocolate, marca MyProtein. Ideal para la recuperación muscular y apoyo nutricional.'),
	('Whey Vainilla','./imagenes/proteinavanila.jpg', 14.99, 300, 4, 10,'Proteína de suero de sabor vainilla. Excelente suplemento para aumentar la masa muscular y la energía.'),
	('Creatina Monohidrato 500g','./imagenes/creatina500.jpg', 24.99, 50, 4, 11,'Suplemento de creatina monohidrato en formato de 500mg, ideal para mejorar el rendimiento deportivo y la ganancia muscular. Aumenta la energía y la fuerza en entrenamientos intensivos.'),
	('Creatina Monohidrato 1kg','./imagenes/creatina1000.jpg', 14.99, 300, 4, 11,'Bote grande de 1kg de creatina monohidrato, excelente para el desarrollo muscular y la resistencia. Proporciona un apoyo energético sostenido durante el ejercicio.'),
	('Pre-Entreno MyProtein','./imagenes/preentreno.jpg', 14.99, 300, 4, 12,'Fórmula avanzada de pre-entreno de la marca MyProtein. Diseñada para maximizar la energía, enfoque y rendimiento durante el entrenamiento. Contiene ingredientes clave como cafeína y aminoácidos para un impulso efectivo antes del ejercicio.'),
	('Pre-Entreno Million','./imagenes/lambo.png', 14.99, 300, 4, 12,'Suplemento pre-entrenamiento Million, formulado para aumentar la energía y la concentración. Ideal para quienes buscan un extra en sus rutinas de ejercicio, mejorando tanto la resistencia como la intensidad del entrenamiento. Compatible con diversas disciplinas deportivas.');

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

CREATE TABLE Favoritos (
    UsuarioID INT NOT NULL,
    ProductoID INT NOT NULL,
    PRIMARY KEY (UsuarioID, ProductoID),
    FOREIGN KEY (UsuarioID) REFERENCES Usuarios(ID),
    FOREIGN KEY (ProductoID) REFERENCES Productos(ID)
);
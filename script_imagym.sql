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
	


DROP TABLE IF EXISTS Usuarios, Categorias, Generos, Productos, Facturas, ProductosEnFacturas CASCADE;

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
    ('Camiseta Nike','./imagenes/nike.png', 29.99, 100, 1, 1),
    ('Camiseta Million','./imagenes/million.png', 39.99, 75, 1, 1),
    ('Pantalón Adidas','./imagenes/adidas.png', 24.99, 50, 1, 2),
    ('Pantalón Joma','./imagenes/joma.png', 19.99, 15, 1, 2),
    ('Zapatillas Asics','./imagenes/asics.png', 69.99, 20, 1, 3),
    ('Zapatillas Nike','./imagenes/nikeShoes.png', 79.99, 10, 1, 3),
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
    FOREIGN KEY (FacturaID) REFERENCES Facturas(ID),
    FOREIGN KEY (ProductoID) REFERENCES Productos(ID)
);
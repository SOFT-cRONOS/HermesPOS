CREATE USER 'hermespos'@'localhost' IDENTIFIED BY 'Cronos71@';
CREATE DATABASE hermespos_db;
GRANT ALL PRIVILEGES ON hermespos_db.* TO 'hermespos'@'localhost';

CREATE TABLE usuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    idrol INT,
    nick VARCHAR(20),
    documento VARCHAR(20),
    nombre VARCHAR(100),
    direccion VARCHAR(70),
    telefono VARCHAR(20),
    email VARCHAR(50),
    contrasena VARCHAR(20),
    estado VARCHAR(10),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
)

CREATE TABLE rol (
    idrol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10),
    detalle VARCHAR(255)
)

CREATE TABLE permisos (
    idpermiso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20),
    detalle VARCHAR(255)
)

CREATE TABLE asig_permisos (
    idrol INT KEY,
    idpermiso INT,
    FOREIGN KEY (idrol) REFERENCES rol(idrol) ON DELETE CASCADE,
    FOREIGN KEY (idpermiso) REFERENCES permisos(idpermiso)
)

CREATE TABLE articulo (
    idarticulo INT AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT,
    codigo VARCHAR(50),
    nombre VARCHAR(100),
    precio_venta DECIMAL(11,2),
    precio_compra DECIMAL(11,2),
    ganancia INT,
    stock INT,
    descripcion VARCHAR(255),
    imagen VARCHAR(20),
    estado BIT,
    compuesto BOOLEAN,
    FOREIGN KEY (idcategoria) REFERENCES categoria(idcategoria)
)

CREATE TABLE articulos_compuestos (
    idarticulo INT KEY,
    idcomponente INT,
    cantidad INT,
    FOREIGN KEY (idarticulo) REFERENCES articulo(idarticulo),
    FOREIGN KEY (idcomponente) REFERENCES articulo(idarticulo)
)

CREATE TABLE variante_producto (
    id_variante INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    codigo INT,
    nombre varchar(100),
    precio_venta DECIMAL(11,2),
    precio_compra DECIMAL(11,2),
    ganancia INT,
    stock INT,
    descripcion VARCHAR(255),
    imagen VARCHAR(20),
    estado BIT
    FOREIGN KEY (id_producto) REFERENCES articulo(idarticulo)
)

CREATE TABLE categoria (
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    detalle VARCHAR(255),
    estado BIT
)

CREATE TABLE proveedor (
    idproveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    direccion VARCHAR(100),
    telefono VARCHAR(100),
    empresa VARCHAR(100),
    web VARCHAR(100)
)

CREATE TABLE ingreso (
    idingreso INT AUTO_INCREMENT PRIMARY KEY,
    idproveedor INT KEY,
    idusuario INT,
    tipo_comprobante VARCHAR(20),
    serie_comprobante VARCHAR(7),
    num_comprobante VARCHAR(10),
    fecha DATE,
    impuesto DECIMAL(4,2),
    total DECIMAL(11,2),
    estado VARCHAR(20),
    FOREIGN KEY (idproveedor) REFERENCES proveedor(idproveedor),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
)

CREATE TABLE detalle_ingreso (
    iddetalle_ingreso INT AUTO_INCREMENT PRIMARY KEY,
    idingreso INT KEY,
    cantidad INT,
    idarticulo INT,
    link VARCHAR(255),
    precio DECIMAL(11,2),
    FOREIGN KEY (idingreso) REFERENCES ingreso(idingreso),
    FOREIGN KEY (idarticulo) REFERENCES articulo(idarticulo)
)

CREATE TABLE cliente (
    idcliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    documento VARCHAR(20) UNIQUE,
    direccion VARCHAR(70),
    telefono VARCHAR(20),
    email VARCHAR(50) UNIQUE,
    empresa VARCHAR(30)
)

CREATE TABLE tipo_pago (
    idtipopago INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10),
    detalle VARCHAR(50)
)

CREATE TABLE transaccion (
    
)
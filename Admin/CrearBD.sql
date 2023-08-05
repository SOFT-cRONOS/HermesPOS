CREATE USER 'admin'@'localhost' IDENTIFIED BY 'Cronos71@';
CREATE DATABASE hermespos;
GRANT ALL PRIVILEGES ON hermespos.* TO 'admin'@'localhost';


CREATE TABLE rol (
    idrol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10),
    detalle VARCHAR(255)
);

INSERT INTO rol (nombre, detalle)
VALUES ('admin', 'tiene control total sobre la aplicacion y los datos');


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
);

INSERT INTO usuario (idrol, nick, documento, nombre, direccion, telefono, email, contrasena, estado)
VALUES (1, 'admin', '1234', 'Administrador','Dirección', 'hermespos', 'usuario1@example.com', 'hermespos', 'activo');


CREATE TABLE permisos (
    idpermiso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20),
    detalle VARCHAR(255)
);

INSERT INTO permisos (nombre, detalle)
VALUES ('editar', 'Ver y agregar nuevos productos y clientes');


CREATE TABLE asig_permisos (
    idrol INT,
    idpermiso INT,
    INDEX idrol_index (idrol),
    FOREIGN KEY (idrol) REFERENCES rol(idrol) ON DELETE CASCADE,
    FOREIGN KEY (idpermiso) REFERENCES permisos(idpermiso)
);

INSERT INTO asig_permisos (idrol, idpermiso)
VALUES (1,1);

CREATE TABLE categoria (
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    detalle VARCHAR(255),
    estado BIT
);

INSERT INTO categoria (nombre, detalle, estado)
VALUES ('varios', 'productos varios',0);


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
);

INSERT INTO articulo (idcategoria, codigo, nombre, precio_venta, precio_compra, ganancia, stock, descripcion, imagen, estado, compuesto)
VALUES (1, '0101', 'Prueba', 200, 100, 100, 1, 'producto de prueba', 'prueba.jpg',0, 0);

CREATE TABLE articulos_compuestos (
    idarticulo INT,
    idcomponente INT,
    cantidad INT,
    INDEX idarticulo_index (idarticulo),
    FOREIGN KEY (idarticulo) REFERENCES articulo(idarticulo),
    FOREIGN KEY (idcomponente) REFERENCES articulo(idarticulo)
);

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
    estado BIT,
    FOREIGN KEY (id_producto) REFERENCES articulo(idarticulo)
);



CREATE TABLE proveedor (
    idproveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    direccion VARCHAR(100),
    telefono VARCHAR(100),
    empresa VARCHAR(100),
    web VARCHAR(100)
);

CREATE TABLE ingreso (
    idingreso INT AUTO_INCREMENT PRIMARY KEY,
    idproveedor INT,
    idusuario INT,
    tipo_comprobante VARCHAR(20),
    serie_comprobante VARCHAR(7),
    num_comprobante VARCHAR(10),
    fecha DATE,
    impuesto DECIMAL(4,2),
    total DECIMAL(11,2),
    estado VARCHAR(20),
    INDEX idproveedor_index (idproveedor),
    FOREIGN KEY (idproveedor) REFERENCES proveedor(idproveedor),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario)
);

CREATE TABLE detalle_ingreso (
    iddetalle_ingreso INT AUTO_INCREMENT PRIMARY KEY,
    idingreso INT,
    cantidad INT,
    idarticulo INT,
    link VARCHAR(255),
    precio DECIMAL(11,2),
    FOREIGN KEY (idingreso) REFERENCES ingreso(idingreso),
    FOREIGN KEY (idarticulo) REFERENCES articulo(idarticulo)
);

CREATE TABLE cliente (
    idcliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    documento VARCHAR(20) UNIQUE,
    direccion VARCHAR(70),
    telefono VARCHAR(20),
    email VARCHAR(50) UNIQUE,
    empresa VARCHAR(30)
);

CREATE TABLE tipo_pago (
    idtipopago INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10),
    detalle VARCHAR(50)
);

CREATE TABLE transaccion (
    idtransaccion INT AUTO_INCREMENT PRIMARY KEY,
    idcliente INT,
    tipo_comprobante VARCHAR(20),
    serie_comprobante VARCHAR(20),
    fecha_venta DATE,
    fecha_pedido DATE,
    idimpuesto INT,
    iddescuentoa INT,
    descuento INT,
    pago DECIMAL(11,2),
    total DECIMAL(11,2),
    idtipo_pago INT,
    estado VARCHAR(20),
    estado_pago VARCHAR(20),
    FOREIGN KEY (idtipo_pago) REFERENCES tipo_pago(idtipopago)
);

CREATE TABLE pagos (
    idpago INT AUTO_INCREMENT PRIMARY KEY,
    idtransaccion INT,
    tipo_pago VARCHAR(20),
    monto DECIMAL(11, 2),
    fecha_pago DATE,
    FOREIGN KEY (idtransaccion) REFERENCES transaccion(idtransaccion)
)

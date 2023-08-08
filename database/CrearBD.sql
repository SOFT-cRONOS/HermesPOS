CREATE USER 'admin'@'localhost' IDENTIFIED BY 'Cronos71@';
CREATE DATABASE hermespos;
GRANT ALL PRIVILEGES ON hermespos.* TO 'admin'@'localhost';

USE hermespos;

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
INSERT INTO categoria (nombre, detalle, estado)
VALUES ('insumos', 'Insumos de impresion, manualidades y mas',0);
INSERT INTO categoria (nombre, detalle, estado)
VALUES ('vinilo', 'vinilos de corte, estampado',0);


CREATE TABLE clase_articulo (
    idarticulo INT AUTO_INCREMENT PRIMARY KEY,
    idcategoria INT,
    codigo VARCHAR(50),
    nombre VARCHAR(100),
    stock INT,
    descripcion VARCHAR(255),
    estado BIT,
    margena BOOLEAN,
    FOREIGN KEY (idcategoria) REFERENCES categoria(idcategoria)
);

INSERT INTO clase_articulo (idcategoria, codigo, nombre, stock, descripcion, estado)
VALUES (1, '0101', 'Prueba', 200, 'producto de prueba',0);

INSERT INTO clase_articulo (idcategoria, codigo, nombre, stock, descripcion, estado)
VALUES (2, '0101', 'Vinilo 651', 3, 'Vinilo Corte oracal', 0);


CREATE TABLE variante_articulo (
    id_variante INT AUTO_INCREMENT PRIMARY KEY,
    idarticulo INT,
    codigo INT,
    nombre varchar(100),
    precio_venta DECIMAL(11,2),
    precio_compra DECIMAL(11,2),
    ganancia INT,
    stock INT,
    descripcion VARCHAR(255),
    imagen VARCHAR(255),
    estado BIT,
    compuesto BIT,
    FOREIGN KEY (id_articulo) REFERENCES clase_articulo(idarticulo)
);

INSERT INTO variante_articulo (id_articulo, codigo, nombre, precio_compra, precio_venta, ganancia, stock, descripcion, imagen, compuesto)
VALUES (1, '01012', '651 rojo', 400, 500, 10, 2, 'vinilo color rojo', 'https://d2r9epyceweg5n.cloudfront.net/stores/093/039/products/367-011-32ca22a9eadc5a027e15126313793897-480-0.jpg',0);



CREATE TABLE articulos_compuestos (
    idarticulo INT,
    idcomponente INT,
    cantidad INT,
    INDEX idarticulo_index (idarticulo),
    FOREIGN KEY (idarticulo) REFERENCES variante_articulo(id_variante),
    FOREIGN KEY (idcomponente) REFERENCES variante_articulo(id_variante)
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
    FOREIGN KEY (idarticulo) REFERENCES variante_articulo(id_variante)
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

INSERT INTO cliente (nombre, documento, direccion, telefono, email, empresa)
VALUES ('Tester', '213123', 'barrio test 321', '23123123','test.teste@gmail.com', 'la tester')

CREATE TABLE tipo_pago (
    idtipopago INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10),
    detalle VARCHAR(50)
);

INSERT INTO tipo_pago (nombre, detalle)
VALUES ('efectivo', 'pago en efectivo billete fisico');

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

INSERT INTO transaccion (idcliente, fecha_venta, fecha_pedido, pago, total, idtipo_pago, estado, estado_pago)
VALUES (1, '2023/08/06', '2023/08/05', '2000', '2000', 1, 'finalizada', 'pagado');
INSERT INTO transaccion (idcliente, fecha_venta, fecha_pedido, pago, total, idtipo_pago, estado, estado_pago)
VALUES (1,NULL, '2023/08/06', '500', '1500', 1, 'terminado', 'parcial');
INSERT INTO transaccion (idcliente, fecha_venta, fecha_pedido, pago, total, idtipo_pago, estado, estado_pago)
VALUES (1,NULL, '2023/08/07', '500', '1500', 1, 'pendiente', 'parcial');
INSERT INTO transaccion (idcliente, fecha_venta, fecha_pedido, pago, total, idtipo_pago, estado, estado_pago)
VALUES (1,NULL, '2023/08/07', '200', '10000', 1, 'pendiente', 'parcial');

CREATE TABLE detalle_transaccion (
    idventa INT,
    id_variante INT,
    cantidad INT,
    precio decimal(11,2),
    descuento decimal(11,2),
    FOREIGN KEY (idventa) REFERENCES transaccion(idtransaccion),
    FOREIGN KEY (id_variante) REFERENCES variante_articulo(id_variante)
);

INSERT INTO detalle_transaccion (idventa, id_variante, cantidad, precio, descuento)
VALUES (3, 1, 1, 200,0);


CREATE TABLE pagos (
    idpago INT AUTO_INCREMENT PRIMARY KEY,
    idtransaccion INT,
    tipo_pago VARCHAR(20),
    monto DECIMAL(11, 2),
    fecha_pago DATE,
    FOREIGN KEY (idtransaccion) REFERENCES transaccion(idtransaccion)
);

CREATE TABLE alertas (
    idalerta INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50),
    mensaje VARCHAR(255),
    fecha_creacion DATE
);

DELIMITER //

CREATE PROCEDURE GetLogUser(IN htmlnick VARCHAR(20), IN htmlpass VARCHAR(20))
BEGIN
    SELECT * FROM usuario WHERE nick = htmlnick AND contrasena = htmlpass;
END //

DELIMITER ;


CREATE TABLE usuarios (
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
    nombre INT,
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
    compuesto BOOLEAN
)

CREATE TABLE asticulos_compuestos (
    idarticulo INT KEY,
    idcomponente INT,
    cantidad INT
)
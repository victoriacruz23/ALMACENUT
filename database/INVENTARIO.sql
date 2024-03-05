CREATE DATABASE inventario;
use inventario;
CREATE TABLE areas (
    id_area INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100)
);

CREATE TABLE producto (
    id_producto INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    imagen VARCHAR(255),
    clave VARCHAR(20) NOT NULL,
    area_id INT,
    nombrepro VARCHAR(100) NOT NULL,
    caracteristicas VARCHAR(100),
    marca VARCHAR(50),
    modelo VARCHAR(50),
    numserie VARCHAR(20),
    estado ENUM('Bueno', 'Dañado') NOT NULL DEFAULT 'Bueno',
    existenciaIni INT NOT NULL DEFAULT 0,
    observaciones VARCHAR(100),
    stock INT NOT NULL DEFAULT 0,
    entrada INT NOT NULL DEFAULT 0,
    salida INT NOT NULL DEFAULT 0,
    FOREIGN KEY (area_id) REFERENCES areas(id_area)
);

CREATE TABLE bajas(
    id_baja INT PRIMARY KEY AUTO_INCREMENT,
    producto_id INT,
    cantidad INT,
    fecha_baja DATE,
    FOREIGN KEY (producto_id) REFERENCES producto(id_producto)
);

CREATE TABLE rol (
    id_rol INT PRIMARY KEY AUTO_INCREMENT,
    rol VARCHAR(100)
);
INSERT INTO Rol (rol)
VALUES ('Almacenista'), ('Alumnos');

CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido_p VARCHAR(150),
    correo VARCHAR(100),
    contrasena VARCHAR(100),
    rol_id INT,
    imagen VARCHAR(255),
    FOREIGN KEY (rol_id) REFERENCES rol(id_rol)
);

CREATE TABLE compra (
    id_compra INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT,
    fecha_compra DATE,
    total DECIMAL(10, 2),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id_usuario)
);

CREATE TABLE detalleCompra (
    compra_id INT,
    producto_id INT,
    cantidad INT,
    PRIMARY KEY (compra_id, producto_id),
    FOREIGN KEY (compra_id) REFERENCES compra(id_compra),
    FOREIGN KEY (producto_id) REFERENCES producto(id_producto)
);

CREATE TABLE pago (
    id_pago INT PRIMARY KEY AUTO_INCREMENT,
    usuario INT,
    producto_id INT,
    fecha_pago DATE,
    cantidad_pagada DECIMAL(10, 2),
    FOREIGN KEY (producto_id) REFERENCES producto(id_producto),
    FOREIGN KEY (usuario) REFERENCES usuario(id_usuario)
);

CREATE TABLE requisicion (
    id_requisicion INT PRIMARY KEY AUTO_INCREMENT,
    fecha_elaboracion DATE,
    fecha_entrega DATE,
    fecha_devolucion DATE,
    estado ENUM('pendiente', 'entregada') NOT NULL DEFAULT 'pendiente',
    devuelto BOOLEAN,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id_usuario)
);

CREATE TABLE detalleRequisicion (
    requisicion_id INT,
    producto_id INT,
    cantidad INT,
    PRIMARY KEY (requisicion_id, producto_id),
    FOREIGN KEY (requisicion_id) REFERENCES requisicion(id_requisicion),
    FOREIGN KEY (producto_id) REFERENCES producto(id_producto)
);

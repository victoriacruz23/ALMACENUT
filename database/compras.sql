CREATE database compras;
use compras;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    contrasena VARCHAR(100)
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(10, 2)
);

CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha DATE,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE detalles_compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_compra INT,
    id_producto INT,
    cantidad INT,
    FOREIGN KEY (id_compra) REFERENCES compras(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);
INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?), ('usuario1','usuario1@gmail.com', 'contraseña1')
INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?), ('usuario2','usuario2@gmail.com', 'contraseña2')
INSERT INTO productos (nombre, precio) VALUES (?, ?), ('Producto A', 10.99)
INSERT INTO productos (nombre, precio) VALUES (?, ?), ('Producto B', 20.49)
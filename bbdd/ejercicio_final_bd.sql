CREATE DATABASE IF NOT EXISTS ejercicio_final_bd;
USE ejercicio_final_bd;



CREATE TABLE users_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255) NOT NULL UNIQUE,
    sexo ENUM('masculino', 'femenino') NOT NULL,
    
    password VARCHAR(255) NOT NULL
);




CREATE TABLE users_login (
    idLogin INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL UNIQUE,
    usuario VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'user')NOT NULL,
    FOREIGN KEY (idUser) REFERENCES users_data(idUser)
);

CREATE TABLE citas (
    idCita INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    fecha_cita DATE NOT NULL,
    motivo_cita TEXT,
    FOREIGN KEY (idUser) REFERENCES users_data(idUser)
);

CREATE TABLE noticias (
    idNoticia INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) UNIQUE NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    texto TEXT NOT NULL,
    fecha DATE NOT NULL,
    idUser INT NOT NULL,
    FOREIGN KEY (idUser) REFERENCES users_data(idUser)
);
ALTER TABLE users_login ADD COLUMN nombre VARCHAR(50);
ALTER TABLE users_login ADD COLUMN apellidos VARCHAR(50);
ALTER TABLE users_login ADD COLUMN fecha_nacimiento DATE;
ALTER TABLE users_login ADD COLUMN direccion VARCHAR(80);
ALTER TABLE users_login ADD COLUMN telefono VARCHAR(15);
ALTER TABLE users_login ADD COLUMN email VARCHAR(50);
ALTER TABLE users_login ADD COLUMN sexo ENUM('masculino', 'femenino');
ALTER TABLE users_login ADD COLUMN password VARCHAR(255);
ALTER TABLE users_login ADD COLUMN rol ENUM('user', 'admin') DEFAULT 'user';

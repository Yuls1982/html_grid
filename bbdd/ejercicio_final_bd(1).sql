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
    FOREIGN KEY (idUser) REFERENCES users_data(id)
);

CREATE TABLE citas (
    idCita INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    fecha_cita DATE NOT NULL,
    motivo_cita TEXT,
    
    FOREIGN KEY (idUser) REFERENCES users_data(id)
);

CREATE TABLE noticias (
    idNoticia INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) UNIQUE NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    texto TEXT NOT NULL,
    fecha DATE NOT NULL,
    idUser INT NOT NULL,
    FOREIGN KEY (idUser) REFERENCES users_data(id);
);
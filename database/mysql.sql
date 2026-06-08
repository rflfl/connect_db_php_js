CREATE DATABASE IF NOT EXISTS imobiliariadb;
USE imobiliariadb;

CREATE TABLE IF NOT EXISTS registros (
    codigo INT PRIMARY KEY,
    subtipo VARCHAR(100) NOT NULL,
    destaque VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_reg INT NOT NULL,
    link_thumb VARCHAR(255) NOT NULL,
    flag TINYINT(1) NOT NULL DEFAULT 0,
    CONSTRAINT fk_images_registros
        FOREIGN KEY (codigo_reg) REFERENCES registros(codigo)
);

INSERT INTO registros (codigo, subtipo, destaque) VALUES
    (1001, 'Apartamento', 'Destaque'),
    (1002, 'Casa', 'Destaque'),
    (1003, 'Terreno', 'Normal');

INSERT INTO images (codigo_reg, link_thumb, flag) VALUES
    (1001, 'https://picsum.photos/id/1018/320/180', 0),
    (1002, 'https://picsum.photos/id/1025/320/180', 0),
    (1003, 'https://picsum.photos/id/1036/320/180', 1);

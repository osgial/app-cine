-- Base de datos de Cine
CREATE DATABASE IF NOT EXISTS cine CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cine;

-- Tabla de películas
CREATE TABLE IF NOT EXISTS peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    director VARCHAR(255) NOT NULL,
    nota DECIMAL(2,1) NOT NULL,
    ano INT NOT NULL,
    presupuesto INT NOT NULL,
    imagen_base64 TEXT,
    url_trailer VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo
INSERT INTO peliculas (titulo, director, nota, ano, presupuesto, url_trailer) VALUES
('Star Wars The Force Awakens', 'JJ Abrams', 6.7, 2015, 552, 'https://www.youtube.com/watch?v=sGbxmsDFVnE'),
('Jurassic World Fallen Kingdom', 'JA Bayona', 5.6, 2018, 503, 'https://www.youtube.com/watch?v=vn9mMeWcgoM'),
('Pirates of the Caribbean On Stranger Tides', 'Rob Marshall', 5.4, 2011, 492, 'https://www.youtube.com/watch?v=KY0CJkJHRGw'),
('Star Wars The Rise of Skywalker', 'JJ Abrams', 5.6, 2019, 476, 'https://www.youtube.com/watch?v=8Qn_spdM5Zg'),
('Avengers Age Of Ultron', 'Joss Whedon', 6.3, 2015, 451, 'https://www.youtube.com/watch?v=tmeOjFno6Do'),
('Pirates of the Caribbean At Worlds End', 'Gore Verbinski', 6.1, 2007, 423, 'https://www.youtube.com/watch?v=HKSZtp_OGHY');

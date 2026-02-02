<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Películas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        thead {
            background-color: #f8f8f8;
            border-bottom: 2px solid #ddd;
        }

        th {
            padding: 15px 10px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 0.9em;
        }

        td {
            padding: 15px 10px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .poster {
            width: 80px;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .trailer-link {
            color: #0066cc;
            text-decoration: none;
            font-size: 0.9em;
        }

        .trailer-link:hover {
            text-decoration: underline;
        }

        .id-cell {
            font-weight: 600;
            color: #666;
        }

        .nota {
            font-weight: 600;
            color: #ff9800;
        }

        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Listado de Películas</h1>

    <?php
    // Configuración de la base de datos
    $host = 'localhost';
    $dbname = 'cine';
    $username = 'root';
    $password = '';

    try {
        // Conexión a la base de datos
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obtener todas las películas
        $sql = "SELECT id, titulo, director, nota, ano, presupuesto, url_trailer FROM peliculas ORDER BY id ASC";
        $stmt = $pdo->query($sql);
        $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // URLs de imágenes de ejemplo (Base64 sería muy largo, usamos URLs externas)
        $imagenes = [
            1 => 'https://m.media-amazon.com/images/M/MV5BOTAzODEzNDAzMl5BMl5BanBnXkFtZTgwMDU1MTgzNzE@._V1_FMjpg_UX1000_.jpg',
            2 => 'https://m.media-amazon.com/images/M/MV5BNzIxMjYwNDEwN15BMl5BanBnXkFtZTgwMzk5MDI3NTM@._V1_.jpg',
            3 => 'https://m.media-amazon.com/images/M/MV5BMjE5MjkwODI3Nl5BMl5BanBnXkFtZTcwNjcwMDk4NA@@._V1_.jpg',
            4 => 'https://m.media-amazon.com/images/M/MV5BMDljNTQ5ODItZmQwMy00M2ExLTljOTQtZTVjNGE2NTg0NGIxXkEyXkFqcGdeQXVyODkzNTgxMDg@._V1_.jpg',
            5 => 'https://m.media-amazon.com/images/M/MV5BMTM4OGJmNWMtOTM4Ni00NTE3LTg3MDItZmQxYjc4N2JhNmUxXkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_.jpg',
            6 => 'https://m.media-amazon.com/images/M/MV5BMjIyNjkxNzEyMl5BMl5BanBnXkFtZTYwMjc3MDE3._V1_.jpg'
        ];

        if (count($peliculas) > 0) {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Título</th>';
            echo '<th>Director</th>';
            echo '<th>Nota</th>';
            echo '<th>Año</th>';
            echo '<th>Presupuesto</th>';
            echo '<th>Imagen (Base64)</th>';
            echo '<th>URL del Trailer</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($peliculas as $pelicula) {
                echo '<tr>';
                echo '<td class="id-cell">' . htmlspecialchars($pelicula['id']) . '</td>';
                echo '<td>' . htmlspecialchars($pelicula['titulo']) . '</td>';
                echo '<td>' . htmlspecialchars($pelicula['director']) . '</td>';
                echo '<td class="nota">' . htmlspecialchars($pelicula['nota']) . '</td>';
                echo '<td>' . htmlspecialchars($pelicula['ano']) . '</td>';
                echo '<td>' . htmlspecialchars($pelicula['presupuesto']) . '</td>';
                
                // Mostrar imagen
                $id = $pelicula['id'];
                if (isset($imagenes[$id])) {
                    echo '<td><img src="' . htmlspecialchars($imagenes[$id]) . '" alt="Poster" class="poster"></td>';
                } else {
                    echo '<td>-</td>';
                }
                
                // Mostrar enlace al trailer
                if (!empty($pelicula['url_trailer'])) {
                    echo '<td><a href="' . htmlspecialchars($pelicula['url_trailer']) . '" target="_blank" class="trailer-link">Ver Trailer</a></td>';
                } else {
                    echo '<td>-</td>';
                }
                
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No hay películas en la base de datos.</p>';
        }

    } catch(PDOException $e) {
        echo '<div class="error">';
        echo '<strong>Error de conexión:</strong> ' . htmlspecialchars($e->getMessage());
        echo '<br><br>';
        echo '<strong>Instrucciones:</strong><br>';
        echo '1. Asegúrate de que MySQL/MariaDB esté ejecutándose<br>';
        echo '2. Importa el archivo cine.sql: <code>mysql -u root -p &lt; mysql/cine.sql</code><br>';
        echo '3. Verifica las credenciales de conexión en index.php';
        echo '</div>';
    }
    ?>

</body>
</html>

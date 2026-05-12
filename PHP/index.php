<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Taller 2 - Gestor de Imágenes</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>

<div class="container">
    <h2>Galería Dinámica</h2>

    <div class="upload-section">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="imagen" required>
            <button type="submit" name="subir">Subir Imagen</button>
        </form>
    </div>

    <div class="carousel" id="carousel">
        <?php
        $directorio = "../uploads/";
        if (!is_dir($directorio)) mkdir($directorio, 0777, true);
        $imagenes = glob($directorio . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        
        foreach ($imagenes as $index => $img) {
            $active = ($index == 0) ? 'active' : '';
            echo "<div class='slide $active'>
                    <img src='$img' class='$active' data-src='$img'>
                  </div>";
        }
        ?>
    </div>
    
    <div class="controls">
        <button onclick="mover(-1)">Anterior</button>
        <button onclick="mover(1)">Siguiente</button>
        <button onclick="eliminarActiva()" style="background:red; color:white;">Eliminar Imagen</button>
    </div>

    <form id="deleteForm" action="upload.php" method="POST" style="display:none;">
        <input type="hidden" name="archivo" id="archivoInput">
        <input type="hidden" name="eliminar" value="1">
    </form>
</div>

<script src="../scripts.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Taller 2 - Gestor de Imágenes</title>
    <link rel="stylesheet" href="estilos.css">
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
        $directorio = "uploads/";
        if (!is_dir($directorio)) mkdir($directorio, 0777, true);
        $imagenes = glob($directorio . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        
        foreach ($imagenes as $index => $img) {
            $active = ($index == 0) ? 'active' : '';
            echo "<div class='slide $active'>
                    <img src='$img' class='$active'>
                    <form action='upload.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='archivo' value='$img'>
                        <button type='submit' name='eliminar' style='background:red; color:white;'>Eliminar</button>
                    </form>
                  </div>";
        }
        ?>
    </div>
    
    <div class="controls">
        <button onclick="mover(-1)">Anterior</button>
        <button onclick="mover(1)">Siguiente</button>
    </div>
</div>

<script>
    let indice = 0;
    function mover(paso) {
        const slides = document.querySelectorAll('.carousel img');
        if (slides.length === 0) return;
        slides[indice].classList.remove('active');
        indice = (indice + paso + slides.length) % slides.length;
        slides[indice].classList.add('active');
    }
    // Auto-play opcional
    setInterval(() => mover(1), 5000);
</script>

</body>
</html>
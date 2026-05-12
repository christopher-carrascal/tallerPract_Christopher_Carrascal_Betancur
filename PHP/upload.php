<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['subir'])) {
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['imagen']['tmp_name'];
            $fileName = $_FILES['imagen']['name'];
            $fileSize = $_FILES['imagen']['size'];
            $fileType = $_FILES['imagen']['type'];
            
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($fileType, $allowedTypes)) {
                header('Location: index.php?error=invalid_type');
                exit;
            }
            
            $imageInfo = getimagesize($fileTmpPath);
            if ($imageInfo === false) {
                header('Location: index.php?error=not_image');
                exit;
            }
            
            $uploadDir = '../uploads/';
            $destPath = $uploadDir . basename($fileName);
            
            if (file_exists($destPath)) {
                $fileName = time() . '_' . $fileName;
                $destPath = $uploadDir . $fileName;
            }
            
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                header('Location: index.php?success=uploaded');
                exit;
            } else {
                header('Location: index.php?error=upload_failed');
                exit;
            }
        } else {
            header('Location: index.php?error=no_file');
            exit;
        }
    } elseif (isset($_POST['eliminar'])) {
        if (isset($_POST['archivo'])) {
            $filePath = $_POST['archivo'];
            
            $uploadDir = '../uploads/';
            $realPath = realpath($uploadDir . basename($filePath));
            $realUploadDir = realpath($uploadDir);
            
            if ($realPath && strpos($realPath, $realUploadDir) === 0 && file_exists($realPath)) {
                if (unlink($realPath)) {
                    header('Location: index.php?success=deleted');
                    exit;
                } else {
                    header('Location: index.php?error=delete_failed');
                    exit;
                }
            } else {
                header('Location: index.php?error=invalid_path');
                exit;
            }
        } else {
            header('Location: index.php?error=no_path');
            exit;
        }
    }
}

header('Location: index.php');
exit;
?>

<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'Conexion.php';
	
	if(isset($_POST['btnsave']))
	{
		$username = $_POST['user_name'];// user name
		$userjob = $_POST['user_job'];// user email
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];	

		$imgFile2 = $_FILES['user_image2']['name'];
		$tmp_dir2 = $_FILES['user_image2']['tmp_name'];
		$imgSize2 = $_FILES['user_image2']['size'];

		if(empty($username)){
			$errMSG = "Ingrese la marca";
		}
		else if(empty($userjob)){
			$errMSG = "Ingrese el tipo.";
		}
		else if(empty($imgFile)){
			$errMSG = "Seleccione el archivo de imagen.";
		}
		else if(empty($imgFile2)){
			$errMSG2 = "Seleccione el archivo de imagen 2.";
		}
		else{
			$upload_dir = 'imagenes/'; // upload directory
			$upload_dir2 = 'imagenes/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$valid_extensions2 = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
			$userpic2 = rand(1000,1000000).".".$imgExt2;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '1MB'
				if($imgSize < 1000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Su archivo es muy grande.";
				}
			}
			else{
				$errMSG = "Solo archivos JPG, JPEG, PNG & GIF son permitidos.";		
			}
			// allow valid image file formats
			if(in_array($imgExt2, $valid_extensions2)){			
				// Check file size '1MB'
				if($imgSize2 < 1000000)				{
					move_uploaded_file($tmp_dir2,$upload_dir2.$userpic2);
				}
				else{
					$errMSG2 = "Su archivo es muy grande.";
				}
			}
			else{
				$errMSG2 = "Solo archivos JPG, JPEG, PNG & GIF son permitidos.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG)){
			$stmt = $DB_con->prepare('INSERT INTO tbl_imagenes(Imagen_Marca,Imagen_Tipo,Imagen_Img,Imagen_Img2) VALUES(:uname, :ujob, :upic, :upic)');
			$stmt->bindParam(':uname',$username);
			$stmt->bindParam(':ujob',$userjob);
			$stmt->bindParam(':upic',$userpic);

			
			if($stmt->execute())
			{
				$successMSG = "Nuevo registro insertado correctamente ...";
				header("refresh:3;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "Error al insertar ...";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Subir, Insertar, Actualizar, Borrar una imágen usando PHP y MySQL</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/jquery.min.js"></script>
</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> <a class="navbar-brand" href="index.php" title='Inicio' target="_blank">Inicio</a> </div>
  </div>
</div>
<div class="container">
  <div class="page-header">
    <h1 class="h3">Agregar nueva imágen. <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Mostrar todo </a></h1>
  </div>
  <?php
	if(isset($errMSG)){
			?>
  <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong> </div>
  <?php
	}
	else if(isset($successMSG)){
		?>
  <div class="alert alert-success"> <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong> </div>
  <?php
	}
	?>
  <form method="post" enctype="multipart/form-data" class="form-horizontal">
    <table class="table table-bordered table-responsive">
      <tr>
        <td><label class="control-label">Marca</label></td>
        <td><input class="form-control" type="text" name="user_name" placeholder="Ingrese la Marca" value="<?php echo $username; ?>" /></td>
      </tr>
      <tr>
        <td><label class="control-label">Modelo</label></td>
        <td><input class="form-control" type="text" name="user_job" placeholder="Ingrese el Modelo" value="<?php echo $userjob; ?>" /></td>
      </tr>
      <tr>
        <td><label class="control-label">Imágen.</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
      </tr>
      <tr>
        <td><label class="control-label">Imágen2.</label></td>
        <td><input class="input-group" type="file" name="user_image2" accept="image/*" /></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default"> <span class="glyphicon glyphicon-save"></span> &nbsp; Guardar Imagen </button></td>
      </tr>
    </table>
  </form>

</div>

<!-- Latest compiled and minified JavaScript --> 
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
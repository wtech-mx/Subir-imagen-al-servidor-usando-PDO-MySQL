<?php
error_reporting( ~E_NOTICE );	
require_once 'Conexion.php';

if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	$stmt_edit = $DB_con->prepare('SELECT Imagen_Marca, Imagen_Tipo, Imagen_Img, Imagen_Img2 FROM tbl_imagenes WHERE Imagen_ID =:uid');
	$stmt_edit->execute(array(':uid'=>$id));
	$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
	extract($edit_row);
}
else
{
	header("Location: index.php");
}	

if(isset($_POST['btn_save_updates']))
{
	$username = $_POST['user_name'];// user name
	$userjob = $_POST['user_job'];// user email
		
	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];

	$imgFile2 = $_FILES['user_image2']['name'];
	$tmp_dir2 = $_FILES['user_image2']['tmp_name'];
	$imgSize2 = $_FILES['user_image2']['size'];
				
	if($imgFile)
	{
		$upload_dir = 'imagenes/'; // upload directory	
		$upload_dir2 = 'imagenes/'; // upload directory

		$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		$imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension

		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		$valid_extensions2 = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

		$userpic = rand(1000,1000000).".".$imgExt;
		$userpic2 = rand(1000,1000000).".".$imgExt2;

			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '1MB'
				if($imgSize < 1000000){
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
		$stmt = $DB_con->prepare('UPDATE tbl_imagenes SET Imagen_Marca=:uname, Imagen_Tipo=:ujob, Imagen_Img=:upic, Imagen_Img2=:upic2 WHERE Imagen_ID=:uid');
		$stmt->bindParam(':uname',$username);
		$stmt->bindParam(':ujob',$userjob);
		$stmt->bindParam(':upic',$userpic);
		$stmt->bindParam(':uid',$id);
		$stmt->bindParam(':upic2',$userpic2);
			
		if($stmt->execute()){
			?>
<script>
			alert('Archivo editado correctamente ...');
			window.location.href='index.php';
			</script>
<?php
		}
		else{
			$errMSG = "Los datos no fueron actualizados !";
		}		
	}						
}	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Subir imagen al servidor usando PDO MySQL</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->

</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> <a class="navbar-brand" href="index.php" title='Inicio' target="_blank">Inicio</a> </div>
  </div>
</div>
<div class="container">
  <div class="page-header">
    <h1 class="h2">Actualización producto. <a class="btn btn-default" href="index.php"> Mostrar todos los modelos </a></h1>
  </div>
  <div class="clearfix"></div>

  <form method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php
	if(isset($errMSG)){
		?>
    <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?> </div>
    <?php
	}
	?>
    <table class="table table-bordered table-responsive">
      <tr>
        <td><label class="control-label">Marca.</label></td>
        <td><input class="form-control" type="text" name="user_name" value="<?php echo $Imagen_Marca; ?>" required /></td>
      </tr>
      <tr>
        <td><label class="control-label">Tipo.</label></td>
        <td><input class="form-control" type="text" name="user_job" value="<?php echo $Imagen_Tipo; ?>" required /></td>
      </tr>
      <tr>
        <td><label class="control-label">Imágen.</label></td>
        <td><p><img src="imagenes/<?php echo $Imagen_Img; ?>" height="150" width="150" /></p>
          <input class="input-group" type="file" name="user_image" accept="image/*" /></td>
      </tr>
      <tr>
        <td><label class="control-label">Imágen2.</label></td>
        <td><p><img src="imagenes/<?php echo $Imagen_Img2; ?>" height="150" width="150" /></p>
          <input class="input-group" type="file" name="user_image2" accept="image/*" /></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default"> <span class="glyphicon glyphicon-save"></span> Actualizar </button>
          <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancelar </a></td>
      </tr>
    </table>
  </form>

</div>
</body>
</html>
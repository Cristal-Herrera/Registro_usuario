<?php
include "config.php";

error_reporting(0);
session_start();



if(isset($_SESSION["username"]))
{
    header("Location: panel.php");
}


if(isset($_POST["submit"])){
    $username=$_POST["username"];
    $email=$_POST["email"];
    $name = ($_POST['name']);
    $password= md5($_POST["password"]);
    $cpassword= md5 ($_POST["cpassword"]);



    if($password==$cpassword){
        $sql="SELECT * FROM users WHERE email='$email'";
        $result= mysqli_query($conn, $sql);
        if(!$result->num_rows > 0){

            $sql="INSERT INTO users (username, name, email,password)
            VALUE ('$username', '$name','$email', '$password')";
            $result=mysqli_query($conn,$sql);

            if($result){

                echo "<script>alert('Usuario registrado con éxito')</script>";
                $username="";
                $email="";
                $name="";
                $_POST["password"]="";
                $_POST["cpassword"]="";

    
             }else{
                 echo "<script>alert('Hay un error')</script>";
            }

         }else{
             echo "<script>alert('El correo ya existe')</script>";
         }
     }else{
             echo "<script>alert('Las contraseñas no coinciden')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;1,700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="css/estilos.css">

	<title>Formulario de registro</title>
</head>
<body>
    <main>
        <h1>Registrate y recibe todas nuestra novedades en evento</h1>
    </main>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <h3 class="login-text">Registro de Usuario</h3>

			<div class="input-group mb-3">
                <label class="col-12 form-label">Usuario</label>
				<input type="text" placeholder="Usuario" class=" form-control" name="username" value="<?php echo $username; ?>" required>
			</div>
            <div class="input-group mb-3">
                <label class="col-12 form-label">Nombre y Apellido</label>
                <input type="text" placeholder="Nombre y Apellido" class="col-12 form-control" name="name" value="<?php echo $name; ?>" required>
            </div>
        
			<div class="input-group  mb-3 ">
                <label for="exampleInputEmail1" class="col-12 form-label">Email </label>
				<input type="email" placeholder="Email" class="col-12 form-control "  name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group mb-3">
                <label for="exampleInputEmail1" class="col-12 form-label">Contraseña</label>
				<input type="password" placeholder="Contraseña" class="form-control " name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group mb-3">
                <label for="exampleInputEmail1" class=" col-12 form-label">Repetir Contraseña</label>
				<input type="password" placeholder="Confirmar contraseña" class="form-control " name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
        
			<div class="input-group mb-12">
				<button name="submit" class="btn btn-success">Registrarme</button>
			</div>
		</form>



	</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
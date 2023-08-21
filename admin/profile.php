<?php
include 'includes/adminheader.php';
include 'includes/adminnav.php';

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username = '$username'" ; 
	$result= mysqli_query($sqlconnection , $query) or die (mysqli_error($sqlconnection));
	if (mysqli_num_rows($result) > 0 ) {
		$row = mysqli_fetch_array($result);
		$identificacion = $row['identificacion'];
		$userid= $row['id'];
		$usernm = $row['username'];
		$userpassword = $row['password'];
		$useremail = $row['email'];
		$userfirstname = $row['firstname'];
		$userlastname = $row['lastname'];

	}

	if (isset($_POST['update'])) {

		if (empty($_POST['newpassword'])) {
			$uderid= $_POST['userid'];
			$userfirstname = $_POST['firstname'];
			$identificacion=$_POST['identificacion'];
			$userlastname = $_POST['lastname'];
			$useremail = $_POST['email'];
			$updatequery1 = "UPDATE users SET identificacion='$identificacion',firstname = '$userfirstname' , lastname='$userlastname' , email='$useremail' WHERE id = '$userid' " ;
			$result2 = mysqli_query($sqlconnection , $updatequery1) or die(mysqli_error($sqlconnection));
			if (mysqli_affected_rows($sqlconnection) > 0) {
				echo "<script>alert('Perfil de Usuario Actualizado Satisfactoriamente');</script>";
			}
			else {
				echo "<script>alert('Ocurrió un error. Intente nuevamente!');</script>";
			}
		}
		else if (isset($_POST['newpassword']) &&  ($_POST['newpassword'] !== $_POST['confirmnewpassword'])) 
		{
			echo  "<center><font color='red'>Nueva contraseña y Confirmar nueva contraseña no coinciden </font></center>";
			
		}
		else {
			$userfirstname = $_POST['firstname'];
			$userlastname = $_POST['lastname'];
			$useremail = $_POST['email'];
			$pass = $_POST['newpassword'];
			$userpassword = password_hash("$pass" , PASSWORD_DEFAULT);
			

			$updatequery = "UPDATE users SET password = '$userpassword', firstname='$userfirstname' , lastname= '$userlastname' , email= '$useremail' WHERE id='$userid'";
			$result1 = mysqli_query($sqlconnection , $updatequery) or die(mysqli_error($sqlconnection));
			if (mysqli_affected_rows($sqlconnection) > 0) {
				echo "<script>alert('Perfil actualizado satisfactoriamente');</script>";
			}
			else {
				echo "<script>alert('Se produjo un error. Intenta nuevamente!');</script>";
			}
		}
	}
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Perfil</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Usuario</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle"
								src="img/<?php echo $logotipo_empresa; ?>"
								alt="User profile picture">
							</div>

							<h3 class="profile-username text-center"><?php echo $_SESSION['username']; ?></h3>

							<p class="text-muted text-center"><?php echo $_SESSION['firstname']; ?></p>

						
							
								<span  class=" btn btn-primary btn-block fa fa-fw fa-eye password-icon show-password "> Mostrar Contraseña</span>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->


					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">

								<li class="nav-item "><a class="nav-link active" href="#settings" data-toggle="tab">Configurar Perfil</a></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">


								<div class="active tab-pane" id="settings">
									<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
										<div class="form-group row">
											<label for="inputName" class="col-sm-2 col-form-label">Usuario</label>
											<div class="col-sm-10">
												<input type="hidden" name="userid" class="form-control" value="<?php echo $userid; ?>" readonly>
												<input type="text" name="username" class="form-control" value="<?php echo $username; ?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Identificación</label>
											<div class="col-sm-10">

												<input type="text" name="identificacion" class="form-control" value="<?php echo $identificacion; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Nombre</label>
											<div class="col-sm-10">

												<input type="text" name="firstname" class="form-control" value="<?php echo $userfirstname; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Correo </label>
											<div class="col-sm-10">

												<input type="email" name="email" class="form-control" value="<?php echo $useremail; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Contraseña Actual </label>
											<div class="col-sm-10">
												
												<input type="password" name="currentpassword" class="form-control password3" placeholder="Ingrese su actual contraseña"  required>
											</div>
										</div>

										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Nueva Contraseña </label>
											<div class="col-sm-10">
												<input type="password" name="newpassword" class="form-control password1" placeholder="Ingrese nueva contraseña">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Confirmar Contraseña </label>
											<div class="col-sm-10">
												<input type="password" name="confirmnewpassword" class="form-control password2" placeholder="Confirme su nueva contraseña" >

											</div>

										</div>



										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-success btn-block" name="update" value="Update User">Guardar Cambios</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>


<?php include ('includes/adminfooter.php');?>

		<script>
			window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword = document.querySelector('.show-password');
            showPassword.addEventListener('click', () => {

                // elementos input de tipo clave
                password3 = document.querySelector('.password3');
                password1 = document.querySelector('.password1');
                password2 = document.querySelector('.password2');

                if ( password1.type === "text" ) {
                	password1.type = "password"
                	password2.type = "password"
                	password3.type = "password"
                	showPassword.classList.remove('fa-eye-slash');
                } else {
                	password1.type = "text"
                	password2.type = "text"
                	password3.type = "text"
                	showPassword.classList.toggle("fa-eye-slash");
                }

            })

        });

    </script>








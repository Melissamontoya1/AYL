<?php include "includes/header.php" ?>

<div class="container">

 <!-- Outer Row -->
 <div class="row justify-content-center">
  <br>
  <div class=" col-xl-10 col-lg-12 col-md-9">

   <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body ">
     <!-- Nested Row within Card Body -->
     <div class="row">
      <div class="pt-5 col-lg-6 d-none d-lg-block">
       <br>
       <br>
       <br>
       <center>
        <img src="admin/img/logo.png" class="img-fluid pt-5 ">
       </center>

      </div>
      <div class="col-lg-6">
       <div class="card">
        <div class="card-header p-2">
         <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"></a></li>

         </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
         <div class="tab-content">
          <div class="active tab-pane" id="activity">
           <div class="pt-2">
            <div class="text-center">
             <h4 class=" mb-4 h4" style="color: black;">Ingresar al Sistema</h4>
            </div>
            <form method="POST" action="login.php" >
             <div class="">
              <input name="user_name" type="text" class="form-control" placeholder="Usuario" required>
              <br>
             </div>

             <div class="input-group">
              <input name="user_password" type="password" class="password1 form-control" placeholder="Contraseña" required>
              <br>
              <span class="input-group-btn btn btn-success fa fa-eye password-icon show-password col-md-2"></span>


             </div>
             <div class="pt-5 pb-5" >

              <button name="login" class="btn-block btn btn-primary" type="submit">
               <i class="fas fa-lg fa-sign-in-alt "></i> Ingresar
              </button>
             </div>
            </form>
            <hr>
            <div class="text-center">
             <a class="small" href="password.php">¿Olvidaste tu contraseña?</a>
            </div>

           </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
           <div class="pt-2">
            <div class="text-center">
             <h4 class=" mb-4 h4" style="color: black;">Contratistas</h4>
            </div>
            <form method="POST" action="login.php" >
             <div class="">
              <input name="id_contratista" type="text" class="form-control" placeholder="Identificacion" required>
              <br>
             </div>

             <div class="input-group">
              <input name="codigo_contratista" type="password" class="password1 form-control" placeholder="Contraseña" required>
              <br>
              <span class="input-group-btn btn btn-success fa fa-eye password-icon show-password col-md-2"></span>


             </div>
             <div class="pt-5 pb-5" >

              <button name="login" class="btn-block btn btn-primary" type="submit">
               <i class="fas fa-lg fa-sign-in-alt "></i> Ingresar
              </button>
             </div>
            </form>
            <hr>
            <div class="text-center">
             <a class="small" href="password.php">¿Olvidaste tu codigo?</a>
            </div>

           </div>
          </div>

         </div>
         <!-- /.tab-content -->
        </div><!-- /.card-body -->
       </div>

      </div>
     </div>
    </div>
   </div>

  </div>

 </div>

</div>

<?php include "includes/footer.php" ?>
<script>
 window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword = document.querySelector('.show-password');
            showPassword.addEventListener('click', () => {

                // elementos input de tipo clave
                password1 = document.querySelector('.password1');

                if ( password1.type === "text" ) {
                 password1.type = "password"
                 showPassword.classList.remove('fa-eye-slash');
                } else {
                 password1.type = "text"
                 showPassword.classList.toggle("fa-eye-slash");
                }

               })

           });

          </script>

         </body>

         </html>
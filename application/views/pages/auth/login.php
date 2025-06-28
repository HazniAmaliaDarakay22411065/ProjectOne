 <style>
     body {

         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
     }

     .login-container {
         background: white;
         padding: 30px;
         border-radius: 12px;
         box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
         display: flex;
         align-items: center;
         max-width: 700px;
         width: 90%;
         flex-direction: row;
     }

     .login-image {
         flex: 1;
         display: flex;
         justify-content: center;
         align-items: center;
         padding-right: 15px;
     }

     .login-image img {
         width: 70%;
     }

     .login-form {
         flex: 1;
         padding-left: 15px;
     }

     .input-group {
         display: flex;
         align-items: center;
         border: 1px solid #ced4da;
         border-radius: 20px;
         padding: 5px 12px;
         background: #f8f9fa;
     }

     .input-group i {
         font-size: 18px;
         color: gray;
         margin-right: 8px;
     }

     .form-control {
         border: none;
         outline: none;
         box-shadow: none;
         background: transparent;
         font-size: 14px;
     }

     .btn-login {
         border-radius: 20px;
         background-color: #007bff;
         color: white;
         font-size: 14px;
         padding: 10px;
     }

     .btn-login:hover {
         background-color: #0056b3;
     }

     a {
         color: #6ca0f5;
         font-size: 14px;
     }
 </style>
 <main>
     <section class="login-box" style="padding-top: 80px;">
         <?php $this->load->view('layouts/_alert') ?>
         <div class="login-container d-flex">

             <!-- Gambar di kiri -->
             <div class="login-image">
                 <img src="<?= base_url('/img/logo.png'); ?>" alt="Login Image">
             </div>

             <!-- Form Login di kanan -->
             <div class="login-form">
                 <h4 class="mb-3">Login Akun</h4>
                 <?= form_open('login', ['method' => 'POST']) ?>
                 <div class="mb-2">
                     <label for="email" class="form-label">E-Mail</label>
                     <div class="input-group">
                         <i class="bi bi-envelope-fill"></i>
                         <?= form_input(['type' => 'email', 'name' => 'email', 'value' => set_value('email'), 'class' => 'form-control', 'placeholder' => 'Masukkan alamat email', 'required' => true]) ?>
                     </div>
                     <?= form_error('email') ?>
                 </div>
                 <div class="mb-2">
                     <label for="password" class="form-label">Password</label>
                     <div class="input-group">
                         <i class="bi bi-lock-fill"></i>
                         <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Masukkan password', 'required' => true]) ?>
                         <!-- Icon mata untuk melihat password -->
                         <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                             <i class="bi bi-eye" id="eyeIcon"></i>
                         </span>
                     </div>
                     <?= form_error('password') ?>
                 </div>
                 <button type="submit" class="btn btn-login w-100 mt-2">Login</button>
                 <div class="text-center mt-2">
                     <a href="<?= base_url('register'); ?>">Belum punya akun? Registrasi di sini</a>
                 </div>
                 <?= form_close() ?>
             </div>
         </div>
 </main>
 <script>
     // Toggle Password Visibility
     const togglePassword = document.querySelector("#togglePassword");
     const passwordInput = document.querySelector("input[name='password']");
     const eyeIcon = document.getElementById("eyeIcon");

     togglePassword.addEventListener("click", function() {
         const type = passwordInput.type === "password" ? "text" : "password";
         passwordInput.type = type;

         // Toggle the eye icon
         eyeIcon.classList.toggle("bi-eye-slash");
     });
 </script>
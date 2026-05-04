<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/edit.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <title>welcome</title>
</head>
<body id="register">
    
    <div class="container-form">
        <div class="left-index">
            <div class="header">
                <h2 class="animation a1">Selamat Datang,</h2>
                    <h4 class="animation a2">Masuk Menggunakan Akun Anda Untuk Meng-akses Website Persediaan Barang.</h4>
            </div>

    <form method="post" id="login">
        <div class="form" >

          <input type="text" name="username" id="username" class="form-field animation a3" placeholder="Username">

          <div class="password">
            <input type="password" name="password" id="passwordInput" class="form-field animation a4" placeholder="Password">
                <div class="toggle-login a4">
                  <i class="fa-solid fa-eye animation a4" id="togglePassword"></i>
                </div>
          </div>
          <input type="submit" class="masuk" name="masuk" value="Masuk">

        </div>
            </div>
    </form>

 

    

    <div class="right-index">
    
    </div>

    
        
    </div>

<script src="assets/js/jquery-3.6.4.min.js"></script>


<script>
    // // register

    // let popup = document.getElementById("popup");
    // function openPopup() {
    //     popup.classList.add("open-popup");
    // }
    // function closePopup() {
    //     popup.classList.remove("open-popup");
    // }

    // // end of register



    
    
    // wrong password 
    $(document).ready(function () {
        $('#login').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: './koneksi/acclogin.php',
                data: data,
                success: function(response){
                    console.log(response.responseText)
                    if (response === "gagal") {
                        console.log("login gagal");
                        alert('Maaf Username atau Password yang anda masukan tidak sesuai!')
                    }else{
                        console.log("");
                        window.location.href = response; 
                    }    
                }
            })
        })
    })

    $(document).ready(function() {
  var passwordInput = $('#passwordInput');
  var togglePassword = $('#togglePassword');

  togglePassword.click(function() {
    var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
    passwordInput.attr('type', type);
    togglePassword.toggleClass('fa-eye fa-eye-slash');
  });
});



     // end of wrong password

</script>



</body>
</html>
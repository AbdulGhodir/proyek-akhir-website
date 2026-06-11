<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Baru</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="password-baru-page">
    <section class="card">
        <div class="left-side">
            <span class="title">Buat Password Baru</span>

            <form id="form-login" class="form" method="POST">
                <div class="input">
                    <label>Password</label>
                    <div class="input-field">
                        <i data-lucide="lock" class="icon" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                        <i data-lucide="eye" id="password-icon" class="icon-eye-password" style="width: 1.25rem; height: 1.25rem; color: gray;" onclick="tampilkanPassword('password', 'password-icon')"></i>
                    </div>
                </div>
                
                <div class="input">
                    <label>Konfirmasi Password</label>
                    <div class="input-field">
                        <i data-lucide="lock" class="icon" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="password" id="konfirmasi-password" name="konfirmasi_password" placeholder="Masukkan Password" required>
                        <i data-lucide="eye" id="konfirmasi-password-icon" class="icon-eye-password" style="width: 1.25rem; height: 1.25rem; color: gray;" onclick="tampilkanPassword('konfirmasi-password', 'konfirmasi-password-icon')"></i>
                    </div>
                </div>

                <button class="submit-button" type="submit" name="password_baru">Submit</button>
            </form>
        </div>

        <div class="rigth-side">
            <span class="title">Sudah Punya Akun?</span>
            <a href="<?= BASEURL; ?>/app/controllers/auth/login.php">Masuk</a>
        </div>
    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>

    <script>
        function tampilkanPassword(inputId, iconId) {
            const password = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (password.type === "password") {
                password.type = "text";
                icon.setAttribute("data-lucide", "eye-off");
            } else {
                password.type = "password";
                icon.setAttribute("data-lucide", "eye");
            }

            lucide.createIcons();
        }
    </script>
        
</body>
</html>
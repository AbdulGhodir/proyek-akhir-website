<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="lupa-password-page">
    <section class="card">
        <div class="left-side">
            <div class="header">
                <span class="title">Lupa Password</span>
                <span class="subtitle">Silahkan masukkan alamat email kamu untuk mereset password</span>
            </div>

            <form id="form-login" class="form" method="POST">
                <div class="input">
                    <label>Email</label>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Masukkan Email" required>
                        <i data-lucide="mail" class="icon" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                    </div>
                </div>

                <button class="submit-button" type="submit" name="lupa_password">Submit</button>
            </form>
        </div>

        <div class="rigth-side">
            <span class="title">Sudah Punya Akun?</span>
            <a href="<?= BASEURL; ?>/app/controllers/auth/login.php">Masuk</a>
        </div>
    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
</body>
</html>
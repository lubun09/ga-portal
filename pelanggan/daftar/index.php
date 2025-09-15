<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelanggan GA-Messenger</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <style>
        body { background: #f4f6f9; }
        .form-container { max-width: 500px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        #preview-img { max-width: 100%; margin-top: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h3 class="text-center">Form Pendaftaran Pelanggan</h3>
        <form action="proses_daftar.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_pelanggan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username_pelanggan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat_pelanggan" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp_pelanggan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email_pelanggan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Foto Profil (jpg, jpeg, png, gif max 2MB)</label>
                <input type="file" name="gambar" class="form-control-file" accept=".jpg,.jpeg,.png,.gif" onchange="previewImage(event)">
                <img id="preview-img" src="#" alt="Preview Gambar" style="display:none;">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
        <p class="text-center mt-2"><a href="../../../ga-messenger">Kembali ke Login</a></p>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-img');
            if(input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>

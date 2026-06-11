<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/KategoriModel.php';
require_once '../../models/EventModel.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ' . BASEURL . '/app/controllers/auth/login.php');
    exit;
}

$aksi = $_POST['aksi'] ?? '';

// ── TAMBAH KATEGORI ───────────────────────────────────────────────────────────
if ($aksi === 'tambah-kat') {
    $nama = trim($_POST['nama_kategori'] ?? '');

    if ($nama === '') {
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Nama kategori tidak boleh kosong.'];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
        exit;
    }
    if (strlen($nama) > 50) {
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Nama kategori maksimal 50 karakter.'];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
        exit;
    }
    if (kategoriNameExists($conn, $nama)) {
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Kategori "' . htmlspecialchars($nama) . '" sudah ada.'];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
        exit;
    }

    insertKategori($conn, $nama);
    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Kategori "' . htmlspecialchars($nama) . '" berhasil ditambahkan.'];
    header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
    exit;
}

// ── HAPUS KATEGORI ───────────────────────────────────────────────────────────
if ($aksi === 'hapus') {
    $id = (int)($_POST['id_kategori'] ?? 0);

    if ($id <= 0) {
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'ID kategori tidak valid.'];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
        exit;
    }

    $cek    = $conn->query("SELECT COUNT(*) AS t FROM event WHERE id_kategori = $id");
    $jumlah = $cek ? (int)$cek->fetch_assoc()['t'] : 0;

    if ($jumlah > 0) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'msg'  => "Kategori tidak dapat dihapus karena masih memiliki $jumlah event terkait."
        ];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
        exit;
    }

    $kat       = getKategoriById($conn, $id);
    $nama_hapus = $kat ? $kat['kategori'] : 'Kategori';
    deleteKategori($conn, $id);

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Kategori "' . htmlspecialchars($nama_hapus) . '" berhasil dihapus.'];
    header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
    exit;
}

// ── TAMBAH EVENT ─────────────────────────────────────────────────────────────
if ($aksi === 'tambah-event') {
    $id_kat      = (int)($_POST['id_kategori'] ?? 0);
    $judul       = trim($_POST['judul'] ?? '');
    $tanggal_raw = trim($_POST['tanggal'] ?? '');
    $biaya       = max(0, (int)($_POST['biaya'] ?? 0));
    $lokasi      = trim($_POST['lokasi'] ?? '');
    $kuota       = max(1, (int)($_POST['kuota'] ?? 1));
    $deskripsi   = trim($_POST['deskripsi'] ?? '');
    $benefit     = trim($_POST['benefit'] ?? '') ?: null;
    $status_raw  = $_POST['status'] ?? 'Dipublikasikan';
    $status      = in_array($status_raw, ['Dipublikasikan', 'Pending', 'Ditolak']) ? $status_raw : 'Dipublikasikan';

    $ts      = strtotime($tanggal_raw);
    $tanggal = $ts ? date('Y-m-d H:i:s', $ts) : '';

    if (!$judul || !$tanggal || !$lokasi || $id_kat <= 0) {
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Judul, tanggal, dan lokasi wajib diisi.'];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php?kat=' . $id_kat);
        exit;
    }

    $gambar = 'tech-seminar.png';
    if (!empty($_FILES['cover_image']['name']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        $ext_ok = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $ext    = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ext_ok)) {
            $nama_file = 'event-' . time() . '-' . uniqid() . '.' . $ext;
            $target    = __DIR__ . '/../../../assets/images/uploads/' . $nama_file;
            if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target)) {
                $gambar = $nama_file;
            }
        }
    }

    insertDataEvent($conn, (int)$_SESSION['id'], $id_kat, $judul, $tanggal, $biaya, $lokasi, $kuota, $deskripsi, $benefit, $gambar, $status);

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Event "' . htmlspecialchars($judul) . '" berhasil ditambahkan.'];
    header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php?kat=' . $id_kat);
    exit;
}

// ── EDIT EVENT ────────────────────────────────────────────────────────────────
if ($aksi === 'edit-event') {
    $id_event    = (int)($_POST['id_event'] ?? 0);
    $id_kat      = (int)($_POST['id_kategori'] ?? 0);
    $judul       = trim($_POST['judul'] ?? '');
    $tanggal_raw = trim($_POST['tanggal'] ?? '');
    $biaya       = max(0, (int)($_POST['biaya'] ?? 0));
    $lokasi      = trim($_POST['lokasi'] ?? '');
    $kuota       = max(1, (int)($_POST['kuota'] ?? 1));
    $deskripsi   = trim($_POST['deskripsi'] ?? '');
    $benefit     = trim($_POST['benefit'] ?? '') ?: null;
    $status_raw  = $_POST['status'] ?? 'Dipublikasikan';
    $status      = in_array($status_raw, ['Dipublikasikan', 'Pending', 'Ditolak']) ? $status_raw : 'Dipublikasikan';
    $gambar      = trim($_POST['current_gambar'] ?? 'tech-seminar.png') ?: 'tech-seminar.png';

    $ts      = strtotime($tanggal_raw);
    $tanggal = $ts ? date('Y-m-d H:i:s', $ts) : '';

    if ($id_event <= 0 || !$judul || !$tanggal || !$lokasi) {
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Data tidak lengkap, silakan coba lagi.'];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php?kat=' . $id_kat);
        exit;
    }

    if (!empty($_FILES['cover_image']['name']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        $ext_ok = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $ext    = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $ext_ok)) {
            $nama_file = 'event-' . time() . '-' . uniqid() . '.' . $ext;
            $target    = __DIR__ . '/../../../assets/images/uploads/' . $nama_file;
            if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target)) {
                $gambar = $nama_file;
            }
        }
    }

    $stmt = $conn->prepare("
        UPDATE `event`
        SET `id_kategori`=?, `judul`=?, `waktu_pelaksanaan`=?, `biaya`=?,
            `lokasi`=?, `kuota`=?, `deskripsi`=?, `benefit`=?,
            `cover_image`=?, `status_publikasi`=?
        WHERE id_event=?
    ");
    $stmt->bind_param(
        "issisissssi",
        $id_kat, $judul, $tanggal, $biaya,
        $lokasi, $kuota, $deskripsi, $benefit,
        $gambar, $status,
        $id_event
    );
    $stmt->execute();

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Event "' . htmlspecialchars($judul) . '" berhasil diperbarui.'];
    header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php?kat=' . $id_kat);
    exit;
}

// ── HAPUS EVENT ───────────────────────────────────────────────────────────────
if ($aksi === 'hapus-event') {
    $id_event = (int)($_POST['id_event'] ?? 0);
    $id_kat   = (int)($_POST['id_kategori'] ?? 0);

    if ($id_event <= 0) {
        $_SESSION['flash'] = ['type' => 'error', 'msg' => 'ID event tidak valid.'];
        header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php?kat=' . $id_kat);
        exit;
    }

    $qev      = $conn->query("SELECT judul FROM event WHERE id_event = $id_event");
    $judul_ev = $qev ? ($qev->fetch_assoc()['judul'] ?? 'Event') : 'Event';

    deleteDataEvent($conn, $id_event);

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Event "' . htmlspecialchars($judul_ev) . '" berhasil dihapus.'];
    header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php?kat=' . $id_kat);
    exit;
}

// Fallback
header('Location: ' . BASEURL . '/app/controllers/admin/kelola-kategori.php');
exit;

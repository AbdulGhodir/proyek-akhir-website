<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
session_start();

$search = trim($_GET['q'] ?? '');
$filter = $_GET['filter'] ?? 'semua';   // semua | user | eo

$where = "WHERE role != 'Admin'";
if ($filter === 'user')
    $where .= " AND role = 'User'";
if ($filter === 'eo')
    $where .= " AND role = 'EO'";
if ($search !== '') {
    $s = $conn->real_escape_string($search);
    $where .= " AND (nama_lengkap LIKE '%$s%' OR email LIKE '%$s%' OR nama_organisasi LIKE '%$s%')";
}

$q_users = $conn->query("SELECT * FROM users $where ORDER BY id DESC");

$c_all = $conn->query("SELECT COUNT(*) AS t FROM users WHERE role != 'Admin'")->fetch_assoc()['t'];
$c_user = $conn->query("SELECT COUNT(*) AS t FROM users WHERE role = 'User'")->fetch_assoc()['t'];
$c_eo = $conn->query("SELECT COUNT(*) AS t FROM users WHERE role = 'EO'")->fetch_assoc()['t'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Pengguna | Eventify Admin</title>
    <meta name="description" content="Kelola pengguna dan event organizer di platform Eventify.">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/admin/admin-style.css">
    <style>
        .status-badge.aktif {
            background: #DCFCE7;
            color: #166534;
        }

        .status-badge.suspended {
            background: #FEE2E2;
            color: #991B1B;
        }

        .status-badge {
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .action-group {
            display: flex;
            gap: 6px;
            align-items: center;
        }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <main class="main">

        <div class="page-header">
            <h1>Manajemen Pengguna</h1>
            <p>Kelola akun pengguna dan event organizer terdaftar.</p>
        </div>

        <div class="toolbar">
            <!-- Search -->
            <form method="GET" action="" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                <input type="hidden" name="filter" value="<?= htmlspecialchars($filter) ?>">
                <div class="search-wrap">
                    <i class='bx bx-search'></i>
                    <input type="text" name="q" placeholder="Cari nama, email, organisasi…"
                        value="<?= htmlspecialchars($search) ?>">
                </div>
                <button type="submit" class="btn btn-primary-grad">
                    <i class='bx bx-search-alt'></i> Cari
                </button>
            </form>

            <div class="filter-bar">
                <a href="?filter=semua&q=<?= urlencode($search) ?>"
                    class="filter-pill <?= $filter === 'semua' ? 'active' : '' ?>">
                    Semua (<?= $c_all ?>)
                </a>
                <a href="?filter=user&q=<?= urlencode($search) ?>"
                    class="filter-pill <?= $filter === 'user' ? 'active' : '' ?>">
                    Pengguna (<?= $c_user ?>)
                </a>
                <a href="?filter=eo&q=<?= urlencode($search) ?>"
                    class="filter-pill <?= $filter === 'eo' ? 'active' : '' ?>">
                    EO (<?= $c_eo ?>)
                </a>
            </div>
        </div>

        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($q_users && $q_users->num_rows > 0):
                            $no = 1;
                            while ($u = $q_users->fetch_assoc()):
                                $is_eo = $u['role'] === 'EO';
                                $init = strtoupper(substr($u['nama_lengkap'], 0, 1));
                                $av_cls = $is_eo ? 'eo' : 'user';
                                $role_badge = $is_eo ? 'yellow' : 'blue';
                                $status = $u['status'] ?? 'aktif';
                                ?>
                                <tr>
                                    <td style="color:var(--muted);font-size:13px;"><?= $no++ ?></td>
                                    <td>
                                        <div class="av-cell">
                                            <div class="av-init <?= $av_cls ?>"><?= $init ?></div>
                                            <div>
                                                <div class="av-name"><?= htmlspecialchars($u['nama_lengkap']) ?></div>
                                                <?php if ($u['nama_organisasi']): ?>
                                                    <div class="av-org"><?= htmlspecialchars($u['nama_organisasi']) ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="font-size:13px;color:var(--muted);"><?= htmlspecialchars($u['email']) ?></td>
                                    <td><span class="badge <?= $role_badge ?>"><?= $u['role'] ?></span></td>
                                    <td>
                                        <span class="status-badge <?= $status ?>">
                                            <?= ucfirst($status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-group">

                                            <form method="POST" action="<?= BASEURL ?>/app/controllers/admin/suspend-user.php"
                                                onsubmit="return confirm('<?= $status === 'aktif' ? 'Suspend' : 'Aktifkan' ?> pengguna ini?')">
                                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                                <input type="hidden" name="status" value="<?= $status ?>">
                                                <input type="hidden" name="redirect"
                                                    value="<?= BASEURL ?>/app/views/admin/manajemen-pengguna.php?filter=<?= $filter ?>">
                                                <button type="submit"
                                                    class="btn <?= $status === 'aktif' ? 'btn-warn' : 'btn-ghost' ?>"
                                                    title="<?= $status === 'aktif' ? 'Suspend' : 'Aktifkan' ?>">
                                                    <i
                                                        class='bx <?= $status === 'aktif' ? 'bx-pause-circle' : 'bx-play-circle' ?>'></i>
                                                    <?= $status === 'aktif' ? 'Suspend' : 'Aktifkan' ?>
                                                </button>
                                            </form>

                                            <form method="POST" action="<?= BASEURL ?>/app/controllers/admin/delete-user.php"
                                                onsubmit="return confirm('Hapus pengguna ini secara permanen?')">
                                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                                <input type="hidden" name="redirect"
                                                    value="<?= BASEURL ?>/app/views/admin/manajemen-pengguna.php?filter=<?= $filter ?>">
                                                <button type="submit" class="btn btn-danger" title="Hapus">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; else: ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class='bx bx-user-x'></i>
                                        <p>Tidak ada pengguna ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>

</html>
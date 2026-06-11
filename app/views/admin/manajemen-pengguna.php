<?php
/**
 * @var array $flash
 * @var string $search
 * @var string $filter
 * @var mysqli_result $q_users
 * @var int $c_all
 * @var int $c_user
 * @var int $c_eo
 */
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Pengguna | Eventify Admin</title>
    <meta name="description" content="Kelola pengguna dan event organizer di platform Eventify.">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/global.css">
</head>

<body class="admin-page">

    <?php include 'sidebar.php'; ?>

    <main class="main">

        <?php if ($flash): ?>
            <div class="flash-toast flash-<?= $flash['type'] ?>" id="flashToast">
                <i class='bx <?= $flash['type'] === 'success' ? 'bx-check-circle' : 'bx-error-circle' ?>'></i>
                <?= htmlspecialchars($flash['msg']) ?>
            </div>
        <?php endif; ?>

        <div class="page-header">
            <h1>Manajemen Pengguna</h1>
            <p>Kelola akun pengguna dan event organizer terdaftar di platform.</p>
        </div>

        <div class="toolbar">
          
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
                            <th>Event</th>
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

                             
                                $ev_count = 0;
                                if ($is_eo) {
                                    $qe = $conn->query("SELECT COUNT(*) AS t FROM event WHERE id_user = " . (int)$u['id']);
                                    if ($qe) $ev_count = $qe->fetch_assoc()['t'];
                                }
                            ?>
                            <tr>
                                <td data-label="#" style="color:var(--muted);font-size:13px;"><?= $no++ ?></td>
                                <td data-label="Pengguna">
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
                                <td data-label="Email" style="font-size:13px;color:var(--muted);"><?= htmlspecialchars($u['email']) ?></td>
                                <td data-label="Role">
                                    <span class="badge <?= $role_badge ?>"><?= $u['role'] ?></span>
                                </td>
                                <td data-label="Event">
                                    <?php if ($is_eo): ?>
                                        <a href="<?= BASEURL ?>/app/controllers/admin/validasi.php?tab=Pending"
                                            style="font-size:13px;color:var(--primary);font-weight:600;">
                                            <?= $ev_count ?> event
                                        </a>
                                    <?php else: ?>
                                        <span style="font-size:13px;color:var(--muted);">—</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Aksi">
                                    <div class="action-group">
                                        <form method="POST"
                                            action="<?= BASEURL ?>/app/controllers/admin/delete-user.php"
                                            onsubmit="return confirm('Hapus pengguna <?= htmlspecialchars(addslashes($u['nama_lengkap'])) ?> secara permanen? Semua data terkait akan ikut terhapus.')">
                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                            <input type="hidden" name="redirect"
                                                value="<?= BASEURL ?>/app/controllers/admin/manajemen-pengguna.php?filter=<?= $filter ?>">
                                            <button type="submit" class="btn btn-danger" title="Hapus Pengguna">
                                                <i class='bx bx-trash'></i> Hapus
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

    <script>
        const toast = document.getElementById('flashToast');
        if (toast) setTimeout(() => toast.style.opacity = '0', 3500);
    </script>
</body>

</html>
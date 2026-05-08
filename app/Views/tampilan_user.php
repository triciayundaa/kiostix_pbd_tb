<!DOCTYPE html>
<html lang="en">
<head>
    <title>PBD Bismillah - Daftar User</title>
</head>
<body>
    <h1>Data Pengguna dari Database</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        <?php foreach($semua_user as $u): ?>
        <tr>
            <td><?= $u['id']; ?></td>
            <td><?= $u['nama']; ?></td>
            <td><?= $u['email']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar Card</title>
</head>

<body>
    <h2>Daftar Card</h2>
    <a href="<?php echo site_url('card/create'); ?>">Tambah Card</a>
    <table border="1">
        <tr>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($cards as $card) { ?>
            <tr>
                <td><img src="<?php echo base_url('uploads/' . $card['image']); ?>" width="100"></td>
                <td><?php echo $card['description']; ?></td>
                <td>
                    <a href="<?php echo site_url('card/edit/' . $card['id']); ?>">Edit</a> |
                    <a href="<?php echo site_url('card/delete/' . $card['id']); ?>" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
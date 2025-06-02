<!DOCTYPE html>
<html>
<head>
    <title>Tambah Card</title>
</head>
<body>
    <h2>Tambah Card</h2>
    <?php echo form_open_multipart('card/store'); ?>
        <label>Gambar:</label>
        <input type="file" name="image" required>
        <br>
        <label>Deskripsi:</label>
        <textarea name="description" required></textarea>
        <br>
        <button type="submit">Simpan</button>
    <?php echo form_close(); ?>
</body>
</html>

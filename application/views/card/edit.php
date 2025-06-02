<!DOCTYPE html>
<html>

<head>
    <title>Edit Card</title>
</head>

<body>
    <h2>Edit Card</h2>
    <?php echo form_open_multipart('card/update/' . $card['id']); ?>
    <label>Gambar:</label>
    <input type="file" name="image">
    <br>
    <label>Deskripsi:</label>
    <textarea name="description" required><?php echo $card['description']; ?></textarea>
    <br>
    <button type="submit">Update</button>
    <?php echo form_close(); ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Form</title>
</head>
<body>

<?php foreach ($errors as $error): ?>
    <li><?= esc($error) ?></li>
<?php endforeach ?>

<?php // echo form_open_multipart('upload/upload', [ 'class' => 'form-validate' ]); ?>

 <!-- form_open_multipart('upload/upload')   -->

<input type="file" name="userfile" size="20" />

<br /><br />222

<input type="submit" value="upload" />

<?php // echo form_close(); ?>
<!-- </form> -->

</body>
</html>
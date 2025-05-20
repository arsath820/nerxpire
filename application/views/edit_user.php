<form method="post" action="<?= base_url('index.php/user/update/' . $student->id) ?>">
    Name: <input type="text" name="name" value="<?= $student->name ?>" required><br>
    Age: <input type="number" name="age" value="<?= $student->age ?>" required><br>
    Email: <input type="email" name="email" value="<?= $reference->email ?>" required><br>
    <button type="submit">Update</button>
</form>

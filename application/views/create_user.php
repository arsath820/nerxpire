<h2>create form</h2>
<form method="post" action="<?= base_url('index.php/user/store') ?>">
    Name: <input type="text" name="name" required><br>
    Age: <input type="number" name="age" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" class="form-control" required><br>
    <button type="submit">Save</button>
</form>

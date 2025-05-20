<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_list</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
    <?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-<?= $this->session->flashdata('msg_type'); ?>">
        <?= $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

    <div class="container mt-5">
        <h1 class="text-center">Students bio data</h1>
        <a href="<?= base_url('index.php/user/create') ?>" class="btn btn-primary mb-3">Add New Student</a>
        <!-- Create a table with Bootstrap classes -->
        <table class="table table-striped table-bordered table-hover" id="studentTable">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($references as $reference): ?>
                    <tr>
                        <td><?= $reference->name ?></td>
                        <td><?= $reference->age ?></td>
                        <td><?= $reference->email ?></td>
                        <td>
    <a href="<?= base_url('index.php/user/edit/' . $reference->id) ?>" class="btn btn-sm btn-warning">Edit</a>
    <a href="<?= base_url('index.php/user/delete/' . $reference->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
</td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add jQuery, DataTables JS, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable();  // Add DataTable functionality
        });
    </script>
    <a href="<?= site_url('auth/logout') ?>" class="btn btn-sm btn-secondary">Logout</a>

</body>
</html>


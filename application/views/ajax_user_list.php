<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAX User List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Students Bio Data (AJAX)</h1>
    <button class="btn btn-primary mb-3" id="addBtn">Add New Student</button>
    <table class="table table-bordered table-hover" id="studentTable">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <form id="userForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Form</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="student_id">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" id="age" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password <small>(Leave blank to keep current)</small></label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    let table = $('#studentTable').DataTable({
        ajax: {
            url: '<?= base_url('index.php/ajaxuser/fetch_all') ?>',
            dataSrc: ''
        },
        columns: [
            { data: 'name' },
            { data: 'age' },
            { data: 'email' },
            {
                data: 'id',
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning editBtn" data-id="${data}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${data}">Delete</button>
                    `;
                }
            }
        ]
    });

    // Open modal for Add
    $('#addBtn').click(function () {
        $('#userForm')[0].reset();
        $('#student_id').val('');
        $('#userModal .modal-title').text('Add Student');
        $('#userModal').modal('show');
    });

    // Submit form
    $('#userForm').submit(function (e) {
        e.preventDefault();
        const id = $('#student_id').val();
        const url = id ? '<?= base_url('index.php/ajaxuser/update/') ?>' + id : '<?= base_url('index.php/ajaxuser/store') ?>';
        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
            success: function () {
                $('#userModal').modal('hide');
                table.ajax.reload(null, false);
            }
        });
    });

    // Edit
    $('#studentTable').on('click', '.editBtn', function () {
        const id = $(this).data('id');
        $.ajax({
            url: '<?= base_url('index.php/ajaxuser/edit/') ?>' + id,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#student_id').val(id);
                $('#name').val(data.student.name);
                $('#age').val(data.student.age);
                $('#email').val(data.reference.email);
                $('#password').val('');
                $('#userModal .modal-title').text('Edit Student');
                $('#userModal').modal('show');
            }
        });
    });

    // Delete
    $('#studentTable').on('click', '.deleteBtn', function () {
        if (confirm('Are you sure you want to delete this student?')) {
            const id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('index.php/ajaxuser/delete/') ?>' + id,
                method: 'POST',
                success: function () {
                    table.ajax.reload(null, false);
                }
            });
        }
    });
});
</script>
</body>
</html>

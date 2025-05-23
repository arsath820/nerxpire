<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Login Form</h2>

        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-<?= $this->session->flashdata('msg_type'); ?>">
                <?= $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/do_login') ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
                <?= form_error('email'); ?>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <?= form_error('password'); ?>
            </div>
            <div class="g-recaptcha" data-sitekey="<?= $this->config->item('recaptcha_site_key') ?>"></div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>

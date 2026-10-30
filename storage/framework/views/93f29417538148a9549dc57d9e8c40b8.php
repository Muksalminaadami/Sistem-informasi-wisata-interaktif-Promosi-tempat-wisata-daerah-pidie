<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Hidden Paradise</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard.css')); ?>">
</head>
<body class="admin-body d-flex align-items-center justify-content-center vh-100">
    <div class="container" style="max-width: 420px;">
        <div class="card p-4 shadow-lg border-0">
            <div class="text-center mb-4">
                <div class="admin-brand-mark mb-2 mx-auto" aria-hidden="true" style="display: inline-flex; width: 48px; height: 48px; align-items: center; justify-content: center;">
                    <svg viewBox="0 0 24 24" width="36" height="36" stroke="currentColor" fill="none" stroke-width="2"><circle cx="12" cy="12" r="9.25"/><path d="M6.8 15.2c1.6-3.1 3.2-4.7 5.2-4.7s3.6 1.6 5.2 4.7"/><path d="M8 18.2h8"/></svg>
                </div>
                <h1 class="h3 fw-bold mb-1">Hidden Paradise</h1>
                <p class="text-muted small">Panel Login Administrator Wisata Pidie</p>
            </div>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 small">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Username / Email</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username atau email" required autofocus>
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="w-full btn btn-success w-100 py-2 fw-semibold">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH /home/vol17_2/infinityfree.com/if0_41923873/sistem-informasi-wisata-interaktif.ct.ws/htdocs/resources/views/admin/login.blade.php ENDPATH**/ ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Premier League Fantasy — Prototype</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.jsx']); ?>
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@2.0.1/css/pico.min.css">
  <style>
    body{max-width:1100px;margin:2rem auto;}
    nav a{margin-right:1rem}
    .injury.yellow{background:#fff8cc;padding:4px;border-radius:4px}
    .injury.orange{background:#ffe4b5;padding:4px;border-radius:4px}
    .injury.red{background:#ffd6d6;padding:4px;border-radius:4px}
  </style>
</head>
<body>
  <header>
    <h1>Premier League Fantasy (Prototype)</h1>
    <nav>
      <a href="<?php echo e(route('players.index')); ?>">Players</a>
      <a href="<?php echo e(route('team.show')); ?>">My Team</a>
      <a href="<?php echo e(route('team.select')); ?>">Pick Team</a>
      <a href="<?php echo e(route('transfers.index')); ?>">Transfers</a>
      <a href="<?php echo e(route('chips.index')); ?>">Chips</a>
      <a href="<?php echo e(route('admin.dashboard')); ?>">Admin</a>
    </nav>
  </header>

  <?php if($errors->any()): ?>
    <article>
      <strong>Errors</strong>
      <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($e); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
    </article>
  <?php endif; ?>
  <?php if(session('ok')): ?>
    <article style="border-left:4px solid #3a5;padding-left:8px"><?php echo e(session('ok')); ?></article>
  <?php endif; ?>

  <main>
    <?php echo $__env->yieldContent('content'); ?>
  </main>
</body>
</html><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/layouts/app.blade.php ENDPATH**/ ?>
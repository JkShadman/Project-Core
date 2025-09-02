

<?php $__env->startSection('content'); ?>
<h2>Players</h2>
<form method="get" style="display:flex;gap:8px;align-items:center">
  <input name="q" placeholder="Search player or club" value="<?php echo e(request('q')); ?>">
  <select name="position">
    <option value="">All positions</option>
    <?php $__currentLoopData = ['GK','DEF','MID','FWD']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($p); ?>" <?php if(request('position')===$p): echo 'selected'; endif; ?>><?php echo e($p); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <button type="submit">Filter</button>
</form>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:12px">
  <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <article>
    <h3><?php echo e($pl->name); ?> <small>(<?php echo e($pl->position); ?>)</small></h3>
    <p><strong><?php echo e($pl->club->name ?? '—'); ?></strong></p>
    <p>Price: £<?php echo e(number_format($pl->price,1)); ?>m</p>
    <?php if($pl->injury_level !== 'none'): ?>
      <div class="injury <?php echo e($pl->injury_level); ?>"><?php echo e(strtoupper($pl->injury_level)); ?> — check updates</div>
    <?php endif; ?>
  </article>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo e($players->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/players/index.blade.php ENDPATH**/ ?>
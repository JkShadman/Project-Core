
<?php $__env->startSection('content'); ?>
<h2>Chips (<?php echo e($gw->name); ?>)</h2>
<p>Available chips: Wildcard, Free Hit, Bench Boost, Triple Captain. Use carefully — each can be played once per season (in prototype tracked per team).</p>

<form method="post" action="<?php echo e(route('chips.play')); ?>">
  <?php echo csrf_field(); ?>
  <label><input type="radio" name="type" value="wildcard"> Wildcard</label>
  <label><input type="radio" name="type" value="freehit"> Free Hit</label>
  <label><input type="radio" name="type" value="benchboost"> Bench Boost</label>
  <label><input type="radio" name="type" value="triplecaptain"> Triple Captain</label>
  <button type="submit">Play Chip for <?php echo e($gw->name); ?></button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/chips/index.blade.php ENDPATH**/ ?>
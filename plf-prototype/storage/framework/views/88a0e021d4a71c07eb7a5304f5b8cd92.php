
<?php $__env->startSection('content'); ?>
<h2>Transfers (<?php echo e($gw->name); ?>)</h2>
<p>Free transfers: 1. Extra transfers cost 4 points each.</p>

<h3>Your squad</h3>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px">
  <?php $__currentLoopData = $current; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <article>
    <h4><?php echo e($pl->name); ?> <small><?php echo e($pl->position); ?></small></h4>
    <p><?php echo e($pl->club->name ?? ''); ?> — £<?php echo e($pl->price); ?></p>

    <form method="post" action="<?php echo e(route('transfers.swap')); ?>">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="out_player_id" value="<?php echo e($pl->id); ?>">
      <label>Swap with:
        <select name="in_player_id">
          <?php $__currentLoopData = $market->where('position',$pl->position); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$current->pluck('id')->contains($m->id)): ?>
              <option value="<?php echo e($m->id); ?>"><?php echo e($m->name); ?> — £<?php echo e($m->price); ?></option>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </label>
      <button type="submit">Swap</button>
    </form>
  </article>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/transfers/index.blade.php ENDPATH**/ ?>
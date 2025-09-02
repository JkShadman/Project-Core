
<?php $__env->startSection('content'); ?>
<h2>My Team (<?php echo e($gw->name); ?>)</h2>

<p><a href="<?php echo e(route('team.select')); ?>">Edit Squad</a></p>

<form method="post" action="<?php echo e(route('team.captain')); ?>">
  <?php echo csrf_field(); ?>
  <label>Captain:
    <select name="captain">
      <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($p->id); ?>" <?php if($p->id==($team->captain_id ?? null)): echo 'selected'; endif; ?>><?php echo e($p->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </label>
  <label>Vice Captain:
    <select name="vice_captain">
      <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($p->id); ?>" <?php if($p->id==($team->vice_captain_id ?? null)): echo 'selected'; endif; ?>><?php echo e($p->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </label>
  <button type="submit">Set Captains</button>
</form>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:12px">
  <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <article>
    <h4><?php echo e($p->name); ?> <small><?php echo e($p->position); ?></small></h4>
    <p><?php echo e($p->club->name ?? ''); ?> — £<?php echo e(number_format($p->price,1)); ?>m</p>
    <?php if($p->injury_level!=='none'): ?><div class="injury <?php echo e($p->injury_level); ?>"><?php echo e($p->injury_level); ?></div><?php endif; ?>
  </article>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/team/show.blade.php ENDPATH**/ ?>

<?php $__env->startSection('content'); ?>
<h2>Pick Squad</h2>
<p>Rules: 15 players: GK×2, DEF×5, MID×5, FWD×3. Max 3 players per club. Budget ≤ £100.0</p>

<form method="post" action="<?php echo e(route('team.save')); ?>">
  <?php echo csrf_field(); ?>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px">
    <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <label style="border:1px solid #ddd;padding:8px;border-radius:6px;">
        <input type="checkbox" name="player_ids[]" value="<?php echo e($pl->id); ?>" <?php if(in_array($pl->id,$existing ?? [])): echo 'checked'; endif; ?>>
        <strong><?php echo e($pl->name); ?></strong><br>
        <small><?php echo e($pl->club->name ?? ''); ?></small><br>
        <span><?php echo e($pl->position); ?> — £<?php echo e(number_format($pl->price,1)); ?>m</span>
        <?php if($pl->injury_level !== 'none'): ?><div class="injury <?php echo e($pl->injury_level); ?>"><?php echo e($pl->injury_level); ?></div><?php endif; ?>
      </label>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <button type="submit">Save Squad</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/team/select.blade.php ENDPATH**/ ?>

<?php $__env->startSection('content'); ?>
<h2>Pick Starting 11 (<?php echo e($gw->name); ?>)</h2>
<p>Rules: Select 11 players from your squad. Allowed combinations:</p>
<ul>
  <li>1 GK, 3 DEF, 4 MID, 3 FWD</li>
  <li>1 GK, 3 DEF, 5 MID, 2 FWD</li>
  <li>1 GK, 4 DEF, 3 MID, 3 FWD</li>
  <li>1 GK, 4 DEF, 4 MID, 2 FWD</li>
  <li>1 GK, 4 DEF, 5 MID, 1 FWD</li>
  <li>1 GK, 5 DEF, 2 MID, 3 FWD</li>
  <li>1 GK, 5 DEF, 3 MID, 2 FWD</li>
  <li>1 GK, 5 DEF, 4 MID, 1 FWD</li>
</ul>

<form method="post" action="<?php echo e(route('team.save_starting')); ?>">
  <?php echo csrf_field(); ?>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px">
    <?php $__currentLoopData = $squadPlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <label style="border:1px solid #ddd;padding:8px;border-radius:6px;">
        <input type="checkbox" name="player_ids[]" value="<?php echo e($pl->id); ?>" <?php if(in_array($pl->id,$startingPlayers ?? [])): echo 'checked'; endif; ?>>
        <strong><?php echo e($pl->name); ?></strong><br>
        <small><?php echo e($pl->club->name ?? ''); ?></small><br>
        <span><?php echo e($pl->position); ?> — £<?php echo e(number_format($pl->price,1)); ?>m</span>
        <?php if($pl->injury_level !== 'none'): ?><div class="injury <?php echo e($pl->injury_level); ?>"><?php echo e($pl->injury_level); ?></div><?php endif; ?>
      </label>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <button type="submit">Save Starting 11</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/team/pick_starting.blade.php ENDPATH**/ ?>
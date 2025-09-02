
<?php $__env->startSection('content'); ?>
<h2>Admin Dashboard</h2>
<p>Create/Update player stats per GW to compute points.</p>
<form method="post" action="<?php echo e(route('admin.update_stats')); ?>">
  <?php echo csrf_field(); ?>
  <label>Gameweek:
    <select name="gameweek_id">
      <?php $__currentLoopData = $gws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($gw->id); ?>"><?php echo e($gw->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </label>
  <p>Paste JSON stats (player_id => fields) in the textarea below (prototype)</p>
  <textarea name="stats_json" style="width:100%;height:200px" placeholder='{"12":{"goals":1,"assists":0,...}}'></textarea>
  <button type="submit">Update</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\premier-league-fantasy-laravel\plf-prototype\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => session()->has('success') ? 'success' : (session()->has('error') ? 'error' : 'info'),
    'message' => session('success') ?? (session('error') ?? '')

]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'type' => session()->has('success') ? 'success' : (session()->has('error') ? 'error' : 'info'),
    'message' => session('success') ?? (session('error') ?? '')

]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($message || $errors->any()): ?>

  <?php if($type == 'success'): ?>
   <div class="space-y-5">
    <div class=" mx-auto w-1/2 mt-5 bg-teal-50 border-t-2 border-teal-600 rounded-lg p-4 dark:bg-teal-800/30" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
        <div class="flex">
        <div class="shrink-0">
            <!-- Icon -->
        <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
            <path d="m9 12 2 2 4-4"></path>
          </svg>
        </span>
            <!-- End Icon -->
        </div>
        <div class="ms-3">
            <h3 id="hs-bordered-success-style-label" class="text-gray-800 font-semibold dark:text-white">
            Successfully Changed
            </h3>
            <?php if($message): ?>
            <p class="text-sm text-gray-900 dark:text-neutral-400">
                <?php echo e($message); ?>

            </p>
            <?php endif; ?>
        </div>
        </div>
    </div>
    <?php elseif($type === 'error'): ?>
    <div class="mx-auto w-1/2 mt-5 bg-red-50 border-s-4 border-red-500 p-4 rounded-lg dark:bg-red-800/30" role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
    <div class="flex">
      <div class="shrink-0">
        <!-- Icon -->
        <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </span>
        <!-- End Icon -->
      </div>
      <div class="ms-3">
        <?php if($message): ?>
        <h3 id="hs-bordered-red-style-label" class="text-gray-800 font-semibold dark:text-white">
          <?php echo e($message); ?>

        </h3>
        <?php endif; ?>
        <?php if($errors->any()): ?>
        <ul class="text-sm text-gray-700 dark:text-neutral-400">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<div class="mt-2 bg-gray-100 border border-gray-200 text-sm text-gray-800 rounded-lg p-4 dark:bg-white/10 dark:border-white/20 dark:text-white" role="alert" tabindex="-1" aria-labelledby="hs-soft-color-dark-label">
  <span id="hs-soft-color-dark-label" class="font-bold"><?php echo e($message); ?></span>
</div><?php endif; ?>
  <?php endif; ?>
<?php /**PATH C:\laraherd\webstore\resources\views\components\alert.blade.php ENDPATH**/ ?>
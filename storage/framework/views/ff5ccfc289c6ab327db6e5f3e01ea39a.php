<?php use \SweetAlert2\Laravel\Swal; ?>
<script type="module">
  let Swal;
  const getSweetAlert2 = async () => {
    // If SweetAlert2 is already loaded, use it
    if (window.Swal) {
      return window.Swal;
    }

    // Otherwise, dynamically import it from CDN
    try {
      return (await import('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js')).default;
    }

    // Fallback in case of an error (e.g., network issues)
    catch (error) {
      console.error('Failed to load SweetAlert2:', error);
      return { fire: () => {} };
    }
  };

  <?php if(session()->has(Swal::SESSION_KEY)): ?>
    (async () => {
        Swal = await getSweetAlert2();
        Swal.fire(<?php echo json_encode(session(Swal::SESSION_KEY), 15, 512) ?>);
    })();
  <?php endif; ?>

  window.addEventListener('<?php echo e(Swal::SESSION_KEY); ?>', async (event) => {
    if (!event.detail || typeof event.detail !== 'object') {
      return;
    }
    Swal = Swal || await getSweetAlert2();
    Swal.fire(event.detail);
  });
</script>

<?php /**PATH C:\laraherd\webstore\vendor\sweetalert2\laravel\resources\views\livewire\index.blade.php ENDPATH**/ ?>
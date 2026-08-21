<?php $__env->startComponent('mail::message'); ?>
# Harga Turun! 🎉

Produk wishlist Anda **<?php echo e($name); ?>** kini lebih murah:

- **Harga Sekarang**: <?php echo e(\Illuminate\Support\Number::currency($newPrice)); ?>

- **Harga Sebelumnya**: <s><?php echo e(\Illuminate\Support\Number::currency($oldPrice)); ?></s>

Ini saat yang tepat untuk membelinya!

<?php $__env->startComponent('mail::button', ['url' => route('product', $slug)]); ?>
    Lihat Produk
<?php echo $__env->renderComponent(); ?>

Terima kasih, — **Riva & Co.**
<?php echo $__env->renderComponent(); ?><?php /**PATH C:\laraherd\webstore\resources\views\mail\products\wishlist-price-drop.blade.php ENDPATH**/ ?>
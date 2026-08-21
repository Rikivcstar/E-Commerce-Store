<?php $__env->startComponent('mail::message'); ?>
# Halo! 🎉

Produk yang Anda tunggu sudah **tersedia kembali**:

## <?php echo e($product->name); ?>


<?php if($product->getFirstMediaUrl('cover')): ?>
![<?php echo e($product->name); ?>](<?php echo e($product->getFirstMediaUrl('cover')); ?>)
<?php endif; ?>

- **Harga**: <?php echo e(\Illuminate\Support\Number::currency($product->price)); ?>

- **Stok**: Tersedia

Jangan sampai kehabisan lagi!

<?php $__env->startComponent('mail::button', ['url' => route('product', $product->slug)]); ?>
    Lihat Produk Sekarang
<?php echo $__env->renderComponent(); ?>

Terima kasih sudah menunggu. — **Riva & Co.**
<?php echo $__env->renderComponent(); ?><?php /**PATH C:\laraherd\webstore\resources\views\mail\products\stock-available.blade.php ENDPATH**/ ?>
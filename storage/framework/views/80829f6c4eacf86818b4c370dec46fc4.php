<?php $__env->startComponent('mail::message'); ?>
# Terima Kasih, <?php echo e($sales_order->customer->full_name); ?> 🎉

Pesanan Anda dengan nomor **#<?php echo e($sales_order->trx_id); ?>** telah berhasil dibuat.

---

## 🧾 Ringkasan Pesanan:

**Alamat Pengiriman:**  
<?php echo e($sales_order->address_line); ?>  
<?php echo e($sales_order->destination->city); ?>, <?php echo e($sales_order->destination->province); ?>, <?php echo e($sales_order->destination->postal_code); ?>


**Tanggal Pemesanan:**  
<?php echo e($sales_order->created_at_formatted); ?>


---

## 🛍️ Item yang Dipesan

<?php $__env->startComponent('mail::table'); ?>
| Produk         | Qty | Harga Satuan | Subtotal   |
|----------------|-----|---------------|------------|
<?php $__currentLoopData = $sales_order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
| <?php echo e($item->name); ?> | <?php echo e($item->quantity); ?> | <?php echo e($item->price_formatted); ?> | <?php echo e($item->total_formatted); ?> |
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo $__env->renderComponent(); ?>

---

## 💰 Rincian Pembayaran

- **Subtotal**: <?php echo e($sales_order->sub_total_formatted); ?>  
- **Ongkir**: <?php echo e($sales_order->shipping_total_formatted); ?>  
- **Total**: **<?php echo e($sales_order->total_formatted); ?>**

---

<?php $__env->startComponent('mail::button', ['url' => route('order-confirmed', $sales_order->trx_id)]); ?>
    Bayar Sekarang
<?php echo $__env->renderComponent(); ?>

Terima kasih telah berbelanja bersama kami 🙏  
Kami akan segera memproses pesanan Anda.

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\laraherd\webstore\resources\views\mail\orders\created.blade.php ENDPATH**/ ?>
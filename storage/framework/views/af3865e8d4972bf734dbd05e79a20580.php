<?php $__env->startComponent('mail::message'); ?>
# Pesanan Anda Telah Dikirim, <?php echo e($sales_order->customer->full_name); ?> 🚚

Pesanan Anda dengan nomor **#<?php echo e($sales_order->trx_id); ?>** telah dikirim dan sedang dalam perjalanan ke alamat tujuan.

---

## 📦 Informasi Pengiriman

- **Nomor Resi:** <?php echo e($sales_order->shipping->receipt_number ?? 'Belum tersedia'); ?>

- **Kurir:** <?php echo e($sales_order->shipping->courier); ?>

- **Layanan:** <?php echo e($sales_order->shipping->service); ?>

- **Estimasi Tiba:** <?php echo e($sales_order->shipping->estimated_delivery); ?>

- **Berat Paket:** <?php echo e($sales_order->shipping->weight); ?> gram
- **Biaya Pengiriman:** <?php echo e($sales_order->shipping_total_formatted); ?>


---

## 📍 Alamat Pengiriman

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

Terima kasih telah berbelanja bersama kami 🙏  
Semoga pesanan Anda segera sampai dengan selamat.

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\laraherd\webstore\resources\views\mail\orders\delivery.blade.php ENDPATH**/ ?>
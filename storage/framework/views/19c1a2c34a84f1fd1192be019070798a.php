<?php $__env->startComponent('mail::message'); ?>
# Pesanan Selesai, <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->customer->full_name); ?> ✅

Pesanan Anda dengan nomor **#<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->trx_id); ?>** telah berhasil diselesaikan dan telah kami kirimkan ke alamat tujuan.

---

## 🧾 Ringkasan Pesanan:

**Alamat Pengiriman:**  
<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->address_line); ?>  
<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->destination->city); ?>, <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->destination->province); ?>, <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->destination->postal_code); ?>


**Tanggal Pemesanan:**  
<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->created_at_formatted); ?>


---

## 🛍️ Item yang Dipesan

<?php $__env->startComponent('mail::table'); ?>
| Produk         | Qty | Harga Satuan | Subtotal   |
|----------------|-----|---------------|------------|
<?php $__currentLoopData = $sales_order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
| <?php echo new \Illuminate\Support\EncodedHtmlString($item->name); ?> | <?php echo new \Illuminate\Support\EncodedHtmlString($item->quantity); ?> | <?php echo new \Illuminate\Support\EncodedHtmlString($item->price_formatted); ?> | <?php echo new \Illuminate\Support\EncodedHtmlString($item->total_formatted); ?> |
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo $__env->renderComponent(); ?>

---

## 💰 Rincian Pembayaran

- **Subtotal**: <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->sub_total_formatted); ?>  
- **Ongkir**: <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->shipping_total_formatted); ?>  
- **Total**: **<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->total_formatted); ?>**

---

Terima kasih telah berbelanja bersama kami 🙏  
Semoga produk kami bermanfaat untuk Anda. Sampai jumpa di pesanan berikutnya!

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\laraherd\webstore\resources\views/mail/orders/completed.blade.php ENDPATH**/ ?>
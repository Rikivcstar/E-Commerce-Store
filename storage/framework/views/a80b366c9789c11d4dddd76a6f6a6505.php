<?php $__env->startComponent('mail::message'); ?>
# Pesanan Dibatalkan, <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->customer->full_name); ?> 😔

Pesanan Anda dengan nomor **#<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->trx_id); ?>** telah dibatalkan dan tidak akan diproses lebih lanjut.

---

## 📄 Ringkasan Pesanan:

**Alamat Pengiriman:**  
<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->address_line); ?>  
<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->destination->city); ?>, <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->destination->province); ?>, <?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->destination->postal_code); ?>


**Tanggal Pemesanan:**  
<?php echo new \Illuminate\Support\EncodedHtmlString($sales_order->created_at_formatted); ?>


---

## 🛍️ Item dalam Pesanan

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

Jika ini terjadi karena kesalahan atau Anda ingin memesan ulang, silakan hubungi tim kami.

Terima kasih telah mempercayai kami 🙏  
Kami berharap dapat membantu Anda di kesempatan berikutnya.

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\laraherd\webstore\resources\views/mail/orders/cancelled.blade.php ENDPATH**/ ?>
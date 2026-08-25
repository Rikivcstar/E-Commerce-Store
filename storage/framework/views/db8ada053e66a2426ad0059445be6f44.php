<?php
    $resolvedDescription = $metaDescription ?? '';
    $resolvedUrl = $metaUrl ?? url()->current();
    $resolvedTitle = $metaTitle ?? config('app.name');
    $resolvedImage = !empty($metaImage)
        ? (str_starts_with($metaImage, 'http') ? $metaImage : url($metaImage))
        : null;
?>

<meta name="description" content="<?php echo e($resolvedDescription); ?>">
<link rel="canonical" href="<?php echo e($resolvedUrl); ?>">

<meta property="og:type" content="website">
<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
<meta property="og:title" content="<?php echo e($resolvedTitle); ?>">
<meta property="og:description" content="<?php echo e($resolvedDescription); ?>">
<meta property="og:url" content="<?php echo e($resolvedUrl); ?>">
<!--[if BLOCK]><![endif]--><?php if($resolvedImage): ?>
    <meta property="og:image" content="<?php echo e($resolvedImage); ?>">
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

<meta name="twitter:card" content="<?php echo e($resolvedImage ? 'summary_large_image' : 'summary'); ?>">
<meta name="twitter:title" content="<?php echo e($resolvedTitle); ?>">
<meta name="twitter:description" content="<?php echo e($resolvedDescription); ?>">
<!--[if BLOCK]><![endif]--><?php if($resolvedImage): ?>
    <meta name="twitter:image" content="<?php echo e($resolvedImage); ?>">
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

<!--[if BLOCK]><![endif]--><?php if(!empty($jsonLd)): ?>
    <script type="application/ld+json"><?php echo json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\laraherd\webstore\resources\views/partials/meta-tags.blade.php ENDPATH**/ ?>
@php
    $resolvedDescription = $metaDescription ?? '';
    $resolvedUrl = $metaUrl ?? url()->current();
    $resolvedTitle = $metaTitle ?? config('app.name');
    $resolvedImage = !empty($metaImage)
        ? (str_starts_with($metaImage, 'http') ? $metaImage : url($metaImage))
        : null;
@endphp

<meta name="description" content="{{ $resolvedDescription }}">
<link rel="canonical" href="{{ $resolvedUrl }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ $resolvedTitle }}">
<meta property="og:description" content="{{ $resolvedDescription }}">
<meta property="og:url" content="{{ $resolvedUrl }}">
@if ($resolvedImage)
    <meta property="og:image" content="{{ $resolvedImage }}">
@endif

<meta name="twitter:card" content="{{ $resolvedImage ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:title" content="{{ $resolvedTitle }}">
<meta name="twitter:description" content="{{ $resolvedDescription }}">
@if ($resolvedImage)
    <meta name="twitter:image" content="{{ $resolvedImage }}">
@endif

@if (!empty($jsonLd))
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif

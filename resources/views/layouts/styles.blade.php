@notifyCss
<link rel="stylesheet" href="{{ asset('vendor/froala-editor/css/froala_editor.pkgd.min.css') }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
@stack('styles')
@bukStyles(true)


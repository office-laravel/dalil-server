<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}"/> 
  {{-- @foreach ( $mainarr['headerlist'] as $headrow )
  {{ Str::of($headrow['value1'])->toHtmlString()}}    
@endforeach --}}
<link href="{{ url('/public/uploading/' . $Settings->favicon) }}" rel="icon">  
<title>
  {{$Settings->nameWebsite}} @yield('page-title')
</title> 
 
  <!-- Bootstrap CSS -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Custom styles -->
 
      <!-- Map -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
      <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">
  
      <link rel="stylesheet" href="{{ url('/public/assets/site/css/map.css') }}">
      <link rel="stylesheet" href="{{ url('/public/assets/site/css/style_product.css') }}" />
          @yield('map-css')
  <link rel="stylesheet" href="{{ url('/public/assets/site/css/styles.css') }}" />
  
  @yield('css')
</head>

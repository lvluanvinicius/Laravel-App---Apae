<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('/images/app/logo-preta.webp') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') . ' | Blog' }}</title>

    @vite('resources/blog/app.js')
  </head>
  <body>
    <div id="blog-root"></div>
  </body>
</html>

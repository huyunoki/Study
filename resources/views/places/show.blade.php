<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Markdown Viewer</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
  <div class="container mx-auto p-6 flex justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full">
      <div class="prose lg:prose-lg mx-auto">
        {!! markdownToHtml($place->body) !!}
      </div>
    </div>
  </div>
</body>

</html>

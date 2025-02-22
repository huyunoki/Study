<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>markdown</title>
</head>

<body>
  <p>aaaS</p>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold">{{ $place->name }}</h1>
    <div class="mt-4 prose">
      {!! $place->description !!} {{-- Markdown をパースしたHTMLを表示 --}}
      
    </div>
  </div>
  <p>aaaS</p>
</body>

</html>
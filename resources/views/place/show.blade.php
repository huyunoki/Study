<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>markdown</title>
</head>

<body>
  <div class="container mx-auto p-4">

    <div class="mt-4 prose">
      {!! markdownToHtml($place->body) !!}
    </div>
  </div>
</body>

</html>
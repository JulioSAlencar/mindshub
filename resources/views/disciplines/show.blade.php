<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $discipline->title }}</title>
</head>
<body>

    <div class="tudo">
        <div id="image-container">
            <img src="/assets/disciplines/{{ $discipline->image }}" alt="{{ $discipline->title }}"
            style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
        </div>
        <div id="info-container">
            <h1>{{ $discipline->title}}</h1>
            <h5>{{ $discipline->description }}</h5>
        </div>

    </div>

</body>
</html>

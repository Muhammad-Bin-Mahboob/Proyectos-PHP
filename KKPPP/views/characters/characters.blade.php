<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character</title>
    <link rel="stylesheet" href="css\style.css">
</head>
<body>
    <div class='container'>
        @foreach ($characters as $character)
            <div class="character-card">
                <img src="{{ $character['img'] }}" alt="{{ $character['name'] }}" class="character-image">
                <div class="character-info">
                    <h3>{{ $character['name'] }}</h3>
                    <div>Alias: {{ $character['alias'] }}</div>
                    <div>Película: {{ $character['movie'] }}</div>
                    <div>Edad: {{ $character['age'] }}</div>
                    <div>Especie: {{ $character['species'] }}</div>
                    <div>Género: {{ $character['gender'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
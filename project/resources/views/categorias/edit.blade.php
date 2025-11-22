<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize/modern-normalize.css">
    <style>
        body{font-family:system-ui,Arial,sans-serif;margin:20px}
        label{display:block;margin-top:10px}
        input,textarea{width:100%;padding:8px;margin-top:4px}
        a.button,button{display:inline-block;padding:6px 10px;margin:10px 0;border:1px solid #444;background:#fff;cursor:pointer;text-decoration:none;color:#000}
    </style>
 </head>
 <body>
    <h1>Editar Categoria #{{ $categoria->id }}</h1>

    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
        @csrf
        @method('PUT')
        <label>Nome
            <input type="text" name="nome" value="{{ old('nome', $categoria->nome) }}" required>
        </label>
        <label>Descrição
            <textarea name="descricao" rows="4">{{ old('descricao', $categoria->descricao) }}</textarea>
        </label>
        <button type="submit">Atualizar</button>
        <a class="button" href="{{ route('categorias.index') }}">Voltar</a>
    </form>
 </body>
 </html>
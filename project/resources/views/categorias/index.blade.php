<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Categorias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize/modern-normalize.css">
    <style>
        body{font-family:system-ui,Arial,sans-serif;margin:20px}
        table{border-collapse:collapse;width:100%}
        th,td{border:1px solid #ddd;padding:8px}
        th{background:#f5f5f5}
        a.button,button{display:inline-block;padding:6px 10px;margin:2px;border:1px solid #444;background:#fff;cursor:pointer;text-decoration:none;color:#000}
        form{display:inline}
    </style>
 </head>
 <body>
    <h1>Categorias</h1>
    <p>
        <a class="button" href="{{ route('categorias.create') }}">Nova Categoria</a>
    </p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categorias as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nome }}</td>
                <td>{{ $c->descricao }}</td>
                <td>
                    <a class="button" href="{{ route('categorias.edit',$c->id) }}">Editar</a>
                    <form method="POST" action="{{ route('categorias.destroy',$c->id) }}" onsubmit="return confirm('Excluir esta categoria?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Nenhuma categoria encontrada.</td></tr>
        @endforelse
        </tbody>
    </table>
 </body>
 </html>
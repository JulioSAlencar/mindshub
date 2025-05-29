@extends('layouts.app')

@section('content')
<form action="{{ route('forum.replies.like', $reply->id) }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-sm btn-outline-danger">
        ❤️ {{ $reply->likes ?? 0 }}
    </button>
</form>

{{-- Resposta principal --}}
<div class="mb-3 p-2 border">
    <strong>{{ $reply->user->name }}</strong>: {{ $reply->content }}

    {{-- Botão para responder a essa resposta --}}
    <button class="btn btn-sm btn-link" onclick="toggleReplyForm({{ $reply->id }})">Responder</button>

    {{-- Formulário para sub-resposta --}}
    <form id="reply-form-{{ $reply->id }}" action="{{ route('forum.replies.reply', $topic->id) }}" method="POST" style="display:none;" class="mt-2">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
        <textarea name="content" class="form-control" rows="2" required></textarea>
        <button type="submit" class="btn btn-primary btn-sm mt-1">Enviar</button>
    </form>

    {{-- Sub-respostas --}}
    @foreach($reply->replies as $subReply)
        <div class="ms-4 mt-2 p-2 border bg-light">
            <strong>{{ $subReply->user->name }}</strong>: {{ $subReply->content }}
        </div>
    @endforeach
</div>

<script>
    function toggleReplyForm(id) {
        const form = document.getElementById('reply-form-' + id);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>

<form action="{{ route('forum.replies.vote', ['id' => $reply->id]) }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="vote" value="up">
    <button type="submit" class="btn btn-sm btn-outline-success">⬆️</button>
</form>

<span class="mx-1">{{ $reply->votes()->sum('vote') }}</span>

<form action="{{ route('forum.replies.vote', ['id' => $reply->id]) }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="vote" value="down">
    <button type="submit" class="btn btn-sm btn-outline-danger">⬇️</button>
</form>

{{-- Botão para abrir o formulário --}}
<button class="btn btn-sm btn-outline-warning" onclick="toggleReportForm({{ $reply->id }})">🚩 Denunciar</button>

{{-- Formulário escondido inicialmente --}}
<form action="{{ route('forum.replies.report', $reply->id) }}" method="POST" id="report-form-{{ $reply->id }}" style="display:none;" class="mt-2">
    @csrf
    <textarea name="reason" class="form-control" rows="2" placeholder="Motivo (opcional)"></textarea>
    <button type="submit" class="btn btn-danger btn-sm mt-1">Enviar denúncia</button>
</form>

<script>
    function toggleReportForm(id) {
        const form = document.getElementById('report-form-' + id);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>


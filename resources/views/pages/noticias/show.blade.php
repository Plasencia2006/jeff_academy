@extends('layouts.app')

@section('title', $noticia->titulo.' - Noticias - Jeff Academy')

@section('content')
<section class="noticia-show" style="margin-top:90px;">
  <div class="container">
    <nav style="margin-bottom:16px;font-size:.9rem;">
      <a href="{{ route('home') }}" style="text-decoration:none;color:var(--verde-medio);font-weight:700;">Inicio</a>
      <span style="color:#94a3b8;"> / </span>
      <a href="{{ route('noticias.index') }}" style="text-decoration:none;color:var(--verde-medio);font-weight:700;">Noticias</a>
    </nav>

    <article class="noticia-detalle" data-aos="fade-up" style="display:grid;grid-template-columns:1fr;gap:24px;">
      <header>
        @if($noticia->categoria)
          <span class="noticia-categoria" style="display:inline-block;background:linear-gradient(135deg,var(--verde-claro), var(--verde-medio));color:#fff;padding:6px 14px;border-radius:999px;font-size:.8rem;font-weight:800;">{{ ucfirst($noticia->categoria) }}</span>
        @endif
        <h1 class="section-title" style="margin:10px 0 6px;font-size:2rem;">{{ $noticia->titulo }}</h1>
        <p style="color:#6b7280;">{{ optional($noticia->fecha ?? $noticia->created_at)->format('d/m/Y') }}</p>
      </header>

      <div class="noticia-media" style="border-radius:16px;overflow:hidden;box-shadow: var(--shadow);">
        @if($noticia->imagen)
          @if(strpos($noticia->imagen, 'http') === 0)
            <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}" style="width:100%;height:460px;object-fit:cover;">
          @else
            <img src="{{ asset('storage/'.$noticia->imagen) }}" alt="{{ $noticia->titulo }}" style="width:100%;height:460px;object-fit:cover;">
          @endif
        @else
          <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?auto=format&fit=crop&w=1470&q=80" alt="{{ $noticia->titulo }}" style="width:100%;height:460px;object-fit:cover;">
        @endif
      </div>

      <div class="noticia-contenido" style="background:#fff;border-radius:16px;padding:24px;box-shadow: var(--shadow);">
        <p style="font-size:1.05rem;color:#374151;line-height:1.8;white-space:pre-line;">{{ $noticia->descripcion }}</p>
      </div>
    </article>

    @if($relacionadas->count())
    <section class="relacionadas" style="margin-top:40px;">
      <h3 style="font-size:1.25rem;margin-bottom:14px;color:#111827;">Noticias relacionadas</h3>
      <div class="noticias-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
        @foreach($relacionadas as $rel)
        <article class="noticia-card" data-aos="fade-up">
          <a href="{{ route('noticias.show', $rel->id) }}" class="noticia-imagen" style="height:160px;display:block;overflow:hidden;border-radius:12px;">
            @if($rel->imagen)
              @if(strpos($rel->imagen, 'http') === 0)
                <img src="{{ $rel->imagen }}" alt="{{ $rel->titulo }}" style="width:100%;height:100%;object-fit:cover;">
              @else
                <img src="{{ asset('storage/'.$rel->imagen) }}" alt="{{ $rel->titulo }}" style="width:100%;height:100%;object-fit:cover;">
              @endif
            @else
              <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?auto=format&fit=crop&w=1200&q=80" alt="{{ $rel->titulo }}" style="width:100%;height:100%;object-fit:cover;">
            @endif
          </a>
          <div class="noticia-contenido" style="padding:10px 2px;">
            <h4 style="margin:8px 0 6px;font-size:1rem;line-height:1.3;">
              <a href="{{ route('noticias.show', $rel->id) }}" style="text-decoration:none;color:#111827;">{{ $rel->titulo }}</a>
            </h4>
            <p style="color:#6b7280;font-size:.85rem;">{{ optional($rel->fecha ?? $rel->created_at)->format('d/m/Y') }}</p>
          </div>
        </article>
        @endforeach
      </div>
    </section>
    @endif
  </div>
</section>
@endsection

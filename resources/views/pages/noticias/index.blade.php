@extends('layouts.app')

@section('title', 'Noticias - Jeff Academy')

@section('content')
<section class="noticias-archive-section" style="margin-top:90px; padding: 60px 0;">
  <div class="container">
    <div class="archive-header" data-aos="fade-down" style="text-align: center; margin-bottom: 50px;">
      <h1 class="section-title" style="margin-bottom: 10px; font-size: 3rem; color: var(--verde-oscuro); font-weight: 800;">Noticias</h1>
      <p class="section-subtitle" style="margin: 0 0 30px; font-size: 1.1rem; color: #666;">Últimas novedades, comunicados y cobertura de eventos</p>
      {{-- <form method="get" action="{{ route('noticias.index') }}" class="archive-search" style="display: flex; justify-content: center; gap: 15px; align-items: center; max-width: 700px; margin: 0 auto;">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar noticias..." style="flex: 1; padding: 16px 24px; border: 3px solid var(--amarillo-brillante); border-radius: 50px; font-size: 1rem; outline: none;">
        <button class="btn-buscar" type="submit" style="background: var(--amarillo-brillante); color: #fff; border: none; padding: 16px 40px; border-radius: 50px; font-size: 1.1rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;">
          <i class="fas fa-search"></i> Buscar
        </button>
      </form> --}}
    </div>

    @if($noticias->count() === 0)
      <div style="padding:60px 0;text-align:center;color:#888;">
        No se encontraron noticias.
      </div>
    @else
    <div class="noticias-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:35px;margin-top:50px;">
      @foreach($noticias as $noticia)
      <article class="noticia-card" data-aos="fade-up">
        <a href="{{ route('noticias.show', $noticia->id) }}" class="noticia-imagen" style="height:240px;display:block;overflow:hidden;border-radius:15px 15px 0 0;">
          @if($noticia->imagen)
            @if(strpos($noticia->imagen, 'http') === 0)
              <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}" style="width:100%;height:100%;object-fit:cover;">
            @else
              <img src="{{ asset('storage/'.$noticia->imagen) }}" alt="{{ $noticia->titulo }}" style="width:100%;height:100%;object-fit:cover;">
            @endif
          @else
            <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?auto=format&fit=crop&w=1350&q=80" alt="{{ $noticia->titulo }}" style="width:100%;height:100%;object-fit:cover;">
          @endif
        </a>
        <div class="noticia-contenido" style="padding:20px;">
          @if($noticia->categoria)
          <span class="noticia-categoria" style="display:inline-block;background:var(--verde-claro);color:#fff;padding:8px 16px;border-radius:25px;font-size:.8rem;font-weight:700;text-transform:capitalize;">{{ ucfirst($noticia->categoria) }}</span>
          @endif
          <h3 style="margin:15px 0 8px;font-size:1.25rem;color:#1a1a1a;line-height:1.4;font-weight:700;">
            <a href="{{ route('noticias.show', $noticia->id) }}" style="text-decoration:none;color:inherit;">{{ $noticia->titulo }}</a>
          </h3>
          <p style="color:#888;font-size:.85rem;margin:0 0 12px;">{{ optional($noticia->fecha ?? $noticia->created_at)->format('d/m/Y') }}</p>
          <p style="color:#555;font-size:.95rem;line-height:1.6;margin-bottom:15px;">{{ Str::limit($noticia->descripcion, 120) }}</p>
          <a href="{{ route('noticias.show', $noticia->id) }}" class="btn-noticia">
            Leer más
          </a>
        </div>
      </article>
      @endforeach
    </div>

    <div class="pagination" style="margin-top:30px;display:flex;justify-content:center;">
      {{ $noticias->links() }}
    </div>
    @endif
  </div>
</section>
@endsection

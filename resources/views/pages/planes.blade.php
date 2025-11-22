@extends('layouts.app')

@section('title', 'Planes y Precios - Jeff Academy')

@section('content')
<section class="planes-hero" style="margin-top:80px;color:#fff; background:
  linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)),
  url('https://images.pexels.com/photos/46798/the-ball-stadion-football-the-pitch-46798.jpeg?auto=compress&cs=tinysrgb&w=1600');
  background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 360px;">
  <div class="container" style="padding:40px 0;">
    <h1 class="section-title" style="color:#fff; margin:0 0 6px;">PLANES Y PRECIOS</h1>
    <p class="section-subtitle" style="margin:0;color:#e9f5ec;">Elige el plan ideal para tu formación</p>
  </div>
</section>

<section class="planes-list" style="background:#fff;">
  <div class="container" style="padding:30px 0;">
    <div class="planes-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
      @foreach($planes as $plan)
      <div class="plan-card" style="background:#fff;border-radius:16px;box-shadow:var(--shadow);overflow:hidden;display:flex;flex-direction:column;">
        <div class="plan-header" style="background:linear-gradient(135deg,var(--verde-oscuro),var(--verde-medio));color:#fff;padding:18px 20px;">
          <h3 style="margin:0;font-size:1.3rem;">{{ $plan->nombre }}</h3>
          <p style="margin:6px 0 0;font-weight:800;font-size:1.4rem;">S/. {{ number_format($plan->precio, 2) }}</p>
        </div>
        <ul style="list-style:none;margin:0;padding:18px 20px;display:flex;flex-direction:column;gap:10px;color:#374151;">
          <li style="display:flex;gap:8px;align-items:flex-start;">
            <i class="fas fa-check" style="color:var(--verde-medio);"></i>
            <span>Duración: {{ $plan->duracion }} meses</span>
          </li>
          <li style="display:flex;gap:8px;align-items:flex-start;">
            <i class="fas fa-check" style="color:var(--verde-medio);"></i>
            <span>Tipo: {{ ucfirst($plan->tipo) }}</span>
          </li>
          @if($plan->disciplinas)
          @php
          $disciplinasIds = explode(',', $plan->disciplinas);
          $disciplinasNombres = \App\Models\Disciplina::whereIn('id', $disciplinasIds)->pluck('nombre')->toArray();
          @endphp
          <li style="display:flex;gap:8px;align-items:flex-start;">
            <i class="fas fa-check" style="color:var(--verde-medio);"></i>
            <span>Disciplinas: {{ implode(', ', $disciplinasNombres) }}</span>
          </li>
          @endif
          @if($plan->beneficios)
          <li style="display:flex;gap:8px;align-items:flex-start;">
            <i class="fas fa-check" style="color:var(--verde-medio);"></i>
            <span>{{ $plan->beneficios }}</span>
          </li>
          @endif
        </ul>
        <div style="padding:0 20px 20px;">
          @if($plan->estado == 'activo')
          <a href="{{ route('inscripcion') }}" class="btn btn-cta-primary" style="display:inline-flex;align-items:center;gap:8px;">
            <i class="fas fa-user-plus"></i> Inscribirme
          </a>
          @else
          <button class="btn btn-secondary" disabled style="display:inline-flex;align-items:center;gap:8px;">
            <i class="fas fa-ban"></i> No disponible
          </button>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
@php
    $map = [
        'pagada'    => 'text-bg-success',
        'parcial'   => 'text-bg-warning',
        'pendiente' => 'text-bg-secondary',
    ];
@endphp
<span class="badge {{ $map[$estatus] ?? 'text-bg-secondary' }}">{{ ucfirst($estatus) }}</span>

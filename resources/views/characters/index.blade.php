@extends('layouts.app')

@section('content')

<form action="{{ route('characters.store') }}" method="POST" class="mb-4 form_prueba">
    @csrf
    <button class="btn btn-success">Guardar Personajes</button>
</form>

<table class="table table-bordered align-middle">
    <tbody>
        <tr class="task">
            <th class="text-center">ID API</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Especie</th>
            <th class="text-center">Imagen</th>
            <th></th>
        </tr>
        @foreach ($characters as $c)
        <tr>
            <td class="text-center">{{ $c['id'] }}</td>
            <td>{{ $c['name'] }}</td>
            <td>{{ $c['status'] }}</td>
            <td class="text-center"><p class="custombadge bg-info text-center">{{ $c['species'] }}</p></td>
            <td class="align_center">
                <img src="{{ $c['image'] }}"
                    alt="{{ $c['name'] }}"
                >
            </td>
            <td class="text-center">
                <button
                    class="btn btn-sm btn-primary btn-detail"
                    data-id="{{ $c['id'] }}"
                    data-name="{{ $c['name'] }}"
                    data-status="{{ $c['status'] }}"
                    data-species="{{ $c['species'] }}"
                    data-type="{{ $c['type'] ?: 'N/A' }}"
                    data-gender="{{ $c['gender'] }}"
                    data-origin-name="{{ $c['origin']['name'] }}"
                    data-origin-url="{{ $c['origin']['url'] }}"
                    data-image="{{ $c['image'] }}"
                >
                    Detalle
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('characters._detail-modal')

@endsection

@push('scripts')
@endpush
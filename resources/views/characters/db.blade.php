@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

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
    @foreach($characters as $c)
    <tr class="task" >
      <td class="text-center">{{ $c->api_id }}</td>
      <td>{{ $c->name }}</td>
      <td>{{ $c->status }}</td>
      <td class="text-center"><p class="custombadge bg-info text-center">{{ $c->species }}</p></td>
      <td class="align_center"><img src="{{ $c->image_url }}"></td>
      <td class="text-center">
        <button
            class="btn btn-sm btn-warning btn-edit"
            data-id="{{ $c->id }}"
            data-name="{{ $c->name }}"
            data-status="{{ $c->status }}"
            data-species="{{ $c->species }}"
            data-type="{{ $c->type }}"
            data-gender="{{ $c->gender }}"
            data-origin_name="{{ $c->origin_name }}"
            data-origin_url="{{ $c->origin_url }}"
            data-image_url="{{ $c->image_url }}"
        >
            Editar
        </button>
        <button
            class="btn btn-sm btn-info btn-detail"
            data-id="{{ $c->api_id }}"
            data-name="{{ $c->name }}"
            data-status="{{ $c->status }}"
            data-species="{{ $c->species }}"
            data-type="{{ $c->type ?: 'N/A' }}"
            data-gender="{{ $c->gender }}"
            data-origin-name="{{ $c->origin_name }}"
            data-origin-url="{{ $c->origin_url }}"
            data-image="{{ $c->image_url }}"
        >
            Detalle
        </button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@include('characters._detail-modal')
@include('characters._edit-modal')
@endsection
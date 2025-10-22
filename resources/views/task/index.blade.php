@extends('app')
@section('body')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('tasks.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por título o descripción" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary ms-2">Buscar</button>
                </form>
            </div>
            <div class="col-md-6">
                <a type="button" class="btn btn-primary" href="{{ route('tasks.create') }}">Agregar Tarea</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Completada</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tasks) > 0)
                        @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{ $task->title }}</th>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->completed ? 'Sí' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="4" class="text-center">No hay tareas registradas</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

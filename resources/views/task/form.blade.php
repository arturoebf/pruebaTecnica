@extends('app')
@section('body')
    <div class="container">
        <div class="row mb-3">
            <div>
                <a type="button" class="btn btn-secondary" href="{{ route('tasks.index') }}">Volver</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>{{ isset($task) ? 'Editar Tarea' : 'Crear Tarea' }}</h2>
                <form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
                    @csrf
                    @if(isset($task))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="completed" name="completed" {{ old('completed', $task->completed ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="completed">Completada</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ isset($task) ? 'Actualizar' : 'Crear' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
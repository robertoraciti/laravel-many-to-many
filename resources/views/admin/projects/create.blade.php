@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1>Aggiungi progetto</h1>
        <a href="{{ route('admin.projects.index')}}" class="btn btn-primary">Torna indietro</a>
    </div>
    <form action="{{ route('admin.projects.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
        @csrf
        <div class="col-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            @error('nome')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-3">
            <label for="repo" class="form-label">Repo</label>
            <input type="url" name="repo" id="repo" class="form-control @error('repo') is-invalid @enderror" value="{{old('repo')}}">
            @error('repo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-3">
            <label for="collaborators" class="form-label">Colaboratori</label>
            <input type="number" name="collaborators" id="collaborators" class="form-control @error('collaborators') is-invalid @enderror" value="{{old('collaborators')}}">
            @error('collaborators')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{old('image')}}">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-3">
            <label for="publishing_date" class="form-label">Data di pubblicazione</label>
            <input type="date" name="publishing_date" id="publishing_date" class="form-control @error('publishing_date') is-invalid @enderror" value="{{old('publishing_date')}}">
            @error('publishing_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-3">
            <label for="typology_id" class="form-label">Tipologia</label>
            <select name="typology_id" id="typology_id" class="form-select @error('typology_id') is-invalid @enderror">
                <option value="">Senza tipologia</option>
                @foreach ($typologies as $typology)
                    <option value="{{ $typology->id }}" @if (old('typology_id') == $typology->id) selected @endif>{{$typology->name }}</option>
                @endforeach
            </select>
            @error('typology_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-12">
            <p>Tecnologie</p>
            <div class="form-check @error('technologies') is-invalid @enderror">
                @foreach ($technologies as $technology)
                    <input type="checkbox" name="technologies[]" id="technology-{{$technology->id}}" value="{{$technology->id}}" class="form-check-control" @if(in_array($technology->id, old('technologies') ?? [])) checked @endif>
                    <label for="technology-{{$technology->id}}">{{$technology->name}}</label><br>
                @endforeach
            </div>
            @error('technologies')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="col-3 mt-4">
            <button class="btn btn-success">Salva</button>
        </div>
    </form>
</div>
@endsection
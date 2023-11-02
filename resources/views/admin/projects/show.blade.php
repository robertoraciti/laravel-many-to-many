@extends('layouts.app')

@section('content')
<section class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.projects.index')}}" class="btn btn-primary">Torna indietro</a>
        <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-warning">Modifica</a>
    </div>
    <h1 class="my-3">
        <div class="col-12">
            {{ $project->title}} 
        </div>
    </h1>
    <div class="row g-5">
        <div class="col-4">
            <img src="{{ asset('/storage/' . $project->image) }}" alt="" class="img-fluid">
        </div>
        <div class="col-8">
            <div class="row g-5">
                <div class="col-2">
                    <strong>ID: </strong><br>
                    {{ $project->id}} 
                </div>
                <div class="col-2">
                    <strong>Name: </strong><br>
                    {{ $project->name}} 
                </div>
                <div class="col-2">
                    <strong>Repo: </strong><br>
                    {{ $project->repo}} 
                </div>
                <div class="col-2">
                    <strong>Data pubblicazione: </strong><br>
                    {{ $project->publishing_date}} 
                </div>
                <div class="col-2">
                    <strong>Collaboratori: </strong><br>
                    {{ $project->collaborators}}
                </div>
                <div class="col-2">
                    <strong>Tipologia: </strong><br>
                    {!! $project->getTypologyName()!!}
                </div>
                <div class="col-2">
                    <strong>Tecnologia: </strong><br>
                    {!! $project->getTechName()!!}
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
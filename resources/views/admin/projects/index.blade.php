@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
@endsection


@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h1>Lista Progetti</h1>
            <a href="{{ route('admin.projects.create')}}" class="btn btn-primary">Aggiungi Progetto</a>
        </div>
    
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Repo</th>
                <th scope="col">Collaboratori</th>
                <th scope="col">Data di Pubblicazione</th>
                <th scope="col">Tipologia</th>
                <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->name}}</td>
                    <td>{{$project->repo}}</td>
                    <td>{{$project->collaborators}}</td>
                    <td>{{$project->publishing_date}}</td>
                    <td>{!! $project->getTypologyName()!!}</td>
                    <td>
                    <a href="{{ route('admin.projects.show', $project) }}">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.projects.edit', $project) }}">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}">
                        <i class="fa-regular fa-trash-can text-danger"></i>
                    </a>
    
                    <div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina progetto</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Sicuro di voler eliminare il seguente progetto : <br>
                              "{{ $project->name }}"
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <form action="{{ route ('admin.projects.destroy', $project) }}" method="POST" class="mx-1">
                                    @method ('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Elimina</button>
                                </form>                        
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>

        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection
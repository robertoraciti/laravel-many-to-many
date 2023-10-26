<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Typology;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typologies = Typology::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('typologies', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validation($data);

        $project = new Project();
        $project->fill($data);
        $project->save();

        if (Arr::exists($data, 'technologies')) {
            $project->technology()->attach($data['technologies']);
        }

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('message', 'Creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $typologies = Typology::all();
        $technologies = Technology::all();
        $technology_ids = $project->technology->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'typologies', 'technologies', 'technology_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();
        $this->validation($data);

        $project->update($data);

        if (Arr::exists($data, 'technologies')) {
            $project->technology()->sync($data['technologies']);
        } else {
            $project->technology()->detach();
        }

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('message', 'Aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technology()->detach();
        $project->delete();
        return redirect()
            ->route('admin.projects.index')
            ->with('message', 'Eliminato con successo');
    }

    private function validation($data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required|string|max:50',
                'repo' => 'required|url',
                'collaborators' => 'required|integer',
                'publishing_date' => 'required|date',
                'typology_id' => 'nullable|exists:typologies,id',
                'technologies' => 'nullable|exists:technologies,id',

            ],
            [
                'name.required' => 'Il nome è obbligatorio',
                'name.string' => 'Il nome deve essere una stringa',
                'name.max' => 'Il nome deve contenere massimo 50 caratteri',

                'repo.required' => 'La repo è obbligatoria',
                'repo.url' => 'La repo deve essere un url',

                'collaborators.required' => 'Il numero dei collaboratori è obbligatorio',
                'collaborators.integer' => 'Il campo deve essere un numero',

                'publishing_date.required' => 'La data è obbligatoria',
                'publishing_date.date' => 'Formato data errato',

                'typology_id.exists' => 'La tipologia inserita non è valida',

                'technologies.exists' => 'La tecnologia inserita non è valida'
            ]

        )->validate();
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
       
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'min:5',
                    'max:150',
                    
                    Rule::unique('projects')->ignore($project)
                ],
                'img'=> [
                    'nullable',
                    'image',
                    'max:256'
                ],
                'type'=> [
                     'nullable',
                     'exists:types,id'
                ]

            ],
                [
                    'name.required'=>'il nome non può essere vuoto',
                    'unique'=>"il nome è già stato preso",
                    'min'=>'il nome deve essere almeno 5 caratteri',
                    'max'=>'il nome può avere massimo 150 caratteri'
                ]
                
                
                
        );
        $newProject = new Project;
        $formData = $request->all();
        //controllo se il campo img contiene una immagine
        if($request->hasFile('img')){
            //carico il file nella cartella
            $img=Storage::disk('public')->put('Project_image', $formData['img']);
            //salvo il path dell'immagine nella colonna
            $formData['img'] = $img;
        }

        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->name,'-');
        $newProject->save();
        return redirect()->route('admin.projects.show', ['project'=> $newProject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.show', compact('project','types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'min:5',
                    'max:150',
                    
                    Rule::unique('projects')->ignore($project)
                ],
                'img'=> [
                    'nullable',
                    'image',
                    'max:256'
                ],
                'type'=> [
                    'nullable',
                    'exists:types,id'
               ]
                
            ],
                [
                    'name.required'=>'il nome non può essere vuoto',
                    'unique'=>"il nome è già stato preso",
                    'min'=>'il nome deve essere almeno 5 caratteri',
                    'max'=>'il nome può avere massimo 150 caratteri'
                ]
                
        );
        $formData = $request->all();
        //controllo se il campo img contiene una immagine
        if($request->hasFile('img')){
           if($project->img){
            Storage::delete($project->img);
           }
           $img= Storage::disk('public')->put('Project_image', $formData['img']);
           $formData['img'] = $img;
        }
        $formData['slug'] = Str::slug($formData['name'],'-');
        $project->update($formData);
        return redirect()->route('admin.projects.show', ['project'=> $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\project;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            return view('admin.projects.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
         $validated = $request->validate(
             [
                 'name' => 'required|min:5|max:150|unique:projects,name',
                 'summary' => 'min:10|max:500',
                 'client_name' => 'min:3|max:250',
                 'cover_image' => 'nullable|image|max:512'
             ],
             [
                'name.required' => 'devi dare un nome al progetto',
                'name.unique' => 'il nome del progetto è già in uso',
                'name.min' => 'il nome del progetto deve avere minimo 5 caratteri',
                'name.max' => 'il nome del progetto deve avere un massimo di 150 caratteri',
                'summary.min' => 'il summary del progetto deve avere una descrizione minima di 10 caratteri',
                'summary.max' => 'il summary del progetto deve avere una descrizione massima di 500 caratteri',
                'client_name.min' => 'il nome del cliente deve avere un minimo di 3 caratteri',
                'client_name.max' => 'il nome del cliente deve avere un massimo di 150 caratteri',
                'cover_image' => "l' immagine caricata non deve superare il peso di 512kb "
             ]
         );





        $formData = $request->all();
        if($request->hasFile('cover_image')) {
            $img_path = Storage::disk('public')->put('project_images', $formData['cover_image']);
            $formData['cover_image'] = $img_path;
        }
        $newProject = new project();
        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->name, '-');
        $newProject->save();

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug]);

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        $validated = $request->validate(
                [
                    'name' => [
                        'required',
                        'min:5',
                        'max:150',
                        Rule::unique('projects')->ignore($project)
                    ],
                    'summary' => 'min:10|max:500',
                    'client_name' => 'min:3|max:250',
                    'cover_image' => 'nullable|image|max:512'
                ],
                [
                   'name.required' => 'devi dare un nome al progetto',
                   'name.unique' => 'il nome del progetto è già in uso',
                   'name.min' => 'il nome del progetto deve avere minimo 5 caratteri',
                   'name.max' => 'il nome del progetto deve avere un massimo di 150 caratteri',
                   'summary.min' => 'il summary del progetto deve avere una descrizione minima di 10 caratteri',
                   'summary.max' => 'il summary del progetto deve avere una descrizione massima di 500 caratteri',
                   'client_name.min' => 'il nome del cliente deve avere un minimo di 3 caratteri',
                   'client_name.max' => 'il nome del cliente deve avere un massimo di 150 caratteri',
                   'cover_image' => "l' immagine caricata non deve superare il peso di 512kb "
                ]
            );







        $formData = $request->all();

        if($request->hasFile('cover_image')) {

            if($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $img_path = Storage::disk('public')->put('project_images', $formData['cover_image']);
            $formData['cover_image'] = $img_path;
        }



        $project->slug = Str::slug($formData['name'], '-');
        $project->update($formData);

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}

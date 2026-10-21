<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->with('items')->latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'area_m2'     => 'nullable|numeric|min:0',
        ]);

        $project = $request->user()->projects()->create($data);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto creado. Ahora agrega materiales.');
    }

    public function show(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $project->load('items.material');

        $categories = Material::active()->distinct()->orderBy('category')->pluck('category');
        $category = $request->query('category');

        $materials = Material::active()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->orderBy('name')
            ->get();

        return view('projects.show', [
            'project'    => $project,
            'materials'  => $materials,
            'categories' => $categories,
            'category'   => $category,
            'budget'     => $project->budget(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $data = $request->validate([
            'name'                => 'sometimes|required|string|max:255',
            'description'         => 'nullable|string|max:2000',
            'area_m2'             => 'nullable|numeric|min:0',
            'status'              => 'sometimes|in:borrador,cotizado,aprobado',
            'labor_percent'       => 'sometimes|numeric|min:0|max:100',
            'contingency_percent' => 'sometimes|numeric|min:0|max:100',
            'tax_percent'         => 'sometimes|numeric|min:0|max:100',
        ]);

        $project->update($data);

        return back()->with('success', 'Proyecto actualizado.');
    }

    public function destroy(Project $project)
    {
        $this->authorizeOwner($project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado.');
    }

    private function authorizeOwner(Project $project): void
    {
        abort_unless($project->user_id === auth()->id(), 403);
    }
}

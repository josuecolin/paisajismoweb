<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Project;
use App\Models\ProjectItem;
use Illuminate\Http\Request;

class ProjectItemController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $data = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'quantity'    => 'required|numeric|min:0.01',
            'notes'       => 'nullable|string|max:255',
        ]);

        $material = Material::active()->findOrFail($data['material_id']);

        // Si el material ya está en el proyecto, suma la cantidad.
        $item = $project->items()->firstOrNew(['material_id' => $material->id]);
        $item->quantity = ($item->exists ? $item->quantity : 0) + $data['quantity'];
        $item->unit_price = $item->exists ? $item->unit_price : $material->unit_price;
        $item->notes = $data['notes'] ?? $item->notes;
        $item->save();

        return back()->with('success', "{$material->name} agregado al presupuesto.");
    }

    public function update(Request $request, Project $project, ProjectItem $item)
    {
        $this->authorizeOwner($project);
        abort_unless($item->project_id === $project->id, 404);

        $data = $request->validate([
            'quantity' => 'required|numeric|min:0.01',
            'notes'    => 'nullable|string|max:255',
        ]);

        $item->update($data);

        return back()->with('success', 'Cantidad actualizada.');
    }

    public function destroy(Project $project, ProjectItem $item)
    {
        $this->authorizeOwner($project);
        abort_unless($item->project_id === $project->id, 404);

        $item->delete();

        return back()->with('success', 'Material eliminado del presupuesto.');
    }

    private function authorizeOwner(Project $project): void
    {
        abort_unless($project->user_id === auth()->id(), 403);
    }
}

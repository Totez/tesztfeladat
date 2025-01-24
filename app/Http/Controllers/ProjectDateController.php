<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDate;
use DateTime;
use Illuminate\Http\Request;

class ProjectDateController extends Controller
{

    public function storeStart(Project $project)
    {

        $dateTime = $project->dates()->create([
            'start' => new DateTime(),
        ]);

        return response()->json($dateTime);
    }

    public function storeFinish(Request $request, $id)
    {

        $projectDate = ProjectDate::findOrFail($id);
        $validated = $request->validate([
            'memo' => 'required|string',
        ]);

        $projectDate->update([
            'memo' => $validated['memo'],
            'finish' => new DateTime()
        ]);

        return response()->json($projectDate);
    }
}

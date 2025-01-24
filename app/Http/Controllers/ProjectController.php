<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('dates')->orderBy('created_at', 'desc')->get();
        return view("page.home", compact("projects"));
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $project = Project::create($validated);

        $html = view("component.project-list-item", compact("project"))->render();

        return response()->json([
            'message' => 'Project created!',
            'project' => $project,
            'html' => $html,
        ]);
    }

    /**
     * Display the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with(['dates' => function ($query) {
            $query->whereNotNull('start')->whereNull('finish');
        }])->findOrFail($id);

        return response()->json($project);
    }


    public function summary()
    {
        $projects = Project::with('dates')->get();
        $totals = [];

        $projects->each(function ($project) use (&$totals) {
            $totalSeconds = 0;

            $project->dates->each(function ($date) use (&$totalSeconds) {
                $start = Carbon::parse($date->start);
                $finish = Carbon::parse($date->finish);
                $diffInSeconds = $finish->diffInSeconds($start);

                $totalSeconds += $diffInSeconds;

                $hours = floor($totalSeconds / 3600);
                $minutes = floor(($totalSeconds % 3600) / 60);
                $seconds = $totalSeconds % 60;

                $date->duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            });

            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;

            $totals[$project->name] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        });

        $firstDate = ProjectDate::orderBy('start')->value('start');
        $lastDate = ProjectDate::orderByDesc('finish')->value('finish');

        return view('page.summary', compact('projects', 'totals', 'firstDate', 'lastDate'));
    }

}

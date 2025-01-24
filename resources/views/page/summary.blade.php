@extends('app')

@section('content')
    <div class="container mt-4">

        <a class="btn btn-secondary mb-3" href="{{ route("projects") }}">Back to Projects</a>

        <div class="border">
            <div class="row p-2">
                <div class="col-md-6">
                    <p class="text-muted"><em>Export period: {{ $firstDate }} - {{ $lastDate }}</em></p>
                    <p class="text-muted"><em>Created at: {{ now()->format('Y-m-d H:i:s') }}</em></p>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Project</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totals as $projectName => $totalDuration)
                                        <tr>
                                            <td>{{ $projectName }}</td>
                                            <td class="text-end fw-bold">{{ $totalDuration }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Project</th>
                                        <th>Start</th>
                                        <th>Finish</th>
                                        <th>Duration</th>
                                        <th>Memo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        @foreach ($project->dates as $date)
                                            <tr>
                                                <td>{{ $project->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($date->start)->format('Y-m-d H:i:s') }}</td>
                                                <td>{{ Carbon\Carbon::parse($date->finish)->format('Y-m-d H:i:s') }}</td>
                                                <td>{{ $date->duration }}</td>
                                                <td>{{ $date->memo }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

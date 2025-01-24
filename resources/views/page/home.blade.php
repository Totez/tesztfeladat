@extends('app')
@section('content')

    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <div class="w-50">
                <div class="border text-center">
                    <h2>Track Time for Project</h2>
                    <form method="POST" action="{{ route("project.store") }}" id="create_new_project">
                        @csrf
                        <input name="name" class="form-control text-center" type="text" placeholder="Add new Project...">
                    </form>
                </div>
                <ul class="list-group text-center" id="project-list">
                    @foreach ($projects as $project)
                        @include("component.project-list-item", ["project" => $project])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="container text-center mt-5">
        <a class="btn btn-primary" href="{{ route("projects.summary") }}">summary</a>
    </div>

    @include("modal.counter")

@endsection



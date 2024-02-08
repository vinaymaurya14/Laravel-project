<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<section class="hero is-primary">
    <div class="hero-body">
        <p class="title">Task Managements</p>
    </div>
</section>
@if($errors->any())
    <div class="notification is-danger">
        <button class="delete"></button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="section">
    <h1 class="title">Tasks | Index</h1>
    <h2 class="subtitle">Can create new task <a href="{{ route('tasks.create') }}">here.</a></h2>
    <div class="tile is-ancestor">
        @foreach($tasks as $task)
            <div class="tile is-parent">
                <article class="tile is-child box @if($task->is_completed) has-background-grey-lighter @endif">
                    <p class="title">{{ Str::limit($task->title, 20) }}</p>
                    <p class="subtitle">{{ Str::limit($task->description, 50) }}</p>
                    <div class="content">
                        <!-- Toggle Task Completion -->
                        @if($task->is_completed)
                            <form method="POST" action="{{ route('tasks.yet_complete', $task->id) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="button is-small">
                                    <span class="icon is-small"><i class="fas fa-undo"></i></span>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('tasks.complete', $task->id) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="button is-small">
                                    <span class="icon is-small"><i class="fas fa-check"></i></span>
                                </button>
                            </form>
                        @endif

                        <!-- Delete Task Button -->
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-small is-danger">
                                <span class="icon is-small"><i class="fas fa-trash"></i></span>
                            </button>
                        </form>

                        <!-- Show Task Details Button -->
                        <a href="{{ route('tasks.show', $task->id) }}" class="button is-small is-info">
                            <span class="icon is-small"><i class="fas fa-eye"></i></span>
                        </a>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</section>
</body>
</html>

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
            <p class="title">
                Task Managements
            </p>
        </div>
    </section>
    @if($errors->any())
        <div class="notification is-danger">
            <button class="delete"></button>
            <ul>
                @foreach(\Illuminate\Support\Arr::flatten($errors->get('*')) as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="section">
        <h1 class="title">Tasks | Show: {{ $task->id }}</h1>
        <div class="card">
            <div class="card-content">
                <!-- Task Detail Fields -->
                <div class="content">
                    <p><strong>Title:</strong> {{ $task->title }}</p>
                    <p><strong>Description:</strong> {{ $task->description }}</p>
                    <p><strong>Status:</strong> {{ $task->is_completed ? 'Completed' : 'Pending' }}</p>
                </div>

                <!-- Comments Section -->
                <div class="comments">
                    <h3>Comments</h3>
                    @foreach($task->comments as $comment)
                        <div class="box">
                            <article class="media">
                                <div class="media-content">
                                    <div class="content">
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <!-- Comment Submission Form -->
                <form method="POST" action="{{ route('tasks.comments.store', $task) }}">
                    @csrf
                    <div class="field">
                        <label class="label" for="comment">New Comment</label>
                        <textarea name="comment" id="comment" class="textarea" required></textarea>
                    </div>
                    <div class="field">
                        <button type="submit" class="button is-link">Add Comment</button>
                    </div>
                </form>

                <!-- Footer with Edit Link -->
                <footer class="card-footer">
                    <a class="card-footer-item button" href="{{ route('tasks.edit', $task) }}">Edit</a>
                </footer>
            </div>
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .posts{
            background-color: gray;
            color: white;
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body>

    @auth
        <p>Hello, {{ auth()->user()->name }}! You are logged in.</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>

        <div style="border: 3px solid black; padding: 2rem;">
            <h2>Create A New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="description" placeholder="description"></textarea>
                <button>Create Post</button>
            </form>
        </div>

        <div style="border: 3px solid black; padding: 2rem; margin-top: 50px;">
            <h2>All Posts</h2>
            @if($posts->isEmpty())
            <p>You have no posts yet.</p>
        @else
            @foreach($posts as $post)
                <div class="posts">
                    <h1>{{$post->title}} by {{$post->user->name}}</h1>
                    <p>{{$post->description}}</p>
                    <p><a href="/edit-post/{{$post->id}}">Edit</a></p>

                    <form action="/delete-post/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>DELETE</button>
                    </form>
                </div>
            @endforeach
        @endif
        </div>
    @else 
        <div style="border: 3px solid black; padding: 2rem;">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input type="text" placeholder="name" name="name">
                <input type="text" placeholder="email" name="email">
                <input type="password" placeholder="password" name="password">
                <button>Register</button>
            </form>
        </div>

        <div style="border: 3px solid black; padding: 2rem;">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input type="text" placeholder="name" name="loginName">
                <input type="password" placeholder="password" name="loginPassword">
                <button>Login</button>
            </form>
        </div>
    @endauth

</body>
</html>
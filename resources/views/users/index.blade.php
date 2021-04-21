@extends("layouts.app")

@section("content")
    <h1>Lista de Usuarios</h1>
    @empty($users)
        <div class="alert alert-warning">
        La lista de usuarios esta vacia!
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{optional($user->admin_since)->diffForHumans() ?? "Nunca"}}</td>
                        <td>
                            <form class="d-inline" action="{{ route("users.admin.toggle", ["user" => $user->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    {{$user->isAdmin() ? "Sacar Admin" : "Hacer Admin"}}
                                </button>
                            </form>                       
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@endsection
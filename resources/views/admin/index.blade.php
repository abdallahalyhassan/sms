@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Admins</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Admins</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Admins</h5>
                            <p> <a href="{{ route('admins.create') }}">Add Admin</a></p>
                             @if (session('success'))
                                <h3 class="text-success my-2"> {{ session('success') }}</h3>
                            @endif
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>N</b>ame
                                        </th>
                                        <th>Email.</th>
                                        <th>edite</th>
                                        <th>show</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                  
                                        <tr>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>
                                                <a href="{{route('admins.edit', $admin->id) }}"
                                                    class="btn btn-info">edit</a>
                                            </td>
                                            <td>
                                                <a href="{{route('admins.show', $admin->id) }}"
                                                    class="btn btn-info">Show</a>
                                            </td>
                                            <td>
                                                <form action="{{route('admins.destroy', $admin->id) }}" method='post'>
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit" class="btn btn-danger" value="Delete"></input>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection

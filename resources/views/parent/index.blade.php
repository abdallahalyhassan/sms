@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Parantes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Parantes</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Parents</h5>
                            <p> <a href="{{ route('parents.create') }}">Add Parent</a></p>
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
                                        <th>children.</th>
                                        <th>Phone</th>
                                        <th>edite</th>
                                        <th>show</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parents as $parent)
                                        <tr>
                                            <td>{{ $parent->user->name }}</td>
                                            <td>
                                                <select name="" id="">
                                                @foreach ($parent->children as $child)
                                                    <option value="">{{ $child->user->name }}{{ !$loop->last ? ',' : '' }} </option>
                                                @endforeach
                                                </select>
                                            </td>
                                            <td>{{ $parent->phone }}</td>
                                            <td>
                                                <a href="{{ route('parents.edit', $parent->id) }}"
                                                    class="btn btn-info">edit</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('parents.show', $parent->id) }}"
                                                    class="btn btn-info">Show</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('parents.destroy', $parent->id) }}" method='post'>
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

@extends('layouts.layout_admin')

@section('contenido')
<div class="container" style="padding-top: 5rem; padding-bottom: 3rem;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Has iniciado sesión correctamente.') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- {{auth()->user()}} --}}

                    <h4>Bienvenido, {{ Auth::user()->name }}</h4>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    {{-- <p><strong>Rol:</strong> {{ Auth::user()->rol ?? 'No definido' }}</p> --}}
                    <p><strong>Rol:</strong> {{ Auth::user()->getRoleNames()->implode(', ') ?: 'No definido' }}</p>



                    {{-- <p class="mt-3 text-muted">
                        {{ __('Has iniciado sesión correctamente.') }}
                    </p> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

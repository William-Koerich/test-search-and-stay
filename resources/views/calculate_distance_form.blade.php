@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <h2 class="mb-4">Calculate Distance Between Two CEPs</h2>
            <form action="{{ route('distance.calculate') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="cep_origem">CEP Origem:</label>
                    <input type="text" class="form-control" id="cep_origem" name="cep_origem" required>
                </div>
                <div class="form-group">
                    <label for="cep_destino">CEP Destino:</label>
                    <input type="text" class="form-control" id="cep_destino" name="cep_destino" required>
                </div>
                <button type="submit" class="btn btn-primary">Calculate</button>
            </form>

            <!-- Exibir resultado do cálculo -->
            @if(isset($distancia))
                <div class="mt-4">
                    <h3>Resultado:</h3>
                    <p>{{ $distancia }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection

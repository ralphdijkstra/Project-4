@extends('layouts.dashboard')

@section('content')
    <div class="text-xl">Personen</div>
    @canany(['manage activiteiten', 'admin'])
        @foreach ($persons as $person)
            <div>
                <a href="{{ route('persons.edit', $person) }}">
                    {{ $person->last_name }}
                </a>
            </div>
        @endforeach
    @else
        <p>Je hebt geen rechten om deze pagina te bekijken</p>
    @endcan
    </div>
@endsection

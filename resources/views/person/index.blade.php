@extends('layouts.dashboard')

@section('content')
@canany(['manage activiteiten', 'admin'])
    <div class="mb-36">
        <div class="flex justify-between items-center h-16 border border-gray-300">
            <div class="flex items-center w-[20%]">
                <p class="text-xl border-r-2 text-center w-[50%]">All Users</p>
                <p class="text-md text-gray-500 text-center w-[50%]">{{ $persons_count }} total</p>
            </div>
            <div class="flex items-center justify-end w-[30%] h-full">
                <div
                    class="border-l border-gray-300 text-white h-full flex justify-between items-center w-[20%] px-3 text-xl">
                    <i class="fa fa-search m-auto text-gray-300"></i>
                </div>
                <div class="bg-blue-500 text-white h-full flex justify-between items-center w-[50%] px-8">
                    <p>Add User</p><i class="fa fa-plus text-blue-300"></i>
                </div>
            </div>
        </div>
        <div class="flex h-12 items-center border-x border-b border-gray-300">
            <div class="flex w-[10%] border-r border-gray-300 h-full">
                <input type="checkbox" class="border-blue-500 rounded-sm m-auto">
            </div>
            <div
                class="flex w-[25%] px-3 border-r border-gray-300 h-full items-center justify-between cursor-pointer hover:bg-gray-100">
                <p class="font-bold">Name</p>
                <i class="fa fa-arrow-up"></i>
            </div>
            <div class="flex w-full px-3 h-full items-center">
                <p class="text-gray-500">Site role</p>
            </div>
        </div>
        @foreach ($persons as $person)
                <div class="flex h-12 items-center border-x border-b border-gray-300">
                    <div class="flex w-[10%] border-r border-gray-300 h-full">
                        <input type="checkbox" class="border-blue-500 rounded-sm m-auto">
                    </div>
                    <a href="{{ route('persons.edit', $person) }}"
                        class="flex w-[25%] px-3 border-r border-gray-300 h-full items-center cursor-pointer hover:bg-gray-100">
                        <p>{{ $person->user->name }}</p>
                    </a>
                    <div class="flex w-full px-3 h-full items-center">
                        <div class="flex w-[65%] h-full items-center">
                            @foreach ($person->user->roles()->orderby('id', 'desc')->get() as $role)
                                <div
                                    class="bg-slate-200 rounded-full px-3 mx-1 text-center hover:border hover:border-black cursor-pointer">
                                    <form action="{{ route('removerole', [$person, $role]) }}" method="get">
                                        @csrf
                                        <input type="submit" value="{{ $role->name }}">
                                    </form>
                                </div>
                            @endforeach
                            <div>
                                <x-role-dropdown>
                                    <x-slot name="trigger">
                                        <div
                                            class="bg-transparent hover:bg-gray-100 border hover:border-black cursor-pointer font-bold rounded-full px-3 mx-1 w-10 text-center">
                                            <p>+</p>
                                        </div>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="mx-auto w-[70%]">
                                            @foreach ($roles as $role)
                                                @if (!$person->user->roles()->get()->contains($role))
                                                    <div class="bg-slate-200 rounded-full px-3 my-2 w-max text-center">
                                                        <form action="{{ route('assignrole', [$person, $role]) }}"
                                                            method="get">
                                                            @csrf
                                                            <input type="submit" value="{{ $role->name }}">
                                                        </form>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </x-slot>
                                </x-role-dropdown>
                            </div>
                        </div>
                        <div class="flex w-[35%] px-3 h-full items-center justify-between">
                            <i class="fa fa-refresh text-gray-500"></i>
                            <p class="text-gray-500">Reset password</p>
                            <i class="fa fa-trash text-gray-500"></i>
                            <p class="text-gray-500">Delete</p>
                        </div>
                    </div>
                </div>
        @endforeach
        <div class= "w-full border-x border-b border-gray-300 p-5">
            {{ $persons->links() }}
        </div>
    </div>
    @else
        <p>Je hebt geen rechten om deze pagina te bekijken</p>
    @endcan
    </div>
@endsection

@extends('layouts.dashboard')

@section('content')
    @canany(['manage activiteiten', 'admin'])
        <div class="mb-36">
            <div class="flex justify-between items-center h-16 border border-gray-300">
                <div class="flex items-center lg:w-[20%] w-[40%]">
                    <p class="lg:text-xl border-r-2 text-center w-[50%]">All Users</p>
                    <p class="lg:text-md text-sm text-gray-500 text-center w-[50%]">{{ $persons_count }} total</p>
                </div>
                <div class="flex items-center justify-end lg:w-[40%] w-full h-full">
                    <div
                        class="border-l border-gray-300 h-full flex justify-between items-center lg:w-[20%] lg:hover:w-[60%] w-[20%] hover:w-[50%] px-3 text-xl group transition-all duration-300">
                        <i class="fa fa-search m-auto text-gray-300 group-hover:text-gray-500 group-hover:mx-5"></i>
                        <input type="text" class="group-hover:block hidden w-full border-gray-500 delay-200">
                    </div>
                    <div class="bg-blue-500 text-white h-full flex justify-between items-center w-[35%] lg:px-8 px-4 lg:text-md text-sm">
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
                        class="flex w-[25%] lg:text-md md:text-sm text-xs px-3 border-r border-gray-300 h-full items-center cursor-pointer hover:bg-gray-100">
                        <p class="break-all">{{ $person->user->name }}</p>
                    </a>
                    <div class="flex w-full px-3 h-full items-center">
                        <div class="flex flex-wrap lg:w-[70%] w-[90%] h-full items-center">
                            @foreach ($person->user->roles()->orderby('id', 'desc')->get() as $role)
                                    @if (Auth::user()->person->id == $person->id && $role->id == 6)
                                    <div
                                        class="bg-slate-200 rounded-full px-3 mx-1 text-center border border-transparent lg:text-md md:text-sm text-xs">
                                        {{$role->name}}
                                    @else
                                    <div
                                        class="bg-slate-200 rounded-full px-3 mx-1 text-center border border-transparent lg:text-md md:text-sm text-xs hover:border hover:border-black cursor-pointer">
                                        <form action="{{ route('removerole', [$person, $role]) }}" method="get">
                                            @csrf
                                            <input type="submit" value="{{ $role->name }}">
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                            <div>
                                <x-role-dropdown>
                                    <x-slot name="trigger">
                                        <div
                                            class="bg-transparent lg:text-md md:text-sm text-xs hover:bg-gray-100 border hover:border-black cursor-pointer font-bold rounded-full px-3 mx-1 w-10 text-center">
                                            <p>+</p>
                                        </div>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="mx-auto w-[70%]">
                                            @foreach ($roles as $role)
                                                @if (!$person->user->roles()->get()->contains($role))
                                                    <div
                                                        class="bg-slate-200 rounded-full px-3 my-2 w-max text-center border border-transparent hover:border hover:border-black cursor-pointer lg:text-md md:text-sm text-xs">
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
                        <div class="flex lg:w-[30%] w-[10%] h-full items-center justify-between">
                            <button class="flex items-center justify-between">
                            <i class="fa fa-refresh text-gray-500 mx-1"></i>
                            <p class="text-gray-500 mx-1 lg:block hidden">Reset password</p>
                            </button>

                            <button class="flex items-center justify-between" x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-{{ $person->id }}-deletion')">
                                <i class="fa fa-trash text-gray-500 mx-1"></i>
                                <p class="text-gray-500 mx-1 lg:block hidden">Delete</p>
                            </button>

                            <x-modal name="confirm-user-{{ $person->id }}-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('persons.destroy', $person) }}" class="p-6">
                                    @csrf
                                    @method('delete')
                                    <p class="text-lg text-center">Are you sure you want to delete <span
                                            class="font-bold">{{ $person->user->name }}</span></p>
                                    <div class="flex justify-center">
                                        <button x-on:click="$dispatch('close')" class="btn btn-invalid px-2 mx-2"
                                            type="button">Cancel</button>
                                        <input type="submit" value="Delete user" class="btn btn-warning px-2 mx-2">
                                    </div>

                                    <x-input-error :messages="$errors->userDeletion->get('name')" class="mt-2" />
                                </form>
                            </x-modal>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="w-full border-x border-b border-gray-300 p-5">
                {{ $persons->links() }}
            </div>
        </div>
    @else
        <p>Je hebt geen rechten om deze pagina te bekijken</p>
    @endcan
    </div>
@endsection

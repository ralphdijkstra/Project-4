<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons_count = count(Person::all());
        $persons = Person::orderBy('created_at', 'asc')->paginate(25);
        $roles = Role::all();
        return view('person.index', [
            'persons' => $persons,
            'persons_count' => $persons_count,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $roles = Role::all();
        return view('person.edit', [
            'person' => $person,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $user = $person->user;
        $person->update($request->except('roles', 'name', 'email'));
        $user->syncRoles($request->roles)->update($request->only('name', 'email'));
        return redirect()->route('persons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }

    public function assignrole(Person $person, Role $role)
    {
        $person->user()->first()->assignRole($role);
        return redirect()->back();
    }

    public function removerole(Person $person, Role $role)
    {
        $person->user()->first()->removeRole($role);
        return redirect()->back();
    }
}

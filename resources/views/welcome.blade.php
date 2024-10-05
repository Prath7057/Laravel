@extends('app')
<div class="container mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-nowrap">User Id</th>
                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ 1 }}</td>
                <td>{{ $user->user_username }}</td>
                <td>{{ $user->user_email }}</td>
                <td><a href="/updateUser/{{ $user->user_id }}" class="btn btn-warning">Update</a></td>
                <td><a href="/deleteUser/{{ $user->user_id }}" class="btn btn-danger">Delete</a></td>
            </tr>
        </tbody>
    </table>
</div>

@extends('layouts.app')

@section('content')
<h1>Tambah User</h1>
<form action="{{ route('admin.store_user') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <label>Role:</label>
    <select name="role">
        <option value="kasir">Kasir</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit">Tambah User</button>
</form>
@endsection

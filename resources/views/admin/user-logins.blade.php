@extends('layouts.app')

@section('title', $user->name . ' belépési naplói')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $user->name }} belépési naplói</h1>

    @if($logins->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Időpont</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">IP-cím</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Eszköz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logins as $login)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $login->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4">{{ $login->ip_address }}</td>
                            <td class="px-6 py-4">{{ $login->user_agent }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $logins->links() }}
        </div>
    @else
        <p class="text-gray-600">Nincs belépési napló ehhez a felhasználóhoz.</p>
    @endif
</div>
@endsection
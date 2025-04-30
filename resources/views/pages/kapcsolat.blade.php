@extends('layouts.app')

@section('title', 'Kapcsolat')

@section('content')
  <div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Kapcsolat</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Írj nekünk!</h2>
        <form action="#" method="POST">
          @csrf
          <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
              Név:
            </label>
            <input
              type="text"
              id="name"
              name="name"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              placeholder="Add meg a neved"
            />
          </div>
          <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
              E-mail cím:
            </label>
            <input
              type="email"
              id="email"
              name="email"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              placeholder="Add meg az e-mail címed"
            />
          </div>
          <div class="mb-4">
            <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">
              Tárgy:
            </label>
            <input
              type="text"
              id="subject"
              name="subject"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              placeholder="Add meg a tárgyat"
            />
          </div>
          <div class="mb-6">
            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">
              Üzenet:
            </label>
            <textarea
              id="message"
              name="message"
              rows="5"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              placeholder="Írd meg az üzeneted"
            ></textarea>
          </div>
          <div class="flex items-center justify-between">
            <button
              class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              type="submit"
            >
              Küldés
            </button>
          </div>
        </form>
      </div>

      <div>
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Elérhetőségeink</h2>
        <div class="mb-4">
          <p class="text-gray-700 font-bold">E-mail:</p>
          <p class="text-gray-700">
            <a href="mailto:info@elvex.hu" class="text-purple-600 hover:underline"
              >info@elvex.hu</a
            >
          </p>
        </div>
        <div class="mb-4">
          <p class="text-gray-700 font-bold">Telefonszám:</p>
          <p class="text-gray-700">+36 30 123 4567</p>
        </div>
        <div class="mb-4">
          <p class="text-gray-700 font-bold">Cím:</p>
          <p class="text-gray-700">4700 Mátészalka, Kossuth tér 1.</p>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Kövess minket!</h3>
          <div class="flex space-x-4">
            <a href="#" class="text-purple-600 hover:text-purple-800">
              Facebook
            </a>
            <a href="#" class="text-purple-600 hover:text-purple-800">
              Instagram
            </a>
            <a href="#" class="text-purple-600 hover:text-purple-800">
              LinkedIn
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

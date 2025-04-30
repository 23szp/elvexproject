@extends('layouts.app')

@section('title', 'Rólunk')

@section('content')
  <div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">
      Üdvözlünk az ElveX világában! ✨
    </h1>

    <section class="mb-8">
      <p class="text-gray-700 leading-relaxed mb-4">
        Az ElveX egy innovatív online platform, amely a használt termékek
        adásvételére, cseréjére és új életre keltésére specializálódott. Küldetésünk,
        hogy egy egyszerű, biztonságos és környezetbarát alternatívát kínáljunk
        mindazok számára, akik szeretnék eladni a már nem használt, de jó állapotban
        lévő dolgaikat, vagy éppen kedvező áron szeretnének hozzájutni minőségi
        termékekhez.
      </p>
      <p class="text-gray-700 leading-relaxed">
        Hiszünk abban, hogy a fenntarthatóság nem csak egy divatos szólam, hanem
        egy életmód, és az ElveX-szel mi is hozzájárulhatunk egy zöldebb jövő
        építéséhez.
      </p>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">
        Miért válaszd az ElveX-et?
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Fenntarthatóság</h3>
          <p class="text-gray-700 leading-relaxed">
            A second-hand termékek vásárlása és eladása nemcsak a pénztárcádnak
            tesz jót, hanem a bolygónknak is. Csökkentsd a hulladékot, spórolj
            erőforrásokat, és légy részese egy tudatosabb fogyasztói kultúrának.
          </p>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Közösség</h3>
          <p class="text-gray-700 leading-relaxed">
            Az ElveX nem csupán egy piactér; egy közösség, ahol hasonló gondolkodású
            emberek találkozhatnak, inspirálhatják egymást, és együtt tehetnek a
            fenntartható életmódért.
          </p>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Egyszerűség</h3>
          <p class="text-gray-700 leading-relaxed">
            Platformunkat úgy terveztük, hogy a használata intuitív és egyszerű
            legyen. Néhány kattintással feltöltheted eladó termékeidet, vagy
            rábukkanhatsz a régóta keresett kincsekre.
          </p>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Biztonság</h3>
          <p class="text-gray-700 leading-relaxed">
            A biztonság kiemelt fontosságú számunkra. Minden tranzakciót
            figyelemmel kísérünk, és igyekszünk a lehető legbiztonságosabb
            környezetet teremteni a vásárlók és eladók számára egyaránt.
          </p>
        </div>
      </div>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">Hogyan működik az ElveX?</h2>
      <ol class="list-decimal list-inside text-gray-700 leading-relaxed">
        <li class="mb-2">
          <span class="font-semibold">Regisztráció:</span> Hozz létre egy fiókot
          néhány egyszerű lépésben.
        </li>
        <li class="mb-2">
          <span class="font-semibold">Hirdetés feladása:</span> Töltsd fel a
          terméked fotóit, adj meg egy részletes leírást, és állapítsd meg az
          árat.
        </li>
        <li class="mb-2">
          <span class="font-semibold">Keresés és böngészés:</span> Fedezd fel a
          kínálatot a kategóriák között, vagy használd a keresőfunkciót, hogy
          megtaláld, amit keresel.
        </li>
        <li class="mb-2">
          <span class="font-semibold">Kapcsolatfelvétel:</span> Lépj kapcsolatba az
          eladókkal vagy vásárlókkal, és egyeztessétek a részleteket.
        </li>
        <li class="mb-2">
          <span class="font-semibold">Biztonságos tranzakció:</span> Élvezd a
          biztonságos vásárlás és eladás előnyeit platformunkon.
        </li>
      </ol>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">Küldetésünk</h2>
      <p class="text-gray-700 leading-relaxed">
        Az ElveX küldetése, hogy a használt termékek körforgását a lehető
        legkönnyebbé és legvonzóbbá tegye mindenki számára. Hiszünk abban, hogy
        minden termék megérdemel egy második esélyt, és hogy a tudatos vásárlás
        és eladás nem csak egy lehetőség, hanem egy felelősség is.
      </p>
    </section>

    <section class="text-center">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">Csatlakozz hozzánk!</h2>
      <p class="text-gray-700 leading-relaxed mb-4">
        Legyél te is része az ElveX közösségének, és fedezd fel a second-hand
        vásárlás és eladás örömét! Kövess minket a közösségi médiában, iratkozz
        fel hírlevelünkre, és légy naprakész a legújabb akciókkal és
        újdonságokkal kapcsolatban.
      </p>
      <a
        href="mailto:info@elvex.hu"
        class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300"
      >
        Kapcsolatfelvétel
      </a>
    </section>
  </div>
@endsection

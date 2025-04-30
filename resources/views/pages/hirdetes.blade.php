@extends('layouts.app')

@section('title', 'Hirdetési Lehetőségek')

@section('content')
  <div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Hirdetési lehetőségek 📢</h1>

    <section class="mb-6">
      <p class="text-gray-700 leading-relaxed mb-4">
        Az ElveX platformon egyszerűen és gyorsan hirdetheted meg termékeidet, hogy
        azok új gazdára találjanak! 🛍️ Legyen szó ruházatról, elektronikai
        eszközökről, lakberendezési tárgyakról vagy bármilyen más használt
        termékről, nálunk mindenki megtalálhatja a helyét. 🎯
      </p>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">
        Miért hirdess az ElveX-en? 🤔
      </h2>
      <ul class="list-disc list-inside text-gray-700 leading-relaxed">
        <li class="mb-2">
          <span class="font-semibold">Széles közönség:</span> Az ElveX közössége
          folyamatosan növekszik, így hirdetéseid sok potenciális vásárlóhoz
          eljuthatnak. 📈
        </li>
        <li class="mb-2">
          <span class="font-semibold">Költséghatékony:</span> Alapvető hirdetéseink
          ingyenesek, de ha gyorsabb eredményt szeretnél, választhatsz kiemelt
          hirdetési lehetőségeink közül. 💸
        </li>
        <li class="mb-2">
          <span class="font-semibold">Egyszerű használat:</span> Néhány kattintással
          feltöltheted a hirdetésedet, és máris elérhetővé válik a vásárlók
          számára. ⚡
        </li>
        <li class="mb-2">
          <span class="font-semibold">Fenntarthatóság:</span> Hirdetéseiddel
          hozzájárulsz a körforgásos gazdasághoz, és segítesz csökkenteni a
          pazarlást. 🌍
        </li>
      </ul>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">
        Hirdetési csomagok és lehetőségek 🛠️
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
          <h3 class="text-xl font-semibold mb-2 text-gray-800">
            Alap hirdetés (Ingyenes) 💡
          </h3>
          <ul class="list-disc list-inside text-gray-700 leading-relaxed">
            <li class="mb-1">Hirdetésed megjelenik a megfelelő kategóriában.</li>
            <li class="mb-1">1-3 kép feltöltése a termékről.</li>
            <li class="mb-1">Hirdetés érvényessége: 30 nap.</li>
          </ul>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
          <h3 class="text-xl font-semibold mb-2 text-gray-800">
            Kiemelt hirdetés (Prémium) 🌟
          </h3>
          <ul class="list-disc list-inside text-gray-700 leading-relaxed">
            <li class="mb-1">
              Hirdetésed kiemelt helyen jelenik meg a kategóriákban és a keresési
              találatok között.
            </li>
            <li class="mb-1">Akár 10 kép feltöltése a termékről.</li>
            <li class="mb-1">Hirdetés érvényessége: 60 nap.</li>
          </ul>
          <p class="text-gray-700 font-semibold mt-2">Ár: [Ár megadása, pl. 1.500
            Ft/hirdetés]</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
          <h3 class="text-xl font-semibold mb-2 text-gray-800">
            Főoldali hirdetés (Exkluzív) 🚀
          </h3>
          <ul class="list-disc list-inside text-gray-700 leading-relaxed">
            <li class="mb-1">Hirdetésed megjelenik a főoldalon, hogy még több
              látogató lássa.</li>
            <li class="mb-1">Akár 15 kép feltöltése a termékről.</li>
            <li class="mb-1">Hirdetés érvényessége: 30 nap.</li>
          </ul>
          <p class="text-gray-700 font-semibold mt-2">Ár: [Ár megadása, pl. 5.000
            Ft/hirdetés]</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
          <h3 class="text-xl font-semibold mb-2 text-gray-800">
            Hirdetés megújítása 🔄
          </h3>
          <p class="text-gray-700 leading-relaxed">
            Ha a hirdetésed lejárt, egyszerűen megújíthatod, hogy továbbra is
            elérhető legyen.
          </p>
          <p class="text-gray-700 font-semibold mt-2">Ár: [Ár megadása, pl. 500
            Ft/hirdetés]</p>
        </div>
      </div>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">
        Hogyan adhatok fel hirdetést? 🖊️
      </h2>
      <ol class="list-decimal list-inside text-gray-700 leading-relaxed">
        <li class="mb-2">Regisztrálj az ElveX platformon, vagy jelentkezz be a
          fiókodba.</li>
        <li class="mb-2">Kattints a "Hirdetés feladása" gombra.</li>
        <li class="mb-2">Töltsd ki a hirdetéshez szükséges adatokat:</li>
        <ul class="list-disc list-inside ml-6">
          <li>Termék neve</li>
          <li>Kategória</li>
          <li>Állapot (újszerű, használt stb.)</li>
          <li>Ár</li>
          <li>Leírás</li>
          <li>Képek feltöltése</li>
        </ul>
        <li class="mb-2">Válaszd ki a kívánt hirdetési csomagot (alap, kiemelt,
          főoldali).</li>
        <li class="mb-2">Ellenőrizd az adatokat, majd kattints a "Hirdetés
          közzététele" gombra.</li>
      </ol>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">
        Tippek a sikeres hirdetéshez 💡
      </h2>
      <ul class="list-disc list-inside text-gray-700 leading-relaxed">
        <li class="mb-2">
          <span class="font-semibold">Használj jó minőségű képeket:</span> A
          vásárlók szívesebben választanak olyan terméket, amelyről tiszta és
          részletes képeket látnak. 📸
        </li>
        <li class="mb-2">
          <span class="font-semibold">Írj részletes leírást:</span> Tüntesd fel a
          termék állapotát, méreteit, és minden fontos információt. 📝
        </li>
        <li class="mb-2">
          <span class="font-semibold">Állíts be reális árat:</span> Nézd meg, hogy
          hasonló termékeket milyen áron kínálnak, és ennek megfelelően határozd
          meg az árat. 💰
        </li>
        <li class="mb-2">
          <span class="font-semibold">Frissítsd a hirdetésedet:</span> Ha a
          terméked nem kelt el, újítsd meg a hirdetést, vagy válaszd a kiemelési
          lehetőségeket. 📅
        </li>
      </ul>
    </section>

    <section class="text-center">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">
        Kapcsolat és további információ 📩
      </h2>
      <p class="text-gray-700 leading-relaxed mb-4">
        Ha kérdésed van a hirdetési lehetőségekkel kapcsolatban, vagy segítségre
        van szükséged, fordulj hozzánk bizalommal:
      </p>
      <p class="text-gray-700 mb-2">
        <span class="font-semibold">E-mail:</span>
        <a href="mailto:info@elvex.hu" class="text-purple-600 hover:underline">
          info@elvex.hu
        </a>
      </p>
      <p class="text-gray-700">
        <span class="font-semibold">Postai cím:</span> 4700 Mátészalka, Kossuth tér
        1.
      </p>
    </section>

    <section class="text-center mt-8">
      <p class="text-gray-700 leading-relaxed">
        Csatlakozz az ElveX közösségéhez, és add el termékeidet gyorsan és
        egyszerűen! 🛒✨
      </p>
    </section>
  </div>
@endsection

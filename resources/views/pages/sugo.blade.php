@extends('layouts.app')

@section('title', 'Súgó')

@section('content')
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Súgó</h1>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">Gyakran Ismételt Kérdések</h2>

      <div class="mb-4">
        <h3 class="text-lg font-semibold mb-1">Hogyan regisztrálhatok az ElveX-en?</h3>
        <p>
          A regisztrációhoz kattints a "Regisztráció" gombra a jobb felső sarokban,
          és kövesd az utasításokat. Szükséged lesz egy érvényes e-mail címre és
          egy jelszóra.
        </p>
      </div>

      <div class="mb-4">
        <h3 class="text-lg font-semibold mb-1">Hogyan tölthetek fel hirdetést?</h3>
        <p>
          Bejelentkezés után kattints a "Hirdetés feltöltése" gombra. Töltsd ki a
          szükséges mezőket, adj meg részletes leírást és tölts fel képeket a
          termékről.
        </p>
      </div>

      <div class="mb-4">
        <h3 class="text-lg font-semibold mb-1">Hogyan kereshetek termékeket?</h3>
        <p>
          A keresőmezőbe írd be a keresett termék nevét vagy kulcsszavait, majd
          kattints a keresés ikonra. Szűrheted a találatokat kategória, ár és
          állapot szerint.
        </p>
      </div>

      <div class="mb-4">
        <h3 class="text-lg font-semibold mb-1">Hogyan léphetek kapcsolatba az eladóval?</h3>
        <p>
          A termék oldalán találsz egy "Üzenet küldése" gombot. Ezen keresztül
          közvetlenül üzenhetsz az eladónak.
        </p>
      </div>

      <div class="mb-4">
        <h3 class="text-lg font-semibold mb-1">Hogyan menthetek el egy terméket?</h3>
        <p>
          A termék oldalán kattints a "Mentés" gombra. A mentett termékeket a
          profilodban a "Mentett hirdetések" menüpont alatt találod meg.
        </p>
      </div>

      <div class="mb-4">
        <h3 class="text-lg font-semibold mb-1">Hogyan módosíthatom a profilomat?</h3>
        <p>
          A profilodat a "Profil kezelése" menüpont alatt módosíthatod. Itt
          megváltoztathatod a neved, e-mail címed, jelszavad és profilképed.
        </p>
      </div>

      <div class="mb-4">
        <h3 class="text-lg font-semibold mb-1">Mit tegyek, ha problémám van egy tranzakcióval?</h3>
        <p>
          Ha problémád van egy tranzakcióval, először vedd fel a kapcsolatot az
          eladóval/vevővel. Ha nem sikerül megoldást találni, fordulj az
          ügyfélszolgálatunkhoz az info@elvex.hu e-mail címen.
        </p>
      </div>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">További segítség</h2>
      <p>
        Ha nem találtad meg a választ a kérdésedre, kérjük, vedd fel velünk a
        kapcsolatot az info@elvex.hu e-mail címen.
      </p>
    </section>
  </div>
@endsection

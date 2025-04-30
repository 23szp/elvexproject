@extends('layouts.app')

@section('title', 'Adatkezelési Tájékoztató')

@section('content')
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-4">Adatkezelési Tájékoztató</h1>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">1. Bevezetés</h2>
      <p class="mb-2">
        1.1. Jelen Adatkezelési Tájékoztató célja, hogy tájékoztatást nyújtson a
        ElveX (a továbbiakban: "Adatkezelő") által végzett adatkezelési
        tevékenységekről, az érintettek jogairól, valamint az adatkezelés módjáról
        és céljáról.
      </p>
      <p class="mb-2">
        1.2. Az Adatkezelő elkötelezett a személyes adatok védelme iránt, és a
        vonatkozó jogszabályoknak, különösen az Európai Parlament és a Tanács
        (EU) 2016/679 rendeletének (GDPR), valamint a magyar adatvédelmi
        törvényeknek megfelelően jár el.
      </p>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">Adatkezelő adatai:</h2>
      <ul class="list-disc list-inside mb-2">
        <li>Cégnév: ElveX</li>
        <li>Székhely: 4700 Mátészalka, Kossuth tér 1.</li>
        <li>Cégjegyzékszám: 12-34-567890</li>
        <li>Adószám: 12345678-1-56</li>
        <li>Kapcsolattartás: info@elvex.hu</li>
      </ul>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">2. Az adatkezelés célja és jogalapja</h2>
      <p class="mb-2">
        2.1. Az Adatkezelő az alábbi célokból kezel személyes adatokat:
      </p>
      <ul class="list-disc list-inside mb-2">
        <li>
          Regisztráció és fiókkezelés: A felhasználók regisztrációjának és
          fiókjának létrehozása, kezelése.
        </li>
        <li>
          Szolgáltatás nyújtása: A Weboldalon keresztül történő adásvétel,
          kommunikáció és tranzakciók lebonyolítása.
        </li>
        <li>
          Kapcsolattartás: A felhasználók megkereséseinek kezelése,
          ügyfélszolgálati támogatás nyújtása.
        </li>
        <li>
          Marketing: Hírlevelek és promóciós ajánlatok küldése (csak az érintett
          hozzájárulása esetén).
        </li>
        <li>
          Jogszabályi kötelezettségek teljesítése: Számlázás, adózási
          kötelezettségek teljesítése.
        </li>
      </ul>
      <p class="mb-2">2.2. Az adatkezelés jogalapja:</p>
      <ul class="list-disc list-inside mb-2">
        <li>
          Az érintett hozzájárulása (GDPR 6. cikk (1) bekezdés a) pont).
        </li>
        <li>
          Szerződés teljesítése (GDPR 6. cikk (1) bekezdés b) pont).
        </li>
        <li>
          Jogszabályi kötelezettség teljesítése (GDPR 6. cikk (1) bekezdés c)
          pont).
        </li>
        <li>
          Az Adatkezelő jogos érdeke (GDPR 6. cikk (1) bekezdés f) pont).
        </li>
      </ul>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">3. Kezelt adatok köre</h2>
      <p class="mb-2">3.1. Az Adatkezelő az alábbi személyes adatokat kezelheti:</p>
      <ul class="list-disc list-inside mb-2">
        <li>
          Regisztráció során megadott adatok: név, e-mail cím, jelszó,
          telefonszám.
        </li>
        <li>
          Tranzakciós adatok: vásárlási és eladási adatok, számlázási
          információk.
        </li>
        <li>
          Kapcsolattartási adatok: e-mail cím, telefonszám, üzenetek tartalma.
        </li>
        <li>
          Technikai adatok: IP-cím, böngésző típusa, sütik (cookie-k) által
          gyűjtött adatok.
        </li>
      </ul>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">4. Az adatok tárolásának időtartama</h2>
      <p class="mb-2">
        4.1. Az Adatkezelő a személyes adatokat csak a szükséges ideig tárolja:
      </p>
      <ul class="list-disc list-inside mb-2">
        <li>Regisztrációs adatok: a felhasználói fiók fennállásáig.</li>
        <li>
          Tranzakciós adatok: a jogszabályok által előírt időtartamig (pl.
          számlázási adatok esetén 8 év).
        </li>
        <li>Marketing célú adatok: a hozzájárulás visszavonásáig.</li>
        <li>
          Technikai adatok: a gyűjtés céljának teljesüléséig, de legfeljebb 1
          évig.
        </li>
      </ul>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">5. Az adatok továbbítása és harmadik felek</h2>
      <p class="mb-2">
        5.1. Az Adatkezelő az érintett személyes adatait harmadik felek részére
        kizárólag az alábbi esetekben továbbítja:
      </p>
      <ul class="list-disc list-inside mb-2">
        <li>
          Szolgáltatók és adatfeldolgozók: például tárhelyszolgáltatók, fizetési
          szolgáltatók, könyvelők.
        </li>
        <li>
          Jogszabályi kötelezettség esetén: hatóságok vagy bíróságok részére.
        </li>
      </ul>
      <p class="mb-2">
        5.2. Az Adatkezelő biztosítja, hogy az adatfeldolgozók a GDPR
        előírásainak megfelelően járjanak el.
      </p>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">6. Az érintettek jogai</h2>
      <p class="mb-2">
        6.1. Az érintettek az alábbi jogokkal rendelkeznek személyes adataik
        kezelésével kapcsolatban:
      </p>
      <ul class="list-disc list-inside mb-2">
        <li>
          Hozzáférés joga: Tájékoztatást kérhetnek az Adatkezelő által kezelt
          személyes adataikról.
        </li>
        <li>Helyesbítés joga: Kérhetik a pontatlan adatok helyesbítését.</li>
        <li>
          Törlés joga: Kérhetik személyes adataik törlését ("elfeledtetéshez való
          jog").
        </li>
        <li>
          Adatkezelés korlátozásának joga: Kérhetik az adatkezelés korlátozását.
        </li>
        <li>
          Adathordozhatóság joga: Kérhetik adataik géppel olvasható formátumban
          történő kiadását.
        </li>
        <li>
          Tiltakozás joga: Tiltakozhatnak az adatkezelés ellen jogos érdek
          alapján.
        </li>
      </ul>
      <p class="mb-2">
        6.2. Az érintettek jogaikat az info@elvex.hu e-mail címen vagy a 4700
        Mátészalka, Kossuth tér 1. postai címen gyakorolhatják.
      </p>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">7. Sütik (cookie-k) használata</h2>
      <p class="mb-2">
        7.1. A Weboldal sütiket használ a felhasználói élmény javítása érdekében.
      </p>
      <p class="mb-2">7.2. A sütik típusai:</p>
      <ul class="list-disc list-inside mb-2">
        <li>
          Munkamenet sütik: A weboldal működéséhez szükségesek, és a böngésző
          bezárásakor törlődnek.
        </li>
        <li>
          Analitikai sütik: A weboldal látogatottságának elemzésére szolgálnak.
        </li>
        <li>
          Marketing sütik: Személyre szabott hirdetések megjelenítésére
          használhatók.
        </li>
      </ul>
      <p class="mb-2">
        7.3. A felhasználók a sütik használatát a böngészőjük beállításaiban
        korlátozhatják vagy letilthatják.
      </p>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">8. Panaszkezelés és jogorvoslat</h2>
      <p class="mb-2">
        8.1. Az érintettek panaszukkal az Adatkezelőhöz fordulhatnak az
        info@elvex.hu e-mail címen.
      </p>
      <p class="mb-2">
        8.2. Amennyiben az érintett nem elégedett az Adatkezelő válaszával,
        panaszt nyújthat be a Nemzeti Adatvédelmi és Információszabadság
        Hatósághoz (NAIH):
      </p>
      <ul class="list-disc list-inside mb-2">
        <li>Cím: 1055 Budapest, Falk Miksa utca 9-11.</li>
        <li>Telefon: +36 (1) 391-1400</li>
        <li>E-mail: ugyfelszolgalat@naih.hu</li>
        <li>Weboldal: www.naih.hu</li>
      </ul>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">9. Záró rendelkezések</h2>
      <p class="mb-2">
        9.1. Az Adatkezelő fenntartja a jogot a jelen Adatkezelési Tájékoztató
        módosítására. A módosítások a Weboldalon történő közzététellel lépnek
        hatályba.
      </p>
      <p class="mb-2">
        9.2. A jelen Adatkezelési Tájékoztató 2023. október 15-től hatályos.
      </p>
    </section>
  </div>
@endsection

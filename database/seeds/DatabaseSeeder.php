<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ideas')->insert([
            'title' => 'Apka przypominająca o myciu rąk',
            'description' => 'Aplikacja cyklicznie włącza powiadomienie o myciu rąk, oraz gra muzykę na czas mycia',
            'problem' => 'Ludzie nie pamiętają o częstym myciu rąk i robią to za krótko',
            'recipients' => 'Zyskują wszysycy ludzie. Potrzebni sa programiści/stki, którzy/re to stworzą',
            'solution' => 'Aplikacja podobnie jak te przypominające o częstym piciu wody, co jakiś czas wydaje dźwięk. Użytkownik/czka idzie wtedy umyć ręce. Można sobie ustawić ulubiony kawałek muzyczny, którzy będzie odtwarzany przez 20-30 sekund lub dokładną instrukcję głosową, która tłumaczy jak poprawnie myć ręce. Apka raz dziennie przypomina również o odkażaniu telefonu.',
            'plus' => 14,
            'minus' => 6
        ]);

        DB::table('comments')->insert([
            'idea_id' => 1,
            'content' => 'Hmm.. czy nie traktujemy dorosłych jak dzieci?',
            'plus' => 1,
            'minus' => 3
        ]);

        DB::table('comments')->insert([
            'idea_id' => 1,
            'content' => 'Super! Na pewno bym zainstalował mojej mamie w podeszłym wieku.',
            'plus' => 4,
            'minus' => 2
        ]);

        DB::table('ideas')->insert([
            'title' => 'Apka fact-checkingowa do info o wirusie',
            'description' => 'Aplikacja wyświetlająca tylko sprawdzone, wiarygodne informacje o koronawirusie, '
                . 'z możliwością wyszukiwania podtematu',
            'problem' => 'Dużo jest teraz niesprawdzonych informacji. Ludzie nie wiedzą czy wierzyć w to co przeczytają',
            'recipients' => 'Zyskują ludzie nie wiedzący gdzie szukać sprawdzonych informacji',
            'solution' => 'Aplikacja jest rozszerzeniem do innych aplikacji i stron. Za pomocą prostej wyszukiwarki słów odnajduje te same pojęcia np. "wysoka temperatura" na stronie WHO lub ECDC i pokazuje tam tekst na dany temat. Wersja anglojęzyczna na początek, potem różne wersje językowe połączone z ministerstwami danego kraju',
            'plus' => 5,
            'minus' => 2
        ]);

        DB::table('comments')->insert([
            'idea_id' => 2,
            'content' => 'Czy nie za dużo takich serwisów w tych dniach? Jest taki zalew informacji...',
            'plus' => 4,
            'minus' => 2
        ]);

        DB::table('ideas')->insert([
            'title' => 'Urządzenie ostrzegające przed dotknięciem twarzy',
            'description' => 'Urządzenie w formie 2 pierścieni na ręce i 2 elementów na okularach, które zaczyna piszczeć '
                . 'gdy ręka zbliży się do twarzy, poprzez komunikację słabym polem elektromagnetycznym.',
            'problem' => 'Nawykowo wszyscy często dotykamy twarze, co sprzyja zarażeniu. Nie da się łatwo zapamiętać by tego nie robić.',
            'recipients' => 'Ogół populacji, choć niektórzy mogą być niechętni ze względu na konieczność noszenia okularów i specjalnych "pierścieni" na rękach',
            'solution' => 'Rozwiązanie składa się z czterech urządzeń: dwóch "pierścieni" zakładanych na palce obu '
                . 'rąk, oraz dwóch elementów przyczepianych do ramek okularów. "Pierścienie" wytwarzają słabe pole '
                . 'elektromagnetyczne, a elementy na okularach nasłuchują go. Gdy siła pola przekroczy pewną wartość, '
                . 'co dzieje się przy zbliżeniu ręki do twarzy, element na okularach zaczyna piszczeć.',
            'plus' => 3,
            'minus' => 6
        ]);

        DB::table('comments')->insert([
            'idea_id' => 3,
            'content' => 'Kosmos :) Za skomplikowane',
            'plus' => 6,
            'minus' => 2
        ]);

        DB::table('ideas')->insert([
            'title' => 'Strona internetowa z bardzo konkretnymi informacjami jak leczyć się w domu',
            'description' => 'Strona www ze szczegółowymi, jasnymi, i sprawdzonymi informacjami jak należy postępować '
                . 'gdy ma się koronawirusa a służba zdrowia zaleciła leczenie się samemu w domu',
            'problem' => 'Nie wszyscy mogą być leczeni szpitalnie, zaś zostając w domu powinni dokładnie wiedzieć co '
                . 'robić w różnych wariantach rozwoju choroby. Nie zawsze można skonsultować się z lekarzem.',
            'recipients' => 'Osoby chore na COVID-19, których nie przyjęto do szpitali',
            'solution' => 'Powinna istnieć strona internetowa zbierająca informacje nt. tego jak najlepiej leczyć się '
                . 'lub opiekować chorym na COVID-19 w warunkach domowych, skierowana do osób bez '
                . 'wykształcenia medycznego. Informacje muszą być oczywiście rzetelne medycznie, ale też łatwe do '
                . 'zrozumienia, oraz odpowiadające na różne sytuacje (np. co jeśli w środku choroby zacznie mnie '
                . 'boleć brzuch?) Źródło pomysłu: https://covid-at-home.info/',
            'plus' => 10,
            'minus' => 3
        ]);

        DB::table('ideas')->insert([
            'title' => 'Szkolenia z IT dla osób tymczasowo nie mogących pracować',
            'description' => 'Wiele osób tymczasowo nie może pracować. Wykorzystajmy ten czas, by dać im wiedzę IT. '
                . 'Widać, że w dobie koronawirusa przyszłością są umiejętności cyfrowe, potrzebne np. do pracy zdalnej.',
            'problem' => 'Wielu ludzi ma teraz więcej wolnego czasu, ale większą niepewność zawodową.',
            'recipients' => 'Osoby tymczasowo nie mogące pracować z powodu koronawirusa. Inne osoby chcące w tym czasie'
                . 'zwiększyć swoje kompetencje IT.',
            'solution' => 'Zorganizować szkolenia online z tematów związanych z komputerami. Jeden przykładowy cykl '
                . 'to mogłyby być 3 spotkania pod tytułem "Czy nadawałbym się na zawodowy kurs programowania w '
                . 'coding academy?"',
            'plus' => 7,
            'minus' => 0
        ]);

        DB::table('comments')->insert([
            'idea_id' => 5,
            'content' => 'Ja bym totalnie poszedł na takie szkolenie teraz...',
            'plus' => 6,
            'minus' => 2
        ]);

        DB::table('comments')->insert([
            'idea_id' => 5,
            'content' => 'A ja (programista) chętnie bym coś takiego teraz poprowadził.',
            'plus' => 3,
            'minus' => 0
        ]);

        DB::table('ideas')->insert([
            'title' => 'Strona informacyjna tylko z dobrymi wiadomościami w walce z COVID',
            'description' => 'Wszyscy czujemy się przytłoczeni z powodu sytuacji w jakiej postawiła nas '
                . 'epidemia. Dobrze by mieć stronę promującą sukcesy w walce z chorobą i jej wszelkimi konsekwencjami, '
                . 'oraz przykłady jak ten trudny czas wydobywa z ludzi to co najlepsze.',
            'problem' => 'Sytuacja świata nie nastraja do radości, a do smutku i lęku.',
            'recipients' => 'Wszyscy pragnący podbudować swoją motywację do dalszej pracy, działań, życia i nadzieję, '
                . 'że z tego wyjdziemy.',
            'solution' => 'Strona informacyjna, gdzie zespół redakcyjny wyszukiwałby ze świata optymistycznych wieści '
                . 'jak ludzie lokalnie zwyciężają chorobę, oraz wszystkie jej negatywne skutki psychologiczne, '
                . 'ekonomiczne, społeczne, itp. Źródło pomysłu: https://helpwithcovid.com/projects/38',
            'plus' => 3,
            'minus' => 2
        ]);

        DB::table('ideas')->insert([
            'title' => 'Strona kojarząca lekarzy, pielęgniarki z wolontariuszami chętnymi by ich odciążyć poza pracą',
            'description' => 'Potrzebujemy, by personel medyczny mógł teraz działać z pełną energią i wydajnością, '
                . 'oraz np. nie potrzebował brać wolnego z pracy by zajmować się dziećmi. '
                . 'Odciążmy ich w zakupach, sprzątaniu, drobnych zadaniach pozapracowych, opiece nad dziećmi.',
            'problem' => 'Potrzebujemy, by personel medyczny mógł teraz działać z pełną energią i wydajnością.',
            'recipients' => 'Wszyscy zarażeni koronawirusem, a szczególnie ciężkie przypadki',
            'solution' => 'Strona gdzie lekarze, pielęgniarki, ratownicy i inne osoby w służbie zdrowia mogą '
                . 'zgłaszać zapotrzebowanie na pomoc pozapracową, a wolontariusze mogą być kojarzeni z nimi by '
                . 'ich odciążyć. Źródło pomysłu: https://www.feedadoc.com',
            'plus' => 0,
            'minus' => 0
        ]);

        DB::table('ideas')->insert([
            'title' => 'Uratujmy nasze restauracje przez platformę płatnych obligacji do zużycia po epidemii',
            'description' => 'Wobec unikania miejsc publicznych, nasze ulubione lokalne restauracje szybko zbankrutują. '
                .'Zbudujmy system pozwalający nam wykupić teraz "obligację" na rzecz konkretnego miejsca np. za 100 zł, '
                .'która gdy zakończy się kryzys koronawirusowy będzie miała w tym lokalu wartość do wykorzystania np. 125 zł.',
            'problem' => 'Bankructwo naszych ulubionych miejsc żywieniowych',
            'recipients' => 'Właściciele lokali i ich personel',
            'solution' => 'Strona gdzie lokale mogą łatwo się zapisać i oferować "obligacje" do wykupienia teraz '
                . '(co wesprze ich budżet), a do zrealizowania np. za rok, albo po oficjalnym zniesieniu stanu '
                . 'pandemii przez WHO. Obligacja kosztuje teraz mniej niż będzie warta w momencie wykorzystania. '
                . 'Źródło pomysłu: https://www.fodors.com/news/restaurants/a-simple-thing-you-can-do-right-now-to-help-save-restaurants',
            'plus' => 4,
            'minus' => 2
        ]);

        DB::table('ideas')->insert([
            'title' => 'Mapa gdzie osoby chore (lub bliscy) zaznaczają fakt chorowania',
            'description' => 'Dobrze byłoby wiedzieć, że np. w moim sąsiedztwie ktoś choruje - wtedy mogę przez jakiś czas być ostrożniejszy. Państwo nam nie powie gdzie dokładnie są osoby chore - może one same mogą?',
            'problem' => 'Nie wiemy kiedy ktoś chory pojawia się w naszym otoczeniu',
            'recipients' => 'Wszyscy, bo wszyscy potrzebujemy zachowywać dystans, a szczególnie wobec osób aktualnie chorych',
            'solution' => 'Strona, gdzie osoba, która choruje (lub jej bliscy) może oznaczyć kropką na mapie, że aktualnie jest chora. Oczywiście nie musi to być z dokładnością do konkretnego domu, dla zachowania prywatności. Źródło pomysłu: https://helpwithcovid.com/projects/81',
            'plus' => 0,
            'minus' => 0
        ]);
    }
}

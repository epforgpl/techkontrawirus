<!doctype html>
<html lang="{{ app()->getLocale() }}" data-crsf_token="{{ csrf_token() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ env('GOOGLE_ANALYTICS_ID') }}');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (!empty($noindex))
        <meta name="robots" content="noindex">
    @endif

    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:url" content="https://techkontrawirus.pl" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Tech Kontra Wirus" />
    <meta property="og:description" content="Działaj przeciwko COVID-19! Widzisz potrzebę, którą trzeba zaopiekować? Opowiedz o niej. Masz pomysł na rozwiązanie? Zaproponuj nowe narzędzie IT, wykorzystanie lub ulepszenia istniejących." />
    <meta property="og:image" content="{{ asset('img/techkontrawirus-social-media-featured.jpg') }}" />
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>

    <title>@yield('title')</title>
    @yield('meta-description')

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body id="body">
    <div class="page">
        <div id="header" class="header">
            <div class="container d-flex justify-content-between">
                <div>
                    <p class="brand"><a href="/"><span class="icon-shield"></span> Tech Kontra Wirus</a></p>
                </div>
                <div class="d-flex align-items-center font-larger">
                    <a href="#" v-b-modal.faq><b>Jak to działa?</b></a>
                </div>
            </div>

            <div class="d-none">
                <b-modal id="faq" size="xl" title="Pytania i odpowiedzi" ok-only>
                    <p><b>1. Jak to działa?</b></p>
                    <p>Szukamy pomysłów, które programiści/programistki będa mogli wprowadzić w życie. Zastawiasz się czy Twoja koncepcja jest wystarczająco dobra albo realna? Wrzuć - będziemy wspólnie myśleć. Pamiętaj jednak, że to nie są żarty, nie zaśmiecajmy platformy pomysłami, które nie mają sensu lub są nierzeczywiste. Jesteś programistą/ką. Chcesz pomóc? Oceniaj pomysły, bierz udział w dyskusjach i pracuj z osobami, które je proponują - a gdy będziesz gotowy/a by zacząć implementację, przenieś się na <a href="https://forum.kodujdlapolski.pl/c/tech-kontra-wirus">forum Koduj dla Polski.</a></p>
                    <p class="mt-4"><b>2. Nie mam pomysłu, ale widzę potrzebę. Co zrobić?</b></p>
                    <p>Nie masz gotowego pomysłu, za to szukasz rozwiązań? Napisz o potrzebie jaką widzisz, a wspólnie pomyślimy co można zrobić!</p>
                    <p class="mt-4"><b>3. Jak oceniane są pomysły?</b></p>
                    <p>Klikasz plus jeśli pomysł Ci się podoba, minus, jeżeli nie uważasz go za dobry. Jakość pomysłu ocenia cała społeczność. Należą do niej wszystkie osoby korzystające z platformy. Każdy może dać głos na tak lub nie danemu pomysłowi. Dodatkowo umożliwiamy możliwość dyskusji pod każdym pomysłem. Oczywiście każda osoba, która zajmuje się programowaniem może również uznać, że dowolny pomysł jej się podoba i po prostu zacząć kodować.</p>
                    <p class="mt-4"><b>4. Jak pomysły docierają do programistów/ek?</b></p>
                    <p>Będziemy zachęcać społeczność koderów i koderek do odwiedzania tej strony. Będziemy również przekazywać pomysły przez koordynatorów i koordynatorki <a href="https://kodujdlapolski.pl">Koduj dla Polski</a>.</p>
                    <p class="mt-4"><b>5. W jakiej kolejności pojawiają się pomysły na stronie?</b></p>
                    <p>Domyślnie najwyżej pojawiają się pomysły, na które oddano najwięcej głosów na tak.</p>
                    <p class="mt-4"><b>6. Jakie są zasady korzystania ze strony?</b></p>
                    <ol>
                        <li>Przy generowaniu pomysłów pamiętajcie żeby uwzględniać odpowiednie wytyczne Ministra Zdrowia, Głównego Inspektora Sanitarnego i innych właściwych służb.</li>
                        <li>Zachęcamy was do refleksji czy pomysły i rozwiązania technologiczne nie są sprzeczne z przepisami prawa.</li>
                        <li>Zachęcamy do tego aby rozwiązania technologiczne, które powstaną na bazie pomysłów były oparte na zasadach open source i na wolnej licencji.</li>
                        <li>Dyskusje nie są moderowane, ale zastrzegamy sobie prawo do usuwania treści obraźliwych i zawierających mowę nienawiści. Będziemy również usuwać reklamy i przekazy komercyjne.</li>
                    </ol>
                    <p class="mt-4"><b>7. Kim jesteście?</b></p>
                    <p>Niniejsza strona jest projektem <a href="https://epf.org.pl">Fundacji ePaństwo</a>. Jesteśmy organizacją koordynującą działania społeczności <a href="https://kodujdlapolski.pl">Koduj dla Polski</a>. Działamy na rzecz rozwoju demokracji, otwartej i przejrzystej władzy oraz zaangażowania obywatelskiego. Wykorzystując moc Internetu i nowe technologie otwieramy różne zasoby danych publicznych i bezpłatnie udostępniamy je obywatelom. Dajemy obywatelom wiedzę i narzędzia do ulepszania swojego państwa. W dobie zagrożenia koronawirusem pragniemy pomóc tak jak umiemy najlepiej: poprzez technologię dla dobra wspólnego.</p>
                    <p class="text-center mt-4">
                        <img src="/img/logo-epanstwo.svgz" class="svg" width="187" height="63" alt="Fundacja ePanstwo">
                    </p>
                </b-modal>
            </div>
        </div>

        <div id="content-wrapper">
            @yield('content')
        </div>
    </div>
    <footer id="footer" class="d-flex flex-row justify-content-center align-items-center">
        <cookie-law button-text="OK">
            <div slot="message">
                Nasz serwis wykorzystuje pliki cookies celem zapamiętania wyborów Użytkownika, oraz analityki ruchu.
                Jeśli nie wyrażasz na to zgody, możesz zmienić ustawienia cookie w swojej przeglądarce.
            </div>
        </cookie-law>
        <span class="mr-2">&copy; 2020</span><a href="https://epf.org.pl"><img src="/img/logo-epanstwo.svgz" class="d-block ml-2" width="124" height="42" alt="Fundacja ePanstwo"></a>
    </footer>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    @yield('scripts')
</body>
</html>

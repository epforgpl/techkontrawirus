@extends('base')

@section('title', 'Tech Kontra Wirus | Pomysły')

@section('styles')
@endsection

@section('scripts')
    <script src="{{ mix('js/ideas.js') }}"></script>
@endsection

@section('content')
    <div id="ideas" class="container">

        <div class="row flex-column-reverse flex-lg-row mt-4">
            <div class="col-lg-8">
                <div class="slogans">
                    <p>
                        <b>Działaj przeciwko COVID-19! Widzisz potrzebę</b>, którą trzeba się zaopiekować? Opowiedz o niej.
                        <b>Masz pomysł</b> na rozwiązanie? <b>Zaproponuj nowe narzędzie IT</b>,
                        wykorzystanie lub ulepszenia istniejących.
                    </p>
                    <p>Łączymy potrzeby i pomysły z osobami, które programują.</p>
                    <p class="new-idea-cta">
                        <a class="btn btn-lg btn-primary" href="/nowy-pomysl">Dodaj pomysł</a>
                    </p>
                    <p>Ale najpierw zapoznaj się z pomysłami, które zgłosili inni:</p>
                </div>
            </div>

            <div class="col-lg-4">
                <img class="img-tech-brain" src="{{ asset('img/tech-brain.svg') }}" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-8">

                <div class="ideas">
                    @foreach($ideas as $idea)
                        {{-- Skip hidden ideas. --}}
                        @if ($idea->is_hidden) @continue @endif
                        <div class="card card-idea">
                            <div class="card-header">
                                <plus-minus :value-on-load="{{ $idea->plus - $idea->minus }}"
                                            :ajax-url="'/pomysl/{{ $idea->id }}/glos'"
                                            :vote-on-load="{{ $voting_history->getIdeaVote($idea->id) }}">
                                </plus-minus>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="who_when">
                                        Dodano {{ $idea->getCreatedAtForDisplay() }}
                                    </div>
                                    <a href="/pomysl/{{ $idea->id }}" class="btn btn-secondary btn-sm" role="button">Więcej</a>
                                </div>
                                <div class="title"><a href="/pomysl/{{ $idea->id }}">{{ $idea->title }}</a></div>
                                <div>{{ $idea->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-lg-4 pt-5 pt-lg-0">

                <div>
                    <p>
                        <b>Jesteś programistą/ką?</b> Chcesz pomóc? Oceniaj pomysły, bierz udział w dyskusjach i pracuj z osobami, które je proponują.
                    </p>
                    <a class="mt-4 mb-4 d-block" href="https://kodujdlapolski.pl/o-nas/"><img src="/img/logo-kdp.png" width="167" height="77" alt="Koduj dla Polski"></a>
                    <p class="mt-4">
                        <b><a href="https://kodujdlapolski.pl/o-nas/">Koduj dla Polski</a></b> to społeczność programistów/ek
                        oraz działaczy/ek społecznych,
                        która pracuje na rzecz ulepszania otaczającego nas świata. Kodujemy z sensem -
                        tworzymy różnorodne i skuteczne rozwiązania technologiczne, które odpowiadają
                        na konkretne wyzwania. Koduj dla Polski jest koordynowane przez <a href="https://epf.org.pl">Fundację ePaństwo</a>.
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection

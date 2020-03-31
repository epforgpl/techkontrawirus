@extends('base')

@section('title', 'Tech Kontra Wirus | Pomysły')

@section('styles')
    <style>
        @foreach ($categories as $category)
        {{-- TODO: Possibly some clean-up here. --}}
        .btn-category-{{ $category->id }} {
            color: {{ $category->text_color }};
            background-color: {{ $category->background_color }};
            border-width: 0;
            border-color: {{ $category->background_color }};
            box-shadow: none !important;
            background-image: none;
            margin: 0 10px 10px 0;
        }
        .btn-category-{{ $category->id }}:active {
            color: {{ $category->text_color }} !important;
            background-color: {{ $category->background_color }} !important;
            border-width: 0;
            background-image: none;
        }
        .btn-category-{{ $category->id }}:hover {
            color: {{ $category->text_color }};
            background-color: {{ $category->background_color }};
            background-image: none;
            border-width: 0;
            filter: brightness(120%);
        }
        .btn-category-{{ $category->id }}:focus {
            color: {{ $category->text_color }};
            background-color: {{ $category->background_color }};
            border-width: 0;
            background-image: none;
        }
        .btn-category-{{ $category->id }}.pressed {
            color: {{ $category->text_color }} !important;
            background-color: {{ $category->background_color }} !important;
            background-image: none;
            box-shadow: 0 0 5px 2px {{ $category->background_color }} !important;
            filter: brightness(120%);
        }
        @endforeach
    </style>
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
                <div class="mb-3">
                    <p class="slogans mb-3"><b>Filtr kategorii</b></p>
                    <div>
                        <b-button-toolbar class="d-flex">
                            <b-button size="sm" variant="primary" @click="setCategory(null)"
                                      style="background-color: #549772;
                                             border-color: #549772;
                                             box-shadow: none !important;
                                             background-image: none;
                                             margin: 0 10px 10px 0">
                                <b>wszystkie</b>
                            </b-button>
                            @foreach ($categories as $category)
                                <b-button size="sm" @click="setCategory({{$category->id}})"
                                          class="btn-category-{{ $category->id }}" :class="category === {{$category->id}} ? 'pressed' : ''">
                                    <b>{{ $category->name }}</b>
                                </b-button>
                            @endforeach
                        </b-button-toolbar>
                    </div>
                </div>

                <div class="ideas">
                    @foreach($ideas as $idea)
                        {{-- Skip hidden ideas. --}}
                        @if ($idea->is_hidden) @continue @endif
                        <div class="card card-idea" v-if="(category === null) || [{{ $idea->getCategoriesString() }}].includes(category)">
                            <div class="card-header">
                                <plus-minus :value-on-load="{{ $idea->plus - $idea->minus }}"
                                            :ajax-url="'/pomysl/{{ $idea->id }}/glos'"
                                            :vote-on-load="{{ $voting_history->getIdeaVote($idea->id) }}"
                                            :key="{{ $idea->id }}">
                                </plus-minus>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="who_when">
                                        Dodano {{ $idea->getCreatedAtForDisplay() }}
                                    </div>
                                    <a href="/pomysl/{{ $idea->id }}" class="btn btn-secondary btn-sm" role="button">Więcej</a>
                                </div>
                                <div>
                                    @foreach ($idea->categories as $category)
                                        <b-badge style="color: {{ $category->text_color }};
                                                        background-color: {{ $category->background_color }}">
                                            {{ $category->name }}
                                        </b-badge>
                                    @endforeach
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

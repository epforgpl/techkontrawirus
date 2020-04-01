@extends('base')

@section('title', "Tech kontra wirus | Pomysł nr $idea->id")

@section('styles')
@endsection

@section('scripts')
    <script src="{{ mix('js/idea.js') }}"></script>
@endsection

@section('content')
    <div id="idea" class="container">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Powrót na stronę główną</a></li>
        </ol>

        @if ($is_new_idea)
            <b-alert variant="primary" :show="true" :dismissible="true">
                Dziękujemy za dodanie pomysłu
            </b-alert>
        @endif
        @if ($has_new_comment)
            <b-alert variant="primary" :show="true" :dismissible="true">
                Dziękujemy za dodanie komentarza
            </b-alert>
        @endif

        <div class="card card-idea card-idea-main">
            <div class="card-header">
                <plus-minus :value-on-load="{{ $idea->plus - $idea->minus }}"
                            :ajax-url="'/pomysl/{{ $idea->id }}/glos'"
                            :vote-on-load="{{ $voting_history->getIdeaVote($idea->id) }}"></plus-minus>
            </div>
            <div class="card-body">
                <div class="who_when">
                    Dodano {{ $idea->getCreatedAtForDisplay() }}
                </div>
                <div>
                    @foreach ($idea->categories as $category)
                        <b-badge style="color: {{ $category->text_color }};
                                        background-color: {{ $category->background_color }}">
                            {{ $category->name }}
                        </b-badge>
                    @endforeach
                </div>
                <h1 class="title"><a href="/pomysl/{{ $idea->id }}">{{ $idea->title }}</a></h1>

                <div class="description pb-4 mb-4">{{ $idea->description }}</div>

                <div class="mb-4"><b>Jaki widzisz problem/potrzebę?</b><br/>{{ $idea->problem }}</div>
                <div class="mb-4"><b>Kogo ten problem dotyczy? Kto miałby skorzystać z rozwiązania?</b><br/>{{ $idea->recipients }}</div>
                <div class="mb-4"><b>Jaką masz propozycję rozwiązania tego problemu czy potrzeby?</b><br/>{{ $idea->solution }}</div>
            </div>
        </div>

        <div class="limit-width">
            <p class="mt-5 mb-5">
                Wykorzystaj komentarze do promowania pomysłu i rozwijania go z innymi. Ustaliliście co chcecie robić?
                Stwórz wątek na <a href="https://forum.kodujdlapolski.pl/c/tech-kontra-wirus">forum Koduj dla Polski</a>
                i umieść link do niego w komentarzach poniżej.
            </p>

            @if ($idea->comments->isNotEmpty())
                <h4 class="mt-4">Komentarze</h4>
            @endif
            @foreach($idea->comments as $comment)
                {{-- Skip hidden comments. --}}
                @if ($comment->is_hidden) @continue @endif
                <div class="card card-idea">
                    <div class="card-header">
                        <plus-minus :value-on-load="{{ $comment->plus - $comment->minus }}"
                                    :ajax-url="'/komentarz/{{ $comment->id }}/glos'"
                                    :vote-on-load="{{ $voting_history->getCommentVote($comment->id) }}"></plus-minus>
                    </div>
                    <div class="card-body">
                        <div class="who_when">Dodano {{ $comment->getCreatedAtForDisplay() }}</div>
                        <div>{{ $comment->content }}</div>
                    </div>
                </div>
            @endforeach

            <h4 class="mt-4">Dodaj komentarz:</h4>
            <form action="/pomysl/{{$idea->id}}/nowy-komentarz" method="post" ref="new-comment" class="mb-2">
                @csrf
                <textarea rows="4" name="content" class="w-100" v-validate="'required|max:500'" data-vv-scope="new-comment"></textarea>
                <p class="text-danger" v-show="errors.has('new-comment.content')">
                    @{{ errors.first('new-comment.content') }}
                </p>
            </form>
            <button class="btn btn-primary" @click="saveComment">Zapisz komentarz</button>
        </div>
    </div>
@endsection

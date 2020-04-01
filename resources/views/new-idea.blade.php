@extends('base')

@section('title', 'Tech kontra wirus | Dodaj swój pomysł')

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
            margin: 0 15px 15px 0;
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
    <script src="{{ mix('js/new-idea.js') }}"></script>
@endsection

@section('content')
    <div id="new-idea" class="container">
        <h3 class="mt-4 mb-5 text-center">Dodaj swój pomysł</h3>

        <form-wizard submit-url="/nowy-pomysl">
            <template v-slot:csrf>@csrf</template>
            <template v-slot:tabs>
                <tab name="Krok 1" info="Zacznij" :selected="true">
                    <div id="form-step-1" >
                        <div class="form-group limit-width">
                            <label for="title"><b>Tytuł (max. 150 znaków)</b></label>
                            <input type="text" name="title" class="form-control" v-validate="'required|max:150'"
                                   data-vv-scope="step1">
                            <p class="text-danger" v-show="errors.has('step1.title')">
                                @{{ errors.first('step1.title') }}
                            </p>
                        </div>
                        <div class="form-group limit-width">
                            <label for="description"><b>Krótki opis (max. 500 znaków)</b></label><br/>
                            <i>Prosimy o krótkie opisanie pomysłu w 2-3 zdaniach.</i><br/><br/>
                            <textarea rows="5" name="description" class="form-control" v-validate="'required|max:500'"
                                      data-vv-scope="step1"></textarea>
                            <p class="text-danger" v-show="errors.has('step1.title') || errors.has('step1.description')">
                                @{{ errors.first('step1.description') }}
                            </p>
                        </div>
                        <div class="form-group limit-width">
                            <label for="categories"><b>Kategorie</b></label><br/>
                            <i>Zaznacz jakich tematów dotyczy pomysł.</i><br/><br/>
                            <div>
                                <b-button-toolbar class="d-flex">
                                    @foreach ($categories as $category)
                                        <b-button size="sm" @click="toggleCategory({{$category->id}})"
                                                  class="btn-category-{{ $category->id }}"
                                                  :class="categories.includes(String({{$category->id}})) ? 'pressed' : ''">
                                            {{ $category->name }}
                                        </b-button>
                                    @endforeach
                                </b-button-toolbar>
                            </div>
                        </div>
                        <input type="hidden" name="categories" ref="categories" value=""/>
                    </div>
                </tab>
                <tab name="Krok 2" info="Co?">
                    <div id="form-step-2">
                        <div class="form-group limit-width">
                            <label for="problem"><b>Na jaki problem czy potrzebę ma odpowiadać proponowane rozwiązanie? (max. 1000 znaków)</b></label><br/>
                            <i>Opisz problem. Uwzględnij kontekst sytuacji i wyzwania. Nie pisz wypracowania, ale pomyśl o różnych czynnikach, które mają wpływ.</i><br/><br/>
                            <textarea name="problem" class="form-control" rows="7" v-validate="'required|max:1000'"
                                      data-vv-scope="step2"></textarea>
                            <p class="text-danger" v-show="errors.has('step2.problem')">
                                @{{ errors.first('step2.problem') }}
                            </p>
                        </div>
                    </div>
                </tab>
                <tab name="Krok 3" info="Kto?">
                    <div id="form-step-3">
                        <div class="form-group limit-width">
                            <label for="recipients"><b>Kogo ten problem dotyczy? Kto miałby skorzystać z rozwiązania? (max. 1000 znaków)</b></label><br/>
                            <i>Napisz kogo dotyka dana sytuacja. Jakie grupy lub instytucje mogłyby pomóc w rozwiązaniu?</i><br/><br/>
                            <textarea name="recipients" class="form-control" rows="7" v-validate="'required|max:1000'"
                                      data-vv-scope="step3"></textarea>
                            <p class="text-danger" v-show="errors.has('step3.recipients')">
                                @{{ errors.first('step3.recipients') }}
                            </p>
                        </div>
                    </div>
                </tab>
                <tab name="Krok 4" info="Jak?">
                    <div id="form-step-4">
                        <div class="form-group limit-width">
                            <label for="solution"><b>Jaką masz propozycje rozwiązania opisanego wyżej problemu czy potrzeby? (max. 1000 znaków)</b></label><br/>
                            <i>Czy masz pomysł na narzędzie opierające się o technologie cyfrowe? Jakie inne rozwiązania widzisz?</i><br/><br/>
                            <textarea name="solution" class="form-control" rows="7" v-validate="'required|max:1000'"
                                      data-vv-scope="step4"></textarea>
                            <p class="text-danger" v-show="errors.has('step4.solution')">
                                @{{ errors.first('step4.solution') }}
                            </p>
                        </div>
                    </div>
                </tab>
            </template>
        </form-wizard>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{ route('home') }}" class="text-body hover:text-pink text-xs">Главная</a></li>
                <li><a href="{{ route('catalog') }}" class="text-body hover:text-pink text-xs">Каталог</a></li>
            </ul>

            <section>
                <!-- Section heading -->
                <h2 class="text-lg lg:text-[42px] font-black">Категории</h2>

                <!-- Categories -->
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
                    @each('catalog.shared.category', $categories, "category")
                </div>
            </section>

            <section class="mt-16 lg:mt-24">
                <!-- Section heading -->
                <h2 class="text-lg lg:text-[42px] font-black">Каталог товаров</h2>

                <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8 ">

                    <!-- Filters -->
                    <aside class="basis-2/5 xl:basis-1/4 ">
                        <form action="{{ route('catalog', $category) }}" class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-10 p-6 2xl:p-8 rounded-2xl bg-card">
                            <!-- Filters item -->
                            <div>
                                <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цена</h5>
                                <div class="flex items-center justify-between gap-3 mb-2">
                                    <span class="text-body text-xxs font-medium">От, ₽</span>
                                    <span class="text-body text-xxs font-medium">До, ₽</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <input
                                        name="filters[price][from]"
                                        value="{{request('filters.price.from') ? request('filters.price.from') : 0 }}"
                                        min="0"
                                        type="number"
                                        class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                        placeholder="От">
                                    <span class="text-body text-sm font-medium">–</span>

                                    <input
                                        name="filters[price][to]"
                                        value="{{request('filters.price.to') ? request('filters.price.to') : 1000000}}"
                                        type="number"
                                        class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                        placeholder="До">
                                </div>
                            </div>
                            <!-- Filters item -->
                            <div>
                                <h5 class="mb-4 text-sm 2xl:text-md font-bold">Бренд</h5>

                                @foreach($brands as $brand)
                                    <div class="form-checkbox">
                                        <input
                                            name="filters[brands][{{ $brand->id }}]"
                                            @checked(request('filters.brands.' . $brand->id))
                                            type="checkbox"
                                            id="filters-item-{{ $brand->id }}"
                                        >
                                        <label for="filters-item-{{ $brand->id }}" class="form-checkbox-label">{{$brand->title}}</label>
                                    </div>
                                @endforeach


                            </div>
                            <!-- Filters item -->
                            <div>
                                <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цвет</h5>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-9">
                                    <label for="filters-item-9" class="form-checkbox-label">Белый</label>
                                </div>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-10">
                                    <label for="filters-item-10" class="form-checkbox-label">Чёрный</label>
                                </div>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-11">
                                    <label for="filters-item-11" class="form-checkbox-label">Желтый</label>
                                </div>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-12">
                                    <label for="filters-item-12" class="form-checkbox-label">Розовый</label>
                                </div>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-13">
                                    <label for="filters-item-13" class="form-checkbox-label">Красный</label>
                                </div>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-14">
                                    <label for="filters-item-14" class="form-checkbox-label">Серый</label>
                                </div>
                            </div>
                            <!-- Filters item -->
                            <div>
                                <h5 class="mb-4 text-sm 2xl:text-md font-bold">Подсветка</h5>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-7">
                                    <label for="filters-item-7" class="form-checkbox-label">Без подсветки</label>
                                </div>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="filters-item-8">
                                    <label for="filters-item-8" class="form-checkbox-label">З подсветкой</label>
                                </div>
                            </div>
                            {{-- Сохраняем заданные фильтры чтобы потом не пришлось заново выбирать фильтры.--}}
                            <div>
                                <input type="hidden"  value="{{ request('sort') ? request('sort') : "" }}" name="sort">
                            </div>
                            <div>
                                <button type="submit" class="w-full !h-16 btn btn-outline mb-1.5">Применить</button>
                                <button type="reset" class="w-full !h-16 btn btn-outline">Сбросить фильтры</button>
                            </div>
                        </form>
                    </aside>

                    <div class="basis-auto xl:basis-3/4">
                        <!-- Sort by -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('catalog') }}" class="pointer-events-none inline-flex items-center justify-center w-10 h-10 rounded-md bg-card text-pink">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                                            <path fill-rule="evenodd" d="M2.6 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 49.4V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM31.2 0h18.2A2.6 2.6 0 0 1 52 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V2.6A2.6 2.6 0 0 1 31.2 0Zm15.6 18.2v-13h-13v13h13ZM31.2 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM2.6 0h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 20.8V2.6A2.6 2.6 0 0 1 2.6 0Zm15.6 18.2v-13h-13v13h13Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="text-body text-xxs sm:text-xs">Найдено: {{ $products->total() }} товаров</div>
                            </div>
                            <div x-data="{}" class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <span class="text-body text-xxs sm:text-xs">Сортировать по</span>

                                <form x-ref="sortForm" action="{{ route('catalog', $category) }}">
                                    <select
                                        name="sort"
                                        x-on:change="$refs.sortForm.submit()"
                                        class="form-select w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xxs sm:text-xs shadow-transparent outline-0 transition">
                                        <option value="" class="text-dark">умолчанию</option>
                                        <option @selected(request('sort') == '+price') value="+price" class="text-dark">от дешевых к дорогим</option>
                                        <option @selected(request('sort') == '-price') value="-price" class="text-dark">от дорогих к дешевым</option>
                                        <option @selected(request('sort') == 'title') value="title" class="text-dark">наименованию</option>
                                    </select>
                                    <div>

                                        {{-- Если в запросе есть фильтр брендов/цены, то сохраняем их,
                                            чтобы при применнении других фильтрова, нынешние не слетели
                                         --}}
                                        @if(request('filters') !== null)
                                            @if(array_key_exists('brands', request('filters')))
                                                @foreach(request('filters.brands') as $brandId => $on)
                                                        <input type="hidden" value="on"  name="filters[brands][{{ $brandId }}]">
                                                @endforeach
                                            @endif
                                        @endif

                                        <input type="hidden"  value="{{ request('filters.price.from') }}" name="filters[price][from]">
                                        <input type="hidden"  value="{{ request('filters.price.to') }}" name="filters[price][to]">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Products list -->
                        <div class="products grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-6 2xl:gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12">
                            @each('catalog.shared.product', $products, "product")
                        </div>

                        <!-- Page pagination -->
                        <div class="mt-12">
                            {{$products->withQueryString()}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

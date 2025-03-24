<div class="">
    <button class="btn btn-primary mb-3" wire:click="openYear">
        فتح عام جيد
    </button>
    <div class="mb-3">
        @if($activeYear != null)
            <div class="accordion " id="accordion-example">
                <div class="accordion-item">
                    <div class="row">
                        <h2 class="accordion-header row align-items-center p-2 p-sm-0 justify-content-center"
                            id="heading-1">
                            <div class="card cursor-pointer col-1 p-1 rounded-circle ms-2" {{ $activeYear->is_show ? '' :
                                "wire:click=updateIsShow($activeYear->id)" }}
                                style="width: 25px;">
                                <div class="rounded-circle {{ $activeYear->is_show ? 'bg-green' : '' }}"
                                    style="width: auto; height: 15px">
                                </div>
                            </div>
                            <button class="accordion-button col-8 col-lg-11 col-md-10 col-ms-9 collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse-{{ $activeYear->id }}"
                                aria-expanded="false" style="width: 90% !important">
                                العام {{ $activeYear->year }}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-{{ $activeYear->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordion-example" style="">
                        <div class="accordion-body pt-0 ms-2 ms-sm-5 indent-5">
                            <div class="row gap-2 ps-2 ms-2 ms-sm-5"
                                style=" border-right: 2px solid; margin-inline-start: 100px">
                                <div class="col-12 p-2 cursor-pointer {{ $activeYear->terms[0]->is_active && $activeYear->is_show ? 'card' : '' }}"
                                    {{ $activeYear->terms[0]->is_active && !$activeYear->is_show ? '' :
                                    'wire:click=toggleActiveTerm(' . $activeYear->terms[0]->id . ')' }}>
                                    <strong>{{ App\Enums\Terms::First->getValue() }}</strong>
                                </div>
                                <div class="col-12 p-2 cursor-pointer {{ $activeYear->terms[1]->is_active && $activeYear->is_show ? 'card' : '' }}"
                                    {{ $activeYear->terms[1]->is_active && !$activeYear->is_show ? '' :
                                    'wire:click=toggleActiveTerm(' . $activeYear->terms[1]->id . ')' }}>
                                    <strong>{{ App\Enums\Terms::Second->getValue() }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse (($years ?? []) as $year)
        <div class="accordion" id="accordion-example">
            <div class="accordion-item">
                <div class="row">
                    <h2 class="accordion-header row align-items-center p-2 p-sm-0 justify-content-center"
                        id="heading-1">
                        <div class="card cursor-pointer col-1 p-1 rounded-circle ms-2" style="width: 25px;" {{ $year->
                            is_show ? '' : "wire:click=updateIsShow($year->id)" }}>
                            <div class="rounded-circle {{ $year->is_show ? 'bg-green' : '' }}"
                                style="width: auto; height: 15px">
                            </div>
                        </div>
                        <button class="accordion-button col-8 col-lg-11 col-md-10 col-ms-9 collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $year->id }}" aria-expanded="false"
                            style="width: 90% !important">
                            العام {{ $year->year }}
                        </button>
                    </h2>
                </div>
                <div id="collapse-{{ $year->id }}" class="accordion-collapse collapse"
                    data-bs-parent="#accordion-example" style="">
                    <div class="accordion-body pt-0 ms-2 ms-sm-5 indent-5">
                        <div class="row gap-2 ps-2 ms-2 ms-sm-5"
                            style=" border-right: 2px solid; margin-inline-start: 100px">
                            <div
                                class="col-12 cursor-pointer p-2 {{ $year->terms[0]->is_active && $year->is_show ? 'card' : '' }}">
                                <strong {{ $year->terms[0]->is_active || !$year->is_show ? '' :
                                    'wire:click=toggleActiveTerm(' . $year->terms[0]->id . ')' }}>{{
                                    App\Enums\Terms::First->getValue() }}</strong>
                            </div>
                            <div
                                class="col-12 p-2 cursor-pointer {{ $year->terms[1]->is_active && $year->is_show ? 'card' : '' }}">
                                <strong {{ $year->terms[1]->is_active || !$year->is_show ? '' :
                                    'wire:click=toggleActiveTerm(' . $year->terms[1]->id . ')' }}>{{
                                    App\Enums\Terms::Second->getValue() }}</strong>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button wire:click='updateIsActive({{ $year->id }})' class="btn btn-primary">تفعيل</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>

    <div class="card-footer d-flex align-items-center flex-wrap row-gap-4">
        <p class="m-0 text-secondary">
            عرض <span>{{ $paginate->firstItem }}</span> إلى
            <span>{{ $paginate->lastItem }}</span> من إجمالي <span>{{ $paginate->total }}</span>
            إدخالاً
        </p>

        @if ($paginate->lastPage > 1)
        <ul class="pagination m-0 ms-auto d-block d-flex flex-wrap">

            <!-- زر الصفحة التالية -->
            <li class="page-item {{ $paginate->hasMorePages ? '' : 'disabled' }}">
                <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $paginate->currentPage + 1 }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                    <span class="d-none d-sm-inline">التالي</span>
                </a>
            </li>

            <!-- أزرار الصفحات -->
            @foreach ($paginate->pages as $page => $url)
            @if ($url !== '...')
            <li class="page-item {{ $url == $paginate->currentPage ? 'active' : '' }}">
                <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $url }}, '{{ $paginate->getPageName }}')">
                    {{ $url }}
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <a class="page-link" href="#">
                    {{ $url }}
                </a>
            </li>
            @endif
            @endforeach

            <!-- زر الصفحة السابقة -->
            <li class="page-item {{ $paginate->onFirstPage ? 'disabled' : '' }}">
                <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $paginate->currentPage - 1 }})">
                    <span class="d-none d-sm-inline">السابق</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 6l-6 6l6 6"></path>
                    </svg>
                </a>
            </li>
        </ul>
        @endif
    </div>
</div>

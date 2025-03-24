<div>
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                عرض
                <div class="mx-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" wire:model="perPage"
                        wire:keydown.enter="changePerpage" value="8" size="3" aria-label="عدد القاعات">
                </div>
                مدخلات
            </div>
            <div class="ms-auto text-secondary">
                بحث:
                <div class="ms-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" wire:model.lazy="search"
                        aria-label="بحث عن قاعة">
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>رقم.</th>
                    <th>اسم القاعة</th>
                    <th>السعة</th>
                    <th>هل توجد شاشة</th>
                    <th>الوصف</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($halls as $hall)
                @livewire('hall.hall-row',['hall'=>$hall],key($hall->id))
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center flex-wrap row-gap-4">
        <p class="m-0 text-secondary">
            عرض <span>{{ $paginate->firstItem }}</span> إلى
            <span>{{ $paginate->lastItem }}</span> من إجمالي <span>{{ $paginate->total }}</span> إدخالاً
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
    <div class="position-fixed w-100 h-100 top-0  loading-box" style="right: 0;" wire:loading wire:target='gotoPage, search, changePerpage'>
        <x-loading />
    </div>
</div>

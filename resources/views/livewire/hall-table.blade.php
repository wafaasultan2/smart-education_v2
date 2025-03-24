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

            <div class="ms-auto me-2">
                <select class="form-select" wire:model="screen" wire:change="changeScreen" style="
                            width: 150px;
                             height: 24px;
                             padding: 0 10px;
                          ">
                    <option value="all">الكل</option>
                    <option value="screen">شاشة</option>
                    <option value="no_screen">بدون شاشة</option>
                </select>
            </div>
            <div class="text-secondary">
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
                    <th>أسم القاعة</th>
                    <th>السعة</th>
                    <th>شاشة</th>
                    <th>8-10</th>
                    <th>10-12</th>
                    <th>12-2</th>
                    <th>2-4</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classRooms as $classRoom)
                <tr>
                    <td>{{ $classRoom->id }}</td>
                    <td>{{ $classRoom->name }}</td>
                    <td>{{ $classRoom->capacity }}</td>
                    <td>
                        @if ($classRoom->is_screen)
                        <span class="badge bg-success p-2"></span>
                        @else
                        <span class="badge bg-danger p-2"></span>
                        @endif
                    </td>
                    @foreach ($classRoom->times as $time)
                    <td>
                        <span class="badge {{ $time === 'فاضي' ? 'bg-success' : 'bg-danger' }} me-1"></span>
                        {{ $time }}
                    </td>
                    @endforeach
                </tr>
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

</div>

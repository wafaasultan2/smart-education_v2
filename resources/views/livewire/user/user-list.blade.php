<div>
    <div class="row row-cards">
        @forelse ($users as $user)
            @livewire('user.user-card', ['user' => $user], key($user->id))
        @empty
        @endforelse
    </div>

    <div class="card-footer d-flex align-items-center flex-wrap row-gap-4 mt-4">
        <p class="m-0 text-secondary">
            عرض <span>{{ $paginate->firstItem }}</span> إلى
            <span>{{ $paginate->lastItem }}</span> من إجمالي <span>{{ $paginate->total }}</span> إدخالاً
        </p>

        @if ($paginate->lastPage > 1)
            <ul class="pagination m-0 ms-auto d-block d-flex flex-wrap">

                <!-- زر الصفحة التالية -->
                <li class="page-item {{ $paginate->hasMorePages ? '' : 'disabled' }}">
                    <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $paginate->currentPage + 1 }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
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
                            <a class="page-link" href="#"
                                wire:click.prevent="gotoPage({{ $url }}, '{{ $paginate->getPageName }}')">
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
                    <a class="page-link" href="#"
                        wire:click.prevent="gotoPage({{ $paginate->currentPage - 1 }})">
                        <span class="d-none d-sm-inline">السابق</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
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

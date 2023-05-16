@if ($paginator->hasPages())
    <div class="pagination flex md:justify-end justify-center">
        <div class="mt-6 flex items-center bg-white border-[#DEE2E6] border rounded-lg divide-x divide-[#DEE2E6]">
            @if ($paginator->onFirstPage() && $paginator->currentPage() > 1)
                <div class="px-2 md:px-4 py-1 cursor-pointer btn-prev hover:bg-[#006FFD] rounded-tl-lg rounded-bl-lg">
                    <a href="{{ $paginator->url(1) }}">
                        <svg width=" 29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.4463 12.6308L15.7546 14.6044L17.4463 16.5781" stroke="#3A57E8"
                                  stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.4014 12.6308L12.7096 14.6044L14.4014 16.5781" stroke="#3A57E8"
                                  stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            @elseif($paginator->currentPage() == 1 && $paginator->onFirstPage())
                <div class="px-2 md:px-4 py-1     rounded-tl-lg rounded-bl-lg" style="cursor: default">
                    <svg width=" 29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.4463 12.6308L15.7546 14.6044L17.4463 16.5781" stroke="#3A57E8"
                              stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.4014 12.6308L12.7096 14.6044L14.4014 16.5781" stroke="#3A57E8"
                              stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            @else
                <div class="px-2 md:px-4 py-1 cursor-pointer  btn-prev hover:bg-[#006FFD]   rounded-tl-lg rounded-bl-lg">
                    <a href="{{ $paginator->previousPageUrl() }}#sp">
                        <svg width=" 29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.4463 12.6308L15.7546 14.6044L17.4463 16.5781" stroke="#3A57E8"
                                  stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.4014 12.6308L12.7096 14.6044L14.4014 16.5781" stroke="#3A57E8"
                                  stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            @endif
            @if($paginator->currentPage() > 3)
                <div
                    class="hidden-xs px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8]  hover:text-white cursor-pointer">
                    <a href="{{ $paginator->url(1) }}" class="leading-[28px] text-sm md:text-base">1</a>
                </div>
            @endif
            @if($paginator->currentPage() > 4)
                <div
                    class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] hover:text-white cursor-pointer">
                    <p class="leading-[28px] text-sm md:text-base">...</p>
                </div>
            @endif
            @foreach(range(1, $paginator->lastPage()) as $i)
                @if($paginator->lastPage() < 5)
                    @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                        @if ($i == $paginator->currentPage())
                            <div
                                class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] page-active hover:text-white cursor-pointer">
                                <a class="leading-[28px] text-sm md:text-base">{{ $i }}</a>
                            </div>
                        @else
                            <div
                                class="hidden-xs px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] hover:text-white cursor-pointer">
                                <a href="{{ $paginator->url($i) }}#sp"
                                   class="leading-[28px] text-sm md:text-base">{{ $i }}</a>
                            </div>
                        @endif
                    @endif
                @else
                    @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                        @if ($i == $paginator->currentPage())
                            <div
                                class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] page-active hover:text-white cursor-pointer">
                                <a class="leading-[28px] text-sm md:text-base">{{ $i }}</a>
                            </div>
                        @else
                            <div
                                class="hidden-xs px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8]  hover:text-white cursor-pointer">
                                <a href="{{ $paginator->url($i) }}#sp"
                                   class="leading-[28px] text-sm md:text-base">{{ $i }}</a>
                            </div>
                        @endif
                    @endif
                @endif

            @endforeach
            @if($paginator->currentPage() < $paginator->lastPage() - 3)
                    <div
                        class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] hover:text-white cursor-pointer">
                        <p class="leading-[28px] text-sm md:text-base">...</p>
                    </div>
                @endif
            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                    <div
                        class="hidden-xs px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8]  hover:text-white cursor-pointer">
                        <a href="{{ $paginator->url($paginator->lastPage()) }}#sp"
                           class="leading-[28px] text-sm md:text-base">{{ $paginator->lastPage() }}</a>
                    </div>
            @endif
            @if ($paginator->hasMorePages())
                    <div class="px-2 md:px-4 py-1 cursor-pointer  btn-prev hover:bg-[#006FFD]  rounded-tr-lg rounded-br-lg">
                        <a href="{{ $paginator->nextPageUrl() }}#sp" rel="next">
                            <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9209 12.6308L13.6126 14.6044L11.9209 16.5781" stroke="#3A57E8" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14.9658 12.6308L16.6576 14.6044L14.9658 16.5781" stroke="#3A57E8" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
            @else
                    <div class="px-2 md:px-4 py-1 rounded-tr-lg rounded-br-lg">
                        <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9209 12.6308L13.6126 14.6044L11.9209 16.5781" stroke="#3A57E8" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.9658 12.6308L16.6576 14.6044L14.9658 16.5781" stroke="#3A57E8" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
            @endif
        </div>
    </div>
@endif

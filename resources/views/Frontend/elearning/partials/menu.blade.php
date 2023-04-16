<div class="main-nav-wrap">
    <div class="mobile-overlay"></div>

    <ul class="mobile-main-nav">
        <div class="mobile-menu-helper-top"></div>
        <li class="has-children">
            <a href="">
                <i class="fas fa-th d-inline"></i>
                <span>Categories</span>
                <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
            </a>

            <ul class="category corner-triangle top-left is-hidden">
                <li class="go-back">
                    <a href=""><i class="fas fa-angle-left"></i>Menu</a>
                </li>

                <li class="has-children">
                <li>
                    @foreach(allCategory() as $category)
                        <a href="{{route('search-course-by-category', $category->slug)}}">
                            <span class="icon"><i class="fa fa-caret-right"></i></span>
                            <span>{{ $category->category_name  }}</span>
                        </a>
                    @endforeach
                </li>

            </ul>
        </li>

        <div class="mobile-menu-helper-bottom"></div>
    </ul>
</div>
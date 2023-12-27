{{-- navbar component.
call or use this component with @include('layout.nav'), --}}


<nav class="myflex myalign-items-center myjustify-content-spaceBetween" id="nav">
    <div class=" d-flex flex-row " id="nav-left">
        <a href="#" class="navbar-brand">
             <img src="" alt="Logo">
        </a>
        <span class="fs-4">24-1</span>
    </div>
    <div class="myflex myalign-items-center myjustify-content-right" id="nav-right">
        <ul class="myflex myliststyle-none m-0 myjustify-content-right" id="nav-ul-right">
            <li class="mynavBtn"><a href="" class="mynavBtn">item1</a></li>
            <li class="mynavBtn"><a href="" class="mynavBtn">item2</a></li>
            <li class="mynavBtn"><a href="" class="mynavBtn">item3</a></li>
            <li class="mynavBtn"><a href="" class="mynavBtn">item4</a></li>
        </ul>
    </div>
</nav>

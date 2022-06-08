<nav id="navigation" class="bg-bluegray h-full w-full">
    <ul class="d-flex flex-column">
        <li class="px-1 position-relative d-block <?= $active=='websites'?'active':'' ?>">
            <a href="/admin/websites">
                <i class="icon-globe"></i>
                <span class="ml-1 d-none d-md-block">Websites</span>
            </a>
        </li>
        <li class="px-1 position-relative d-block <?= $active=='banners'?'active':'' ?>">
            <a href="/admin/banners">
                <i class="icon-card"></i>
                <span class="ml-1 d-none d-md-block">Banners</span>
            </a>
        </li>
    </ul>
</nav>
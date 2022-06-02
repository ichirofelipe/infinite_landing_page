<nav id="navigation" class="bg-bluegray">
    <div class="container container--full">
        <div class="d-flex justify-between align-items-center py-2">
            <a href="/admin" class="logo">
                Admin ILP
            </a>
            

            <div class="menu-btn d-flex d-sm-none">
                <div class="menu-btn__burger" data-target="#menu">
                </div>
            </div>
            <ul id="menu" class="align-items-center d-flex">
                <li id="account" class="px-1 position-relative d-none d-sm-block mr-sm-1">
                    
                    <a class="d-flex flex-column align-items-center" href="javascript:void(0)">
                        <span class="icon-user-1 overflow-hidden"></span>
                        <?php if($admin){ ?>
                        <p class="m-0 badge"><?= $admin['admin_username'] ?></p>
                        <?php } ?>
                    </a>
                    <ul class="dropdown dropdown--align-right">
                        <li>
                            <form method="POST" action="/logout-request">
                                <button name="admin" class="text-plain" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="px-1 d-flex d-sm-none">
                    <a href="/post">Change Password</a>
                </li>
                <li class="px-1 d-flex d-sm-none">
                    <form class="w-full" method="POST" action="/logout-request">
                        <button name="admin" class="text-plain" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
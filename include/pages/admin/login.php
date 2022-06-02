<div class="container">
    <div>
        <h1 class="title title--md text-center">Admin ILP</h1>
        <article class="card">
            <div class="card__body text-center">
                <h4 class="card__title title--sm text-bold m-0">Login</h4>
                <div class="divider"></div>
                <form class="form--validate text-left" method="POST" action="/adminlogin-request">
                    <div class="form__group form__group--append">
                        <span class="icon-user-1"></span>
                        <input data-fieldname="Username" data-rules="required" type="text" name="username" placeholder="Username *">
                    </div>
                    <div class="form__group form__group--append">
                        <span class="icon-lock"></span>
                        <input data-fieldname="Password" data-rules="required" class="password" id="password" type="password" name="password" placeholder="Password *">
                        <label for="password" class="icon-eye form__toggle-password"></label>
                    </div>

                    <div class="form__actions">
                        <button name="admin" type="submit" class="form__submit d-block">Continue</button>
                        <a class="color-default d-block mt-1" href="/admin/signup">Create New Account</a>
                    </div>
                </form>
            </div>
        </article>
    </div>
</div>
<body id="public">
    <div class="container container-centered">
        <div class="box">
            <form action="<?= URL; ?>users/login/" method="POST">
                <header class="box-header row">
                    <div class="large-12 column center">
                        <h1>Urban</h1>
                        <h3>please login below</h3>
                    </div>
                </header>
                <div class="row">
                    <!-- Email Input -->
                    <div class="input-container">
                        <i class="fa fa-envelope"></i>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" />
                    </div>
                    <!-- Password Input -->
                    <div class="input-container">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" />
                    </div>
                </div>
                <footer class="box-footer row row-inline-input">
                    <div class="small-12 medium-8 large-8 columns">
                        <input type="hidden" name="remember_login" data-input="remember_login" value="0" />
                        <label class="input-checkbox-label">
                            <span class="input-checkbox" data-input="remember_login"></span>
                            Remember Me?
                        </label>
                    </div>
                    <div class="small-12 medium-4 large-4 columns">
                        <button id="submit" class="large-12 fill button button-primary">
                            Login
                        </button>
                    </div>
                </footer>
            </form>
        </div>
        <footer class="copyright center">
            2014 &copy; urban.wiki
        </footer>
    </div>
</body>
<div class="content-w3ls">
    <div class="agileits-grid">
        <div class="content-top-agile">
            <h2>Login to core</h2>
        </div>
        <div class="content-bottom">
            <form role="login" action="{{url('admin/authenticate')}}" method="post">
                <div class="field_w3ls">
                    <div class="field-group">
                        <input name="email" id="text1" type="text" value="" placeholder="username" required>
                    </div>
                    <div class="field-group">
                        <input id="password-field" type="password" class="form-control" name="password" value="" placeholder="Password">
                    </div>
                </div>
                <div class="wthree-field">
                    <button type="button" data-request="ajax-submit" data-target='[role="login"]'> Login </button>
                </div>
                <ul class="list-login">
                    <li>
                        <a href="#" class="text-right">forgot password?</a>
                    </li>
                    <li class="clearfix"></li>
                </ul>
            </form>
        </div>
        <!-- //content bottom -->
    </div>
</div>
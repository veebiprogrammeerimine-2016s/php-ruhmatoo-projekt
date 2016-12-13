<form id="log" method="POST">
    <div id="login" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Logi sisse</h4>
                </div>
                <div class="modal-body">
                    <p id="login-error">Invalid username or password!</p>
                    <div class="form-group">
                        <input name="username" type="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                    </div>

                    <input type="hidden" name="submit" value="submit" />

                </div>
                <div class="modal-footer">
                    <button id="submit-login" type="button" class="btn btn-primary btn-block">Logi sisse</button>
                    <div class="row">
                        <div id="sign-up-form-body">
                            Pole kontot? <a data-toggle="modal" data-target="#register" data-dismiss="modal" style="cursor:pointer">Registreeru!</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<?php


?>

<form id="reg" method="POST">
    <div id="register" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Loo kasutaja</h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="regUsername" type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="regPassword" type="password" class="form-control"
                               aria-describedby="passwordHelpBlock" id="exampleInputPassword1" placeholder="Password">
                        <p id="passwordHelpBlock" class="form-text text-muted">
                            Parool peab olema vahemalt 8 sumboli pikkune
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button id="butt" type="submit" class="btn btn-primary">Registreerun</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>



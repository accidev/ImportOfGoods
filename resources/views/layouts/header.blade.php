<?php
use App\Http\Controllers\GoodController;
$total=0;
if(Session::has('user'))
{
    $total= GoodController::cartItem();
}

?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="{{ route('upload.file') }}" style="color: #f2f2f2;">Загрузить файл</a></li>
                <li><a href="{{ route('goods') }}" style="color: #f2f2f2;">Все товары</a></li>
            </ul>
        </div>
    </div>
</nav>

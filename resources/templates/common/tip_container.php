<?php
echo <<<TAG
<div class="container tip-container">
    <h2 class="">
        <span class="glyphicon glyphicon-info-sign text-muted"></span>
        <br/>
        {$get('title')}
    </h2>
    <small>
        <span class="glyphicon glyphicon-ok text-muted"></span>
        {$get('tip')}
    </small>
    </div>
</div>
TAG;


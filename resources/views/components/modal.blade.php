<div {{$attributes->merge([
    'class'=>'modal fade',
    'data-backdrop'=>'static',
    'data-keyboard'=>'false',
    'id'=> 'modal-form',
    'tabindex'=> '-1',
    'aria-labelledby'=>'exampleModalLabel',
    'aria-hidden'=>'true',
    ])}}>

    <div class="modal-dialog {{isset($size) ? $size : 'modal-lg'}}">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
              @csrf
              @method('POST')
                @isset($title)
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endisset

                <div class="modal-body">
                    {{$slot}}
                </div>

                @isset($footer)
                <div class="modal-footer">
                    {{$footer}}
                </div>
                @endisset
            </form>
        </div>
    </div>
</div>

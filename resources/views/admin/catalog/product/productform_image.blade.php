@php
    $image_path = '/media/product/thumb/';
@endphp
<div class="form-group">
    <button id="addMoreImage" class="btn btn-info" style="margin-bottom: 10px">Add Image</button>

    <div class="input-image-group" style="display: block">       
        {{ Form :: file('base_image[]') }}
    </div>

    <div class="gallery-item">
        <ul style="list-style:none" class="admin-gallery">
            @if(count($images) > 0 )
                @foreach($images as $image)
                    @if(!empty($image['path']))
                       <li id=" {{$image['id']}} "><img src="{{asset($image_path.$image['path']) }}" width="100px">
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>
<script>
    $('.imageUpload').click(function (e) {
        e.preventDefault();
        $('.imgInp').trigger('click');
    });

    $('#addMoreImage').click(function (e) {
        e.preventDefault();
        var html = ' <div class="input-image-group" style="display: block"> <input type="file" class="imgInp" name="base_image[]"></div>';
        $('.input-image-group').append(html);
    })

</script>
                    

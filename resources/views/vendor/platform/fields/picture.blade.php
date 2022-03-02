@component($typeForm, get_defined_vars())
    <div data-controller="picture"
         data-picture-value="{{ $attributes['value'] }}"
         data-picture-storage="{{ $storage ?? 'public' }}"
         data-picture-target="{{ $target }}"
         data-picture-url="{{ $url }}"
         data-picture-max-file-size="{{ $maxFileSize }}"
         data-picture-accepted-files="{{ $acceptedFiles }}"
         data-picture-groups="{{$attributes['groups'] ?? ''}}"
    >
        <div class="border-dashed text-center p-3 picture-actions">

            <div class="fields-picture-container">
                <img src="#" class="picture-preview img-fluid mb-2 border" alt="">
            </div>
        </div>

        <input class="picture-path d-none"
               type="text"
               data-target="picture.source"
               {{ $attributes }}
        >
    </div>
@endcomponent
@foreach($types as $type)
    <li data-id="{{ $type->id }}" data-name="{{ $type->name }}" class="type-plate-single-item type-plate-single-checked">{{ $type->name }} <span class="type-checked-icon type-plate-icon-{{ $type->id }}"></span></li>
@endforeach

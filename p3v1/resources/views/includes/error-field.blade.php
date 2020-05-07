@if($errors->get($fieldName))
<div usk='error-field-{{ $fieldName }}' class='alert alert-danger error'>
    {{ $errors->first($fieldName) }}
</div>
@endif